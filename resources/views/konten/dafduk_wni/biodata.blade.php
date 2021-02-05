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
                    <h4 class="card-title">Statistik Pendaftaran Penduduk WNI - Biodata</h4>
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
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Filter</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1" onclick="location.href = ''">Reset</button>
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
            {{-- 
            <table class='table table-striped' >                
                <thead>
                    <tr id='thead'>
                    </tr>
                </thead>
                <tbody id='tbody'>
                </tbody>
            </table>
            --}}
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

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/dafduk_wni/biodata_statistik') }}",
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
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Dak. Laki-Laki</th><th scope='col'>Dak. Perempuan</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.DAK_LK+"</td><td>"+data[i]?.DAK_LP+"</td></tr>";
                            }
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut jenis Kelamin"); 
                    }

                    if($('#statistik').val() == 2)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Sort</th><th scope='col'>Struktur Umur</th><th scope='col'>Laki Laki</th><th scope='col'>Perempuan</th><th scope='col'>Ada Akta</th><th scope='col'>Tidak Ada Akta</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.SORT+"</td><td>"+data[i]?.STRUKTUR_UMUR+"</td><td>"+data[i]?.LAKI_LAKI+"</td><td>"+data[i]?.PEREMPUAN+"</td><td>"+data[i]?.ADA_AKTA+"</td><td>"+data[i]?.TIDAK_ADA_AKTA+"</td></tr>";
                            }
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Struktur Umur & Jenis Kelamin"); 
                    }

                    if($('#statistik').val() == 3)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>PDD01</th><th scope='col'>PDD02</th><th scope='col'>PDD03</th><th scope='col'>PDD04</th><th scope='col'>PDD05</th><th scope='col'>PDD06</th><th scope='col'>PDD07</th><th scope='col'>PDD08</th><th scope='col'>PDD09</th><th scope='col'>PDD10</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.PDD01+"</td><td>"+data[i]?.PDD02+"</td><td>"+data[i]?.PDD03+"</td><td>"+data[i]?.PDD04+"</td><td>"+data[i]?.PDD05+"</td><td>"+data[i]?.PDD06+"</td><td>"+data[i]?.PDD07+"</td><td>"+data[i]?.PDD08+"</td><td>"+data[i]?.PDD09+"</td><td>"+data[i]?.PDD10+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html);
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Pendidikan Akhir"); 
                    }

                    if($('#statistik').val() == 4)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Kode Pekerjaan</th><th scope='col'>Value</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.KODE_PEKERJAAN+"</td><td>"+data[i]?.VALUE+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut jenis Pekerjaan"); 
                    }

                    if($('#statistik').val() == 5)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Belum Kawin</th><th scope='col'>Kawin</th><th scope='col'>Cerai Hidup</th><th scope='col'>Cerai Mati</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.BELUM_KAWIN+"</td><td>"+data[i]?.KAWIN+"</td><td>"+data[i]?.CERAI_HIDUP+"</td><td>"+data[i]?.CERAI_MATI+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                            else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Status Perkawinan");  
                    }

                    if($('#statistik').val() == 6)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>A</th><th scope='col'>B</th><th scope='col'>AB</th><th scope='col'>O</th><th scope='col'>A+</th><th scope='col'>A-</th><th scope='col'>B+</th><th scope='col'>B-</th><th scope='col'>AB+</th><th scope='col'>AB-</th><th scope='col'>0+</th><th scope='col'>0-</th><th scope='col'>Tidak Tahu</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.A+"</td><td>"+data[i]?.B+"</td><td>"+data[i]?.AB+"</td><td>"+data[i]?.O+"</td><td>"+data[i]?.A_POS+"</td><td>"+data[i]?.A_MIN+"</td><td>"+data[i]?.B_POS+"</td><td>"+data[i]?.B_MIN+"</td><td>"+data[i]?.AB_POS+"</td><td>"+data[i]?.AB_MIN+"</td><td>"+data[i]?.O_POS+"</td><td>"+data[i]?.O_MIN+"</td><td>"+data[i]?.TIDAK_TAHU+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Golongan Darah"); 
                    }

                    if($('#statistik').val() == 7)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Islam</th><th scope='col'>Kristen</th><th scope='col'>Katholik</th><th scope='col'>Hindu</th><th scope='col'>Budha</th><th scope='col'>Konghucu</th><th scope='col'>Kepercayaan</th></thead>";

                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.ISLAM+"</td><td>"+data[i]?.KRISTEN+"</td><td>"+data[i]?.KATHOLIK+"</td><td>"+data[i]?.HINDU+"</td><td>"+data[i]?.BUDHA+"</td><td>"+data[i]?.KONGHUCU+"</td><td>"+data[i]?.KEPERCAYAAN+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Agama"); 
                    }

                    if($('#statistik').val() == 8)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Fisik</th><th scope='col'>Netra</th><th scope='col'>Rungu</th><th scope='col'>Mental</th><th scope='col'>Fisik Mental</th><th scope='col'>Lainnya</th></thead>"; 

                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.FISIK+"</td><td>"+data[i]?.NETRA+"</td><td>"+data[i]?.RUNGU+"</td><td>"+data[i]?.MENTAL+"</td><td>"+data[i]?.FISIK_MENTAL+"</td><td>"+data[i]?.LAINNYA+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Penyandang Cacat"); 
                    }

                    if($('#statistik').val() == 9)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Laki-Laki</th><th scope='col'>Perempuan</th></thead>"; 

                        //insert tbody
                        
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.LK+"</td><td>"+data[i]?.LP+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html);
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Wajib KTP"); 
                    }

                    if($('#statistik').val() == 10)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Kepala Keluarga</th><th scope='col'>Suami</th><th scope='col'>Istri</th><th scope='col'>Anak</th><th scope='col'>Menantu</th><th scope='col'>Cucu</th><th scope='col'>Orang Tua</th><th scope='col'>Mertua</th><th scope='col'>Famili Lain</th><th scope='col'>Pembantu</th><th scope='col'>Lainnya</th></thead>"; 
                        
                        //insert tbody
                        if(data.length > 0)
                        {
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                html += "<tr role='row' class='even'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.KEPALA_KELUARGA+"</td><td>"+data[i]?.SUAMI+"</td><td>"+data[i]?.ISTRI+"</td><td>"+data[i]?.ANAK+"</td><td>"+data[i]?.MENANTU+"</td><td>"+data[i]?.CUCU+"</td><td>"+data[i]?.ORANG_TUA+"</td><td>"+data[i]?.MERTUA+"</td><td>"+data[i]?.FAMILI_LAIN+"</td><td>"+data[i]?.PEMBANTU+"</td><td>"+data[i]?.LAINNYA+"</td></tr>";
                            }
                            html += "</tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row' class='even'><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html);
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Wajib KTP"); 
                    }
                    
                    // $('#tabel').DataTable().destroy();
                    // $('#tabel').DataTable({
                    //     dom: 'Bfrtip',
                    //     lengthMenu: [
                    //         [ 10, 25, 50, 100 ],
                    //         [ '10 rows', '25 rows', '50 rows', '100 rows' ]
                    //     ],
                    //     buttons: [
                    //         'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
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