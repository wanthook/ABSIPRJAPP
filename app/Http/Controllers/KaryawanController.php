<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateKaryawanRequest;
use App\Http\Controllers\Controller;

use App\Karyawan;
use Auth;
use Yajra\Datatables\Datatables;

class KaryawanController extends Controller
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
        
        $this->menu   = $this->parentMenu('datakaryawan');
    }
    
    public function show()
    {
        return view('admin.karyawan.show',['menu'=>$this->menu]);
    }
    
    public function create()
    {
        return view('admin.karyawan.create',['menu'=>$this->menu]);
    }
    
    public function edit($id, Karyawan $karyawan)
    {
        $karyawan   = $karyawan->whereId($id)->first();
        
        return view('admin.karyawan.edit',compact('karyawan'))->with(['menu'=>$this->menu]);
    }
    
    public function save(CreateKaryawanRequest $request, Karyawan $karyawan)
    {
        $data   = $request->all();
        
        if ($request->hasFile('karyawan_foto')) 
        {
            $file = $request->file('karyawan_foto');
            $filename   = crc32($file->getClientOriginalName()).'.tpk';
            $file->move('uploads/profiles/', $filename);
            
            $data['karyawan_foto']  = $filename;
        }
        else
        {
            unset($data['karyawan_foto']);
        }
        
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        
        $karyawan->create($data);
        
        return redirect()->route('karyawan.tabel');
    }
    
    public function update($id, Request $request, Karyawan $karyawan)
    {
       $edit    = $karyawan->whereId($id)->first();
       
       $data    = $request->input();
       
       if ($request->hasFile('karyawan_foto')) 
        {
            $file = $request->file('karyawan_foto');
            $filename   = crc32($file->getClientOriginalName()).'.tpk';
            $file->move('uploads/profiles/', $filename);
            
            $data['karyawan_foto']  = $filename;
        }
        else
        {
            unset($data['karyawan_foto']);
        }
        
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
       
       $edit->fill($data)->save();
       
       return redirect()->route('karyawan.tabel');
    }
    
    public function softdelete($id, Request $request, Karyawan $karyawan)
    {
        $edit    = $karyawan->whereId($id)->first();
        
        $data    = $request->input();
        
        $data['hapus']    = '0';
        $data['updated_by'] = Auth::user()->id;
        
        $edit->fill($data)->save();
        
        echo json_encode(array('status' => 1, 'msg' => 'Data berhasil dihapus!!!'));
    }
    
    public function dataTables(Request $request, Karyawan $karyawan)
    {
        $data   = $karyawan
                  ->with('jabatan','divisi','perusahaan')
                  ->select('karyawan_pin',
                           'karyawan_kode',
                           'karyawan_nama',
                           'jenis_kelamin',
                           'tempat_lahir',
                           'tanggal_lahir',
                           'rekening',
                           'karyawan_status',
                           'karyawan_statuskontrak',
                           'karyawan_statustanggal',
                           'karyawan_tanggalawalkontrak',
                           'karyawan_tanggalakhirkontrak',
                           'created_at',
                           'id',
                           'jabatan_id','divisi_id','perusahaan_id')
                  ->where('hapus','1');
        
        return  Datatables::of($data)
                ->addColumn('action',function($data)
                {
                    $str  = '<a href="'.route("karyawan.ubah",$data->id).'" class="editrow btn btn-default"><span class="icon-edit"></span></a>&nbsp;';
                    $str .= '<a href="'.route("karyawan.hapus",$data->id).'" class="deleterow btn btn-default"><span class="icon-remove"></span></a>&nbsp;';
                    return $str;
                })
                ->addColumn('statuskaryawan',function($data)
                {
                    $str = "";
                    if($data->karyawan_status=='1')
                        $str = '<span class="label label-success">Aktif</span>';
                    else
                        $str = '<span class="label label-danger">Tidak Aktif</span>';
                    
                    return $str;
                })
                ->addColumn('statuskontrak',function($data)
                {
                    $str = "";
                    if($data->karyawan_statuskontrak=='1')
                        $str = '<span class="label label-warning">Kontrak</span>';
                    else
                        $str = '<span class="label label-success">Tetap</span>';
                    
                    return $str;
                })
                ->editColumn('id', 'ID: {{$id}}')
                ->make(true);
    }
}
