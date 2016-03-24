@extends('layouts.app')

@section('additional_style')
<link href="{{ asset('/assets/css/select2.css') }}" rel="stylesheet">
<style>
</style>
@endsection

@section('additional_js')
@include('admin.jadwal.script')
@endsection

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('jadwal.tabel') }}">Jadwal</a> <span class="separator"></span></li>
<li>Form Tambah Jadwal Dayshift</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Tambah Jadwal Dayshift</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Tambah Jadwal Dayshift</h4>
    <div class="widgetcontent">
        {!! Form::open(array('url' => route('jadwal.tambah.dayshift'),'class' => 'stdform')) !!}
        @include ('admin.jadwal.formdayshift')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection