<script src="{{ asset('/assets/js/colorpicker.js') }}"></script>
<script src="{{ asset('/assets/js/select2.js') }}"></script>
<script>
    var waktu_pendek = [
        {'id':'1', 'text':'YA'},
        {'id':'0', 'text':'TIDAK'}
    ];
    var waktu_istirahat = [
        {'id':'1', 'text':'SATU'},
        {'id':'0', 'text':'SETENGAH'}
    ];
    
    jQuery(document).ready(function()
    {
        jQuery.ajaxSetup({
            headers: {'X-CSRF-Token':'{{ csrf_token() }}'}
        });
        
        jQuery('#waktu_pendek').select2(
        {
            placeholder: "Waktu Pendek",
            minimumInputLength: 0,
            data:{results : waktu_pendek}
        });
        
        jQuery('#waktu_istirahat').select2(
        {
            placeholder: "Waktu Istirahat",
            minimumInputLength: 0,
            data:{results : waktu_istirahat}
        });
        
        jQuery('#colorSelector').ColorPicker({
            onShow: function (colpkr) 
            {
                    jQuery(colpkr).fadeIn(500);
                    return false;
            },
            onHide: function (colpkr) 
            {
                    jQuery(colpkr).fadeOut(500);
                    return false;
            },
            onChange: function (hsb, hex, rgb) 
            {
                    jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                    jQuery('#colorpicker').val('#'+hex);
            }
        });
    });
</script>