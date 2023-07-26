@extends('layouts.global')

@section('content')

<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Semua Data</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No Sewa</th>
                                        <th>Kendaraan</th>
                                        <th>Brand</th>
                                        <th>Nama Penyewa</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Biaya Sewa</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rents as $rent)
                                    <tr>
                                        <td>{{ $rent->id }}</td>
                                        <td>{{ $rent->cars[0]->name }}</td>
                                        <td> {{ $rent->cars[0]->brands->name }}</td>
                                        <td>{{ $rent->user->name }}</td>
                                        <td>{{ $rent->user->phone }}</td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $rent->cars[0]->pivot->booked_start }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-warning">
                                                {{ $rent->cars[0]->pivot->booked_end }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                -
                                            </span>
                                        </td>
                                        <td>Rp{{ number_format($rent->cars[0]->pivot->total_price, 0,",",".") }}</td>
                                        <td>{{ $rent->status }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.rents.edit', $rent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure !')" action="{{ route('admin.rents.destroy', $rent) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    {{-- <tr>
                                        <td colspan="9" class="text-center">Data Kosong !</td>
                                    </tr> --}}
                                    @endforelse
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@push('style-alt')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push('script-alt')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $("#data-table").DataTable();

</script>
@endpush
