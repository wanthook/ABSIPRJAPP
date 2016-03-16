<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateDivisiRequest extends Request
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
            'divisi_kode' => 'required|unique:divisi,divisi_kode,null,id,hapus,1',
            'divisi_nama' => 'required'
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
           'divisi_kode.required' => 'Kode divisi harus diisi.',
           'divisi_kode.unique' => 'Kode divisi Sudah ada di database.',
           'divisi_nama.required'  => 'Nama divisi harus diisi',
       ];
   }
}
