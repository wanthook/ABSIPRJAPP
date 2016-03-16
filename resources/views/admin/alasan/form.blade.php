<div class="par control-group {{ $errors->has('alasan_kode')?'error':'' }}">
    <label class="control-label">Kode Alasan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('alasan_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('alasan_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('alasan_nama')?'error':'' }}">
    <label class="control-label">Nama Alasan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('alasan_nama',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('alasan_nama','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>