@include('layouts.admin_header')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card col-lg-12 container-f;uid">
                <div class="card-header"><i class="fas fa-cog"></i> List Mekanik</div>
                <table class="table table-hover" id="table_perbaikan">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Mekanik</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($mekanik->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center badge-secondary">Tidak ada Mekanik</td>
                            </tr>
                        @else
                            @foreach ($mekanik as $key => $m)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $m->nama_mekanik }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalPenduduk-{{ $m->id_mekanik }}"><i class="fas fa-pen"></i>
                                            Ubah</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalPenduduk-{{ $m->id_mekanik }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalPendudukLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalPendudukLabel">Ubah data
                                                            mekanik {{ $m->nama_mekanik }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card container-fluid">
                                                            <form action="{{ route('update.mekanik', $m->id_mekanik) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="nama_mekanik">Nama
                                                                                Mekanik</label>
                                                                            <input type="text" class="form-control @error('nama_mekanik') is-invalid @enderror" id="nama_mekanik" name="nama_mekanik" placeholder="Masukan Nama Mekanik" value="{{ old('nama_mekanik', $m->nama_mekanik) }}">
                                                                            @error('nama_mekanik')
                                                                            <div class="invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit"
                                                                            class="btn btn-primary"><i
                                                                                class="fas fa-save"></i> Simpan</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-{{ $m->id_mekanik }}"><i class="fas fa-trash"></i>
                                            Hapus</button>


                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="modal-hapus-{{ $m->id_mekanik }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-hapusLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal-hapusLabel">
                                                            Konfirmasi
                                                            Hapus Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data mekanik
                                                        <b>{{ $m->nama_mekanik }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <form
                                                            action="{{ route('destroy.mekanik', ['id_mekanik' => $m->id_mekanik]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal" data-target="#ModalTambah">
                        <i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin_footer')

<!-- Modal Tambah -->
<div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="ModalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.mekanik') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label for="nik">Nama Mekanik</label>
                            <input type="text"
                                class="form-control @error('nama_mekanik')
                            is-invalid
                        @enderror"
                                name="nama_mekanik" id="nama_mekanik" placeholder="Nama Mekanik"
                                value="{{ old('nama_mekanik') }}">
                            @error('nama_mekanik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                    Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>
