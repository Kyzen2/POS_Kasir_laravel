<div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <!-- Tombol navigasi -->
            <button wire:click="pilihMenu('lihat')"
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'lihat' ? 'btn-warning' : 'btn-outline-warning' }} mx-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-box-open"></i>
                <span class="text-custom-orange-semuauser">Semua User</span>
            </button>

            <button wire:click="pilihMenu('tambah')"
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'tambah' ? 'btn-warning' : 'btn-outline-warning' }} mx-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-plus-circle"></i>
                <span class="text-custom-orange-tambahuser">Tambah User</span>
            </button>

            <button wire:loading
                class="col-lg-4 col-md-6 mb-4 btn btn-custom-orange mx-2 py-2 px-4 rounded-pill shadow-sm">
                <i class="fas fa-spinner fa-spin"></i>
                <span class="text-custom-orange-loading">Loading...</span>
            </button>

        </div>
    </div>
    <!-- CSS Tombol Navigasi -->
    <style>
        .text-custom-orange-tambahuser {
            color: rgb(146, 54, 0)
        }

        .text-custom-orange-semuauser {
            color: rgb(146, 54, 0)
        }

        .text-custom-orange-loading {
            color: rgb(107, 43, 0)
        }

        .btn-custom-orange {
            background-color: rgb(255, 94, 0);
        }
    </style>
    <!-- --- -->

    <!-- CSS untuk card semua user -->
    <style>
        .outline-semuauser {
            border: 2px solid rgb(255, 94, 0);
        }
        .bg-semuauser {
            background-color: rgb(255, 94, 0)
        }
    </style>
    <!-- --- -->

    <div class="row">
        <div class="col-12">
            @if ($pilihanMenu == 'lihat')
            <div class="card outline-semuauser shadow-sm mb-4">
                <div class="card-header bg-semuauser text-white">
                    Semua User
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaPengguna as $pengguna)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengguna->name }}</td>
                                    <td>{{ $pengguna->email }}</td>
                                    <td>{{ $pengguna->peran }}</td>
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
            <div class="card outline-semuauser shadow-sm mb-4">
                <div class="card-header bg-semuauser text-white">
                    Tambah User
                </div>
                <div class="card-body">
                    <form action="" wire:submit="simpan">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" />
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model="email" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" wire:model="password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Peran</label>
                            <select name="" id="" class="form-control" wire:model='peran'>
                                <option>Pilih Peran</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
                            @error('peran')
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
                    <form action="" wire:submit="simpanEdit">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model="nama" />
                            @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model="email" />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control" wire:model="password" />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Peran</label>
                            <select name="" id="" class="form-control" wire:model='peran'>
                                <option>Pilih Peran</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                            </select>
                            @error('peran')
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
                    <p><strong>Nama:</strong> {{ $penggunaTerpilih->name }}</p>
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