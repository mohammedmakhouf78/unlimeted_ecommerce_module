@extends('admin.master')

@push('title')
    version Sprints Table
@endpush


@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom:24px;">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Edit Version Sprints<span class="badge badge-success"></span></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{ route('admin.store.update', $store->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name',$store->name) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Type</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                @foreach ($types as $type )
                                <option value="{{$type}}" {{ old('type',$store->type) == $type ? 'selected' : '' }}>{{$type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
