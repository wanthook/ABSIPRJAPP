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
<li>Form Edit Jadwal</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Edit Jadwal</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Edit Jadwal</h4>
    <div class="widgetcontent">
        {!! Form::model($jadwal,['method' => 'PATCH', 'route' => ['jadwal.ubah.dayshift',$jadwal->id], 'class' => 'stdform']) !!}
        @include ('admin.jadwal.formdayshift')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection