
<div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <!-- Tombol navigasi -->
            <button wire:click="pilihMenu('lihat')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-box-open"></i> Semua Karyawan
            </button>
            <button wire:click="pilihMenu('tambah')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-plus-circle"></i> Tambah Karyawan
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
                    Semua Karyawan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penggunas as $pengguna)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengguna->nama }}</td>
                                    <td>{{ $pengguna->nis }}</td>
                                    <td>{{ $pengguna->jabatan }}</td>
                                    <td>
                                        <div class="d-flex gap-3 flex-wrap justify-content-center">
                                            <button wire:click="pilihEdit({{ $pengguna->id }})" 
                                                class="btn col-lg-3 col-md-4 btn-sm btn-outline-warning mb-2">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </button>
                                            <button wire:click="pilihHapus({{ $pengguna->id }})" 
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
            @elseif ($pilihanMenu == 'tambah')
            <div class="card border-primary shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
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
                            <label for="" class="form-label">NIS</label>
                            <input type="text" class="form-control" wire:model="nis" />
                            @error('nis')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">jabatan</label>
                            <input type="text" class="form-control" wire:model="jabatan" />
                            @error('jabatan')
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
                    Edit Pengguna
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
                    Hapus Pengguna
                </div>
                <div class="card-body">
                    <p>Anda yakin ingin menghapus pengguna ini?</p>
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
