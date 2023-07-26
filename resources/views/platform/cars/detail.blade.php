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
                            <div class="listing-img h-100 mr-4">
                                {{-- <img src="{{ Storage::url($car->image) }}" alt="Image" class="img-fluid" /> --}}
                                <img src="{{ 'https://images.unsplash.com/photo-1502877338535-766e1452684a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80.jpg' }}" alt="Image" class="img-fluid" />
                            </div>
                            <div class="listing-contents h-100">
                                <h3>{{ $car->nama_mobil }}</h3>
                                <div class="rent-price">
                                    <strong>Rp{{ number_format($car->price,0,",",".") }}</strong><span class="mx-1">/</span>hari
                                </div>
                                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                                    {{-- <div class="listing-feature pr-4">
                                <span class="caption">Pintu:</span>
                                <span class="number">{{ $car->doors }}</span>
                                </div> --}}
                                <div class="listing-feature pr-4">
                                    <span class="caption">Kapasitas:</span>
                                    <span class="number">{{ $car->passengers }}</span>
                                </div>
                                <div class="listing-feature pr-4">
                                    <span class="caption">Brand:</span>
                                    <span class="number">{{ $car->brands->name }}</span>
                                </div>
                                <div class="listing-feature pr-4">
                                    <span class="caption">Model:</span>
                                    <span class="number">{{ $car->models->name }}</span>
                                </div>
                            </div>
                            <div>
                                <p>
                                    {{ $car->description }}
                                </p>
                                {{-- <p>
                                    <a href="{{ route('car.show', $car) }}" class="btn btn-primary btn-sm">Sewa Sekarang</a>
                                </p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="listing d-block align-items-stretch">
                        <h2 class="section-heading"><strong>Ketersedian</strong></h2>
                        <form action="{{ route('rent.check') }}" method="post">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <div class="form-group">
                                <label for="booked_start">Tanggal Mulai</label>
                                <input type="date" name="booked_start" class="form-control" id="booked_start">
                            </div>
                            <div class="form-group">
                                <label for="booked_end">Tanggal Kembali</label>
                                <input type="date" name="booked_end" class="form-control" id="booked_end">
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
