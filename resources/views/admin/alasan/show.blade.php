@extends('layouts.app')

@section('additional_style')
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
            "searching":false,
            "ordering": true,
            "scrollY": 400,
            "scrollX": true,
            "deferRender": true,
            "processing": true,
            "serverSide": true,
            "lengthMenu": [100, 500, 1000, 1500, 2000 ],
            "ajax":
            {
                "url"       : "{{ route('alasan.tabel') }}",
                "type"      : 'POST',
                "headers"   : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            "columns"           :
            [
                { data    : "action", name: "action", orderable: false, searchable: false},
                { data    : "alasan_kode", name: "alasan_kode" },
                { data    : "alasan_nama", name: "alasan_nama" },
                { data    : "created_at", name: "created_at" }

            ]
        });
    }
    
    new App();
</script>
@endpush

@section('navigator')
<li><a href="{{ route('home.root') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li>Alasan</li>            
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-comments"></span></div>
<div class="pagetitle">
    <h5>List Master Alasan</h5>
    <h1>Alasan</h1>
</div>
@endsection

@section('maincontent')
<div class="headtitle">    
    <div class="btn-group">
        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('alasan.tambah') }}"><i class="iconfa-plus-sign"></i>&nbsp;Tambah Alasan</a>
            </li>
        </ul>
    </div>
    <h4 class="widgettitle">Tabel List Alasan</h4>
    
    <table id="tableId" class="table table-bordered responsive">
        {{--*/
        $arrHead = array('&nbsp;',
                         'Kode',
                         'Nama',                         
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