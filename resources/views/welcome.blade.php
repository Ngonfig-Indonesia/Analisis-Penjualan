@extends('/layouts/app')
@section('content')
<div class="row">
  <div class="card-body">
    <div class="">
        <div class="card" >
          <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="#" method="get">
                    <div class="input-group">
                        <select class="form form-control" name="search" aria-label="Default select example">
                          <option>======Pilih Tahun======</option>
                          @foreach ($year as $item)
                            <option value="{{ $item->tahun }}">{{ $item->tahun }}</option>
                          @endforeach
                          </select>
                        <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fas fa-cloud-upload-alt"></i> Import Data</button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#Analisis">
                      <i class="far fa-analytics"></i> Analisis Data</button>
                </div>
              </div>
          </div>
        </div>
        <div class="card mt-2" >
            <div class="card-body">
                <div class="row">
                  <div class="card">
                      <div class="card-title text-dark h4 mt-1"><b>Data Penjualan</b></div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Total Qty</th>
                                        <th scope="col">Total Penjualan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($data as $item => $items)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>
                                            @php
                                                echo date('F', strtotime($items->tanggal_transaksi));
                                            @endphp
                                        </td>
                                        <td>{{ $items->qty }}</td>
                                        <td>{{ format_uang($items->total_harga) }}</td>
                                        <td>
                                            <a href="{{ route('data.edit', $items->bulan_id) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        </td>
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
        <div class="card mt-2" >
          <div class="card-body">
              <div class="row">
                <div class="card">
                    <div class="card-title text-dark h4 mt-1"><b>Statistik</b></div>
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="card-body">
            <div class="card" >
              <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-title text-dark h4 mt-1 text-center"><b>Top 10 Seller Product</b></div>
                          <div class="table-responsive">
                              <table class="table table-striped display" id="table-1" style="width:100%">
                                  <thead>
                                      <tr class="text-center">
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Barang</th>
                                          <th scope="col">Qty</th>
                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php
                                          $no = 0;
                                      @endphp
                                      @foreach ($count as $item => $items)
                                      <tr>
                                          <th class="text-center" scope="row">{{ ++$no }}</th>
                                          <td>{{ $items->nama_barang}}</td>
                                          <td class="text-center">{{ $items->qty }}</td>
                                          <td class="text-center">
                                            @if ($items->qty > 30)
                                              <i class="fas fa-arrow-up" style="color:green"></i>
                                            @elseif($items->qty == 30)
                                              <i class="fas fa-clock" style="color:#0d6efd"></i>
                                            @else
                                              <i class="fas fa-arrow-down" style="color:red"></i>
                                            @endif
                                          </td>
                                      </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-title text-dark h4 mt-1 text-center"><b>Produk Slow Move</b></div>
                          <div class="table-responsive">
                              <table class="table table-striped" id="table-2" style="width:100%">
                                  <thead>
                                      <tr class="text-center">
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Barang</th>
                                          <th scope="col">Qty</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @php
                                          $no = 0;
                                      @endphp
                                      @foreach ($counts as $item => $items)
                                      @if ($items->qty < 100)
                                        <tr>
                                            <th class="text-center" scope="row">{{ ++$no }}</th>
                                            <td>{{ $items->nama_barang}}</td>
                                            <td class="text-center">{{ $items->qty }}</td>
                                        </tr>
                                      @endif
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Import Data Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('import.excel') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="import" required="required">
                    <button class="btn btn-success" type="submit" id="button-addon2">Import</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="Analisis" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AnalisisLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AnalisisLabel">Analisi Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <div>
                <div class="card-title text-dark h4 mt-1 text-center"><b>Trend Data Penjualan</b></div>
                  <div class="table-responsive">
                      <table class="table table-striped" id="table-2" style="width:100%">
                          <thead>
                              <tr class="text-center">
                                  <th scope="col">No</th>
                                  <th scope="col">Nama Barang</th>
                                  @foreach ($bulan as $item)
                                    <th scope="col">{{ date('F', strtotime($item->tanggal_transaksi)) }}</th>
                                  @endforeach
                                  <th scope="col">Total Qty</th>
                                  <th scope="col">Total Income</th>
                              </tr>
                          </thead>
                          <tbody>
                                
                          </tbody>
                      </table>
                  </div>
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni','July','Agustus','September','Oktober','November','Desember'],
          datasets: [{
              label: 'Data Penjualan',
              data: [
              @foreach($chart as $charts)
                {{ $charts->total_harga }},
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
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/datatables.js') }}"></script>
</div>
@endpush