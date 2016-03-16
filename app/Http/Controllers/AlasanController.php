<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateAlasanRequest;
use App\Http\Controllers\Controller;

use App\Alasan;
use Auth;
use Yajra\Datatables\Datatables;

class AlasanController extends Controller
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
        
        $this->menu   = $this->parentMenu('alasan');
    }
    
    public function show()
    {
        return view('admin.alasan.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.alasan.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Alasan $alasan)
    {
        $alasan   = $alasan->whereId($id)->first();
        
        return view('admin.alasan.edit',compact('alasan'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateAlasanRequest $request, Alasan $alasan)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $alasan->create($data);
        
        return redirect()->route('alasan.tabel');
    }
    
    public function update($id, Request $request, Alasan $alasan)
    {
       $edit    = $alasan->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('alasan.tabel');
    }
    
    public function softdelete($id, Request $request, Alasan $alasan)
    {
        $edit    = $alasan->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Alasan $alasan)
    {
        $data   = $alasan->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("alasan.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("alasan.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
}
