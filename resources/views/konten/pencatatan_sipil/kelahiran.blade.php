@extends('core/main')
@extends('core/navbar')
@extends('core/footer')

@section('title', 'Daftar Pencatatan Sipil - Sistem Informasi Statistik Data Kependudukan Kabupaten Sidoarjo')
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
                    <h4 class="card-title">Statistik Pencatatan Sipil - Kelahiran</h4>
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
                                        <label for="first-name-column">Tahun</label>
                                        <fieldset class="form-group">
                                            <input type="text" pattern="\d*" name="tahun" maxlength="4" minlength="4" required>
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
                url: "{{ url('/pencatatan_sipil/kelahiran_statistik') }}",
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
                        html += "<thead><th scope='col'>Tanggal</th><th scope='col'>Laki-Laki</th><th scope='col'>Perempuan</th></thead>"; 

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
                                html += "<tr role='row'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.LK+"</td><td>"+data[i]?.LP+"</td></tr>";
                            }
                            html += "<tr role='row'><td><strong>TOTAL</strong></td><td>"+sum_LK+"</td><td>"+sum_LP+"</td></tr>";
                            html += "</tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td><strong>TOTAL</strong></td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut jenis Kelamin"); 
                    }

                    if($('#statistik').val() == 2)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Sort</th><th scope='col'>Struktur Umur</th><th scope='col'>Laki Laki</th><th scope='col'>Perempuan</th><th scope='col'>Ada Akta</th><th scope='col'>Tidak Ada Akta</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            let sum_LAKI_LAKI = 0;
                            let sum_PEREMPUAN = 0;
                            let sum_ADA_AKTA = 0;
                            let sum_TIDAK_ADA_AKTA = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_LAKI_LAKI = sum_LAKI_LAKI+parseInt(data[i]?.LAKI_LAKI);
                                sum_PEREMPUAN = sum_PEREMPUAN+parseInt(data[i]?.PEREMPUAN);
                                sum_ADA_AKTA = sum_ADA_AKTA+parseInt(data[i]?.ADA_AKTA);
                                sum_TIDAK_ADA_AKTA = sum_TIDAK_ADA_AKTA+parseInt(data[i]?.TIDAK_ADA_AKTA);

                                html += "<tr role='row'><td>"+data[i]?.SORT+"</td><td>"+data[i]?.LAKI_LAKI+"</td><td>"+data[i]?.PEREMPUAN+"</td><td>"+data[i]?.ADA_AKTA+"</td><td>"+data[i]?.TIDAK_ADA_AKTA+"</td></tr>";
                            }
                            html += "<tr role='row'><td><strong>TOTAL</strong></td><td>SEMUA</td><td>"+sum_LAKI_LAKI+"</td><td>"+sum_PEREMPUAN+"</td><td>"+sum_ADA_AKTA+"</td><td>"+sum_TIDAK_ADA_AKTA+"</td></tr>";
                            html += "<tbody>";
                        } 
                        else
                        {
                            html += "<tbody><tr role='row'><td><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Struktur Umur & Jenis Kelamin"); 
                    }

                    if($('#statistik').val() == 3)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Bulan</th><th scope='col'>Polindes</th><th scope='col'>Puskesmas</th><th scope='col'>Rumah Sakit</th><th scope='col'>Rumah</th><th scope='col'>Lainnya</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            let sum_POLINDES = 0;
                            let sum_PUSKESMAS = 0;
                            let sum_RS = 0;
                            let sum_RUMAH = 0;
                            let sum_LAINNYA = 0;
                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_POLINDES = sum_POLINDES+parseInt(data[i]?.POLINDES);
                                sum_PUSKESMAS = sum_PUSKESMAS+parseInt(data[i]?.PUSKESMAS);
                                sum_RS = sum_RS+parseInt(data[i]?.RS);
                                sum_RUMAH = sum_RUMAH+parseInt(data[i]?.RUMAH);
                                sum_LAINNYA = sum_LAINNYA+parseInt(data[i]?.LAINNYA);

                                html += "<tr role='row'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.POLINDES+"</td><td>"+data[i]?.PUSKESMAS+"</td><td>"+data[i]?.RS+"</td><td>"+data[i]?.RUMAH+"</td><td>"+data[i]?.LAINNYA+"</td></tr>";
                            }
                            html += "<tr role='row'><td><strong>TOTAL</strong></td><td>"+sum_POLINDES+"</td><td>"+sum_PUSKESMAS+"</td><td>"+sum_RS+"</td><td>"+sum_RUMAH+"</td><td>"+sum_LAINNYA+"</td></tr>";
                            html += "<tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row'><td><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html);
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut Pendidikan Akhir"); 
                    }

                    if($('#statistik').val() == 4)
                    {
                        //insert thead
                        html += "<thead><th scope='col'>Bulan</th><th scope='col'>L1</th><th scope='col'>L2</th><th scope='col'>L3</th><th scope='col'>L4</th><th scope='col'>L5</th></thead>";

                        //insert tbody
                        if(data.length > 0) 
                        {
                            let sum_L1 = 0;
                            let sum_L2 = 0;
                            let sum_L3 = 0;
                            let sum_L4 = 0;
                            let sum_L5 = 0;

                            html += "<tbody>";
                            for(let i=0; i<data.length; i++)
                            {
                                sum_L1 = sum_L1+parseInt(data[i]?.L1);
                                sum_L2 = sum_L2+parseInt(data[i]?.L2);
                                sum_L3 = sum_L3+parseInt(data[i]?.L3);
                                sum_L4 = sum_L4+parseInt(data[i]?.L4);
                                sum_L5 = sum_L5+parseInt(data[i]?.L5);

                                html += "<tr role='row'><td>"+data[i]?.BLN+"</td><td>"+data[i]?.L1+"</td><td>"+data[i]?.L2+"</td><td>"+data[i]?.L3+"</td><td>"+data[i]?.L4+"</td><td>"+data[i]?.L5+"</td></tr>";
                            }
                            html += "<tr role='row'><td><strong>TOTAL</strong></td><td>"+sum_L1+"</td><td>"+sum_L2+"</td><td>"+sum_L3+"</td><td>"+sum_L4+"</td><td>"+sum_L5+"</td></tr>";
                            html += "<tbody>";
                        }
                        else
                        {
                            html += "<tbody><tr role='row'><td><strong>TOTAL</strong></td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr></tbody>";
                        }

                        //insert ke id
                        $('#tabel').html(html); 
                        $('#judul_tabel').html("Statistik Jumlah Penduduk Menurut jenis Pekerjaan"); 
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