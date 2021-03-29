@extends('layouts.app-admin')

@section('content')
<div class="container">
    

    <div class="row justify-content-center">
        

        @if(count($sort_users)>0)
            <table class="table ">
                <caption>List of all users</caption>
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>

                <tbody>

                    @foreach ($sort_users as $users)
                        <tr>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email }}</td>
                            <td>
                                @if($users->role == 1 )
                                    Student
                                @elseif($users->role == 2 )
                                    Teacher
                                @elseif($users->role == 3 )
                                    Alumni
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin-users-edit', ['id'=>$users->id]) }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ route('admin-users-delete', ['id'=>$users->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {!! $sort_users->links() !!}
                
            </div>
        @else
            <h2>No {{ $type }} Available</h2>
        @endif


    </div>
  
</div>
@endsection
