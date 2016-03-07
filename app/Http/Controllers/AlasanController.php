<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Alasan;

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
    
    public function alasanViewTable()
    {
        return view('admin/alasan_table',['menu'=>$this->menu]);
    }
    
    public function alasanFormTable()
    {
        return view('admin/alasan_form',['menu'=>$this->menu]);
    }
    
    public function alasanDataTable(Request $request)
    {
        $ret        = array();
        
        $start      = $request->input('start');
        $length     = $request->input('length');
        
        $draw       = $request->input('draw');
        
        $datasT     = Alasan::whereBetween('hapus',[1,2]);
        
        $countDataT = count($datasT->get());
        
        $dataT      = $datasT->skip($start)->take($length)->orderBy('alasan_kode','ASC')->get();
        
        foreach ($dataT as $dataV)
        {
            $row[]  = array(
                'kode'          => $dataV->alasan_kode,
                'nama'          => $dataV->alasan_nama,
                'id'            => $dataV->id,
                'tglbuat'       => ($dataV->created_at!="")?$dataV->created_at->format('d-m-Y H:i:s'):''
            );
        }
        
        $ret['draw']            = $draw;
        $ret['recordsTotal']    = count(Alasan::where('hapus','<','2')->get());
        $ret['recordsFiltered'] = $countDataT;
        $ret['data']            = $row;
        
        
        echo json_encode($ret);
    }
}
