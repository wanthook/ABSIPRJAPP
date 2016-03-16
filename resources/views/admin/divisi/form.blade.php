<div class="par control-group {{ $errors->has('divisi_kode')?'error':'' }}">
    <label class="control-label">Kode Divisi <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('divisi_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('divisi_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('divisi_nama')?'error':'' }}">
    <label class="control-label">Nama Divisi <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('divisi_nama',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('divisi_nama','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>