<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateLiburRequest extends Request
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
            'tanggal' => 'required|unique:libur,tanggal,null,id,hapus,1',
            'keterangan' => 'required'
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
           'tanggal.required' => 'Tanggal libur harus diisi.',
           'tanggal.unique' => 'Tanggal libur Sudah ada di database.',
           'keterangan.required'  => 'Keterangan libur harus diisi',
       ];
   }
}
