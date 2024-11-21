@extends('backend.template.main')

@section('title', 'Edit Selling')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Selling</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('panel.selling.update', $selling->uuid) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User </label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Select User</option>
@foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $selling->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="invoice" class="form-label">Invoice</label>
                            <input type="text" name="invoice" id="invoice" class="form-control" value="{{ $selling->invoice }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ $selling->date }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_amount" class="form-label">Total Amount</label>
                            <input type="number" name="total_amount" id="total_amount" class="form-control" value="{{ $selling->total_amount }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
