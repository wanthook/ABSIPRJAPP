@extends('layouts.app')

@section('additional_style')
<link href="{{ asset('/assets/css/select2.css') }}" rel="stylesheet">
@endsection

@section('additional_js')
@include('admin.waktu.script')
@endsection

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('waktu.tabel') }}">Waktu</a> <span class="separator"></span></li>
<li>Form Edit Waktu</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Edit Waktu</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Edit Waktu</h4>
    <div class="widgetcontent">
        {!! Form::model($waktu,['method' => 'PATCH', 'route' => ['waktu.ubah',$waktu->id],'class' => 'stdform']) !!}
        @include ('admin.waktu.form')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection