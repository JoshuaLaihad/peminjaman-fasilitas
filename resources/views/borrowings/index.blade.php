<!-- resources/views/borrowings/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Borrowings</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fasilitas</th>
                                    <th>Peminjam</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($borrowings as $borrowing)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $borrowing->facilities->name }}</td>
                                        <td>{{ $borrowing->users->name }}</td>
                                        <td>{{ $borrowing->tanggal_dari }}</td>
                                        <td>{{ $borrowing->tanggal_sampai }}</td>
                                        <td>{{ $borrowing->status }}</td>
                                        <td>
                                            <a href="{{ route('borrowings.show', $borrowing->id) }}"
                                                class="btn btn-primary btn-sm">View</a>
                                            @if (Auth::user()->is_admin || $borrowing->user_id == Auth::id())
                                                <a href="{{ route('borrowings.edit', $borrowing->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('borrowings.destroy', $borrowing->id) }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this borrowing?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
