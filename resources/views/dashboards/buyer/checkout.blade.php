@extends('dashboards.buyer.layouts.buyer-layout')

@section('title', 'CheckOut Page')

@section('content')

    <!--Section: Block Content-->
    <section class="content">
        <div class="container-fluid">

            <br>

            <!--Grid row-->
            <div class="row">

                <div class="col-lg-3">
                </div>

                <!--Grid column-->
                <div class="col-lg-6">

                    <!-- Card -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total Amount:</strong>
                                    </div>
                                    @foreach ($cart as $check)
                                        <strong>{{ $check->product->price }}</strong>
                                    @endforeach
                                </li>
                            </ul>

                            <button type="button"
                                class="btn btn-primary btn-block waves-effect waves-light text-uppercase">Checkout</button>

                        </div>
                    </div>
                    <!-- Card -->

                    <!-- Card -->
                    <div class="card mb-3">
                        <div class="card-body">

                            <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse"
                                href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                Add a Discount Code (optional)
                                <span><i class="fas fa-chevron-down pt-1"></i></span>
                            </a>

                            <div class="collapse" id="collapseExample1">
                                <div class="mt-3">
                                    <div class="md-form md-outline mb-0">
                                        <input type="text" id="discount-code1" class="form-control font-weight-light"
                                            placeholder="Enter discount code">
                                    </div>
                                </div>
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
