<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CreateKaryawanRequest;
use App\Http\Requests\CreateKaryawanUploadRequest;
use App\Http\Controllers\Controller;

use Validator;

use App\Karyawan;
use App\Jabatan;
use App\Divisi;
use App\Perusahaan;
use Auth;
use Yajra\Datatables\Datatables;
use Excel;

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
    
    public function upload()
    {
        return view('admin.karyawan.upload',['menu'=>$this->menu]);
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
        
        if(empty($data['agama_id']))
        {
            $data['agama_id'] = 'NULL';
        }
        
        $data['created_by'] = Auth::user()->id;
        $data['updated_by'] = Auth::user()->id;
        
        $karyawan->create($data);
        
        return redirect()->route('karyawan.tabel');
    }
    
    public function saveupload(CreateKaryawanUploadRequest $request, Karyawan $karyawan)
    {
        $data   = $request->all();
        
        $dataBErsih = array();
        
        if ($request->hasFile('karyawan_excel')) 
        {
            $file = $request->file('karyawan_excel');
            $filename   = crc32($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->move('uploads/excel/', $filename);
            
            $bla = Excel::load('uploads/excel/'.$filename, function($reader)
            {
                $reader->ignoreEmpty();
                $reader->skip(1);
            })->get()->toArray()[0];
            
            for($i = 0 ; $i<count($bla) ; $i++)
            {
                $bla[$i]['jabatan_id'] = $this->getIdJabatan($bla[$i]['jabatan_id']);
                $bla[$i]['divisi_id'] = $this->getIdDivisi($bla[$i]['divisi_id']);
                $bla[$i]['perusahaan_id'] = $this->getIdPerusahaan($bla[$i]['perusahaan_id']);
                
                $validator = Validator::make($bla[$i], [
                    'karyawan_pin'                  => 'required|unique:karyawan,karyawan_pin,null,id,hapus,1',
                    'karyawan_kode'                 => 'required|unique:karyawan,karyawan_kode,null,id,hapus,1',
                    'karyawan_nama'                 => 'required',
                    'karyawan_status'               => 'required',
                    'karyawan_statustanggal'        => 'required|date',
                    'karyawan_statuskontrak'        => 'required',
                    'karyawan_tanggalawalkontrak'   => 'required_if:karyawan_statuskontrak,1|date',
                    'karyawan_tanggalakhirkontrak'  => 'required_if:karyawan_statuskontrak,1|date',
                    'jabatan_id'                    => 'required',
                    'divisi_id'                     => 'required',
                    'perusahaan_id'                 => 'required'
                ]);
                
                if($validator->fails())
                {
                    continue;
                }
                else
                {
                    $bla[$i]['created_by'] = Auth::user()->id;
                    $bla[$i]['updated_by'] = Auth::user()->id;
                    $dataBErsih[] = $bla[$i];
                }
                
            }
        }
        
        if(count($dataBErsih)>0)
        {
            print_r($dataBErsih);
            //$karyawan->create($dataBErsih);
        }
        
        //return redirect()->route('karyawan.tabel');
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
    
    private function getIdJabatan($kode)
    {
        $jabatans = Jabatan::where('jabatan_kode',$kode)->first();
        
        if($jabatans)
            return $jabatans->id;
        
        return '';
    }
    
    private function getIdDivisi($kode)
    {
        $divisis = Divisi::where('divisi_kode',$kode)->first();
        
        if($divisis)
            return $divisis->id;
        
        return '';
    }
    
    private function getIdPerusahaan($kode)
    {
        $perusahaans = Perusahaan::where('perusahaan_kode',$kode)->first();
        
        if($perusahaans)
            return $perusahaans->id;
        
        return '';
    }
}
