@extends('layouts.admin.template')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">About</h1>
    </div>
  </div>
<section>
  @include('includes.admin.alerts')
  <div class="container-fluid text-right" style="margin-bottom: 16px;">
    <a class="btn btn-success" href="{{route('gallery.create')}}">
      Add New
    </a>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>About</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($galleries as $gallery)
      <tr>
      <td style="width: 20%;">{{$gallery->id}}</td>
        <td>{{$gallery->image_title}}</td>
        
        <td><img src="{{ asset($gallery->image)}}" alt="" width="60" height="6  0"></td>
        <td>
          <a href="{{route('gallery.edit',$gallery->id)}}" class="btn btn-primary">
            <span class="glyphicon glyphicon-edit"></span>
          </a>
          <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$gallery->id}}">
            <span class="glyphicon glyphicon-trash"></span>
          </a>
          <div class="modal fade" id="deleteModal{{$gallery->id}}" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Delete</h4>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete this gallery?</p>
                </div>
                <div class="modal-footer">
                  {{Form::open(['url'=>route('gallery.destroy',$gallery->id),'method'=>'delete'])}}
                  <button type="submit" class="btn btn-default">Yes</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                  {{Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
<div class="row">
  {{$galleries->links()}}
</div>
</section>
@endsection