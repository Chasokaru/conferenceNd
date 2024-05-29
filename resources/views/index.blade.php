@extends('app')

@section('content')

    <div class="container">
        <div class="conference-title-box" style="background-color: #c1aeae; padding: 5px; border: 1px solid #000000; border-radius: 40px; margin-bottom: 1px;">
            <h1 class="text-center">Conference List</h1>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Conference title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Address of conference</th>
                <th>Number of participants</th>
                @auth
                    <th>Edit/Delete</th>
                @endauth
            </tr>
            </thead>
            <tbody>
            @foreach ($conferences as $conference)
                <tr>
                    <td>{{ $conference->title }}</td>
                    <td>{{ $conference->description }}</td>
                    <td>{{ $conference->date }}</td>
                    <td>{{ $conference->address }}</td>
                    <td>{{ $conference->participants }}</td>
                    @auth
                        <td>
                            <form action="{{ route('conferences.edit', $conference->id) }}" method="GET" style="display: inline;">
                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: white; color: #7c4a0a; border-color: #a6530e;">Edit</button>
                            </form>
                            <form action="{{ route('conferences.destroy', $conference->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="background-color: red; color: white;" onclick="return confirm('Are you sure you want to delete this conference?')">Delete</button>
                            </form>
                        </td>
                    @endauth
                </tr>
            @endforeach
            </tbody>
        </table>

        @auth
            <div class="text-right" style="margin-top: 20px;">
                <form action="{{ route('conferences.create') }}" method="GET" style="display: inline;">
                    <button type="submit" class="btn btn-sm" style="background-color: #a6530e; border-color: #7c4a0a; color: white;">Add Conference</button>
                </form>
            </div>
        @endauth

    </div>

@endsection
