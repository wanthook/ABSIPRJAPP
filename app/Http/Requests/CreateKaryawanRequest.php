<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateKaryawanRequest extends Request
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
            'karyawan_pin'                  => 'required|unique:karyawan,karyawan_pin,null,id,hapus,1',
            'karyawan_kode'                 => 'required|unique:karyawan,karyawan_kode,null,id,hapus,1',
//            'alasan_nama' => 'required',
            'karyawan_nama'                 => 'required',
            'karyawan_status'               => 'required',
            'karyawan_statustanggal'        => 'required|date',
            'karyawan_statuskontrak'        => 'required',
            'karyawan_tanggalawalkontrak'   => 'required_if:karyawan_statuskontrak,1|date',
            'karyawan_tanggalakhirkontrak'  => 'required_if:karyawan_statuskontrak,1|date',
            'jabatan_id'                    => 'required',
            'divisi_id'                     => 'required',
            'perusahaan_id'                 => 'required',
            'jenis_kelamin'                 => 'required'
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
           'karyawan_pin.required' => 'PIN harus diisi.',
           'karyawan_pin.unique' => 'PIN sudah ada di database.',
           'karyawan_kode.required' => 'Kode karyawan harus diisi.',
           'karyawan_kode.unique' => 'Kode karyawan sudah ada di database.',
           'karyawan_nama.required'  => 'Nama karyawan harus diisi',
           'karyawan_status.required' => 'Status karyawan harus diisi.',
           'karyawan_statustanggal.required' => 'Tanggal status harus diisi.',
           'karyawan_statustanggal.date' => 'Format tanggal status salah.',
           'karyawan_statuskontrak.required' => 'Status kontrak karyawan harus diisi.',
           'karyawan_tanggalawalkontrak.required' => 'Tanggal kontrak awal harus diisi.',
           'karyawan_tanggalawalkontrak.date' => 'Format tanggal kontrak awal salah.',
           'karyawan_tanggalakhirkontrak.required' => 'Tanggal kontrak akhir harus diisi.',
           'karyawan_tanggalakhirkontrak.date' => 'Format tanggal kontrak akhir salah.',
           'jabatan_id.required' => 'Jabatan harus diisi.',
           'divisi_id.required' => 'Divisi harus diisi.',
           'perusahaan_id.required' => 'Perusahaan harus diisi.',
           'jenis_kelamin.required' => 'Jenis kelamin harus diisi.'
       ];
   }
}
