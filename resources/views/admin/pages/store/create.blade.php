@extends('admin.master')

@push('title')
    Store Table
@endpush


@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-bottom:24px;">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Create Store<span class="badge badge-success"></span></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form method="POST" action="{{route('admin.store.store')}}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Type</label>
                            <select name="type" class="form-control @error('type') is-invalid @enderror">
                                @foreach ($types as $type )
                                <option value="{{$type}}" {{ old('type') == $type ? 'selected' : '' }}>{{$type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>





                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
