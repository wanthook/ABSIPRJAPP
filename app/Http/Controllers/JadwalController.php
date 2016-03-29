<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateJadwalDayshiftRequest;
use App\Http\Controllers\Controller;

use App\Jadwal;
use App\JadwalDetail;
use Auth;
use Yajra\Datatables\Datatables;

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
}
