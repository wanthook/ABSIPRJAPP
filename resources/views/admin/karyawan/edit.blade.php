@extends('layouts.app')

@section('additional_style')
<link href="{{ asset('/assets/css/select2.css') }}" rel="stylesheet">
@endsection

@section('additional_js')
@include('admin.karyawan.script')
@endsection

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('karyawan.tabel') }}">Karyawan</a> <span class="separator"></span></li>
<li>Form Edit Karyawan</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Edit Karyawan</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Edit Karyawan</h4>
    <div class="widgetcontent">
        {!! Form::model($karyawan,['method' => 'PATCH', 'route' => ['karyawan.ubah',$karyawan->id], 'files'=> true, 'class' => 'stdform']) !!}
        @include ('admin.karyawan.form')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection