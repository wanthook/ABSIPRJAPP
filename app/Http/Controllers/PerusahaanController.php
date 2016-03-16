<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreatePerusahaanRequest;
use App\Http\Controllers\Controller;

use App\Perusahaan;
use Auth;
use Yajra\Datatables\Datatables;

class PerusahaanController extends Controller
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
        
        $this->menu   = $this->parentMenu('perusahaan');
    }
    
    public function show()
    {
        return view('admin.perusahaan.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.perusahaan.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Perusahaan $perusahaan)
    {
        $perusahaan   = $perusahaan->whereId($id)->first();
        
        return view('admin.perusahaan.edit',compact('perusahaan'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreatePerusahaanRequest $request, Perusahaan $perusahaan)
    {
        $data   = $request->all();
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        $perusahaan->create($data);
        
        return redirect()->route('perusahaan.tabel');
    }
    
    public function update($id, Request $request, Perusahaan $perusahaan)
    {
       $edit    = $perusahaan->whereId($id)->first();
       
       $edit->fill($request->input())->save();
       
       return redirect()->route('perusahaan.tabel');
    }
    
    public function softdelete($id, Request $request, Perusahaan $perusahaan)
    {
        $edit    = $perusahaan->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Perusahaan $perusahaan)
    {
        $data   = $perusahaan->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("perusahaan.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("perusahaan.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
    
    public function selectdua(Request $request, Perusahaan $perusahaan)
    {
        $ret    = array();
        $datas  = array();
        if($request->input('id'))
        {
            $datas = $perusahaan->where('id',$request->input('id'));
        }
        else
        {
            $datas = $perusahaan->where(function($query) use ($request)
                               {
                                    $query->where('perusahaan_kode','like','%'.$request->input('q').'%')
                                          ->orWhere('perusahaan_nama','like','%'.$request->input('q').'%');
                               });
        }
        $datas = $datas->get()->toArray();
        
        foreach($datas as $data)
        {
            $ret[] = array('id' => $data['id'], 'text' => $data['perusahaan_kode'].' - '.$data['perusahaan_nama']);
        }
        
        echo json_encode($ret);
    }
}
