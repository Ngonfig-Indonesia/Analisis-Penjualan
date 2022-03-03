@extends('/layouts/app')
@section('content')
<div class="card-body">
        <div class="card mt-2" >
            <div class="card-body">
                <div class="row">
                  <div class="card">
                      <div class="card-title text-dark h4 mt-2"><b>Data Penjualan</b></div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal Transaksi</th>
                                        <th scope="col">Total Qty</th>
                                        <th scope="col">Total Penjualan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($bulan->penjualan as $item)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $item->tanggal_transaksi }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ format_uang($item->total_harga) }}</td>
                                        </tr>                               
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="card mt-2" >
            <div class="card-body">
                <div class="row">
                  <div class="card">
                      <div class="card-title text-dark h4 mt-2"><b>Statistik</b></div>
                      <canvas id="Bulan" width="400" height="200"></canvas>
                  </div>
                </div>
            </div>
          </div>
          <div class="card mt-2" >
            <div class="card-body">
                <div class="row">
                  <div class="card">
                    <div class="card-title text-dark h4 mt-2"><b>Total Qty Penjualan</b></div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Total Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($count->penjualan as $items)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $items->nama_barang }}</td>
                                        <td>{{ $items->qty }}</td>
                                    </tr>                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <a href="{{ route('home') }}" class="btn btn-light m-3">Back</a>
    </div>
@push('js')
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/datatables.js') }}"></script>
<script>
    const ctx = document.getElementById('Bulan').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                @foreach ($bulan->penjualan as $items)
                  {{ date('d', strtotime($items->tanggal_transaksi)) }},
                @endforeach
            ],
            datasets: [{
                label: 'Data Penjualan Perhari',
                data: [
                @foreach ($bulan->penjualan as $item)
                  {{ $item->total_harga }},
                @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 4
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>
@endpush

@endsection