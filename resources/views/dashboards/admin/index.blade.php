@extends('dashboards.admin.layouts.admin-layout')

@section('title', 'Dashboard')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3" style="margin-top:50px">
  
              @if (Session::get('success'))
              <div class="alert alert-success">
                  {{ Session::get('success') }}
              </div>
              @endif
  
            <h4>Products List</h4>
  
            <table class="table table-hover">
                <thead>
                    <th>Sr.</th>
                    <th>Product By</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price ($)</th>
                    <th>Image</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($product as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{!! $item->description !!}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            @foreach (explode('|', $item->image) as $newImage)
                                <img width="55px" height="50px" src="/images/{{ $newImage }}">
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="admin/delete/{{ $item->id }}" class="btn btn-danger btn-xs">Delete</a>
                                <a href="admin/edit/{{ $item->id }}" class="btn btn-primary btn-xs">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>

@endsection