<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateJadwalDayshiftRequest extends Request
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
            'jadwal_kode'                   => 'required|unique:jadwal,jadwal_kode,null,id,hapus,1',
            'mon'                           => 'required',
            'tue'                           => 'required',
            'wed'                           => 'required',
            'thu'                           => 'required',
            'fri'                           => 'required',
            'sat'                           => 'required',
            'sun'                           => 'required'
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
           'jadwal_kode.required'   => 'Kode jadwal harus diisi.',
           'jadwal_kode.unique'     => 'Kode jadwal sudah ada di database.',
           'mon.required'           => 'Harus diisi.',
           'tue.required'           => 'Harus diisi.',
           'wed.required'           => 'Harus diisi.',
           'thu.required'           => 'Harus diisi.',
           'fri.required'           => 'Harus diisi.',
           'sat.required'           => 'Harus diisi.',
           'sun.required'           => 'Harus diisi.'
       ];
   }
}
