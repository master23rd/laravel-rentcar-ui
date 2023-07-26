@extends('layouts.global')

@section('content')

<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data</h3>
                        <a href="{{ route('admin.rents.index')}}" class="btn btn-success shadow-sm float-right"> <i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.rents.update', $rent) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group row border-bottom pb-4">
                                <label for="nama_mobil" class="col-sm-2 col-form-label">Nama Mobil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $rent->cars[0]->name) }}" id="name" disabled>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label"> Brand</label>
                                <div class="col-sm-10">
                                    <input type="text" name="brand" class="form-control" id="brand" value="{{ $rent->cars[0]->brands->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-10">
                                    <input type="date" name="booked_start" class="form-control" id="booked_start" value="{{ $rent->cars[0]->pivot->booked_start }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-10">
                                    <input type="date" name="booked_end" class="form-control" id="booked_end" value="{{ $rent->cars[0]->pivot->booked_start }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-10">
                                    <input type="date" name="return_date" class="form-control" id="return_date" value="{{ $rent->cars[0]->pivot->return_date }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type='number' name="price" class="form-control" id="price" value="{{ number_format($rent->cars[0]->pivot->total_price,0,",",".") }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row border-bottom pb-4">
                                <label for="image" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                                <div class="listing-img h-100 mr-4">
                                    {{-- <img src="{{ Storage::url($rent->image) }}" alt="Image" class="img-fluid" /> --}}
                                    <img src="{{ 'https://images.unsplash.com/photo-1502877338535-766e1452684a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80.jpg' }}" alt="Image" class="img-fluid" />
                                </div>
                                {{-- <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control">
                                </div> --}}
                            </div>

                            {{-- <div class="form-group row border-bottom pb-4">
                                <label for="brand" class="col-sm-2 col-form-label">Tanggal Bayar</label>
                                <div class="col-sm-10">
                                    <input type="date" name="booked_end" class="form-control" id="booked_end" value="{{ $rent->cars[0]->pivot->return_date }}" disabled>
                    </div>
                </div> --}}

                <div class="form-group row border-bottom pb-4">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status" id="status">
                            @foreach($statuses as $status)
                            <option {{ old('status', $rent->status) == $status ? 'selected' : null }} value="{{ $status }}">{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
                </form>
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
