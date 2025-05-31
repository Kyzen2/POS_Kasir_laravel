<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-primary shadow-sm rounded mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h4 class="card-title mb-0">📄 Laporan Transaksi</h4>
                            <a href="{{ route('cetak') }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="bi bi-printer"></i> Cetak
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="laporan">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Inv.</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaTransaksi as $transaksi)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $transaksi->kode }}</td>
                                            <td class="text-end">Rp. {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($semuaTransaksi->isEmpty())
                            <div class="alert alert-warning text-center mt-3">
                                Tidak ada transaksi untuk ditampilkan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
