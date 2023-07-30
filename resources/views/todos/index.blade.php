@extends('layouts.app')
@section('styles')
<style>
#outer {
    /* width: 100%; */
    text-align: center;
}

.inner {
    display: inline-block;
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (Session::has('alert-warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>{{ Session::get('alert-warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (Session::has('alert-info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>{{ Session::get('alert-info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>{{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <a href="{{ route('todos.create') }}" class="btn btn-primary mb-3">Go To Create</a>
                    @if (count($todos)>0)

                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Completed</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                <tr>
                                    <td>{{ $todo->title }}</td>
                                    <td>{{ $todo->description }}</td>
                                    <td>
                                        @if ($todo->is_completed == 1)
                                        <a class="btn btn-sm btn-success" href="">Completed</a>
                                        @else
                                        <a class="btn btn-sm btn-danger" href="">In Completed</a>
                                        @endif
                                    </td>
                                    <td id="outer">
                                        <a class="btn btn-sm btn-info inner"
                                            href="{{ route('todos.show',$todo->id) }}">View</a>
                                        <a class="btn btn-sm btn-primary inner"
                                            href="{{ route('todos.edit',$todo->id) }}">Edit</a>
                                        <form action="{{ route('todos.destroy') }}" method="post" class="inner">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    </td>

                                    </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <h4>No Todos are Created yed!</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection