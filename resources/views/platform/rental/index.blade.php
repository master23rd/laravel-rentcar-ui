@extends('layouts.platform')

@section('content')
<div class="hero inner-page" style="background-image: url('{{ asset('frontend/images/hero_1_a.jpg') }}')">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-5">
                <div class="intro">
                    <h1><strong>Daftar Mobil</strong></h1>
                    <div class="custom-breadcrumbs">
                        <a href="index.html">Home</a> <span class="mx-2">/</span>
                        <strong>Daftar Mobil</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Sewa Mobil</h3>
                        <a href="{{ route('car.index')}}" class="btn btn-success shadow-sm float-right"> <i class="fa fa-plus"></i> Tambah </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No Sewa</th>
                                        <th>Nama</th>
                                        <th>Brand</th>
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
                                        <td> {{ $rent->cars[0]->brands->name }}
                                        </td>
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
                                                @if($rent->status === 'BOOKED')
                                                <a href="{{ route('rent.detail', $rent->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form onclick="return confirm('are you sure !')" action="{{ route('rent.cancel', $rent) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                                @else
                                                <a href="{{ route('rent.detail', $rent->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endif
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
            </div>
        </div>
        {{-- @empty
        <p class="display-4 text-center mx-auto">Data yang anda cari kosong !</p>
        @endforelse --}}
    </div>
</div>
</div>
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
