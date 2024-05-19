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
                            <th>Nama jasa</th>
                            <th>Nama Mekanik</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($jasa->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center badge-secondary">Tidak ada data jasa</td>
                            </tr>
                        @else
                            @foreach ($jasa as $key => $j)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $j->nama_jasa }}</td>
                                    <td>{{ $j->mekanik->nama_mekanik }}</td>
                                    <td>{{ 'Rp ' . number_format($j->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalPenduduk-{{ $j->id_jasa }}"><i class="fas fa-pen"></i>
                                            Ubah</button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalPenduduk-{{ $j->id_jasa }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalPendudukLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalPendudukLabel">Ubah data
                                                            {{ $title }} {{ $j->nama_jasa }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card container-fluid">
                                                            <form action="{{ route('update.jasa', $j->id_jasa) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="nama_jasa">Nama Jasa: </label>
                                                                            <input type="text" name="nama_jasa" id="nama_jasa"
                                                                                placeholder="Masukan Nama Jasa"
                                                                                class="form-control @error('nama_jasa') is-invalid @enderror"
                                                                                value="{{ old('nama_jasa', $j->nama_jasa) }}">
                                                                            @error('nama_jasa')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="id_mekanik">Nama Mekanik:</label>
                                                                            <select name="id_mekanik" class="form-control">
                                                                                <option value="">--- Pilih Mekanik ---</option>
                                                                                @if ($mekanik->isEmpty())
                                                                                    <option value="" disabled>Tidak ada data mekanik</option>
                                                                                @else
                                                                                    @foreach ($mekanik as $key => $m)
                                                                                        <option value="{{$m->id_mekanik}}" {{ $j->id_mekanik == $j->id_mekanik ? 'selected' : '' }}>{{ $m->nama_mekanik }}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>                                                                            
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="harga">Harga:</label>
                                                                            <input type="number" name="harga" value="{{ $j->harga }}" class="form-control">
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
                                            data-target="#modal-hapus-{{ $j->id_jasa }}"><i class="fas fa-trash"></i>
                                            Hapus</button>


                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="modal-hapus-{{ $j->id_jasa }}" tabindex="-1"
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
                                                        <b>{{ $j->nama_jasa }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <form
                                                            action="{{ route('destroy.jasa', ['id_jasa' => $j->id_jasa]) }}"
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
                    <button class="btn btn-primary btn-sm mb-2" type="button" data-toggle="modal"
                        data-target="#ModalTambah">
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
                <form action="{{ route('store.jasa') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nama_jasa">Nama Jasa: </label>
                                <input type="text" name="nama_jasa" id="nama_jasa"
                                    placeholder="Masukan Nama Jasa"
                                    class="form-control @error('nama_jasa') is-invalid @enderror"
                                    value="{{ old('nama_jasa') }}">
                                @error('nama_jasa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="id_mekanik">Nama Mekanik:</label>
                                <select name="id_mekanik" class="form-control">
                                    <option value="">--- Pilih Mekanik ---</option>
                                    @if ($mekanik->isEmpty())
                                        <option value="" disabled>Tidak ada data mekanik</option>
                                    @else
                                        @foreach ($mekanik as $key => $m)
                                        <option value="{{$m->id_mekanik}}">{{ $m->nama_mekanik }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="harga">Harga:</label>
                                <input type="number" name="harga" value=""
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
