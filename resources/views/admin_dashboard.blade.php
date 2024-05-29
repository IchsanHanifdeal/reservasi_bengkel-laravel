@include('layouts.admin_header')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $total_pelanggan }}</h3>

                        <p>Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('dashboard') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $total_mekanik }}</h3>

                        <p>Mekanik</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('mekanik') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_item }}</h3>

                        <p>Item</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('item') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $jumlah_jasa }}</h3>

                        <p>Jasa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('jasa') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="d-flex justify-content-center">
            <div class="card col-lg-12 container-f;uid">
                <div class="card-header"><i class="fas fa-table"></i> List Perbaikan</div>
                <table class="table table-hover" id="table_perbaikan">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Mobil</th>
                            <th>Plat Mobil</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($perbaikan->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center badge-secondary">Tidak ada History Peminjaman</td>
                            </tr>
                        @else
                            @foreach ($perbaikan as $key => $p)
                                <tr class="text-center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $p->users->nama_depan . ' ' . $p->users->nama_belakang }}</td>
                                    <td>{{ $p->nama_mobil }}</td>
                                    <td>{{ $p->plat_mobil }}</td>
                                    <td>
                                        @if ($p->status === 'sudah selesai')
                                            <span class="badge badge-success">Sudah Selesai</span>
                                        @elseif ($p->status === 'sudah diproses')
                                            <span class="badge badge-warning">Diproses</span>
                                        @else
                                            <span class="badge badge-secondary">Belum diproses</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal"
                                            data-target="#modalPenduduk-{{ $p->id_perbaikan }}"><i
                                                class="fas fa-pen"></i> Ubah</button>

                                        <div class="modal fade" id="modalPenduduk-{{ $p->id_perbaikan }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modalPendudukLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalPendudukLabel">Ubah data
                                                            perbaikan {{ $p->users->nama_depan }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card container-fluid">
                                                            <form action="{{ route('update.perbaikan', $p->id_perbaikan) }}" method="post" id="form_perbaikan_{{ $p->id_perbaikan }}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="card-body">
                                                                    <div class="row mt-3">
                                                                        <div class="col-lg-12">
                                                                            <label for="id_user">Nama Pemilik :</label>
                                                                            <input type="text" class="form-control" name="nama_pemilik" value="{{ ucfirst($p->users->nama_depan . ' ' . $p->users->nama_belakang) }}" readonly>
                                                                            <input type="hidden" class="form-control" name="id_user" value="{{ $p->id_user }}" readonly>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-2">
                                                                            <label for="nama_mobil">Nama Mobil :</label>
                                                                            <input type="text" class="form-control" name="nama_mobil" value="{{ $p->nama_mobil }}" readonly>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-2">
                                                                            <label for="plat_mobil">Plat Mobil :</label>
                                                                            <input type="text" class="form-control" name="plat_mobil" value="{{ $p->plat_mobil }}" readonly>
                                                                        </div>
                                                                        <div class="col-lg-12 mt-2">
                                                                            <label for="tentang_kerusakan">Kerusakan :</label>
                                                                            <textarea class="form-control" name="tentang_kerusakan" id="tentang_kerusakan" rows="4">{{ $p->tentang_kerusakan }}</textarea>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-2">
                                                                            <label for="tanggal_mulai">Tanggal Mulai :</label>
                                                                            <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" value="{{ date('Y-m-d') }}" readonly>
                                                                        </div>
                                                                        <div class="col-lg-6 mt-2">
                                                                            <label for="tanggal_selesai">Tanggal Selesai :</label>
                                                                            <input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai" value="{{ date('Y-m-d', strtotime($p->tanggal_selesai)) }}">
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <label for="id_mekanik">Nama Mekanik:</label>
                                                                            <select name="id_mekanik" class="form-control">
                                                                                <option value="">--- Pilih Mekanik ---</option>
                                                                                @if ($mekanik->isEmpty())
                                                                                    <option value="" disabled>Tidak ada data mekanik</option>
                                                                                @else
                                                                                    @foreach ($mekanik as $m)
                                                                                        <option value="{{ $m->id_mekanik }}" {{ $p->id_mekanik == $m->id_mekanik ? 'selected' : '' }}>
                                                                                            {{ $m->nama_mekanik }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <label for="status">Status</label>
                                                                            <select name="status" class="form-control" id="status">
                                                                                <option value="">--- Pilih Status ---</option>
                                                                                <option value="belum diproses" {{ $p->status == 'belum diproses' ? 'selected' : '' }}>Belum diproses</option>
                                                                                <option value="sudah diproses" {{ $p->status == 'sudah diproses' ? 'selected' : '' }}>Sudah diproses</option>
                                                                                <option value="sudah selesai" {{ $p->status == 'sudah selesai' ? 'selected' : '' }}>Sudah Selesai</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="id_item">Item :</label>
                                                                                <div class="checkbox-group">
                                                                                    @foreach ($items as $item)
                                                                                        <div class="form-check">
                                                                                            <input type="checkbox"
                                                                                                   class="form-check-input"
                                                                                                   id="item_{{ $item->id_item }}"
                                                                                                   name="id_item[]"
                                                                                                   value="{{ $item->id_item }}"
                                                                                                   data-harga="{{ $item->harga }}"
                                                                                                   {{ in_array($item->id_item, $selected_id_items) ? 'checked' : '' }}
                                                                                                   onchange="calculateTotal('{{ $p->id_perbaikan }}')">
                                                                                            <label class="form-check-label" for="item_{{ $item->id_item }}">{{ $item->nama_item }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                    @if ($items->isEmpty())
                                                                                        <p>Tidak ada Item tersedia</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="id_jasa">Jasa :</label>
                                                                                <div class="checkbox-group">
                                                                                    @foreach ($jasas as $jasa)
                                                                                        <div class="form-check">
                                                                                            <input type="checkbox"
                                                                                                   class="form-check-input"
                                                                                                   id="jasa_{{ $jasa->id_jasa }}"
                                                                                                   name="id_jasa[]"
                                                                                                   value="{{ $jasa->id_jasa }}"
                                                                                                   data-harga="{{ $jasa->harga }}"
                                                                                                   {{ in_array($jasa->id_jasa, $selected_id_jasas) ? 'checked' : '' }}
                                                                                                   onchange="calculateTotal('{{ $p->id_perbaikan }}')">
                                                                                            <label class="form-check-label" for="jasa_{{ $jasa->id_jasa }}">{{ $jasa->nama_jasa }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                    @if ($jasas->isEmpty())
                                                                                        <p>Tidak ada Jasa tersedia</p>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="col-lg-12">
                                                                        <label for="harga">Harga :</label>
                                                                        <input type="text" name="harga" id="harga_{{ $p->id_perbaikan }}" class="form-control" value="{{ $p->harga_total }}" readonly>
                                                                    </div>
                                                                    <div class="card-footer">
                                                                        <div class="d-flex justify-content-end">
                                                                            <button class="btn btn-warning mr-3" id="total_harga" type="button" onclick="calculateTotal('{{ $p->id_perbaikan }}')">
                                                                                <i class="fas fa-search"></i> Hitung Total
                                                                            </button>
                                                                            <button type="submit" class="btn btn-primary">
                                                                                <i class="fas fa-save"></i> Simpan
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-{{ $p->id_perbaikan }}"><i
                                                class="fas fa-trash"></i> Hapus</button>

                                        {{-- Modal Hapus --}}
                                        <div class="modal fade" id="modal-hapus-{{ $p->id_perbaikan }}"
                                            tabindex="-1" role="dialog" aria-labelledby="modal-hapusLabel"
                                            aria-hidden="true">
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
                                                        Apakah Anda yakin ingin menghapus data perbaikan
                                                        <b>{{ $p->users->nama_depan }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <form
                                                            action="{{ route('destroy.perbaikan', ['id_perbaikan' => $p->id_perbaikan]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary" onclick="confirmSend('{{ $p->no_whatsapp }}', '{{ $p->users->nama_depan }}', '{{ $p->users->nama_belakang }}')">
                                            <i class="fas fa-phone"></i> Pesan
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('layouts.admin_footer')
<script>
    function calculateTotal(id_perbaikan) {
        var total = 0;
        var form = document.getElementById('form_perbaikan_' + id_perbaikan);

        // Calculate total for items
        form.querySelectorAll('input[name="id_item[]"]:checked').forEach(function(checkbox) {
            total += parseFloat(checkbox.dataset.harga);
        });

        // Calculate total for jasa
        form.querySelectorAll('input[name="id_jasa[]"]:checked').forEach(function(checkbox) {
            total += parseFloat(checkbox.dataset.harga);
        });

        // Format the total as Rupiah
        var formattedTotal = formatRupiah(total.toFixed(0), 'Rp ');
        document.getElementById('harga_' + id_perbaikan).value = formattedTotal;
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            var separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }

    // Initial calculation
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($perbaikan as $p)
            calculateTotal('{{ $p->id_perbaikan }}');
        @endforeach
    });
</script>

<script>
    function confirmSend(no_whatsapp, nama_depan, nama_belakang) {
        Swal.fire({
            title: `Apakah Anda yakin ingin mengirim pesan WhatsApp kepada ${nama_depan} ${nama_belakang}?`,
            input: 'text',
            inputPlaceholder: 'Masukkan pesan Anda',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Kirim',
            cancelButtonText: 'Batal',
            showLoaderOnConfirm: true,
            preConfirm: (pesan) => {
                const encodedPesan = encodeURI(pesan);
                const url = `https://wa.me/${no_whatsapp}?text=${encodedPesan}`;
                window.location.href = url;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Berhasil!',
                    'Pesan WhatsApp telah terkirim.',
                    'success'
                )
            }
        });
    }
</script>