<div class="tabs-stacked">
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#dakar">Data Karyawan</a>
        </li>
        <li>
            <a data-toggle="tab" href="#daprikar">Data Pribadi Karyawan</a>
        </li>
        <li>
            <a data-toggle="tab" href="#daktp">Data KTP Karyawan</a>
        </li>
        <li>
            <a data-toggle="tab" href="#dapa">Data Pasangan</a>
        </li>
        <li>
            <a data-toggle="tab" href="#daan">Data Anak</a>
        </li>
        <li>
            <a data-toggle="tab" href="#daor">Data Orangtua</a>
        </li>
        <li>
            <a data-toggle="tab" href="#damer">Data Mertua</a>
        </li>
        <li>
            <a data-toggle="tab" href="#dasar">Data Saudara</a>
        </li>
        
    </ul>
    <div class="tab-content">
        <div id="dakar" class="tab-pane active">
            <hr>
            <div class="par control-group">
                <label class="control-label">Preview</label>
                @if(empty(Form::getValueAttribute('karyawan_foto')))
                {{ Html::image('assets/images/photos/polos.png', 'Photo Karyawan',array('class' => 'img-polaroid', 'id' => 'imgDiv', 'style' => 'width:100px;height:150px;')) }}
                @else
                {{ Html::image('uploads/profiles/'.Form::getValueAttribute('karyawan_foto'), 'Photo Karyawan',array('class' => 'img-polaroid', 'id' => 'imgDiv', 'style' => 'width:100px;height:150px;')) }}
                @endif
            </div>
            <div class="par control-group {{ $errors->has('karyawan_foto')?'error':'' }}">
                <label class="control-label">File Foto Karyawan</label>
                <div class="field">
                    {!! Form::file('karyawan_foto',['class' => 'input-xxlarge', 'id' => 'karyawan_foto']) !!}
                    {!! $errors->first('karyawan_foto','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_pin')?'error':'' }}">
                <label class="control-label">PIN <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::text('karyawan_pin',null,['class' => 'input-xxlarge', 'autofocus' => '']) !!}
                    {!! $errors->first('karyawan_pin','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_kode')?'error':'' }}">
                <label class="control-label">Kode <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::text('karyawan_kode',null,['class' => 'input-xxlarge']) !!}
                    {!! $errors->first('karyawan_kode','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_nama')?'error':'' }}">
                <label class="control-label">Nama <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::text('karyawan_nama',null,['class' => 'input-xxlarge']) !!}
                    {!! $errors->first('karyawan_nama','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('jenis_kelamin')?'error':'' }}">
                <label class="control-label">Jenis Kelamin <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('jenis_kelamin',null,['class' => 'input-xxlarge','id' => 'jenis_kelamin']) !!}
                    {!! $errors->first('jenis_kelamin','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('divisi_id')?'error':'' }}">
                <label class="control-label">Divisi <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('divisi_id',null,['class' => 'input-xxlarge','id' => 'divisi_id']) !!}
                    {!! $errors->first('divisi_id','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('jabatan_id')?'error':'' }}">
                <label class="control-label">Jabatan <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('jabatan_id',null,['class' => 'input-xxlarge','id' => 'jabatan_id']) !!}
                    {!! $errors->first('jabatan_id','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('perusahaan_id')?'error':'' }}">
                <label class="control-label">Perusahaan <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('perusahaan_id',null,['class' => 'input-xxlarge','id' => 'perusahaan_id']) !!}
                    {!! $errors->first('perusahaan_id','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_status')?'error':'' }}">
                <label class="control-label">Status Karyawan <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('karyawan_status',null,['class' => 'input-xxlarge','id' => 'karyawan_status']) !!}
                    {!! $errors->first('karyawan_status','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_statustanggal')?'error':'' }}">
                <label class="control-label">Tanggal Status <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::text('karyawan_statustanggal',null,['class' => 'input-large','id' => 'karyawan_statustanggal']) !!}
                    {!! $errors->first('karyawan_statustanggal','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_statuskontrak')?'error':'' }}">
                <label class="control-label">Status Kontrak <small>(Wajib Diisi)</small></label>
                <div class="field">
                    {!! Form::hidden('karyawan_statuskontrak',null,['class' => 'input-xxlarge','id' => 'karyawan_statuskontrak']) !!}
                    {!! $errors->first('karyawan_statuskontrak','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group {{ $errors->has('karyawan_tanggalawalkontrak') || $errors->has('karyawan_tanggalakhirkontrak')?'error':'' }}">
                <label class="control-label">Tanggal Kontrak</label>
                <div class="field">
                    {!! Form::text('karyawan_tanggalawalkontrak',null,['class' => 'input-large','id' => 'karyawan_tanggalawalkontrak']) !!} &nbsp; &nbsp; S/D &nbsp; &nbsp;
                    {!! Form::text('karyawan_tanggalakhirkontrak',null,['class' => 'input-large','id' => 'karyawan_tanggalakhirkontrak']) !!}
                    {!! $errors->first('karyawan_tanggalawalkontrak','<span class="help-inline warning">:message</span>') !!} &nbsp; &nbsp;
                    {!! $errors->first('karyawan_tanggalakhirkontrak','<span class="help-inline warning">:message</span>') !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Rekening </label>
                <div class="field">
                    {!! Form::text('rekening',null,['class' => 'input-large','id' => 'rekening']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. BPJS </label>
                <div class="field">
                    {!! Form::text('bpjs',null,['class' => 'input-large','id' => 'bpjs']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Asuransi </label>
                <div class="field">
                    {!! Form::text('asuransi',null,['class' => 'input-large','id' => 'asuransi']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. NPWP </label>
                <div class="field">
                     {!! Form::text('npwp',null,['class' => 'input-large','id' => 'npwp']) !!}&nbsp; &nbsp; Tanggal NPWP:
                     {!! Form::text('tanggal_npwp',null,['class' => 'input-large','id' => 'tanggal_npwp']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Inventaris </label>
                <div class="field">
                    {!! Form::textarea('inventaris',null,['class' => 'input-xxlarge','id' => 'inventaris', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
        </div>
        
        <!-- batas -->
        
        <div id="daprikar" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">Tempat Lahir </label>
                <div class="field">
                    {!! Form::text('tempat_lahir',null,['class' => 'input-large','id' => 'tempat_lahir']) !!}&nbsp; &nbsp; Tanggal Lahir:
                    {!! Form::text('tanggal_lahir',null,['class' => 'input-large','id' => 'tanggal_lahir']) !!}
                </div>                
            </div>            
            <div class="par control-group">
                <label class="control-label">Agama</label>
                <div class="field">
                    {!! Form::hidden('agama_id',null,['class' => 'input-xxlarge','id' => 'agama_id']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Alamat </label>
                <div class="field">
                    {!! Form::textarea('alamat',null,['class' => 'input-xxlarge','id' => 'alamat', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kelurahan </label>
                <div class="field">
                    {!! Form::text('kelurahan',null,['class' => 'input-large','id' => 'kelurahan']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kecamatan </label>
                <div class="field">
                    {!! Form::text('kecamatan',null,['class' => 'input-large','id' => 'kecamatan']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kota </label>
                <div class="field">
                    {!! Form::text('kota',null,['class' => 'input-large','id' => 'kota']) !!}&nbsp; &nbsp; Kode Pos:
                    {!! Form::text('kodepos',null,['class' => 'input-large','id' => 'kodepos']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Telpon </label>
                <div class="field">
                    {!! Form::text('telpon',null,['class' => 'input-large','id' => 'telpon']) !!}&nbsp; &nbsp; Handphone:
                    {!! Form::text('handphone',null,['class' => 'input-large','id' => 'handphone']) !!}
                </div>                
            </div>            
            <div class="par control-group">
                <label class="control-label">Status Rumah</label>
                <div class="field">
                    {!! Form::hidden('status_rumah',null,['class' => 'input-xxlarge','id' => 'status_rumah']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Status Nikah</label>
                <div class="field">
                    {!! Form::hidden('status_nikah',null,['class' => 'input-xxlarge','id' => 'status_nikah']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Pendidikan</label>
                <div class="field">
                    {!! Form::hidden('pendidikan',null,['class' => 'input-large','id' => 'pendidikan']) !!}&nbsp; &nbsp; Tahun Lulus:
                    {!! Form::text('tahun_lulus',null,['class' => 'input-large','id' => 'tahun_lulus']) !!}
                </div>                
            </div>
        </div>
        
        <div id="daktp" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">NIK </label>
                <div class="field">
                    {!! Form::text('ktp_nik',null,['class' => 'input-xxlarge','id' => 'ktp_nik']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tanggal KTP </label>
                <div class="field">
                    {!! Form::text('ktp_tanggal',null,['class' => 'input-large','id' => 'ktp_tanggal']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Alamat KTP </label>
                <div class="field">
                    {!! Form::textarea('ktp_alamat',null,['class' => 'input-xxlarge','id' => 'ktp_alamat', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kelurahan KTP </label>
                <div class="field">
                    {!! Form::text('ktp_kelurahan',null,['class' => 'input-large','id' => 'ktp_kelurahan']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kecamatan KTP </label>
                <div class="field">
                    {!! Form::text('ktp_kecamatan',null,['class' => 'input-large','id' => 'ktp_kecamatan']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kota KTP</label>
                <div class="field">
                    {!! Form::text('ktp_kota',null,['class' => 'input-large','id' => 'ktp_kota']) !!}&nbsp; &nbsp; Kode Pos KTP:
                    {!! Form::text('ktp_kodepos',null,['class' => 'input-large','id' => 'ktp_kodepos']) !!}
                </div>                
            </div>
        </div>
        
        <div id="dapa" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">Nama Pasangan </label>
                <div class="field">
                    {!! Form::text('pasangan_nama',null,['class' => 'input-xxlarge','id' => 'pasangan_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tempat Lahir Pasangan </label>
                <div class="field">
                    {!! Form::text('pasangan_tempatlahir',null,['class' => 'input-xxlarge','id' => 'pasangan_tempatlahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tanggal Lahir Pasangan </label>
                <div class="field">
                    {!! Form::text('pasangan_tanggallahir',null,['class' => 'input-large','id' => 'pasangan_tanggallahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Asuransi Pasangan </label>
                <div class="field">
                    {!! Form::text('pasangan_asuransi',null,['class' => 'input-large','id' => 'pasangan_asuransi']) !!}
                </div>                
            </div>
        </div>
        
        <div id="daan" class="tab-pane">
            <div class="row-fluid">
                <div class="span12">
                    <h4 class="widgettitle title-inverse">Anak Ke-1</h4><br />
                </div><!--span6-->
            </div>
            <div class="par control-group">
                <label class="control-label">Nama Anak </label>
                <div class="field">
                    {!! Form::text('anak1_nama',null,['class' => 'input-xxlarge','id' => 'anak1_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tempat Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak1_tempatlahir',null,['class' => 'input-xxlarge','id' => 'anak1_tempatlahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tanggal Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak1_tanggallahir',null,['class' => 'input-large','id' => 'anak1_tanggallahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Asuransi Anak </label>
                <div class="field">
                    {!! Form::text('anak1_asuransi',null,['class' => 'input-large','id' => 'anak1_asuransi']) !!}
                </div>                
            </div>
            
            <div class="row-fluid">
                <div class="span12">
                    <h4 class="widgettitle title-inverse">Anak Ke-2</h4><br />
                </div><!--span6-->
            </div>
            <div class="par control-group">
                <label class="control-label">Nama Anak </label>
                <div class="field">
                    {!! Form::text('anak2_nama',null,['class' => 'input-xxlarge','id' => 'anak2_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tempat Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak2_tempatlahir',null,['class' => 'input-xxlarge','id' => 'anak2_tempatlahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tanggal Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak2_tanggallahir',null,['class' => 'input-large','id' => 'anak2_tanggallahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Asuransi Anak </label>
                <div class="field">
                    {!! Form::text('anak2_asuransi',null,['class' => 'input-large','id' => 'anak2_asuransi']) !!}
                </div>                
            </div>
            
            <div class="row-fluid">
                <div class="span12">
                    <h4 class="widgettitle title-inverse">Anak Ke-3</h4><br />
                </div><!--span6-->
            </div>
            <div class="par control-group">
                <label class="control-label">Nama Anak </label>
                <div class="field">
                    {!! Form::text('anak3_nama',null,['class' => 'input-xxlarge','id' => 'anak3_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tempat Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak3_tempatlahir',null,['class' => 'input-xxlarge','id' => 'anak3_tempatlahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Tanggal Lahir Anak </label>
                <div class="field">
                    {!! Form::text('anak3_tanggallahir',null,['class' => 'input-large','id' => 'anak3_tanggallahir']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">No. Asuransi Anak </label>
                <div class="field">
                    {!! Form::text('anak3_asuransi',null,['class' => 'input-large','id' => 'anak3_asuransi']) !!}
                </div>                
            </div>
            
        </div>
        
        <div id="daor" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">Nama Ayah </label>
                <div class="field">
                    {!! Form::text('ortuayah_nama',null,['class' => 'input-xxlarge','id' => 'ortuayah_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Nama Ibu </label>
                <div class="field">
                    {!! Form::text('ortuibu_nama',null,['class' => 'input-xxlarge','id' => 'ortuibu_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Alamat Orangtua </label>
                <div class="field">
                    {!! Form::textarea('ortu_alamat',null,['class' => 'input-xxlarge','id' => 'ortu_alamat', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kota Orangtua</label>
                <div class="field">
                    {!! Form::text('ortu_kota',null,['class' => 'input-large','id' => 'ortu_kota']) !!}
                </div>                
            </div>
        </div>
        
        <div id="damer" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">Nama Ayah Mertua </label>
                <div class="field">
                    {!! Form::text('mertuaayah_nama',null,['class' => 'input-xxlarge','id' => 'mertuaayah_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Nama Ibu Mertua </label>
                <div class="field">
                    {!! Form::text('mertuaibu_nama',null,['class' => 'input-xxlarge','id' => 'mertuaibu_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Alamat Mertua </label>
                <div class="field">
                    {!! Form::textarea('mertua_alamat',null,['class' => 'input-xxlarge','id' => 'mertua_alamat', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Kota Mertua </label>
                <div class="field">
                    {!! Form::text('mertua_kota',null,['class' => 'input-large','id' => 'mertua_kota']) !!}
                </div>                
            </div>
        </div>
        
        <div id="dasar" class="tab-pane">
            <hr>
            <div class="par control-group">
                <label class="control-label">Nama Saudara </label>
                <div class="field">
                    {!! Form::text('saudara_nama',null,['class' => 'input-xxlarge','id' => 'saudara_nama']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Alamat Saudara </label>
                <div class="field">
                    {!! Form::textarea('saudara_alamat',null,['class' => 'input-xxlarge','id' => 'saudara_alamat', 'cols' => '150', 'rows' => '5']) !!}
                </div>                
            </div>
            <div class="par control-group">
                <label class="control-label">Telpon Saudara </label>
                <div class="field">
                    {!! Form::text('saudara_tlp',null,['class' => 'input-large','id' => 'saudara_tlp']) !!}
                </div>                
            </div>
        </div>
        <!--
        <div id="lC" class="tab-pane">
            <p>What up girl, this is Section C.</p>
        </div>-->
    </div><!--tab-content-->
</div><!--tabs-left-->

<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>