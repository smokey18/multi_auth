@extends('dashboards.buyer.layouts.buyer-layout')

@section('title', 'Cart Page')

@section('content')

<!--Section: Block Content-->
<section class="content">
  <div class="container-fluid">

    <!--Grid row-->
    <div class="row">

      <div class="col-lg-1">
      </div>

      <!--Grid column-->
      <div class="col-lg-10">

        <br>

        <!-- Card -->
        <div class="card wish-list mb-3">
          <div class="card-body">

            <h5 class="mb-4">Cart</h5>

            @if (Session::get('success'))
              <div class="alert alert-success">
                  {{ Session::get('success') }}
              </div>
            @endif

            @foreach ($cart as $cartItem)

              <div class="row mb-4">
                <div class="col-md-5 col-lg-3 col-xl-3">
                  <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
                    @foreach (explode('|', $cartItem->product->image) as $newImage)
                      <img class="img-fluid w-100" src="/images/{{ $newImage }}">
                    @endforeach
                  </div>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                  <div>
                    <div class="d-flex justify-content-between">
                      <div>
                        <h5>{{ $cartItem->product->title }}</h5>
                      </div>
                      <div>
                        <div class="def-number-input number-input safari_only mb-0 w-100">
                          <input class="form-control" min="0" name="quantity" value="1" type="number">
                        </div>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <a href="/buyer/removecart/{{ $cartItem->id }}" class="btn btn-warning text-uppercase mr-2" style="font-size: 10px">
                          <i class="fas fa-trash-alt mr-1"></i> Remove </a>
                        <a href="#!" type="button" class="btn btn-primary text-uppercase" style="font-size: 10px"><i
                            class="fas fa-heart mr-1"></i> Add to wish list </a>
                      </div>
                      <p class="mb-0"><span><strong>Price: {{ $cartItem->product->price }}</strong></span></p>
                    </div>
                  </div>
                </div>
              </div>
              
              <hr class="mb-4">
            
            @endforeach

            <div>
              <a href="/buyer/checkout" class="btn btn-success text-uppercase mr-2 float-right">
                Checkout
              </a>
            </div>

          </div>
        </div>
        <!-- Card -->

      </div>
      <!--Grid column-->

    </div>
    <!--Grid row-->

  </div>

</section>
<!--Section: Block Content-->

@endsection