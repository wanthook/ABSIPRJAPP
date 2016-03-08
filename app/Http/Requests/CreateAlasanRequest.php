<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateAlasanRequest extends Request
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
            'alasan_kode' => 'required|unique:alasan,alasan_kode',
            'alasan_nama' => 'required'
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
           'alasan_kode.required' => 'Kode alasan harus diisi.',
           'alasan_kode.unique' => 'Kode alasan Sudah ada di database.',
           'alasan_nama.required'  => 'Nama alasan harus diisi',
       ];
   }
}
