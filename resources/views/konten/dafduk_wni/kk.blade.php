@extends('core/main')
@extends('core/navbar')
@extends('core/footer')

@section('title', 'Daftar Penduduk WNI - Sistem Informasi Statistik Data Kependudukan Kabupaten Sidoarjo')
@section('page-title', 'Sistem Informasi Statistik Data Kependudukan Kabupaten Sidoarjo')
@section('page-subtitle', '')

@section('css')
<!--===============================================================================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
    <link href="{{ asset('/vendors/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
@endsection

@section('konten')

    <div class="card">
        <div class="card-header">
            <div class="col-12">
                <div class="card-header">
                    <h4 class="card-title">Statistik Pendaftaran Penduduk WNI - Kartu Keluarga</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Provinsi</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" name='provinsi' required>
                                                @foreach ($provinsi as $prov)
                                                    <option value='{{$prov['id']}}'>{{$prov['nama']}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Kabupaten / Kota</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" name='kabupaten' id='kabupaten' required>
                                                @foreach ($kabupaten as $kab)
                                                    <option value='{{$kab->NO_KAB}}'>{{$kab->NAMA_KAB}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Kecamatan</label>
                                        <fieldset class="form-group">
                                            <select  class="form-select" name='kecamatan' id='kecamatan' onClick="select_kecamatan()" required>
                                                <option value="semua">SEMUA</option>
                                                <option></option>
                                                <option></option>
                                                <option></option>
                                                <option></option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Desa / Kelurahan</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" name='kelurahan' id='kelurahan'
                                            onClick="select_kelurahan()" required>
                                                <option value="semua">SEMUA</option>
                                                <option></option>
                                                <option></option>
                                                <option></option>
                                                <option></option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Statistik</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" name="statistik" id='statistik' required>
                                                @foreach ($statistik as $stat)
                                                    <option value='{{$stat['id']}}'>{{$stat['nama']}}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="first-name-column">Bulan</label>
                                        <fieldset class="form-group">
                                            <input type="month" name="bulan" required>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success me-1 mb-1">Filter</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            <h4 class="card-title" id='judul_tabel'></h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-condensed flip-content edit-table" id="tabel">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
@endsection

@section('js_asset')

    <!-- Datatable -->
    <script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    
    <script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
    
    <script>
        
    </script>

@endsection

@section('js_script')
    <script>
        function select_kecamatan(){
            const token = $('meta[name="csrf-token"]').attr('content');
            $('#kelurahan').html("<option value='semua'>SEMUA</option><option></option><option></option><option></option><option></option>");
            if(isNaN($('#kecamatan').val()))
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: "{{ url('/get_kecamatan') }}",
                    type: "POST",
                    data: {
                            id: $('#kabupaten').val(),
                        },
                    async : true,
                    dataType : 'json',
                    //jika ajax sukses
                    success: function(data){
                        let html = "<option value='semua'>SEMUA</option>";
                        for(let i=0; i<data.length; i++){
                            html += '<option value='+data[i].NO_KEC+'>'+data[i].NAMA_KEC+'</option>';
                        }
                        $('#kecamatan').html(html);
                    },
                    //jika ajax gagal
                    error: function () {
                        swal.fire("Error", "Periksa koneksi anda", "error");
                    }
                });
            
        }

        function select_kelurahan(){
            const token = $('meta[name="csrf-token"]').attr('content');
            if(isNaN($('#kelurahan').val()))
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/get_kelurahan') }}",
                type: "POST",
                data: {
                        id: $('#kecamatan').val(),
                    },
                async : true,
                dataType : 'json',
                //jika ajax sukses
                success: function(data){
                    let html = "<option value='semua'>SEMUA</option>";
                    for(let i=0; i<data.length; i++){
                        html += '<option value='+data[i].NO_KEL+'>'+data[i].NAMA_KEL+'</option>';
                    }
                    $('#kelurahan').html(html);
                },
                //jika ajax gagal
                error: function () {
                    swal.fire("Error", "Periksa koneksi anda", "error");
                }
            });
        }

        /* Send Form Add */
        $( "form" ).on( "submit", function( e ) {
            e.preventDefault();
            let valid=true;
            let token = $('meta[name="csrf-token"]').attr('content');
            //generalisasi form agar data file bisa masuk
            let form = $(this)[0];
            //mengambil semua data di dalam form
            let formData = new FormData(form);
            
            $('#thead').html(""); 
            $('#tbody').html("");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/dafduk_wni/kk_statistik') }}",
                type: "POST",
                data: formData,
                dataType: "html",
                contentType: false,
                processData: false,
                //jika ajax sukses
                success: function(data){
                    data = JSON.parse(data);
                    let html = '';

                    if($('#statistik').val() == 1)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan, Desa/Kelurahan</th><th scope='col'>Laki-Laki</th><th scope='col'>Perempuan</th><th scope='col'>Total</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_LK = 0;
                            let sum_LP = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_LK = sum_LK+parseInt(data[i]?.LK);
                                sum_LP = sum_LP+parseInt(data[i]?.LP);
                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.LK+"</td><td>"+data[i]?.LP+"</td><td>"+(parseInt(data[i]?.LK)+parseInt(data[i]?.LP))+"</td></tr>";
                            }
                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_LK+"</td><td>"+sum_LP+"</td><td>"+(parseInt(sum_LK)+parseInt(sum_LP))+"</td></tr>";
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut jenis Kelamin"); 
                    }

                    if($('#statistik').val() == 2)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan dan Desa/Kelurahan</th><th scope='col'>PDD1</th><th scope='col'>PDD2</th><th scope='col'>PDD3</th><th scope='col'>PDD4</th><th scope='col'>PDD5</th><th scope='col'>PDD6</th><th scope='col'>PDD7</th><th scope='col'>PDD8</th><th scope='col'>PDD9</th><th scope='col'>PDD10</th><th scope='col'>TOTAL</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_PDD01 = 0;let sum_PDD02 = 0;let sum_PDD03 = 0;
                            let sum_PDD04 = 0;let sum_PDD05 = 0;let sum_PDD06 = 0;
                            let sum_PDD07 = 0;let sum_PDD08 = 0;let sum_PDD09 = 0;
                            let sum_PDD10 = 0;
                            
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_PDD01 = sum_PDD01+parseInt(data[i]?.PDD01);
                                sum_PDD02 = sum_PDD02+parseInt(data[i]?.PDD02);
                                sum_PDD03 = sum_PDD03+parseInt(data[i]?.PDD03);
                                sum_PDD04 = sum_PDD04+parseInt(data[i]?.PDD04);
                                sum_PDD05 = sum_PDD05+parseInt(data[i]?.PDD05);
                                sum_PDD06 = sum_PDD06+parseInt(data[i]?.PDD06);
                                sum_PDD07 = sum_PDD07+parseInt(data[i]?.PDD07);
                                sum_PDD08 = sum_PDD08+parseInt(data[i]?.PDD08);
                                sum_PDD09 = sum_PDD09+parseInt(data[i]?.PDD09);
                                sum_PDD10 = sum_PDD10+parseInt(data[i]?.PDD10);

                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.PDD01+"</td><td>"+data[i]?.PDD02+"</td><td>"+data[i]?.PDD03+"</td><td>"+data[i]?.PDD04+"</td><td>"+data[i]?.PDD05+"</td><td>"+data[i]?.PDD06+"</td><td>"+data[i]?.PDD07+"</td><td>"+data[i]?.PDD08+"</td><td>"+data[i]?.PDD09+"</td><td>"+data[i]?.PDD10+"</td><td>"+(parseInt(data[i]?.PDD01)+parseInt(data[i]?.PDD02)+parseInt(data[i]?.PDD03)+parseInt(data[i]?.PDD04)+parseInt(data[i]?.PDD05)+parseInt(data[i]?.PDD06)+parseInt(data[i]?.PDD07)+parseInt(data[i]?.PDD08)+parseInt(data[i]?.PDD09)+parseInt(data[i]?.PDD10))+"</td></tr>";
                            }
                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_PDD01+"</td><td>"+sum_PDD02+"</td><td>"+sum_PDD03+"</td><td>"+sum_PDD04+"</td><td>"+sum_PDD05+"</td><td>"+sum_PDD06+"</td><td>"+sum_PDD07+"</td><td>"+sum_PDD08+"</td><td>"+sum_PDD09+"</td><td>"+sum_PDD10+"</td>><td>"+(sum_PDD01+sum_PDD02+sum_PDD03+sum_PDD04+sum_PDD05+sum_PDD06+sum_PDD07+sum_PDD08+sum_PDD09+sum_PDD10)+"</td></tr>";
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut Pendidikan Terakhir");
                    }

                    if($('#statistik').val() == 3)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan, Desa/Kelurahan</th><th scope='col'>Belum Kawin</th><th scope='col'>Kawin</th><th scope='col'>Cerai Hidup</th><th scope='col'>Cerai Mati</th><th scope='col'>TOTAL</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_BELUM_KAWIN = 0; let sum_KAWIN = 0;
                            let sum_CERAI_HIDUP = 0; let sum_CERAI_MATI = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_BELUM_KAWIN = sum_BELUM_KAWIN+parseInt(data[i]?.BELUM_KAWIN);
                                sum_KAWIN = sum_KAWIN+parseInt(data[i]?.KAWIN);
                                sum_CERAI_HIDUP = sum_CERAI_HIDUP+parseInt(data[i]?.CERAI_HIDUP);
                                sum_CERAI_MATI = sum_CERAI_MATI+parseInt(data[i]?.CERAI_MATI);

                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.BELUM_KAWIN+"</td><td>"+data[i]?.KAWIN+"</td><td>"+data[i]?.CERAI_HIDUP+"</td><td>"+data[i]?.CERAI_MATI+"</td><td>"+(parseInt(data[i]?.KAWIN)+parseInt(data[i]?.BELUM_KAWIN)+parseInt(data[i]?.CERAI_HIDUP)+parseInt(data[i]?.CERAI_MATI))+"</td></tr>";
                            }
                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_BELUM_KAWIN+"</td><td>"+sum_KAWIN+"</td><td>"+sum_CERAI_HIDUP+"</td><td>"+sum_CERAI_MATI+"</td><td>"+(parseInt(sum_KAWIN)+parseInt(sum_BELUM_KAWIN)+parseInt(sum_CERAI_HIDUP)+parseInt(sum_CERAI_MATI))+"</td></tr>";
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut Status Perkawinan");
                    }

                    if($('#statistik').val() == 4)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan, Desa/Kelurahan</th><th scope='col'>A</th><th scope='col'>B</th><th scope='col'>AB</th><th scope='col'>O</th><th scope='col'>A+</th><th scope='col'>A-</th><th scope='col'>B+</th><th scope='col'>B-</th><th scope='col'>AB+</th><th scope='col'>AB-</th><th scope='col'>0+</th><th scope='col'>0-</th><th scope='col'>Tidak Tahu</th><th scope='col'>TOTAL</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_A = 0;let sum_B = 0;let sum_AB = 0;
                            let sum_O = 0;let sum_A_POS = 0;let sum_A_MIN = 0;
                            let sum_B_POS = 0;let sum_B_MIN = 0;let sum_AB_POS = 0;
                            let sum_AB_MIN = 0;let sum_O_POS = 0;let sum_O_MIN = 0;
                            let sum_TIDAK_TAHU = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_A = sum_A+parseInt(data[i]?.A);
                                sum_B = sum_B+parseInt(data[i]?.B);
                                sum_AB = sum_AB+parseInt(data[i]?.AB);
                                sum_O = sum_O+parseInt(data[i]?.O);
                                sum_A_POS = sum_A_POS+parseInt(data[i]?.A_POS);
                                sum_A_MIN = sum_A_MIN+parseInt(data[i]?.A_MIN);
                                sum_B_POS = sum_B_POS+parseInt(data[i]?.B_POS);
                                sum_B_MIN = sum_B_MIN+parseInt(data[i]?.B_MIN);
                                sum_AB_POS = sum_AB_POS+parseInt(data[i]?.AB_POS);
                                sum_AB_MIN = sum_AB_MIN+parseInt(data[i]?.AB_MIN);
                                sum_O_POS = sum_O_POS+parseInt(data[i]?.O_POS);
                                sum_O_MIN = sum_O_MIN+parseInt(data[i]?.O_MIN);
                                sum_TIDAK_TAHU = sum_TIDAK_TAHU+parseInt(data[i]?.TIDAK_TAHU);

                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.A+"</td><td>"+data[i]?.B+"</td><td>"+data[i]?.AB+"</td><td>"+data[i]?.O+"</td><td>"+data[i]?.A_POS+"</td><td>"+data[i]?.A_MIN+"</td><td>"+data[i]?.B_POS+"</td><td>"+data[i]?.B_MIN+"</td><td>"+data[i]?.AB_POS+"</td><td>"+data[i]?.AB_MIN+"</td><td>"+data[i]?.O_POS+"</td><td>"+data[i]?.O_MIN+"</td><td>"+data[i]?.TIDAK_TAHU+"</td><td>"+(parseInt(data[i]?.A)+parseInt(data[i]?.B)+parseInt(data[i]?.AB)+parseInt(data[i]?.O)+parseInt(data[i]?.A_POS)+parseInt(data[i]?.A_MIN)+parseInt(data[i]?.B_POS)+parseInt(data[i]?.B_MIN)+parseInt(data[i]?.AB_POS)+parseInt(data[i]?.AB_MIN)+parseInt(data[i]?.O_POS)+parseInt(data[i]?.O_MIN)+parseInt(data[i]?.TIDAK_TAHU))+"</td></tr>";
                            }

                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_A+"</td><td>"+sum_B+"</td><td>"+sum_AB+"</td><td>"+sum_O+"</td><td>"+sum_A_POS+"</td><td>"+sum_A_MIN+"</td><td>"+sum_B_POS+"</td><td>"+sum_B_MIN+"</td><td>"+sum_AB_POS+"</td><td>"+sum_AB_MIN+"</td><td>"+sum_O_POS+"</td><td>"+sum_O_MIN+"</td><td>"+sum_TIDAK_TAHU+"</td><td>"+(parseInt(sum_A)+parseInt(sum_B)+parseInt(sum_AB)+parseInt(sum_O)+parseInt(sum_A_POS)+parseInt(sum_A_MIN)+parseInt(sum_B_POS)+parseInt(sum_B_MIN)+parseInt(sum_AB_POS)+parseInt(sum_AB_MIN)+parseInt(sum_O_POS)+parseInt(sum_O_MIN)+parseInt(sum_TIDAK_TAHU))+"</td></tr>";

                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut Golongan Darah"); 

                        $('#thead').html(""); 
                        $('#tbody').html("");
                        if(data.length > 0) $('#tbody').html("");
                        $('#judul_tabel').html(""); 
                    }

                    if($('#statistik').val() == 5)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan, Desa/Kelurahan</th><th scope='col'>Islam</th><th scope='col'>Kristen</th><th scope='col'>Katholik</th><th scope='col'>Hindu</th><th scope='col'>Budha</th><th scope='col'>Konghucu</th><th scope='col'>Kepercayaan</th><th scope='col'>TOTAL</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_ISLAM = 0;
                            let sum_KRISTEN = 0;
                            let sum_KATHOLIK = 0;
                            let sum_HINDU = 0;
                            let sum_BUDHA = 0;
                            let sum_KONGHUCU = 0;
                            let sum_KEPERCAYAAN = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_ISLAM = sum_ISLAM+parseInt(data[i]?.ISLAM);
                                sum_KRISTEN = sum_KRISTEN+parseInt(data[i]?.KRISTEN);
                                sum_KATHOLIK = sum_KATHOLIK+parseInt(data[i]?.KATHOLIK);
                                sum_HINDU = sum_HINDU+parseInt(data[i]?.HINDU);
                                sum_BUDHA = sum_BUDHA+parseInt(data[i]?.BUDHA);
                                sum_KONGHUCU = sum_KONGHUCU+parseInt(data[i]?.KONGHUCU);
                                sum_KEPERCAYAAN = sum_KEPERCAYAAN+parseInt(data[i]?.KEPERCAYAAN);

                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.ISLAM+"</td><td>"+data[i]?.KRISTEN+"</td><td>"+data[i]?.KATHOLIK+"</td><td>"+data[i]?.HINDU+"</td><td>"+data[i]?.BUDHA+"</td><td>"+data[i]?.KONGHUCU+"</td><td>"+data[i]?.KEPERCAYAAN+"</td><td>"+(parseInt(data[i]?.ISLAM)+parseInt(data[i]?.KRISTEN)+parseInt(data[i]?.KATHOLIK)+parseInt(data[i]?.HINDU)+parseInt(data[i]?.BUDHA)+parseInt(data[i]?.KONGHUCU)+parseInt(data[i]?.KEPERCAYAAN))+"</td></tr>";
                            }

                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_ISLAM+"</td><td>"+sum_KRISTEN+"</td><td>"+sum_KATHOLIK+"</td><td>"+sum_HINDU+"</td><td>"+sum_BUDHA+"</td><td>"+sum_KONGHUCU+"</td><td>"+sum_KEPERCAYAAN+"</td><td>"+(parseInt(sum_ISLAM)+parseInt(sum_KRISTEN)+parseInt(sum_KATHOLIK)+parseInt(sum_HINDU)+parseInt(sum_BUDHA)+parseInt(sum_KONGHUCU)+parseInt(sum_KEPERCAYAAN))+"</td></tr>";
                            
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut Agama");
                    }

                    if($('#statistik').val() == 6)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Kecamatan, Desa/Kelurahan</th><th scope='col'>Fisik</th><th scope='col'>Netra</th><th scope='col'>Rungu</th><th scope='col'>Mental</th><th scope='col'>Fisik Mental</th><th scope='col'>Lainnya</th><th scope='col'>TOTAL</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            let sum_FISIK = 0;
                            let sum_NETRA = 0;
                            let sum_RUNGU = 0;
                            let sum_MENTAL = 0;
                            let sum_FISIK_MENTAL = 0;
                            let sum_LAINNYA = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_FISIK = sum_FISIK+parseInt(data[i]?.FISIK);
                                sum_NETRA = sum_NETRA+parseInt(data[i]?.NETRA);
                                sum_RUNGU = sum_RUNGU+parseInt(data[i]?.RUNGU);
                                sum_MENTAL = sum_MENTAL+parseInt(data[i]?.MENTAL);
                                sum_FISIK_MENTAL = sum_FISIK_MENTAL+parseInt(data[i]?.FISIK_MENTAL);
                                sum_LAINNYA = sum_LAINNYA+parseInt(data[i]?.LAINNYA);

                                html += "<tr role='row'><td>"+data[i]?.NAMA_KEC+", "+data[i]?.NAMA_KEL+"</td><td>"+data[i]?.FISIK+"</td><td>"+data[i]?.NETRA+"</td><td>"+data[i]?.RUNGU+"</td><td>"+data[i]?.MENTAL+"</td><td>"+data[i]?.FISIK_MENTAL+"</td><td>"+data[i]?.LAINNYA+"</td><td>"+(parseInt(data[i]?.FISIK)+parseInt(data[i]?.NETRA)+parseInt(data[i]?.RUNGU)+parseInt(data[i]?.MENTAL)+parseInt(data[i]?.FISIK_MENTAL)+parseInt(data[i]?.LAINNYA))+"</td></tr>";
                            }
                            html += "<tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>"+sum_FISIK+"</td><td>"+sum_NETRA+"</td><td>"+sum_RUNGU+"</td><td>"+sum_MENTAL+"</td><td>"+sum_FISIK_MENTAL+"</td><td>"+sum_LAINNYA+"</td><td>"+(parseInt(sum_FISIK)+parseInt(sum_NETRA)+parseInt(sum_RUNGU)+parseInt(sum_MENTAL)+parseInt(sum_FISIK_MENTAL)+parseInt(sum_LAINNYA))+"</td></tr>";

                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td class='text-center'><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Kepala Keluarga Menurut Penyandang Cacat"); 
                    }
                    
                    // $('#tabel').DataTable().destroy();
                    // $('#tabel').DataTable({
                    //     dom: 'Bfrtip',
                    //     buttons: [
                    //         'copy', 'csv', 'excel', 'pdf', 'print'
                    //     ],
                    //     rowReorder: {
                    //         selector: 'td:nth-child(2)'
                    //     },
                    //     responsive: true
                    // });
                },
                //jika ajax gagal
                error: function () {
                    swal.fire("Error", "Periksa koneksi anda", "error");
                }
            });
        });

        /* Send Form End */
    </script>
@endsection