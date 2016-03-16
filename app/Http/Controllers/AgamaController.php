<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateAgamaRequest;
use App\Http\Controllers\Controller;

use App\Agama;
use Auth;
use Yajra\Datatables\Datatables;

class AgamaController extends Controller
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
        
        $this->menu   = $this->parentMenu('agama');
    }
    
    public function show()
    {
        return view('admin.agama.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.agama.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Agama $agama)
    {
        $agama   = $agama->whereId($id)->first();
        
        return view('admin.agama.edit',compact('agama'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateAgamaRequest $request, Agama $agama)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $agama->create($data);
        
        return redirect()->route('agama.tabel');
    }
    
    public function update($id, Request $request, Agama $agama)
    {
       $edit    = $agama->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('agama.tabel');
    }
    
    public function softdelete($id, Request $request, Agama $agama)
    {
        $edit    = $agama->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Agama $agama)
    {
        $data   = $agama->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("agama.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("agama.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Agama $agama)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $agama->where('id',$request->input('id'));
        }
        else
        {
            $datas = $agama->where('agama_nama','like','%'.$request->input('q').'%');
        }
        $datas = $datas->get()->toArray();
        
        foreach($datas as $data)
        {
            $ret[] = array('id' => $data['id'], 'text' => $data['agama_nama']);
        }
        
        echo json_encode($ret);
    }
}
