<div>
    <div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <!-- Tombol navigasi -->
            <button wire:click="pilihMenu('lihat')"
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'lihat' ? 'btn-warning' : 'btn-outline-warning' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-box-open"></i>
                <span class="text-custom-orange-semuakaryawan">Daftar Absensi</span>
            </button>
            <button wire:click="pilihMenu('tambah')"
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'tambah' ? 'btn-warning' : 'btn-outline-warning' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-plus-circle"></i>
                <span class="text-custom-orange-tambahkaryawan">Buat Absensi</span>
            </button>
            <button wire:loading
                class="col-lg-4 col-md-6 mb-4 btn btn-custom-orange mx-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-spinner fa-spin"></i>
                <span class="text-custom-orange-loading">Loading...</span>
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if ($pilihanMenu == 'lihat')
            <div class="card outline-semuaukaryawan shadow-sm mb-4">
                <div class="card-header bg-semuakaryawan text-white">
                    Semua Karyawan
                </div>
                <div class="card-body">
                     <div class="d-flex justify-content-start mb-3">
                        <button class="btn btn-danger rounded-pill px-4 py-2" wire:click="hapusSemua" onclick="return confirm('Yakin ingin menghapus semua data absensi?')">
                            <i class="fas fa-trash-alt"></i> Hapus Semua Data
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Kehadiran</th>
                                    <th>Tanggal Hari Ini</th>
                                    <th>Waktu Kedatangan</th>
                                    <th>ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $absen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absen->nama }}</td>
                                    <td>{{ $absen->position }}</td>
                                    <td>{{ $absen->kehadiran }}</td>
                                    <td>{{ $absen->tanggal }}</td>
                                    <td>{{ $absen->waktu }}</td>
                                    <td>{{ $absen->keterangan }}</td>
                                    {{-- <td>
                                        <div class="d-flex gap-3 flex-wrap justify-content-center">
                                            <button wire:click="pilihEdit({{ $absen->id }})"
                                                class="btn col-lg-3 col-md-4 btn-sm btn-outline-warning mb-2">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button>
                                            <button wire:click="pilihHapus({{ $absen->id }})"
                                                class="btn col-lg-3 col-md-4 btn-sm btn-outline-danger mb-2">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </div>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start mb-3">
                <a href="{{ route('absensi.export.pdf') }}" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 mx-2">
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </a>
            </div>

            @elseif ($pilihanMenu == 'tambah')
            <div class="card outline-semuaukaryawan shadow-sm mb-4">
                <div class="card-header bg-semuakaryawan text-white">
                    Tambah Karyawan
                </div>
                
                <div class="card-body">
                      
                    <form wire:submit.prevent="simpan">

                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" />
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jabatan</label>
                            <select name="" id="" class="form-control" wire:model='position'>
                                <option>Pilih Jabatan</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="staff">Staff</option>
                            </select>
                            @error('position')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Kehadiran</label>
                            <select name="" id="" class="form-control" wire:model='kehadiran'>
                                <option>Pilih Absen</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="cuti">Cuti</option>
                                <option value="alpha">Alpha</option>
                                <option value="sakit">Sakit</option>
                            </select>
                            @error('kehadiran')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Hari Ini</label>
                             <input type="text" class="form-control"
                                value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Waktu Saat Ini</label>
                            <input type="text" class="form-control"
                                value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan <span style="font-size: 11px;"><i><span style="color: red">*</span>Permohonan cuti atau izin wajib disertai dengan keterangan alasan yang jelas.</i></span></label>
                            <textarea class="form-control" wire:model="keterangan" rows="3" placeholder="Boleh dikosongkan"></textarea>
                            @error('keterangan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success rounded-pill px-4 py-2 mt-3">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
            @elseif ($pilihanMenu == 'edit')
            <div class="card border-primary shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    Edit Absen
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="simpanEdit">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" />
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">NIS</label>
                            <input type="text" class="form-control" wire:model="nis" />
                            @error('nis')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" wire:model="jabatan" />
                            @error('jabatan')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success rounded-pill mt-3 px-4 py-2">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <button type="button" wire:click='batal' class="btn btn-secondary rounded-pill mt-3 px-4 py-2">
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </form>
                </div>
            </div>
            @elseif ($pilihanMenu == 'hapus')
            <div class="card border-danger shadow-sm mb-4">
                <div class="card-header bg-danger text-white">
                    Hapus Absen
                </div>
                <div class="card-body">
                    <p>Anda yakin ingin menghapus Absen ini?</p>
                    <p><strong>Nama:</strong> {{ $penggunaTerpilih->nama }}</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn col-lg-3 col-md-4 btn-sm btn-danger" wire:click='hapus'>
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                        <button class="btn col-lg-3 col-md-4 btn-sm btn-secondary" wire:click='batal'>
                            <i class="fas fa-times"></i> Batal
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
