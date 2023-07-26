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
            <div class="col-lg-7">
                <h2 class="section-heading"><strong>Daftar Mobil</strong></h2>
                <p class="mb-5">
                    Kami menyediakan berbagai macam mobil.
                </p>
            </div>
        </div>

        <div class="row">
            @forelse($cars as $car)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="listing d-block align-items-stretch">
                    <div class="listing-img h-100 mr-4">
                        {{-- <img src="{{$car->image ? Storage::url($car->image) : }}"> --}}
                        <img src="{{ 'https://images.unsplash.com/photo-1502877338535-766e1452684a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80.jpg' }}" alt="Image" class="img-fluid" />
                    </div>
                    <div class="listing-contents h-100">
                        <h3>{{ $car->name }}</h3>
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
                        <p>
                            <a href="{{ route('car.show', $car) }}" class="btn btn-primary btn-sm">Sewa Sekarang</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="display-4 text-center mx-auto">Data yang anda cari kosong !</p>
        @endforelse
    </div>
</div>
</div>
@endsection
