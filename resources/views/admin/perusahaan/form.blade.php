<div class="par control-group {{ $errors->has('perusahaan_kode')?'error':'' }}">
    <label class="control-label">Kode Perusahaan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('perusahaan_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('perusahaan_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('perusahaan_nama')?'error':'' }}">
    <label class="control-label">Nama Perusahaan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('perusahaan_nama',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('perusahaan_nama','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>