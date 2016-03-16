@extends('layouts.app')

@section('additional_style')
@endsection

@section('additional_js')
@endsection

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('perusahaan.tabel') }}">Perusahaan</a> <span class="separator"></span></li>
<li>Form Edit Perusahaan</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Edit Perusahaan</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Edit Perusahaan</h4>
    <div class="widgetcontent">
        {!! Form::model($perusahaan,['method' => 'PATCH', 'route' => ['perusahaan.ubah',$perusahaan->id]]) !!}
        @include ('admin.perusahaan.form')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection