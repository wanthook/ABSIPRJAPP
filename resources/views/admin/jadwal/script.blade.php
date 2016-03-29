<script src="{{ asset('/assets/js/select2.js') }}"></script>
<script src="{{ asset('/assets/js/fullcalendar.min.js') }}"></script>
<script>
    var tipe = [
        {'id':'S', 'text':'SHIFT'},
        {'id':'D', 'text':'DAYSHIFT'}
    ];
    
    var objWaktu    = {};
    
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
        });
        
        jQuery('#calendar').fullCalendar({
            dayClick: function(date, jsEvent, view) {
                
                var _this   = this;
                
                if(!jQuery.isEmptyObject(objWaktu))
                {
                    //console.log('kosong');
                    console.log(jQuery(_this).html());
                    jQuery(_this).css('background-color', '#'+objWaktu.warna);
                }
            }
        });
    });

</script>