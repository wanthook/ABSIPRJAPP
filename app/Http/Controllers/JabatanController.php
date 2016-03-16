<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateJabatanRequest;
use App\Http\Controllers\Controller;

use App\Jabatan;
use Auth;
use Yajra\Datatables\Datatables;

class JabatanController extends Controller
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
        
        $this->menu   = $this->parentMenu('jabatan');
    }
    
    public function show()
    {
        return view('admin.jabatan.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.jabatan.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Jabatan $jabatan)
    {
        $jabatan   = $jabatan->whereId($id)->first();
        
        return view('admin.jabatan.edit',compact('jabatan'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateJabatanRequest $request, Jabatan $jabatan)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $jabatan->create($data);
        
        return redirect()->route('jabatan.tabel');
    }
    
    public function update($id, Request $request, Jabatan $jabatan)
    {
       $edit    = $jabatan->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('jabatan.tabel');
    }
    
    public function softdelete($id, Request $request, Jabatan $jabatan)
    {
        $edit    = $jabatan->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Jabatan $jabatan)
    {
        $data   = $jabatan->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("jabatan.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("jabatan.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Jabatan $jabatan)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $jabatan->where('id',$request->input('id'));
        }
        else
        {
            $datas = $jabatan->where(function($query) use ($request)
                               {
                                    $query->where('jabatan_kode','like','%'.$request->input('q').'%')
                                          ->orWhere('jabatan_nama','like','%'.$request->input('q').'%');
                               });
        }
        $datas = $datas->get()->toArray();
        //print_r($datas);
        foreach($datas as $data)
        {
            $ret[] = array('id' => $data['id'], 'text' => $data['jabatan_kode'].' - '.$data['jabatan_nama']);
        }
        
        echo json_encode($ret);
    }
}
