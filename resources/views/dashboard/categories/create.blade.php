@extends('layouts.dashboard.master')
@section('title','Categories')
@section('content')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">create</li>

@endsection
<form class="container" method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
  @csrf
    <div class="mb-3 ">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" @required(true)>
    </div>
    <div class="mb-3 form-goup">
      <label  class="form-label">parent</label>
      <select name="parent_id" class="form-select form-control" >
        <option value="" >Primary Category</option>
      @foreach($parent as $parent)
      <option value="{{$parent->id}}" >{{$parent->name}}</option>
      @endforeach
    </select>
    </div>

    <div class="form-group">
      <label for="">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control" type="file" id="formFile" name="image">
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="active" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          Active
        </label>
      </div>  
      <div class="form-check">
        <input class="form-check-input" type="radio" name="status" value="archived" id="flexCheckChecked" >
        <label class="form-check-label" for="flexCheckChecked">
          Archived
        </label>
      </div>          
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection