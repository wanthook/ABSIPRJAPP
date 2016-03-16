<div class="par control-group {{ $errors->has('tanggal')?'error':'' }}">
    <label class="control-label">Tanggal <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('tanggal',null,['class' => 'input-xxlarge', 'id' => 'tanggal']) !!}
        {!! $errors->first('tanggal','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('keterangan')?'error':'' }}">
    <label class="control-label">Keterangan <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('keterangan',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('keterangan','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>