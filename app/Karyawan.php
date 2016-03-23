<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    
    protected $fillable = [
        'karyawan_pin',
        'karyawan_kode',
        'karyawan_foto',
        'karyawan_nama',
        'karyawan_status',
        'karyawan_statustanggal',
        'karyawan_statuskontrak',
        'karyawan_tanggalawalkontrak',
        'karyawan_tanggalakhirkontrak',
        'jabatan_id',
        'divisi_id',
        'jadwal_id',
        'perusahaan_id',
        'bpjs',
        'asuransi',
        'rekening',
        'npwp',
        'tanggal_npwp',
        'inventaris',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'kodepos',
        'telpon',
        'handphone',
        'status_rumah',
        'pendidikan',
        'tahun_lulus',
        'status_nikah',
        'ktp_nik',
        'ktp_tanggal',
        'ktp_alamat',
        'ktp_kelurahan',
        'ktp_kecamatan',
        'ktp_kota',
        'ktp_kodepos',
        'pasangan_nama',
        'pasangan_tempatlahir',
        'pasangan_tanggallahir',
        'pasangan_asuransi',
        'anak1_nama',
        'anak1_tempatlahir',
        'anak1_tanggallahir',
        'anak1_asuransi',        
        'anak2_nama',
        'anak2_tempatlahir',
        'anak2_tanggallahir',
        'anak2_asuransi',        
        'anak3_nama',
        'anak3_tempatlahir',
        'anak3_tanggallahir',
        'anak3_asuransi',
        'ortuayah_nama',
        'ortuibu_nama',
        'ortu_alamat',
        'ortu_kota',
        'mertuaayah_nama',
        'mertuaibu_nama',
        'mertua_alamat',
        'mertua_kota',
        'saudara_nama',
        'saudara_alamat',
        'saudara_tlp',
        'created_by', 
        'updated_by', 
        'hapus'
    ];


    protected $dates = ['created_at','modified_at'];
    
    public function divisi()
    {
        return $this->belongsTo('App\Divisi');
    }
    
    public function jabatan()
    {
        return $this->belongsTo('App\Jabatan');
    }
    
    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan');
    }
    
    public function jadwal()
    {
        return $this->belongsTo('App\Jadwal');
    }
    
    public function agama()
    {
        return $this->belongsTo('App\Agama');
    }
}
