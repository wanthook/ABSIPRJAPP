@extends('layouts.app')

@section('additional_style')
@endsection

@section('additional_js')
<script src="{{ asset('/assets/js/jquery.dataTables.1.10.min.js') }}"></script>      
<script>
    var App = function(){
        this.dataTable  = null;
        this.DOM        = this.getDOM();
        //this.dataSearch = this.dataSearch();
        this.table();
        this.loadAction();
    }
    
    App.prototype.getDOM    = function(){
        return {
            tableId         : jQuery('#tableId'),
            formSearch      : jQuery('#formSearch'),
        }
    }
    
    App.prototype.loadAction    = function(){
        
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
                "url"       : "{{ url('monitoring/table') }}",
                "type"      : 'POST',
                "headers"   : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                "data"      : {
                    "txtPrime" : jQuery('#txtPrime').val()
                }
            },
            "columns"           :
            [
                {
                    sortable    : false,
                    "render"    : function ( data, type, row, meta )
                    {
                        var str	=	'';
						
                        str	+= '<a href="'+row.id+'" class="detailrow"><span class="iconfa-list"></span></a>&nbsp;';
//                        str  	+= '<a href="'+row.id+'" class="deleterow"><span class="icon-trash"></span></a>';

                        return str;
                    }
                },
                //{ "data"    : "" },
                { "data"    : "tglmasuk" },
                { "data"    : "jammasuk" },
                { "data"    : "tglkeluar" },
                { "data"    : "jamkeluar" },
                { "data"    : "tiket" },
                { "data"    : "namabarang" },
                { "data"    : "nopolisi" },
                { "data"    : "relasi" },
                { "data"    : "supir" },
                { "data"    : "beratgross" },
                { "data"    : "berattara" },
                { "data"    : "beratnetto" },
                { "data"    : "dibuatoleh" }

            ],
            "drawCallback": function( settings, json ) 
            {
                jQuery('.detailrow').on('click',function(e)
                {
                    e.preventDefault();
//                    var idLink = jQuery(this).attr('href');
//                    _this.openDialog(idLink);
                    //console.log(idLink);
                }); 
            }
        });
    }
    
    new App();
</script>
@endsection

@section('navigator')
<li><a href="{{ url('/home') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
<li>Monitoring Timbangan</li>            
@endsection

@section('pageheader')
<div class="pageicon"><span class="iconfa-eye-open"></span></div>
<div class="pagetitle">
    <h5>List Hasil Timbangan</h5>
    <h1>Monitoring Timbangan</h1>
</div>
@endsection

@section('maincontent')
<div class="navbar">
    <div class="navbar-inner">
        <form class="navbar-search pull-left" id="formSearch">
            <span class="label-default">Tiket/No Pol/Relasi/Supir:</span> 
            <input type="text" value="GRM" id="txtPrime" name="txtPrime" class="input-sm" style="width: 180px;" placeholder="Tiket/No Pol/Relasi/Supir">
            <span class="label-default">Tanggal Timbang:</span> 
            <input type="text" id="txtStartDate" name="txtStartDate" class="input-sm" style="width: 120px;" placeholder="Tanggal Awal">S/D
            <input type="text" id="txtEndDate" name="txtEndDate" class="input-sm" style="width: 120px;" placeholder="Tanggal Akhir">
            <span class="label-default">Nama Barang:</span>
            <input type="hidden" id="txtNamaBarang" name="txtNamaBarang" style="width:250px;">
            <button class="btn btn-success"><i class="iconfa-search"></i>Cari</button>
        </form>
    </div>
</div>
<div class="headtitle">    
<!--    <div class="btn-group">
        <button data-toggle="dropdown" class="btn dropdown-toggle">Action <span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li>
                <a href="#" id="cmdTambahMesin"><i class="iconfa-plus-sign"></i>&nbsp;Tambah Mesin</a>
            </li>
            <li>
                <a href="#" id="downloadXlsButton"><i class="iconfa-download"></i>&nbsp;Download XLS</a>
            </li>
        </ul>
    </div>-->
    <h4 class="widgettitle">Tabel List Monitoring</h4>
    
    <table id="tableId" class="table table-bordered responsive">
        {{--*/
        $arrHead = array('&nbsp;',
                         'Tanggal Masuk',
                         'Jam Masuk',
                         'Tanggal Keluar',
                         'Jam Keluar',
                         'Tiket',
                         'Nama Barang',
                         'No. Polisi',
                         'Relasi',
                         'Supir',
                         'Berat Gross',
                         'Berat Tara',
                         'Berat Netto',
                         'Dibuat Oleh'
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