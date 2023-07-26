@extends('layouts.global')

@section('content')

<!-- Main content -->
<section class="content pt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data</h3>
                        <a href="{{ route('admin.cars.index')}}" class="btn btn-success shadow-sm float-right"> <i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.cars.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row border-bottom pb-4">
                                <label for="nama_mobil" class="col-sm-2 col-form-label">Nama Mobil</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="type_id" class="col-sm-2 col-form-label">Brand Mobil</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="brand_id" id="brand_id">
                                        @foreach($brands as $brand)
                                        <option {{ old('type') == $brand->id ? 'selected' : null }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="type_id" class="col-sm-2 col-form-label">Brand Mobil</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="model_id" id="model_id">
                                        @foreach($models as $model)
                                        <option {{ old('type') == $model->id ? 'selected' : null }} value="{{ $model->id }}">{{ $model->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="price" class="col-sm-2 col-form-label">Harga Sewa</label>
                                <div class="col-sm-10">
                                    <input type="number" min='1' class="form-control" name="price" value="{{ old('price') }}" id="price">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="pintu" class="col-sm-2 col-form-label">Jumlah Pintu</label>
                                <div class="col-sm-10">
                                    <input type="number" min='1' class="form-control" name="doors" value="{{ old('doors') }}" id="doors">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="penumpang" class="col-sm-2 col-form-label">Jumlah Penumpang</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="passengers" value="{{ old('passengers') }}" id="passengers">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="image" class="col-sm-2 col-form-label">Gambar Mobil</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="6">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row border-bottom pb-4">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" id="status">
                                        @foreach($statuses as $no => $status)
                                        <option {{ old('status') == $no ? 'selected' : null }} value="{{ $no }}">{{ $status }}</option>
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
