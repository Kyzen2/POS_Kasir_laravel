<div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <!-- Tombol navigasi -->
            <button wire:click="pilihMenu('lihat')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-box-open"></i> Lihat Pelatihan
            </button>
            <button wire:click="pilihMenu('tambah')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-plus-circle"></i> Tambah Pelatihan
            </button>
            <button wire:loading class="col-lg-4 col-md-6 mb-4 btn btn-info mx-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-spinner fa-spin"></i> Loading...
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if ($pilihanMenu == 'lihat')
            <div class="card border-primary shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    Semua Pelatihan
                </div>
                <div class="card-body">
                    <!-- Tambahkan class table-responsive di sini -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instruktur</th>
                                    <th>Nama Sekolah</th>
                                    <th>Nama Pembimbing</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->instruktur }}</td>
                                    <td>{{ $produk->sekolah }}</td>
                                    <td>{{$produk->pembimbing}}</td>
                                    <td>{{ $produk->siswa }}</td>
                                    <td>{{ $produk->ket }}</td>
                                    <td>
                                        <div class="d-flex gap-3 flex-wrap justify-content-center">
                                            <button wire:click="pilihEdit({{ $produk->id }})" 
                                                class="btn col-lg-3 col-md-4 btn-sm btn-outline-warning mb-2">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button>
                                            <button wire:click="pilihHapus({{ $produk->id }})" 
                                                class="btn col-lg-3 col-md-4 btn-sm btn-outline-danger mb-2">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @elseif(in_array($pilihanMenu, ['tambah', 'edit']))
            <div class="card border-primary shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    {{ $pilihanMenu == 'tambah' ? '➕ Tambah Pelatihan' : '✏️ Edit Produk' }}
                </div>
                <div class="card-body">
                     <form wire:submit.prevent="simpan">

                        <div class="mb-3">
                            <label for="" class="form-label">Instruktur</label>
                            <select class="form-control" wire:model="instruktur">
                                <option value="">Pilih Pegawai</option>
                                @foreach($daftarInstruktur as $pegawai)
                                    <option value="{{ $pegawai->nama }}">{{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                            @error('instruktur')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" wire:model="sekolah" />
                            @error('sekolah')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Nama Pembimbing</label>
                            <input type="text" class="form-control" wire:model="pembimbing" />
                            @error('pembimbing')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah Siswa</label>
                            <input type="text" class="form-control" wire:model="siswa" />
                            @error('siswa')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" wire:model="ket" />
                            @error('ket')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success rounded-pill px-4 py-2 mt-3">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
            @elseif($pilihanMenu == 'hapus')
            <div class="card border-danger shadow-sm mb-4">
                <div class="card-header bg-danger text-white">
                    ⚠️ Konfirmasi Hapus
                </div>
                <div class="card-body">
                    <p>Anda yakin ingin menghapus pelatihan ini?</p>
                    <ul>
                        <li><strong>Atas nama Instruktur:</strong> {{ $produkTerpilih->instruktur }}</li>
                    </ul>
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
            @elseif($pilihanMenu == 'excel')
            <div class="card border-success shadow-sm mb-4">
            </div>
            @endif
        </div>
    </div>
</div>
