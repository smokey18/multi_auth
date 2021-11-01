@extends('dashboards.seller.layouts.seller-layout')

@section('title', 'Add Product')

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Product</li>
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

            <br>

            @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif

            <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="text-area" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="text" name="price" id="price" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" onchange="loadPreview(this)" name="image[]" multiple>
                        <div id="thumb-output"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">SAVE</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>

@endsection