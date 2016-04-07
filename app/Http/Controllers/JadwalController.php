<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateJadwalDayshiftRequest;
use App\Http\Requests\CreateJadwalShiftRequest;
use App\Http\Controllers\Controller;

use App\Jadwal;
use App\JadwalDetail;
use Auth;
use Yajra\Datatables\Datatables;

use DateTime;
use DateInterval;
use DatePeriod;

class JadwalController extends Controller
{
    private $menu;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        $this->menu   = $this->parentMenu('jadwalkerja');
    }
    
    public function show()
    {
        return view('admin.jadwal.show',['menu'=>$this->menu]);
    }    
    
    
    public function create_dayshift()
    {
        return view('admin.jadwal.createdayshift',['menu'=>$this->menu]);
    }
    
    public function create_shift()
    {
        return view('admin.jadwal.createshift',['menu'=>$this->menu]);
    }
    
    public function edit_dayshift($id, Jadwal $jadwal, JadwalDetail $jadwaldetail)
    {
        $jadwal         = $jadwal->with('jadwal_detail')->first();        
        
        $jadwal_detail  = $jadwaldetail->select('waktu_id','hari')->where('jadwal_id',$jadwal->id)->get();
        
        foreach($jadwal_detail as $jd)
        {
            $jadwal->{$jd->hari}     = $jd->waktu_id;
        }
        
        return view('admin.jadwal.editdayshift',compact('jadwal'))->with(['menu'=>$this->menu]);
    }
    
    public function edit_shift($id, Jadwal $jadwal)
    {
        $jadwal         = $jadwal->with('jadwal_detail')->first(); 
                
        return view('admin.jadwal.editshift',compact('jadwal'))->with(['menu'=>$this->menu]);
    }
    
    public function save_dayshift(CreateJadwalDayshiftRequest $request, Jadwal $jadwal, JadwalDetail $jadwaldetail)
    {
        $data   = $request->all();
        
        $dataMaster['jadwal_kode']      = $data['jadwal_kode'];
        $dataMaster['jadwal_tipe']      = 'D';
        $dataMaster['created_by']       = Auth::user()->id;
        $dataMaster['updated_by']       = Auth::user()->id;
        
        /*
         * save master
         */
        $mId    = $jadwal->create($dataMaster);
        
        $days   = array('mon','tue','wed','thu','fri','sat','sun');
        
        foreach($days as $day)
        {
            $jadwaldetail->create(['jadwal_id'=>$data[$day], 'waktu_id'=>$mId->id, 'hari'=>$day]);
        }
        
        return redirect()->route('jadwal.tabel');
    }
    
    public function save_shift(CreateJadwalShiftRequest $request, Jadwal $jadwal, JadwalDetail $jadwaldetail)
    {
        $data   = $request->all();
        
        $dataMaster['jadwal_kode']      = $data['jadwal_kode'];
        $dataMaster['jadwal_tipe']      = 'S';
        $dataMaster['created_by']       = Auth::user()->id;
        $dataMaster['updated_by']       = Auth::user()->id;
        
        /*
         * save master
         */
        $mId    = $jadwal->create($dataMaster);
        
        $listshift = (array)json_decode($data['listshift'],true);
        
        $detail = $this->parsingDetail($listshift, $mId->id);
        
        foreach($detail as $v)
        {
            $editDet    = $jadwaldetail->whereJadwal_id($v['jadwal_id'])->whereWaktu_id($v['waktu_id'])->whereTanggal($v['tanggal'])->first();
            if($editDet)
            {
                $editDet->fill($v)->save();
            }
            else
            {
                $jadwaldetail->create($v);
            }
        }
        return redirect()->route('jadwal.tabel');
    }
    
    public function update_dayshift($id, Request $request, Jadwal $jadwal, JadwalDetail $jadwaldetail)
    {
        $data   = $request->all();
        
        /*
         * update master
         */
        $dataM  = array('_method' => 'PATCH', '_token' => $data['_token'], 'jadwal_kode' => $data['jadwal_kode']);
        $edit    = $jadwal->whereId($id)->first();
        
        /*
         * update detail
         */
        $days   = array('mon','tue','wed','thu','fri','sat','sun');
        $edit->fill($dataM)->save();
        
        foreach($days as $day)
        {
            $editDetail = $jadwaldetail->where('jadwal_id',$id)->where('hari',$day)->first();
            $dataD  = array('_method' => 'PATCH', '_token' => $data['_token'], 'waktu_id' => $data[$day]);
            
            $editDetail->fill($dataD)->save();
        }
        
       
       return redirect()->route('jadwal.tabel');
    }
    
    public function update_shift($id, Request $request, Jadwal $jadwal, JadwalDetail $jadwaldetail)
    {
        $data   = $request->all();
        
        /*
         * update master
         */
        $dataM  = array('_method' => 'PATCH', '_token' => $data['_token'], 'jadwal_kode' => $data['jadwal_kode']);
        $edit    = $jadwal->whereId($id)->first();
        
        /*
         * update detail
         */
        $listshift = (array)json_decode($data['listshift'],true);
        
        $detail         = $this->parsingDetail($listshift, $id);
        $detailDelete   = $this->parsingDetailDelete($listshift, $id);
        
        foreach($detail as $v)
        {
            $editDet    = $jadwaldetail->whereJadwal_id($v['jadwal_id'])->whereTanggal($v['tanggal'])->first();
            if($editDet)
            {
                $editDet->fill($v)->save();
            }
            else
            {
                $jadwaldetail->create($v);
            }
        }
        
        foreach($detailDelete as $vD)
        {
            $editDetDel    = $jadwaldetail->whereJadwal_id($vD['jadwal_id'])->whereTanggal($vD['tanggal'])->first();
            if($editDetDel)
            {
                $editDetDel->fill($vD)->save();
            }
        }
       
       return redirect()->route('jadwal.tabel');
    }
    
    public function softdelete($id, Request $request, Jadwal $jadwal)
    {
        $edit    = $jadwal->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Jadwal $jadwal)
    {
        $data   = $jadwal->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    if($data->jadwal_tipe=='S')
                        $str  = '<a href="'.route("jadwal.ubah.shift",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    else if($data->jadwal_tipe=='D')
                        $str  = '<a href="'.route("jadwal.ubah.dayshift",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("jadwal.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->addColumn('tipe',function($data)
                {
                    $str = "";
                    if($data->jadwal_tipe=='S')
                        $str    = '<span class="label label-warning">SHIFT</span>';
                    else
                        $str    = '<span class="label label-success">DAY SHIFT</span>';
                    
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Jadwal $jadwal)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $jadwal->where('id',$request->input('id'));
        }
        else
        {
            $datas = $jadwal->where(function($query) use ($request)
                               {
                                    $query->where('jadwal_kode','like','%'.$request->input('q').'%')
                                          ->orWhere('jadwal_nama','like','%'.$request->input('q').'%');
                               });
        }
        $datas = $datas->get()->toArray();
        //print_r($datas);
        foreach($datas as $data)
        {
            $ret[] = array('id' => $data['id'], 'text' => $data['jadwal_kode'].' - '.$data['jadwal_nama']);
        }
        
        echo json_encode($ret);
    }
    
    function calendar(Request $request)
    {
        $periode    = $request->input('p');
        $id         = $request->input('id');
        
        if(empty($periode))
            $periode    = date('Y-m');
        
        echo $this->createDateAbsen($periode, $id);
    }
    
    private function createDateAbsen($periode,$id=null)
    {
        $ret        =   "";
        
        $height     = 'style="height:100px;"';
        
        $date_start = date("Y-m-d",strtotime("-1 month ".$periode."-22"));
        $begin      = new DateTime( $date_start );
        $end        = new DateTime( $periode."-22" );
        $ed         = new DateTime( $periode."-21" );
        $interval   = new DateInterval('P1D');
        $daterange  = new DatePeriod($begin, $interval ,$end);
        
        $posFirstDate = $begin->format('N')-1;
        $posLastDate  = 7-$ed->format('N');
        
        $data       = array();
        
        if($id)
        {
            $jadwal_detail  = JadwalDetail::where('jadwal_id',$id)
                                           ->whereBetween('tanggal',[$begin->format('Y-m-d'),$ed->format('Y-m-d')])
                                           ->whereHapus('1')
                                           ->get();
            
            foreach($jadwal_detail as $jd)
            {
                
                $data[$jd->tanggal] = ['kode'     => $jd->waktu->waktu_kode,
                                       'masuk'    => $jd->waktu->waktu_masuk,
                                       'keluar'   => $jd->waktu->waktu_keluar,
                                       'pendek'   => $jd->waktu->waktu_pendek,
                                       'istirahat'=> $jd->waktu->waktu_istirahat,
                                       'warna'    => $jd->waktu->waktu_warna];
            }
        }
        
        //print_r($daterange);
        foreach($daterange as $range)
        {
            //echo $range->format('Y-m-d');
            $style  = "";
            $label  = "";
            
            if(isset($data[$range->format('Y-m-d')]))
            {
                $style  = ' style="background:'.$data[$range->format('Y-m-d')]['warna'].';height:100px;"';
                $label  = '<br>'.$data[$range->format('Y-m-d')]['kode'].'<br>'.$data[$range->format('Y-m-d')]['masuk'].' - '.$data[$range->format('Y-m-d')]['keluar'].'<br>Istirahat: '.$data[$range->format('Y-m-d')]['istirahat'].'<br>Pendek: '.$data[$range->format('Y-m-d')]['pendek'];
            }
            
            if(empty($style)) $style = $height;
            
            if($range->format('d')==22)
            {
                $ret.=  '<tr>';
                if($posFirstDate>0)
                {
                    $ret.=  '<td '.$height.' colspan="'.$posFirstDate.'">&nbsp;</td>';
                }
                
                $ret.=  '<td dt="'.$range->format('Y-m-d').'"'.$style.'>'.$range->format('d').$label.'</td>';
            
                if($range->format('N')%7 == 0)
                {
                    $ret.=  '</tr>';
                }
            }
            else
            {
                if($range->format('N')%7 == 1)
                {
                    $ret.=  '<tr>';
                }
                $ret.=  '<td dt="'.$range->format('Y-m-d').'"'.$style.'>'.$range->format('d').$label.'</td>';
                if($range->format('N')%7 == 0)
                {
                    $ret.=  '</tr>';
                }
            }
            
            
        }
        
        if($posLastDate>0)
        {
            $ret.=  '<td '.$height.' colspan="'.$posLastDate.'">&nbsp;</td></tr>';
        }
        
        return $ret;
    }
    
    private function parsingDetail($param, $id)
    {
        $ret    = array();
        
        if(is_array($param) && count($param)>0 && !empty($id))
        {
            foreach($param as $k => $v)
            {
                if(is_array($v) && count($v)>0)
                {
                    $dt     = new DateTime($k);
                    $ret[]  = ['jadwal_id'=>$id, 'waktu_id'=>$v['id'], 'hari'=>  strtolower($dt->format('D')), 'tanggal'=>$k, 'hapus'=>'1'];
                }
            }
        }
        
        return $ret;
    }
    
    private function parsingDetailDelete($param, $id)
    {
        $ret    = array();
        
        if(is_array($param) && count($param)>0 && !empty($id))
        {
            foreach($param as $k => $v)
            {
                if(count($v)<1)
                {
                    $ret[]  = ['jadwal_id'=>$id, 'tanggal'=>$k, 'hapus'=>'0'];
                }
            }
        }
        
        return $ret;
    }
}
