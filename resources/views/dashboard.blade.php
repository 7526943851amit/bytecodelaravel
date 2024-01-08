<!-- resources/views/dashboard.blade.php -->

@extends('layout')

@section('content')
    <div class="container">
        <h2>Food Items</h2>
        <a class="btn btn-success" href="{{ route('fooditems.create') }}">Add Food Item</a>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mt-3">
                <p>{{ $message }}</p>
            </div>
        @endif
        <form action="{{ route('fooditems.search') }}" method="GET" class="mt-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by Name or Price" value="{{ request('search') }}">
                </div>
                <div class="col-md-6 mt-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fooditems as $fooditem)
                    <tr>
                        <td>{{ $fooditem->id }}</td>
                        <td><img src="{{ asset('images/'.$fooditem->image) }}" alt="Food Image" style="max-width: 100px;"></td>

                        <td>{{ $fooditem->name }}</td>
                        <td>{{ $fooditem->description }}</td>
                        <td>{{ $fooditem->price }}</td>
                        <td>{{ $fooditem->status }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('fooditems.edit', $fooditem->id) }}">Edit</a>
                            <form action="{{ route('fooditems.destroy', $fooditem->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $fooditems->links() !!}
    </div>
@endsection
