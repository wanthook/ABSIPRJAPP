<div class="par control-group {{ $errors->has('jadwal_kode')?'error':'' }}">
    <label class="control-label">Kode Jadwal <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::text('jadwal_kode',null,['class' => 'input-xxlarge']) !!}
        {!! $errors->first('jadwal_kode','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<div class="par control-group {{ $errors->has('jadwal_tipe')?'error':'' }}">
    <label class="control-label">Tipe Jadwal <small>(Wajib Diisi)</small></label>
    <div class="field">
        {!! Form::hidden('jadwal_tipe',null,['class' => 'input-large', 'id' => 'jadwal_tipe']) !!}
        {!! $errors->first('jadwal_tipe','<span class="help-inline warning">:message</span>') !!}
    </div>                
</div>
<hr>
<h4 class="widgettitle title-warning">Detail Dayshift</h4>
<div style="overflow-x: auto;">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>SENIN</th>
            <th>SELASA</th>
            <th>RABU</th>
            <th>KAMIS</th>
            <th>JUM'AT</th>
            <th>SABTU</th>
            <th>MINGGU</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                &nbsp;{!! Form::hidden('mon',null,['class' => 'input-medium', 'id' => 'mon']) !!}
                {!! $errors->first('mon','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('tue',null,['class' => 'input-medium', 'id' => 'tue']) !!}
                {!! $errors->first('tue','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('wed',null,['class' => 'input-medium', 'id' => 'wed']) !!}
                {!! $errors->first('wed','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('thu',null,['class' => 'input-medium', 'id' => 'thu']) !!}
                {!! $errors->first('thu','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('fri',null,['class' => 'input-medium', 'id' => 'fri']) !!}
                {!! $errors->first('fri','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('sat',null,['class' => 'input-medium', 'id' => 'sat']) !!}
                {!! $errors->first('sat','<span class="help-inline warning">:message</span>') !!}
            </td>
            <td>
                &nbsp;{!! Form::hidden('sun',null,['class' => 'input-medium', 'id' => 'sun']) !!}
                {!! $errors->first('sun','<span class="help-inline warning">:message</span>') !!}
            </td>
        </tr>
    </tbody>
</table>
</div>
<p class="stdformbutton">
    <button class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn">Reset</button>
</p>