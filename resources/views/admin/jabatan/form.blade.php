<div class="par control-group {{ $errors->has('jabatan_kode')?'error':'' }}">
    <label class="control-label">Kode Jabatan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('jabatan_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('jabatan_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('jabatan_nama')?'error':'' }}">
    <label class="control-label">Nama Jabatan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('jabatan_nama',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('jabatan_nama','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>