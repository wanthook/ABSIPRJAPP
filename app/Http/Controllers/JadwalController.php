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
    
    public function edit_dayshift($id, Jadwal $jadwal)
    {
        $jadwal   = $jadwal->whereId($id)->first();
        
        return view('admin.jadwal.editdayshift',compact('jadwal'))->with(['menu'=>$this->menu]);
    }
    
    public function save_dayshift(CreateJadwalDayshiftRequest $request, Jadwal $jadwal)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $jadwal->create($data);
        
        return redirect()->route('jadwal.tabel');
    }
    
    public function update($id, Request $request, Jadwal $jadwal)
    {
       $edit    = $jadwal->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
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
                    $str  = '<a href="'.route("jadwal.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
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
