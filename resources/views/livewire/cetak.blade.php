<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #laporan,
            #laporan * {
                visibility: visible;
            }

            #laporan {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- CSS Tombol Navigasi -->
    <style>
        .text-custom-orange-tambahlatihan {
            color: rgb(146, 54, 0)
        }

        .text-custom-orange-semualatihan {
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
    <!-- CSS untuk card semua karyawan -->
    <style>
        .outline-semuaukaryawan {
            border: 2px solid rgb(255, 94, 0);
        }

        .bg-semuaukaryawan {
            background-color: rgb(255, 94, 0);
        }
    </style>
    <!-- --- -->

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card outline-semuaukaryawan shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Laporan Transaksi</h4>

                        <!-- Tombol Cetak -->
                        <button class="btn btn-success mb-3" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak
                        </button>

                        <table class="table table-bordered table-striped table-hover" id="laporan">
                            <thead class="table-warning">
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $transaksi->kode }}</td>
                                    <td>Rp. {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>