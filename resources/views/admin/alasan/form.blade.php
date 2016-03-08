<div class="par control-group {{ $errors->has('txtKodeAlasan')?'error':'' }}">
    <label class="control-label">Kode Alasan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('alasan_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('txtKodeAlasan','<span class="help-inline">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('txtNamaAlasan')?'error':'' }}">
    <label class="control-label">Nama Alasan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('alasan_nama',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('txtNamaAlasan','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>