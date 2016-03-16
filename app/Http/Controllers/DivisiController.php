<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateDivisiRequest;
use App\Http\Controllers\Controller;

use App\Divisi;
use Auth;
use Yajra\Datatables\Datatables;

class DivisiController extends Controller
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
        
        $this->menu   = $this->parentMenu('divisi');
    }
    
    public function show()
    {
        return view('admin.divisi.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.divisi.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Divisi $divisi)
    {
        $divisi   = $divisi->whereId($id)->first();
        
        return view('admin.divisi.edit',compact('divisi'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateDivisiRequest $request, Divisi $divisi)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $divisi->create($data);
        
        return redirect()->route('divisi.tabel');
    }
    
    public function update($id, Request $request, Divisi $divisi)
    {
       $edit    = $divisi->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('divisi.tabel');
    }
    
    public function softdelete($id, Request $request, Divisi $divisi)
    {
        $edit    = $divisi->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Divisi $divisi)
    {
        $data   = $divisi->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("divisi.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("divisi.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Divisi $divisi)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $divisi->where('id',$request->input('id'));
        }
        else
        {
            $datas = $divisi->where(function($query) use ($request)
                               {
                                    $query->where('divisi_kode','like','%'.$request->input('q').'%')
                                          ->orWhere('divisi_nama','like','%'.$request->input('q').'%');
                               });
        }
        $datas = $datas->get()->toArray();
        
        foreach($datas as $data)
        {
            $ret[] = array('id' => $data['id'], 'text' => $data['divisi_kode'].' - '.$data['divisi_nama']);
        }
        
        echo json_encode($ret);
    }
}
