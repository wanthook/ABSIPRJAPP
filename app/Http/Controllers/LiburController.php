<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateLiburRequest;
use App\Http\Controllers\Controller;

use App\Libur;
use Auth;
use Yajra\Datatables\Datatables;

class LiburController extends Controller
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
        
        $this->menu   = $this->parentMenu('libur');
    }
    
    public function show()
    {
        return view('admin.libur.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.libur.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Libur $libur)
    {
        $libur   = $libur->whereId($id)->first();
        
        return view('admin.libur.edit',compact('libur'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateLiburRequest $request, Libur $libur)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $libur->create($data);
        
        return redirect()->route('libur.tabel');
    }
    
    public function update($id, Request $request, Libur $libur)
    {
       $edit    = $libur->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('libur.tabel');
    }
    
    public function softdelete($id, Request $request, Libur $libur)
    {
        $edit    = $libur->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Libur $libur)
    {
        $data   = $libur->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("libur.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("libur.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
}
