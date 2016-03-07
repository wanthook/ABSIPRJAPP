@extends('layouts.app')

@section('additional_style')
@endsection

@section('additional_js')
@endsection

@section('navigator')   
@endsection

@section('pageheader')

@endsection

@section('maincontent')
<div class="widget">
    <h4 class="widgettitle">Form Alasan</h4>
    <div class="widgetcontent">
        <li><a href="{{ url('/home') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Alasan</li>
    </div>
</div>
@endsection