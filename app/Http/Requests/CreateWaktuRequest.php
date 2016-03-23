<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateWaktuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'waktu_kode' => 'required|unique:waktu,waktu_kode,null,id,hapus,1',
            'waktu_masuk' => 'required',
            'waktu_keluar' => 'required',
            'waktu_pendek' => 'required',
            'waktu_istirahat' => 'required',
            'waktu_warna' => 'required'
        ];
    }
    
    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
   public function messages()
   {
       return [
           'waktu_kode.required' => 'Kode Waktu harus diisi.',
           'waktu_kode.unique' => 'Kode Waktu Sudah ada di database.',
           'waktu_masuk.required'  => 'Jam masuk harus diisi',
           'waktu_keluar.required'  => 'Jam Keluar harus diisi',
           'waktu_pendek.required'  => 'Hari Pendek harus diisi',
           'waktu_istirahat.required'  => 'Kode Istirahat harus diisi',
           'waktu_warna.required'  => 'Warna harus diisi',
       ];
   }
}
