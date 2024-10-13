@extends('layouts.dashboard.master')
@section('title','Categories')
@section('content')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">categories</li>

@endsection
    <!-- Main content -->
    <div class="mt-4 mb-2">
        <a class="btn btn-outline-success" href="{{route('categories.create')}}">Create</a>
    </div>
    <table class="table">

        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Parent</th>
            <th scope="col">Created_At</th> 
            <th scope="col"></th> 
          </tr>
        </thead>
        @forelse ($data as $data)

        <tbody>
          <tr>
            <th scope="row">{{$data->id}}</th>
            <td>{{$data->name}}</td>
            <td>{{$data->parent_id}}</td>
            <td>{{$data->created_at}}</td>
            <td colspan="2" class="">
              <a class="btn btn-sm btn-outline-primary" href="{{route('categories.edit',$data->id)}}">Edit</a>

              <form action="{{route('categories.destroy',$data->id)}}" style="display: inline" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
              </form>
            </td>
          </tr>

          </tr>
        </tbody>

        @empty

            <th colspan="7">No Data Defined.</th>

        @endforelse
      </table>  
@endsection