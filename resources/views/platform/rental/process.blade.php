@extends('layouts.platform')

@section('content')
<div class="hero inner-page" style="background-image: url('{{ asset('frontend/images/hero_1_a.jpg') }}')">
    <div class="container">

    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @if(count($errors) > 0 )
                <div class="content-header mb-0 pb-0">
                    <div class="container-fluid">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul class="p-0 m-0" style="list-style: none;">
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                @if(session()->has('message'))
                <div class="content-header mb-0 pb-0">
                    <div class="container-fluid">
                        <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6 col-lg-12 mb-4">
                        <div class="listing d-block align-items-stretch">
                            <div class="listing-img h-50 mr-4">
                                {{-- <img src="{{ Storage::url($car->image) }}" alt="Image" class="img-fluid" /> --}}
                                <img src="{{ 'https://images.unsplash.com/photo-1502877338535-766e1452684a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80.jpg' }}" alt="Image" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                    <div class="listing d-block align-items-stretch" style="width:100%">
                        <h2 class="section-heading"><strong>Kendaraan Tersedia</strong></h2>
                        <form action="{{ route('rent.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="duration" value="{{ $car->duration }}">
                            <input type="hidden" name="booked_start" value="{{ $car->start }}">
                            <input type="hidden" name="booked_end" value="{{ $car->end }}">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="name" name="name" class="form-control" id="name" value="{{ $car->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="brand" name="brand" class="form-control" id="brand" value="{{ $car->brands->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="booked_start">Tanggal Mulai</label>
                                <input type="date" name="booked_start" class="form-control" id="booked_start" value="{{ $car->start }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="booked_end">Tanggal Kembali</label>
                                <input type="date" name="booked_end" class="form-control" id="booked_end" value="{{ $car->end }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi </label>
                                <input type='number' name="duration" class="form-control" id="duration" value="{{ $car->duration }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="price">Total Harga {{$car->duration}} Hari </label>
                                <input type='number' name="price" class="form-control" id="price" value="{{ number_format($car->totalPrice,0,",",".") }}" disabled>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
