@extends('welcome')

@section('content')
   <div class="card">
       <div class="card-header">
            <a href="" class="btn btn-primary">Add Item</a>
       </div>
       <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $index => $post)
                        <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$post->name}}</td>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
       </div>
   </div>
@endsection