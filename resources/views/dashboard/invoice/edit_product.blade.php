@extends('layouts.app')

@section('content')
    <div class="row items-push">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4 text-start d-flex justify-content-between">
                                <a href="{{ route('invoice.index') }}" class="btn btn-primary btn-sm">Back to All Invoice</a>

                                <!-- Add a new button for editing -->
                                <a href="{{ route('invoice.add-product')}}" class="btn btn-primary btn-sm">Add Item to This Invoice</a>
                            </div>
                            <livewire:all-product-invoices :invoice="$invoice"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
