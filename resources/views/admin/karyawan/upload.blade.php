@extends('layouts.app')

@section('additional_style')
<style>
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;   
    }
</style>
@endsection

@push('additional_js')
<script src="{{ asset('/assets/js/jquery.dataTables.1.10.min.js') }}"></script>     
<script>
    jQuery(document).ready(function()
    {
        jQuery('#tableId').DataTable({
            "sPaginationType": "full_numbers",
            "searching":true,
            "ordering": true,
            "scrollY": 400,
            "scrollX": true,
            "deferRender": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [100, 500, 1000, 1500, 2000 ],
            "ajax":
            {
                "url"       : "{{ route('karyawan.tabellog') }}",
                "type"      : 'POST',
                "headers"   : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            "columns"           :
            [
                { data    : "action",                       name: "action", orderable: false, searchable: false},
                { data    : "file_upload",                 name: "file_upload" },
                { data    : "upload_date",                name: "upload_date" }

            ],
            "drawCallback": function( settings, json ) 
            {
                jQuery('.deleterow').on('click',function(e){
                    e.preventDefault();
                    var _this	= jQuery(this);
                    if(confirm('Apakah anda yakin ingin menghapus data ini?'))
                    {
                        var url = jQuery(this).attr('href');
                        jQuery.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            headers   : 
                            {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            data: {_method: 'PATCH'}
                        }).success(function (data) {
                            if(data.status==1)
                            {
                                _this.parents('tr').fadeOut(function(){
                                    _this.remove();
                                });

                                jQuery.alerts.dialogClass = 'alert-info';
                                jAlert(data.msg, 'Informasi', function()
                                {
                                    jQuery.alerts.dialogClass = null; // reset to default
                                });
                           }
                           else
                           {
                               jQuery.alerts.dialogClass = 'alert-warning';
                                jAlert(data.msg, 'Perhatian', function()
                                {
                                    jQuery.alerts.dialogClass = null; // reset to default
                                });
                            }
                        });
                    }
                    
                    return false;
                });
            }
        });
    });

</script>
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
<div class="headtitle"> 
    <h4 class="widgettitle">Tabel List Log Upload</h4>
    
    <table id="tableId" class="table table-bordered responsive">
        {{--*/
        $arrHead = array('&nbsp;',
                         'File Upload',
                         'Upload Date'
                         )
        /*--}}
        <colgroup>
        {{--*/ $col = 0 /*--}}
        @for ($i = 0; $i < count($arrHead); $i++)
            <col class="con{{$col}}" />
            @if($col==0) 
                {{--*/ $col = 1 /*--}}
            @else
                {{--*/ $col = 0 /*--}}
            @endif
        @endfor   
        </colgroup>
        <thead>
            <tr>
                {{--*/  $col = 0  /*--}}
                @for ($i = 0; $i < count($arrHead); $i++)
                    <th class="head{{$col}}">{{$arrHead[$i]}}</th>
                    @if($col==0) 
                        {{--*/ $col = 1 /*--}}
                    @else
                        {{--*/ $col = 0 /*--}}
                    @endif
                @endfor  
            </tr>
        </thead>
    </table>
</div>
@endsection