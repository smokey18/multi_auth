@extends('dashboards.buyer.layouts.buyer-layout')

@section('title', 'Dashboard')

@section('content')

<br>

<section class="mb-5">

  <div class="row">

    <div class="col-md-6 mb-4 mb-md-0">

      <div class="mdb-lightbox">

        <div class="row product-gallery mx-1">

          <div class="col-12 mb-0">
            <figure class="view overlay rounded z-depth-1 main-img">
              @foreach (explode('|', $list->image) as $newImage)
                <img class="img-fluid z-depth-1" src="/images/{{ $newImage }}">
              @endforeach
              </a>
            </figure>
          </div>
        </div>

      </div>

    </div>
    <div class="col-md-6">

      <h4><b>Title:</b></h4>
      <div class="card-subtitle mb-2 text-muted">
        <h5>{{ $list->title }}</h5>
      </div>
      
      <h4><b>Price:</b></h4>
      <div class="card-subtitle mb-2 text-muted">
        <h6>{{ $list->price }}</h6>
      </div>

      <h4><b>Description:</b></h4>
      <div class="card-subtitle mb-2 text-muted">
        <p>{!! $list->description !!}</p>
      </div>

      <hr>
      <div class="table-responsive mb-2">
        <table class="table table-sm table-borderless">
          <tbody>
            <tr>
              <td class="pl-0 pb-0 w-25"><b>Quantity</b></td>
            </tr>
            <tr>
              <td class="pl-0">
                <div class="def-number-input number-input mb-0">
                  <input class="form-control" min="0" name="quantity" value="1" type="number">
                </div>
              </td>
              <td>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <form action="{{ route('addToCart') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $list->id }}">
        <button class="btn btn-secondary btn-md mr-1 mb-2"></i>Add to cart</button>
      </form>
      @if (Session::get('error'))
        <div class="alert alert-danger">
          {{ Session::get('error') }}
        </div>
      @endif
      
      @if (Session::get('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
          <a href="{{ route('cartList') }}">(View Your Cart)</a>
        </div>
      @endif
    </div>
  </div>
  
  <br>

  <div class="classic-tabs border rounded px-4 pt-1">

    <ul class="nav tabs-primary nav-justified" id="advancedTab" role="tablist">
      
      <li class="nav-item">
        <a class="nav-link active show" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews (1)</a>
      </li>
    </ul>
    <div class="tab-content" id="advancedTabContent">
      <div class="tab-pane show active" id="info" role="tabpanel" aria-labelledby="info-tab">
        <h5>Additional Information</h5>
        <table class="table table-striped table-bordered mt-3">
          <thead>
            <tr>
              <th>Product By</th>
              <td>{{ $list->user->name }}</td>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
        <h5><span>1</span> review for <span>{{ $list->title }}</span></h5>
        <hr>
        <h5 class="mt-4"><b>Add a review</b></h5>
        <p>Your email address will not be published.</p>
        <div>
          <!-- Your review -->
          <div class="md-form md-outline">
            <textarea id="form76" class="md-textarea form-control pr-6" rows="4"></textarea>
            <label for="form76">Your review</label>
          </div>
          <!-- Name -->
          <div class="md-form md-outline">
            <input type="text" id="form75" class="form-control pr-6">
            <label for="form75">Name</label>
          </div>
          <!-- Email -->
          <div class="md-form md-outline">
            <input type="email" id="form77" class="form-control pr-6">
            <label for="form77">Email</label>
          </div>
          <div class="text-right pb-2">
            <button type="button" class="btn btn-primary">Add a review</button>
          </div>
        </div>
      </div>
    </div>

  </div>

</section>

@endsection