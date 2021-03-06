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
    var App = function(){
        this.dataTable  = null;
        this.DOM        = this.getDOM();
        this.table();
    }
    
    App.prototype.getDOM    = function(){
        return {
            tableId         : jQuery('#tableId')
        }
    }
    
    App.prototype.table     = function(){
        var _this   = this;

        this.dataTable = _this.DOM.tableId.DataTable({
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
                "url"       : "{{ route('karyawan.tabel') }}",
                "type"      : 'POST',
                "headers"   : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            "columns"           :
            [
                { data    : "action",                       name: "action", orderable: false, searchable: false},
                { data    : "karyawan_pin",                 name: "karyawan_pin" },
                { data    : "karyawan_kode",                name: "karyawan_kode" },
                { data    : "karyawan_nama",                name: "karyawan_nama" },
                { data    : "jabatan.jabatan_kode",         name: "jabatan_kode", searchable: false },
                { data    : "jabatan.jabatan_nama",         name: "jabatan_nama", searchable: false },
                { data    : "divisi.divisi_kode",           name: "divisi_kode", searchable: false },
                { data    : "divisi.divisi_nama",           name: "divisi_nama", searchable: false },
                { data    : "perusahaan.perusahaan_nama",   name: "perusahaan_nama", searchable: false },
                { data    : "jenis_kelamin",                name: "jenis_kelamin" },
                { data    : "tempat_lahir",                 name: "tempat_lahir" },
                { data    : "tanggal_lahir",                name: "tanggal_lahir" },
                { data    : "rekening",                     name: "rekening" },
                { data    : "statuskaryawan",               name: "statuskaryawan" , orderable: false, searchable: false},
                { data    : "karyawan_statustanggal",       name: "karyawan_statustanggal" },
                { data    : "statuskontrak",                name: "statuskontrak" , orderable: false, searchable: false},
                { data    : "karyawan_tanggalawalkontrak",  name: "karyawan_tanggalawalkontrak" },
                { data    : "karyawan_tanggalakhirkontrak", name: "karyawan_tanggalakhirkontrak" },
                { data    : "created_at",                   name: "created_at" }

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
    }
    
    new App();
</script>
@endpush

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li>Karyawan</li>            
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-flag"></span></div>
<div class="pagetitle">
    <h5>List Master Karyawan</h5>
    <h1>Karyawan</h1>
</div>
@endsection

@section('maincontent')
<div class="headtitle">    
    <div class="btn-group">
        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('karyawan.tambah') }}"><i class="iconfa-plus-sign"></i>&nbsp;Tambah Karyawan</a>
            </li>
            <li>
                <a href="{{ route('karyawan.upload') }}"><i class="iconfa-upload"></i>&nbsp;Upload XLS Karyawan</a>
            </li>
        </ul>
    </div>
    <h4 class="widgettitle">Tabel List Karyawan</h4>
    
    <table id="tableId" class="table table-bordered responsive">
        {{--*/
        $arrHead = array('&nbsp;',
                         'PIN',
                         'Kode',  
                         'Nama',
                         'Kode Jabatan',
                         'Nama Jabatan',
                         'Kode Divisi',
                         'Nama Divisi',
                         'Perusahaan',
                         'Jenis Kelamin',
                         'Tempat Lahir',
                         'Tanggal Lahir',
                         'No. Rekening',
                         'Status Aktif',
                         'Tanggal Status',
                         'Status Karyawan',
                         'Tanggal Awal Kontrak',
                         'Tanggal Awal Kontrak',
                         'Tanggal Buat'
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