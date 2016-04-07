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
        <span class="label label-warning">SHIFT</span>
    </div>                
</div>
<hr>
<div class="row-fluid">
    <div class="par control-group span4">
        <label class="control-label">Periode Shift</label>
        <div class="field">
            {!! Form::text('periode',null,['class' => 'input-large', 'id' => 'periode']) !!}
        </div> 
    </div>
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
<h2><i class="iconfa-calendar"></i>&nbsp;<span id="lblCal"></span></h2>
{!! Form::hidden('listshift',null,['id' => 'listshift']) !!}
<h4>{!! $errors->first('listshift','<span class="help-inline warning">:message</span>') !!}</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Senin</th>
            <th>Selasa</th>
            <th>Rabu</th>
            <th>Kamis</th>
            <th>Jum'at</th>
            <th>Sabtu</th>
            <th>Minggu</th>
        </tr>
    </thead>
    <tbody id="calendar">
    </tbody>
</table>
<!--<div style="overflow-x: auto;">
<div id='calendar'></div>
</div>-->
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>