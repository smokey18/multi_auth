@extends('dashboards.seller.layouts.seller-layout')

@section('title', 'Edit Product')

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Product Information</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>

            <form action="{{ route('seller.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <br>

                @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                <input type="hidden" name="cid" value="{{ $list->id }}">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $list->title }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="text-area" class="form-control">{{ $list->description }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="text" name="price" id="price" class="form-control" value="{{ $list->price }}">
                        <p>Old Price: {{ $list->price }}</p>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image[]" multiple>
                        @foreach (explode('|', $list->image) as $newImage)
                            <img width="75px" height="70px" src="/images/{{ $newImage }}">
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">UPDATE</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

@endsection