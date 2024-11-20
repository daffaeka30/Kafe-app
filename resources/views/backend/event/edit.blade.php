@extends('backend.template.main')

@section('title', 'Edit Event')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white text-capitalize ps-3">Edit Event</h6>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body px-0 pb-2">
                        <form action="{{ route('panel.event.update', $events->uuid) }}" method="post" class="p-3"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text"
                                            class="form-control border px-3 @error('name') is-invalid @enderror"
                                            value="{{ old('name', $events->name) }}" name="name" id="name"
                                            placeholder="Enter Event Name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="event_category_id" class="form-label">Category</label>
                                        <select name="event_category_id" id="event_category_id"
                                        class="form-select border ps-2 pe-4 @error('event_category_id') is-invalid @enderror">
                                        <option value="" disabled selected>---- Choose Category ----</option>
                                        @foreach ($eventCategories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $events->event_category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                        </select>

                                        @error('event_category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number"
                                            class="form-control border px-3 @error('stock') is-invalid @enderror"
                                            value="{{ old('price', $events->price) }}" name="price" id="price"
                                            placeholder="Enter Price">

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status"
                                            class="form-select border ps-2 pe-4 @error('status') is-invalid @enderror">
                                            <option value="" disabled selected>---- Select Status ----</option>
                                            <option value="active" {{ $events->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive" {{ $events->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file"
                                            class="form-control border px-3 @error('image') is-invalid @enderror"
                                            name="image" id="image" accept="image/*">

                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @if ($events->image)
                                    <img src="{{ asset('storage/' . $events->image) }}" alt="Image" class="img-fluid img-thumbnail mb-3" style="width: 150px; height: auto;">
                                @endif
                            </div>

                            <div class="float-end">
                                <a href="{{ route('panel.event.index') }}" class="btn btn-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
