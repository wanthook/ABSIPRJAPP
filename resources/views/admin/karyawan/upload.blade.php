@extends('layouts.app')

@section('additional_style')
<link href="{{ asset('/assets/css/select2.css') }}" rel="stylesheet">
@endsection

@push('additional_js')
@include('admin.karyawan.script')
@endpush

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('karyawan.tabel') }}">Karyawan</a> <span class="separator"></span></li>
<li>Form Upload Karyawan</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-upload"></span></div>
<div class="pagetitle">
    <h5>Form Upload Karyawan</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Upload Karyawan</h4>
    <div class="widgetcontent">
        {!! Form::open(array('url' => route('karyawan.upload'),'class' => 'stdform','files'=> true )) !!}
        <div class="par control-group {{ $errors->has('karyawan_excel')?'error':'' }}">
            <label class="control-label">File Data Karyawan</label>
            <div class="field">
                {!! Form::file('karyawan_excel',['class' => 'input-xxlarge', 'id' => 'karyawan_excel']) !!}
                {!! $errors->first('karyawan_excel','<span class="help-inline warning">:message</span>') !!}
            </div>                
        </div>
        <div class="par control-group">
            <label class="control-label">Template File Upload</label>
            <div class="field">
                <a class="btn btn-inverse" href="{{ url('assets/template/template_karyawan.xlsx') }}">Template File Karyawan</a>
            </div>                
        </div>
        <div class="stdformbutton">
        <ul>
            <li>Gunakan file template untuk mengisi data karyawan.</li>
            <li>Isi mulai dari baris ke-3</li>
            <li>Header berwarna merah, berarti WAJIB DIISI. Jika salah satu tidak diisi, maka tidak akan masuk ke database. Harap diperhatikan.</li>
        </ul>
        </div>
        <p class="stdformbutton">
            <button class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn">Reset</button>
        </p>
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection