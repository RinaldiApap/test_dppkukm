@extends('layout.main')

@section('title')
<a href="{{ url('transaksi') }}">Transaksi</a> > Detail Transaksi
@endsection

@section('m2')
active
@endsection

@section('content')
<div class="container">
    <div class="page-inner">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Transaksi QRIS - <span
                                class="badge bg-primary">{{ $pemilik->nama_pemilik_qris }}</span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tangggal Transaksi</th>
                                        <th>Nama Produk</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tangggal Transaksi</th>
                                        <th>Nama Produk</th>
                                        <th>Nominal</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $row->tanggal_transaksi }}</td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>Rp. {{ number_format($row->nominal) }}</td>
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
</div>
@endsection

@section('style')
@endsection

@section('script')
<!-- Datatables -->
<script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

<script>
    $(document).ready(function () {

            $("#multi-filter-select").DataTable({
              pageLength: 10,
              initComplete: function () {
                this.api()
                  .columns()
                  .every(function () {
                    var column = this;
                    var select = $(
                      '<select class="form-select"><option value=""></option></select>'
                    )
                      .appendTo($(column.footer()).empty())
                      .on("change", function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
    
                        column
                          .search(val ? "^" + val + "$" : "", true, false)
                          .draw();
                      });
    
                    column
                      .data()
                      .unique()
                      .sort()
                      .each(function (d, j) {
                        select.append(
                          '<option value="' + d + '">' + d + "</option>"
                        );
                      });
                  });
              },
            });
    
    });
</script>
@endsection