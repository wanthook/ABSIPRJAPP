<script src="{{ asset('/assets/js/select2.js') }}"></script>
<script>
    var tipe = [
        {'id':'S', 'text':'SHIFT'},
        {'id':'D', 'text':'DAYSHIFT'}
    ];
    
    var sMonth   = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Des'];
    
    var objWaktu    = {}, objSel    ={};
    
    Date.prototype.ymd = function() {
        var yyyy = this.getFullYear().toString();
        var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
        var dd  = this.getDate().toString();
        return yyyy +'-'+ (mm[1]?mm:"0"+mm[0]) +'-'+ (dd[1]?dd:"0"+dd[0]); // padding
       };
       
    jQuery(document).ready(function()
    {
        jQuery.ajaxSetup({
            headers: {'X-CSRF-Token':'{{ csrf_token() }}'}
        });
        
        jQuery('#jadwal_tipe').select2(
        {
            placeholder: "Tipe Jadwal",
            minimumInputLength: 0,
            data:{results : tipe}
        });
        
        jQuery('#mon,#tue,#wed,#thu,#fri,#sat,#sun,#waktukerja').select2({
            placeholder: "Waktu",
            minimumInputLength: 0,
            ajax: 
            {
                url: "{{ route('waktu.selectdua') }}",
                dataType: 'json', 
                type: 'post',                
                data: function (term, page) 
                {                
                    return { q : term  }
                },
                results: function(data, page ) 
                {
                    return { results: data }
                }
            }
        });
        
        jQuery('#waktukerja').on('change',function(e)
        {
            objWaktu    = jQuery(this).select2('data');
        });
        
        jQuery("#resetwaktukerja").click(function(e)
        {
            e.preventDefault();

            jQuery("#waktukerja").select2('val','');
            objWaktu    = {};
        });
        
        jQuery('#periode').datepicker(
        {
            dateFormat  : 'yy-mm',
            changeMonth: true,
            changeYear: true,
            onClose: function(dateText, inst) { 
                var month = jQuery("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = jQuery("#ui-datepicker-div .ui-datepicker-year :selected").val();
                jQuery(this).datepicker('setDate', new Date(year, month, 1));                
                renderTable(year+'-'+(month));
            }
        });
        
        renderTable('');
    });
    
    var renderTable = function(date)
    {   
        var month   = '';
        var year    = '';
        if(date=='')
        {
            var dt  = new Date();
            month   = parseInt(dt.getMonth());
            year    = parseInt(dt.getFullYear());
        }
        else
        {
            var splt    = date.split('-');
            month       = parseInt(splt[1]);
            year        = parseInt(splt[0]);
        }
        
        var strMonth      = month-1;
        jQuery('#lblCal').html('Periode: 22 '+sMonth[(strMonth<0)?11:strMonth]+' - 21 '+sMonth[strMonth+1]+' '+year);
        
        date = year+'-'+(month+1);
        
        jQuery("#calendar").off();        
        jQuery('#calendar').load("{{ route('jadwal.calendar') }}",{'p':date,'id':'{{ $jadwal->id }}'})
                           .delegate("tr td", "click", function () {
                               var date       = jQuery(this).attr('dt');
                               var dt       = new Date(date);
                               //console.log(objWaktu);
                               if(!jQuery.isEmptyObject(objWaktu))
                               {
                                   if(date)
                                   {
                                        var html = dt.getDate()+'<br>'+objWaktu.kode+'<br>'+objWaktu.masuk+' - '+objWaktu.keluar+'<br>Istirahat: '+objWaktu.istirahat+'<br>Pendek: '+objWaktu.pendek;
                                        jQuery(this).html(html);
                                        jQuery(this).css('background-color', objWaktu.warna);
                                   }
                               }
                               else
                               {
                                   var html = dt.getDate();
                                   jQuery(this).html(html);
                                   jQuery(this).css('background-color', '#FFFFFF');
                               }
                               
                               objSel[date] = objWaktu;
                               
                               jQuery('#listshift').val(JSON.stringify(objSel));
                           });
    }
</script>