@extends('layouts.master')

@section('title', 'Konfigurasi')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Role</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="dt-responsive table-responsive nowrap`">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.include.datatables')

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
