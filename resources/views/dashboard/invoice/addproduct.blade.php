@extends('layouts.app')

@section('content')
    <div class="row items-push">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4 text-start">
                                <a href="{{ route('invoice.index') }}" class="btn btn-primary btn-sm">Back to All Invoice</a>
                            </div>
                            @livewire('add-product-to-invoice', ['invoice_id' => $invoice->id])

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
