@include('layouts.user_header')

<div class="content">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card">

                    <form action="{{ route('store.perbaikan') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <label for="id_user">Nama Pemilik :</label>
                                    <input type="text" class="form-control" name="nama_pemilik"
                                        value="{{ ucfirst($nama_depan . ' ' . $nama_belakang) }}" readonly>
                                    <input type="hidden" class="form-control" name="id_user"
                                        value="{{ $id_user }}" readonly>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label for="nama_mobil">Nama Mobil :</label>
                                    <input type="text" class="form-control" name="nama_mobil"
                                        value="{{ $nama_mobil }}" {{ $readonly }}>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label for="plat_mobil">Plat Mobil :</label>
                                    <input type="text" class="form-control" name="plat_mobil"
                                        value="{{ $plat_mobil }}" {{ $readonly }}>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label for="tentang_kerusakan">Kerusakan :</label>
                                    <textarea class="form-control" name="tentang_kerusakan" rows="4" {{ $readonly }}>{{ $tentang_kerusakan }}</textarea>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label for="tanggal_mulai">Tanggal Mulai :</label>
                                    <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai"
                                        value="{{ date('Y-m-d') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-3">
                            <div class="d-flex justify-content-end">
                                @if ($allReadOnly)
                                    @if ($status == 'sudah selesai')
                                    <a class="btn btn-primary" type="button" href="{{ route('cetaknota', ['id_perbaikan' => $id_perbaikan]) }}">
                                    <i class="fas fa-file-alt"></i> Lihat Nota </a>                                
                                    @elseif ($status == 'sudah diproses')
                                        <button class="btn btn-primary" type="button" onclick="showStatusAlert()">
                                            <i class="fas fa-search"></i> Lihat Status Perbaikan</button>
                                    @elseif ($status == 'belum diproses')
                                        <button class="btn btn-primary" type="button" onclick="showStatusAlert()">
                                            <i class="fas fa-search"></i> Lihat Status Perbaikan</button>
                                    @endif
                                @else
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-save"></i> Simpan</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
</div>

@include('layouts.user_footer')

<script>
    function showStatusAlert() {
        var status = "{{ $status }}";

        Swal.fire({ 
            title: 'Status Perbaikan',
            text: status,
            icon: 'info',
            confirmButtonText: 'OK'
        });
    }
</script>

