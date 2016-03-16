@extends('layouts.app')

@section('additional_style')
@endsection

@push('additional_js')
<script src="{{ asset('/assets/js/jquery.bootstrap-datepicker.js') }}"></script>
<script>
jQuery(document).ready(function(){
    jQuery('#tanggal').datepicker(
    {
        dateFormat:'yy-mm-dd'
    });
});
</script>
@endpush

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li><a href="{{ route('libur.tabel') }}">Libur</a> <span class="separator"></span></li>
<li>Form Tambah Libur</li>
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-list-alt"></span></div>
<div class="pagetitle">
    <h5>Form Tambah Libur</h5>
    <h1>Form</h1>
</div>
@endsection

@section('maincontent')
<div class="widgetbox box-inverse">
    <h4 class="widgettitle">Form Tambah Libur</h4>
    <div class="widgetcontent">
        {!! Form::open(array('url' => route('libur.tambah'),'class' => 'stdform')) !!}
        @include ('admin.libur.form')
        {!! Form::close() !!}
    </div><!--widgetcontent-->
</div>
@endsection