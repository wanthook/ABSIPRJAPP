<script src="{{ asset('/assets/js/select2.js') }}"></script>
<script>
    var tipe = [
        {'id':'S', 'text':'SHIFT'},
        {'id':'D', 'text':'DAYSHIFT'}
    ];
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
        
        jQuery('#mon,#tue,#wed,#thu,#fri,#sat,#sun').select2({
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
            },
            initSelection: function(element, callback) 
            {
                var id = jQuery(element).val();

                if(id!="")
                {
                    jQuery.ajax( 
                    {                    
                        url: "{{ route('waktu.selectdua') }}",
                        dataType: 'json',
                        type: 'post',
                        data: {id: id}
                    }).done(function(data){ callback(data[0]); });
                }
            }
        });
    });
</script>