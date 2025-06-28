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
                        <h1 class="mb-2">Tambah Menu Action</h1>
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
                                <form action="{{ route('setting-menu.add-action-proses', $settingMenu->id) }}" method="POST">
                                    @csrf
                                    
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
                                        <label class="form-label" for="textInput">Label</label>
                                        <input type="text" id="label" class="form-control" name="label" autocomplete="off" value="{{ $settingMenu->label }}" disabled>
                                    </div>
                                    {{-- <input type="hidden" name="action[]" value="1">  --}}
                                    {{-- ini idnya si viewnya --}}
                                    <div class="mb-3">
                                        <label class="form-label" for="selectOne">Action</label>
                                        <select id="select-item-selector" name="action[]" multiple class="form-select">
                                            @foreach ($getDataAction as $key => $jp)
                                                @php
                                                    // $isView = $jp->id == 1;
                                                    $isView = false;
                                                    $isSelected = $isView || in_array($jp->id, $getDataExistingSetAction ?? []);
                                                @endphp
                                                <option 
                                                    value="{{ $jp->id }}"
                                                    {{ $isSelected ? 'selected' : '' }}
                                                    {{ $isView ? 'disabled' : '' }}
                                                >
                                                    {{ $jp->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="btn btn-outline-success">Update</button>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-3">
                                            <a href="{{ route('setting-menu.index') }}"
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
