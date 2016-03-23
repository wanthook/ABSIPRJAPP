<div class="par control-group {{ $errors->has('waktu_kode')?'error':'' }}">
    <label class="control-label">Kode Waktu <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('waktu_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('waktu_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('waktu_masuk')?'error':'' }}">
    <label class="control-label">Jam Masuk <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('waktu_masuk',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('waktu_masuk','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('waktu_keluar')?'error':'' }}">
    <label class="control-label">Jam Keluar <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('waktu_keluar',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('waktu_keluar','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('waktu_pendek')?'error':'' }}">
    <label class="control-label">Pendek <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::hidden('waktu_pendek',null,['class' => 'input-xxlarge', 'id' => 'waktu_pendek']) !!}
        {!! $errors->first('waktu_pendek','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('waktu_istirahat')?'error':'' }}">
    <label class="control-label">Istirahat <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::hidden('waktu_istirahat',null,['class' => 'input-xxlarge', 'id' => 'waktu_istirahat']) !!}
        {!! $errors->first('waktu_istirahat','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('waktu_warna')?'error':'' }}">
    <label class="control-label">Warna <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('waktu_warna',null,['class' => 'input-mini', 'id' => 'colorpicker']) !!}
        <span id="colorSelector" class="colorselector">
            <span></span>
        </span>
        {!! $errors->first('waktu_warna','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>