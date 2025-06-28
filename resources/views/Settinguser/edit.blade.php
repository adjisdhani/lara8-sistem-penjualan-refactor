@extends('layouts.master')
@push('style')
@endpush
@section('judul')
Aplikasi Data Penjualan
@endsection
@section('judul_sub')
Form Data Penjualan
@endsection
@section('content')

<div class="row">
    <div class="offset-xl-1 col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- Content -->
        <div class="docs-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="mb-7" id="intro">
                        <h1 class="mb-2">Edit Data User</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <!-- Card -->
                    <div class="card">
                        <div class="tab-content p-4" id="pills-tabContent-basic-forms">
                            <div class="tab-pane tab-example-design fade show active" id="pills-basic-forms-design"
                                role="tabpanel" aria-labelledby="pills-basic-forms-design-tab">
                                <form action="/setting-user/{{ $settingUser->id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label class="form-label" for="textInput">Name</label>
                                        <input type="text" id="name" class="form-control" name="name" autocomplete="off" value="{{ $settingUser->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="textInput">Email</label>
                                        <input type="text" id="email" class="form-control" name="email" autocomplete="off" value="{{ $settingUser->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="selectOne">Role</label>
                                        <select id="role" class="form-select" name="role">
                                            @foreach ($getDataRole as $key => $jp)
                                                <option value="{{ $jp['id'] }}" {{ $jp['id'] == $settingUser->role ? 'selected' : '' }}>{{ $jp['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-outline-success">Update</button>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-3">
                                            <a href="{{ route('setting-user.index') }}"
                                                class="btn btn-outline-warning text-end">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@endpush
@endsection
