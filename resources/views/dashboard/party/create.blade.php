@extends('layouts.app')
@section('content')
    <div class="row items-push">
        <div class="col-md-12">
            <a href="{{ route('party.index') }}" class="btn btn-primary btn-sm">Go Back</a>
        </div>
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                @livewire('party-create')
                </div>
            </div>
        </div>
    </div>
@endsection