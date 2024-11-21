@extends('backend.template.main')

@section('title', 'View Selling')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>View Selling</h5>
                </div>
                <div class="card-body">
                    <p><strong>User:</strong> {{ $selling->user->name }}</p>
                    <p><strong>Invoice:</strong> {{ $selling->invoice }}</p>
                    <p><strong>Date:</strong> {{ $selling->date }}</p>
                    <p><strong>Total Amount:</strong> {{ $selling->total_amount }}</p>
                    <a href="{{ route('panel.selling.edit', $selling->uuid) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('panel.selling.destroy', $selling->uuid) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('panel.selling.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
