<div>
    <h4>Add New Product to Invoice</h4>

    <form wire:submit.prevent="saveProduct">
    <div class="mb-3">
        <div class="row">
            <div class="col-6">
                <label for="invoice_id" class="form-label">Select Invoice</label>
                <select id="invoice_id" class="form-control" wire:model="invoice_id">
                    <option value="">Select an Invoice</option>
                    
                    @forelse($invoices as $invoice)
                        <option value="{{ $invoice['id'] }}">{{ $invoice['id'] }}</option>
                    @empty
                        <option value="">No Invoices Found</option>
                    @endforelse
                </select>
                @error('invoice_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-6">
                <label for="product_id" class="form-label">Select Product</label>
                <select id="product_id" class="form-control" wire:model.defer="product_id">
                    <option value="">Select a Product</option>
                    @forelse($products as $product)
                        <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                    @empty
                        <option value="">No Products Found</option>
                    @endforelse
                </select>
                @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
        </div>
</div>
<div class="mb-3">
<div class="row">
    <div class="col-6">
        <label for="plai_id" class="form-label">Select Plai</label>
        <select id="plai_id" class="form-control" wire:model.defer="plai_id">
            <option value="">Select a Plai</option>
            @forelse($plais as $plai)
                <option value="{{ $plai['id'] }}">{{ $plai['name'] }}</option>
            @empty
                <option value="">No Plaises Found</option>
            @endforelse
        </select>
        @error('plai_id') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    <div class="col-6">
        <label for="qty" class="form-label">Quantity</label>
        <input type="number" id="qty" class="form-control" wire:model="qty">
        @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
    </div>
</div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label for="width_in_feet" class="form-label">Width (Feet)</label>
                    <input type="number" id="width_in_feet" class="form-control" wire:model="width_in_feet">
                </div>
                <div class="col-6">
                    <label for="width_in_inches" class="form-label">Width (Inches)</label>
                    <input type="number" id="width_in_inches" class="form-control" wire:model="width_in_inches">

                </div>
            </div>
        </div>


        <!-- Height in Feet -->
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label for="height_in_feet" class="form-label">Height (Feet)</label>
                    <input type="number" id="height_in_feet" class="form-control" wire:model="height_in_feet">
                </div>
                <div class="col-6">

                    <label for="height_in_inches" class="form-label">Height (Inches)</label>
                    <input type="number" id="height_in_inches" class="form-control" wire:model="height_in_inches">
                </div>
            </div>
        </div>

        <!-- Height in Inches -->
        <div class="mb-3">
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" class="form-control" wire:model="price">
            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>

    <!-- Product Details Table -->
    @if ($invoice_id)
        <h4>Products for Invoice ID: {{ $invoice_id }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Qty</th>
                    <th>Price/sqft</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoiceProducts as $invoiceProduct)
                    <tr>
                        <td>{{ $invoiceProduct->product->name }}</td>
                        <td>{{ $invoiceProduct->width_in_feet }} ft {{ $invoiceProduct->width_in_inches }} in</td>
                        <td>{{ $invoiceProduct->height_in_feet }} ft {{ $invoiceProduct->height_in_inches }} in</td>
                        <td>{{ $invoiceProduct->qty }}</td>
                        <td>{{ $invoiceProduct->price }}</td>
                        <td>{{ $invoiceProduct->qty * $invoiceProduct->price }}</td>
                        <td>
                            <!-- Action buttons like edit, delete -->
                            <button wire:click="deleteProduct({{ $invoiceProduct->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
