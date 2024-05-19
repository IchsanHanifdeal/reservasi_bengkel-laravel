@include('layouts.admin_header')

<div class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="card col-lg-12 container-f;uid">
                <div class="card-header"><i class="fas fa-cog"></i> List {{ $title }}</div>
                <table class="table table-hover" id="table_perbaikan">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Item</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($item->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center badge-secondary">Tidak ada data item</td>
                            </tr>
                        @else
                            @foreach ($item as $key => $i)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $i->nama_item }}</td>
                                    <td>{{ "Rp " . number_format($i->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalPenduduk-{{ $i->id_item }}"><i class="fas fa-pen"></i>
                                            Ubah</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalPenduduk-{{ $i->id_item }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalPendudukLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalPendudukLabel">Ubah data
                                                            {{ $title }} {{ $i->nama_item }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card container-fluid">
                                                            <form action="{{ route('update.item', $i->id_item) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="nama_item">Nama Item: </label>
                                                                            <input type="text" name="nama_item" id="nama_item" placeholder="Masukan Nama Item" class="form-control @error('nama_item') is-invalid @enderror" value="{{ old('nama_item', $i->nama_item )}}">
                                                                            @error('nama_item')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="harga">Harga: </label>
                                                                            <input type="number" name="harga" id="harga" value="{{ $i->harga }}" placeholder="Masukan Harga Item" class="form-control">
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
                                            data-target="#modal-hapus-{{ $i->id_item }}"><i class="fas fa-trash"></i>
                                            Hapus</button>


                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="modal-hapus-{{ $i->id_item }}" tabindex="-1"
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
                                                        Apakah Anda yakin ingin menghapus data {{ $title }}
                                                        <b>{{ $i->nama_item }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <form
                                                            action="{{ route('destroy.item', ['id_item' => $i->id_item]) }}"
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
                <form action="{{ route('store.item') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nama_item">Nama Item: </label>
                                <input type="text" name="nama_item" id="nama_item" placeholder="Masukan Nama Item" class="form-control @error('nama_item') is-invalid @enderror" value="{{ old('nama_item')}}">
                                @error('nama_item')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="harga">Harga: </label>
                                <input type="number" name="harga" id="harga" value="" placeholder="Masukan Harga Item" class="form-control">
                            </div>
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
