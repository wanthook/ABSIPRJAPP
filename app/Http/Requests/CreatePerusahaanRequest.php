<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePerusahaanRequest extends Request
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
            'perusahaan_kode' => 'required|unique:perusahaan,perusahaan_kode,null,id,hapus,1',
            'perusahaan_nama' => 'required'
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
           'perusahaan_kode.required' => 'Kode perusahaan harus diisi.',
           'perusahaan_kode.unique' => 'Kode perusahaan Sudah ada di database.',
           'perusahaan_nama.required'  => 'Nama perusahaan harus diisi',
       ];
   }
}
