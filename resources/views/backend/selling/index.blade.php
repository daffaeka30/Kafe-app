@extends('backend.template.main')

@section('title', 'Sellings')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Selling List</h6>
                        <a href="{{ route('panel.selling.create') }}" class="btn btn-sm btn-primary me-3">
                            <i class="fas fa-plus me-1"></i> Add Selling
                        </a>
                    </div>
                </div>

                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 text-white" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3 text-white" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close text-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endif

                <div class="card-body px-4 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Invoice</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sellings as $selling)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $selling->user->name }}</td>
                                    <td>{{ $selling->invoice }}</td>
                                    <td>{{ $selling->date }}</td>
                                    <td>{{ $selling->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('panel.selling.show', $selling->uuid) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('panel.selling.edit', $selling->uuid) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('panel.selling.destroy', $selling->uuid) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-3 justify-content-center" style="margin-left: 20px; margin-right: 20px;">
                            {{ $events->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
