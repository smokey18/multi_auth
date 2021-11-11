@extends('dashboards.buyer.layouts.buyer-layout')

@section('title', 'CheckOut Page')

@section('content')

<!--Section: Block Content-->
<section class="content">
    <div class="container-fluid">

        <br>
        <div class="row">
            <div class="col-lg-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="col-md-12 col-md-offset-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row text-center">
                                        <h3 class="panel-heading">Payment Details</h3>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                    @endif

                                    <form role="form" action="{{ route('stripe.payment') }}" method="post"
                                        class="validation" data-cc-on-file="false"
                                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                                        @csrf

                                        <div class='form-group'>
                                            <div class='form-group required'>
                                                <label class='control-label'>Name on Card</label> <input
                                                    class='form-control' size='4' type='text'>
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <div class='form-group required'>
                                                <label class='control-label'>Card Number</label>
                                                <input autocomplete='off' class='form-control card-num' size='20'
                                                    type='text'>
                                            </div>
                                        </div>

                                        <div class='form-group row'>
                                            <div class='col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label> <input
                                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                                    type='text'>
                                            </div>
                                            <div class='col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label> <input
                                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                    type='text'>
                                            </div>
                                            <div class='col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label>
                                                <input autocomplete='off' class='form-control card-cvc'
                                                    placeholder='e.g 415' size='4' type='text'>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-danger btn-block" type="submit">Pay Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Grid column-->
            <div class="col-lg-5">

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
                                <strong>{{ $check->product->sum('price') }}</strong>
                                @endforeach
                            </li>
                        </ul>
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

    </div>

</section>
<!--Section: Block Content-->

@endsection