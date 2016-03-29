<div class="par control-group {{ $errors->has('jadwal_kode')?'error':'' }}">
    <label class="control-label">Kode Jadwal <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('jadwal_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('jadwal_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group">
    <label class="control-label">Tipe Jadwal <small>(Wajib Diisi)</small></label>
    <div class="field">
        <span class="label label-success">SHIFT</span>
    </div>                
</div>
<hr>
<div class="row-fluid">
    <div class="par control-group span6">
        <label class="control-label">Waktu kerja</label>
        <div class="field">
            {!! Form::hidden('waktukerja',null,['class' => 'input-large', 'id' => 'waktukerja']) !!}            
        </div> 
    </div>
    <div class="par control-group span2">
        <button id="resetwaktukerja" class="btn btn-danger"><span class="iconfa-remove-circle"></span>&nbsp;&nbsp;Hapus Waktu</button>
    </div>
</div>

<h4 class="widgettitle title-warning">Detail Shift</h4>
<div style="overflow-x: auto;">
<div id='calendar'></div>
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>