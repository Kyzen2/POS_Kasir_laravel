<div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <!-- Tombol navigasi -->
            <button wire:click="pilihMenu('lihat')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-box-open"></i> Semua Produk
            </button>
            <button wire:click="pilihMenu('tambah')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </button>
            <button wire:click="pilihMenu('excel')" 
                class="col-lg-4 col-md-6 mb-4 btn {{ $pilihanMenu == 'excel' ? 'btn-primary' : 'btn-outline-primary' }} mx-2 py-2 px-4 rounded-pill shadow-sm btn-custom">
                <i class="fas fa-file-import"></i> Import Produk
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
                    Semua Produk
                </div>
                <div class="card-body">
                    <!-- Tambahkan class table-responsive di sini -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->kode }}</td>
                                    <td>{{ $produk->nama }}</td>
                                    <td class="text-end">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $produk->stok }}</td>
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
                    {{ $pilihanMenu == 'tambah' ? '➕ Tambah Produk' : '✏️ Edit Produk' }}
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
                        @foreach (['nama' => 'Nama', 'kode' => 'Kode / Barcode', 'harga' => 'Harga', 'stok' => 'Stok'] as $field => $label)
                        <div class="mb-3">
                            <label class="form-label">{{ $label }}</label>
                            <input type="{{ $field === 'harga' || $field === 'stok' ? 'number' : 'text' }}"
                                class="form-control" wire:model="{{ $field }}">
                            @error($field) <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-success mt-2 w-100">
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
                    <p>Anda yakin ingin menghapus produk ini?</p>
                    <ul>
                        <li><strong>Nama:</strong> {{ $produkTerpilih->nama }}</li>
                        <li><strong>Kode:</strong> {{ $produkTerpilih->kode }}</li>
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
                <div class="card-header bg-success text-white">
                    📥 Import Produk (Excel)
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='imporExcel'>
                        <input type="file" class="form-control" wire:model="fileExcel" />
                        @error('fileExcel') <small class="text-danger">{{ $message }}</small> @enderror
                        <button class="btn btn-outline-success mt-3 w-100" type="submit">
                            <i class="fas fa-upload"></i> Kirim
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
