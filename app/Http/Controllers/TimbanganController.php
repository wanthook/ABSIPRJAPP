<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Timbangan;

class TimbanganController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function monitoringViewTable()
    {
        $menu = $this->parentMenu('monitoring');
        return view('admin/timbangan_monitoring',['menu'=>$menu]);
    }
    
    public function monitoringDataTable(Request $request)
    {
        $ret        = array();
        
        $txtPrime       = $request->input('txtPrime');
        $txtStartDate   = $request->input('txtStartDate');
        $txtEndDate     = $request->input('txtEndDate');
        $txtNamaBarang  = $request->input('txtNamaBarang');
                
        
        $start      = $request->input('start');
        $length     = $request->input('length');
        
        $draw       = $request->input('draw');
        
        //$order      = $request->input('order');
        
        $datasT      = Timbangan::whereBetween('timbangan.hapus',[1,2])
                        ->leftjoin('jenis_barang as jb','jb.id','=','timbangan.jenis_barang_id')
                        ->leftjoin('users as usrcreate','usrcreate.id','=','timbangan.created_by')
                        ->leftjoin('users as usrupdate','usrupdate.id','=','timbangan.updated_by')
                        ->select('timbangan.*', 'jb.nama_barang','jb.kode','usrcreate.name as usrcrt','usrupdate.name as usrupd');
        
        if(!empty($txtPrime))
        {
            $datasT->where(function($q) use ($txtPrime){
                $q->where('timbangan.tiket','like','%'.$txtPrime.'%')
                  ->orwhere('timbangan.no_pol','like','%'.$txtPrime.'%')
                  ->orwhere('timbangan.relasi','like','%'.$txtPrime.'%')
                  ->orwhere('timbangan.nama_supir','like','%'.$txtPrime.'%');
            });
        }
        
        if(!empty($txtStartDate) && !empty($txtEndDate))
        {
            $datasT->where(function($q) use ($txtStartDate,$txtEndDate){
                $q->whereBetween('timbangan.tanggal_masuk',[$txtStartDate,$txtEndDate]);
            });
        }
        
        if(!empty($txtNamaBarang))
        {
            $datasT->where('timbangan.jenis_barang_id',$txtNamaBarang);
        }
        
        $countDataT = count($datasT->get());
        
        $dataT      = $datasT->skip($start)->take($length)->orderBy('timbangan.id','DESC')->get();
        
        $row        = array();
        
        foreach ($dataT as $dataTimbangan)
        {
            $row[]  = array(
                'tglmasuk'      => ($dataTimbangan->tanggal_masuk!="")?$dataTimbangan->tanggal_masuk->format('d-m-Y'):'',
                'tglkeluar'     => ($dataTimbangan->tanggal_keluar!="")?$dataTimbangan->tanggal_keluar->format('d-m-Y'):'',
                'jammasuk'      => $dataTimbangan->jam_masuk,
                'jamkeluar'     => $dataTimbangan->jam_keluar,
                'timmasuk'      => $dataTimbangan->timbang_in,
                'timkeluar'     => $dataTimbangan->timbang_out,
                'tiket'         => $dataTimbangan->tiket,
                'namabarang'    => $dataTimbangan->nama_barang,
                'nopolisi'      => $dataTimbangan->no_pol,
                'relasi'        => $dataTimbangan->relasi,
                'supir'         => $dataTimbangan->nama_supir,
                'beratgross'    => $dataTimbangan->berat_gross,
                'berattara'     => $dataTimbangan->berat_tara,
                'beratnetto'    => $dataTimbangan->berat_netto,
                'nosj'          => $dataTimbangan->sj,
                'nopo'          => $dataTimbangan->po,
                'type'          => $dataTimbangan->type,
                'print'         => $dataTimbangan->print,
                'dibuatoleh'    => $dataTimbangan->usrcrt,
                'id'            => $dataTimbangan->id,
                'tglbuat'       => ($dataTimbangan->created_at!="")?$dataTimbangan->created_at->format('d-m-Y'):''
            );
        }
        
        $ret['draw']            = $draw;
        $ret['recordsTotal']    = count(Timbangan::where('timbangan.hapus','<','2')->get());
        $ret['recordsFiltered'] = $countDataT;
        $ret['data']            = $row;
        
        
        echo json_encode($ret);
    }
}
