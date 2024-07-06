<!-- resources/views/borrowings/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Borrowing Details</div>

                    <div class="card-body">
                        <p><strong>Facility:</strong> {{ $borrowing->facilities->name }}</p>
                        <p><strong>Borrower:</strong> {{ $borrowing->users->name }}</p>
                        <p><strong>Start Date:</strong> {{ $borrowing->start_date }}</p>
                        <p><strong>End Date:</strong> {{ $borrowing->end_date }}</p>
                        <p><strong>Status:</strong> {{ $borrowing->status }}</p>

                        @if (Auth::user()->is_admin || $borrowing->user_id == Auth::id())
                            <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this borrowing?')">Delete</button>
                            </form>
                        @endif
                        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
