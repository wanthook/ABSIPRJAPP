<script src="{{ asset('/assets/js/select2.js') }}"></script>
<script src="{{ asset('/assets/js/jquery.bootstrap-datepicker.js') }}"></script>
<script>
    var jenKel = [
        {'id':'L', 'text':'Laki-laki'},
        {'id':'P', 'text':'Perempuan'}
    ];
    var statusKar = [
        {'id':'1', 'text':'Aktif'},
        {'id':'0', 'text':'Tidak Aktif'}
    ];
    var statusKon = [
        {'id':'1', 'text':'Kontrak'},
        {'id':'0', 'text':'Tetap'}
    ];
    var statusRumah = [
        {'id':'1', 'text':'Milik Sendiri'},
        {'id':'2', 'text':'Ikut Orang Tua'},
        {'id':'3', 'text':'Kontrak'},
        {'id':'4', 'text':'Mess Karyawan'}
    ];
    var statusNikah = [
        {'id':'1', 'text':'Lajang'},
        {'id':'2', 'text':'Kawin'},
        {'id':'3', 'text':'Duda'},
        {'id':'4', 'text':'Janda'}
    ];
    jQuery(document).ready(function()
    {
        jQuery.ajaxSetup({
            headers: {'X-CSRF-Token':'{{ csrf_token() }}'}
        });
        
        jQuery('#karyawan_foto').change(function()
        {
            console.log('bla');
            if (this.files && this.files[0]) 
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#imgDiv').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
        
        jQuery('#jenis_kelamin').select2(
        {
            placeholder: "Jenis Kelamin",
            minimumInputLength: 0,
            data:{results : jenKel}
        });
        
        jQuery('#jabatan_id').select2({
            placeholder: "Pilih Jabatan",
            minimumInputLength: 0,
            ajax: 
            {
                url: "{{ route('jabatan.selectdua') }}",
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
                        url: "{{ route('jabatan.selectdua') }}",
                        dataType: 'json',
                        type: 'post',
                        data: {id: id}
                    }).done(function(data){ callback(data[0]); });
                }
            }
        });
        
        jQuery('#divisi_id').select2({
            placeholder: "Pilih Divisi",
            minimumInputLength: 0,
            ajax: 
            {
                url: "{{ route('divisi.selectdua') }}",
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
                        url: "{{ route('divisi.selectdua') }}",
                        dataType: 'json',
                        type: 'post',
                        data: {id: id}
                    }).done(function(data){ callback(data[0]); });
                }
            }
        });
        
        jQuery('#perusahaan_id').select2({
            placeholder: "Pilih Perusahaan",
            minimumInputLength: 0,
            ajax: 
            {
                url: "{{ route('perusahaan.selectdua') }}",
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
                        url: "{{ route('perusahaan.selectdua') }}",
                        dataType: 'json',
                        type: 'post',
                        data: {id: id}
                    }).done(function(data){ callback(data[0]); });
                }
            }
        });
        
        jQuery('#karyawan_status').select2(
        {
            placeholder: "Status Karyawan",
            minimumInputLength: 0,
            data:{results : statusKar}
        });
        
        jQuery('#karyawan_statuskontrak').select2(
        {
            placeholder: "Status Kontrak",
            minimumInputLength: 0,
            data:{results : statusKon}
        });
        
        jQuery('#karyawan_statustanggal,#karyawan_tanggalawalkontrak,#karyawan_tanggalakhirkontrak,#tanggal_npwp,#tanggal_lahir,#ktp_tanggal,#pasangan_tanggallahir,#anak1_tanggallahir,#anak2_tanggallahir,#anak3_tanggallahir').datepicker(
        {
            dateFormat:'yy-mm-dd'
        });
        
        jQuery('#agama_id').select2({
            placeholder: "Pilih Agama",
            minimumInputLength: 0,
            ajax: 
            {
                url: "{{ route('agama.selectdua') }}",
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
                        url: "{{ route('agama.selectdua') }}",
                        dataType: 'json',
                        type: 'post',
                        data: {id: id}
                    }).done(function(data){ callback(data[0]); });
                }
            }
        });
        
        jQuery('#status_rumah').select2(
        {
            placeholder: "Status Rumah",
            minimumInputLength: 0,
            data:{results : statusRumah}
        });
        
        jQuery('#status_nikah').select2(
        {
            placeholder: "Status Nikah",
            minimumInputLength: 0,
            data:{results : statusNikah}
        });
        
    });
</script>