@extends('dashboards.buyer.layouts.buyer-layout')

@section('title', 'Dashboard')

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                @foreach ($product as $item)
                    <div class="col-md-3 mb-3">
                        <div class="card-product">
                            <a href="buyer/product/{{ $item->id }}">
                                <div class="card-body">
                                    <div class="card-body-image">
                                        @foreach (explode('|', $item->image) as $newImage)
                                            <img src="/images/{{ $newImage }}">
                                        @endforeach
                                    </div>
                                    <h5><b>{{ $item->title }}</b></h5>
                                    <span style="color: red">{{ $item->price }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
