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
                    <div class="listing d-block align-items-stretch" style="width:100%">
                        <a href="{{ route('rent.list')}}" class="btn btn-success shadow-sm float-right"> <i class="fa fa-back"></i> Back </a>
                        <h2 class="section-heading"><strong>Data Penyewaan</strong></h2>
                        <form action="{{ route('rent.update', $rent) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $rent->cars[0]->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" id="brand" value="{{ $rent->cars[0]->brands->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="booked_start">Tanggal Mulai</label>
                                <input type="date" name="booked_start" class="form-control" id="booked_start" value="{{ $rent->cars[0]->pivot->booked_start }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="booked_end">Tanggal Kembali</label>
                                <input type="date" name="booked_end" class="form-control" id="booked_end" value="{{ $rent->cars[0]->pivot->booked_start }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi </label>
                                <input type='number' name="duration" class="form-control" id="duration" value="{{ $rent->duration }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="price">Total Harga {{$rent->duration}} Hari </label>
                                <input type='number' name="price" class="form-control" id="price" value="{{ number_format($rent->cars[0]->pivot->total_price,0,",",".") }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="name">Status Penyewaan</label>
                                <input type="name" name="status" class="form-control" id="status" value="{{ $rent->status }}" disabled>

                            </div>
                            @if($rent->status === 'BOOKED')
                            <div class="form-group row border-bottom pb-4">
                                <label for="image" class="col-sm-2 col-form-label">Upload Bukti Pembyaran</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control">
                                    <label for="image">Harap Transfer ke Nomer rekening : 1230239</label>
                                </div>

                            </div>
                            @endif


                            @if($rent->status === 'BOOKED')
                            <button type="submit" class="btn btn-primary">Submit</button>
                            @endif

                        </form>
                        @if($rent->status === 'PAID' || $rent->status === 'ONDUTY')
                        <form onclick="return confirm('are you sure !')" action="{{ route('rent.cancel', $rent) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Cancel</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
