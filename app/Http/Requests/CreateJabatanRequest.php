<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateJabatanRequest extends Request
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
            'jabatan_kode' => 'required|unique:jabatan,jabatan_kode,null,id,hapus,1',
            'jabatan_nama' => 'required'
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
           'jabatan_kode.required' => 'Kode jabatan harus diisi.',
           'jabatan_kode.unique' => 'Kode jabatan Sudah ada di database.',
           'jabatan_nama.required'  => 'Nama jabatan harus diisi',
       ];
   }
}
