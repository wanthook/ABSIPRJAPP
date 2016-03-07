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
            tableId         : jQuery('#tableId')
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
                "url"       : "{{ route('alasan.tabel') }}",
                "type"      : 'POST',
                "headers"   : {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            "columns"           :
            [
                {
                    sortable    : false,
                    "render"    : function ( data, type, row, meta )
                    {                        
                        var str	=	'', dis='';
			
                        if(row.kode=='C' || row.kode=='GP' || row.kode=='SD')
                        {
                            dis = 'disabled="disabled"';
                        }
                        
                        
                        str	+= '&nbsp;<a href="'+row.id+'" class="editrow btn btn-default" '+dis+'><span class="icon-pencil"></span></a>&nbsp;';
                        str  	+= '<a href="'+row.id+'" class="deleterow btn btn-default" '+dis+'><span class="icon-trash"></span></a>';

                        return str;
                    }
                },
                { "data"    : "kode" },
                { "data"    : "nama" },
                { "data"    : "tglbuat" }

            ],
            "drawCallback": function( settings, json ) 
            {
                jQuery('.detailrow').on('click',function(e)
                {
                    e.preventDefault();
                }); 
            }
        });
    }
    
    new App();
</script>
@endsection

@section('navigator')
<li><a href="{{ url('/home') }}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
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