<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateWaktuRequest;
use App\Http\Controllers\Controller;

use App\Waktu;
use Auth;
use Yajra\Datatables\Datatables;

class WaktuController extends Controller
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
        
        $this->menu   = $this->parentMenu('waktukerja');
    }
    
    public function show()
    {
        return view('admin.waktu.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.waktu.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Waktu $waktu)
    {
        $waktu   = $waktu->whereId($id)->first();
        
        return view('admin.waktu.edit',compact('waktu'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateWaktuRequest $request, Waktu $waktu)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $waktu->create($data);
        
        return redirect()->route('waktu.tabel');
    }
    
    public function update($id, Request $request, Waktu $waktu)
    {
       $edit    = $waktu->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('waktu.tabel');
    }
    
    public function softdelete($id, Request $request, Waktu $waktu)
    {
        $edit    = $waktu->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Waktu $waktu)
    {
        $data   = $waktu->where('hapus','1')
                         ->where('waktu_kode','<>','L');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("waktu.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("waktu.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->addColumn('pendek',function($data)
                {
                    $str = ($data->waktu_pendek=='1')?'<span class="label label-warning">YA</span>':'<span class="label label-success">TIDAK</span>';
                    return $str;
                })
                ->addColumn('istirahat',function($data)
                {
                    $str = ($data->waktu_istirahat=='1')?'<span class="label label-info">1</span>':'<span class="label label-inverse">0.5</span>';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Waktu $waktu)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $waktu->where('id',$request->input('id'))
                            ->where('hapus','1');
        }
        else
        {
            $datas = $waktu->where('waktu_kode', 'like','%'.$request->input('q').'%')
                            ->where('hapus','1');
        }
        $datas = $datas->get()->toArray();
        
        foreach($datas as $data)
        {
            $pen    = ($data['waktu_pendek']=='1')?'Y':'T';
            $ist    = ($data['waktu_istirahat']=='1')?'1':'0.5';
            $ret[] = array('id' => $data['id'], 'text' => $data['waktu_kode'].' | '.$data['waktu_masuk'].' - '.$data['waktu_keluar'].' | PEN:'.$pen.' | IST:'.$ist);
        }
        
        echo json_encode($ret);
    }
}
