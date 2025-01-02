<?php

namespace App\Livewire;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Plai;
use App\Models\Product; 
use Livewire\Component;

class AddProductToInvoice extends Component
{
    public $invoice_id;
    public $product_id;
    public $plai_id;
    public $qty;
    public $width_in_feet;
    public $width_in_inches;
    public $height_in_feet;
    public $height_in_inches;
    public $price;

    public $invoices = [];
    public $products = [];
    public $plais = [];
    public $invoiceProducts = [];

    public function mount()
    {
        $this->invoices = Invoice::all(); // Fetch all invoices
        $this->products = Product::all(); // Fetch all products
        $this->plais = Plai::all();       // Fetch all plai options
    }

    public function updatedInvoiceId()
    {
        // Load products based on the selected invoice
        $this->invoiceProducts = InvoiceProduct::where('invoice_id', $this->invoice_id)
            ->with('product') // Assuming 'product' relation is defined in the InvoiceProduct model
            ->get();
    }

    public function saveProduct()
    {
        $this->validate([
            'invoice_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required|integer|min:1',
            'width_in_feet' => 'required|numeric',
            'width_in_inches' => 'nullable|numeric',
            'height_in_feet' => 'required|numeric',
            'height_in_inches' => 'nullable|numeric',
            'price' => 'required|numeric|min:0',
        ]);

        

        // Insert data into the database
    try {
        InvoiceProduct::create([
            'invoice_id' => $this->invoice_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'width_in_feet' => $this->width_in_feet,
            'width_in_inches' => $this->width_in_inches ?? 0,
            'height_in_feet' => $this->height_in_feet,
            'height_in_inches' => $this->height_in_inches ?? 0,
            'price' => $this->price,
        ]);

        // Reset fields after successful insertion
        $this->resetFields();

        // Reload products for the selected invoice
        $this->updatedInvoiceId();

        session()->flash('message', 'Product added successfully.');
    } catch (\Exception $e) {
        session()->flash('error', 'Failed to save product: ' . $e->getMessage());
    }
    }

    public function deleteProduct($id)
    {
        $product = InvoiceProduct::findOrFail($id);
        $product->delete();

        $this->updatedInvoiceId(); // Reload the products for the selected invoice
        session()->flash('message', 'Product removed successfully.');
    }

    private function resetFields()
    {
        $this->product_id = null;
        $this->qty = null;
        $this->width_in_feet = null;
        $this->width_in_inches = null;
        $this->height_in_feet = null;
        $this->height_in_inches = null;
        $this->price = null;
    }

    public function render()
    {
        return view('livewire.add-product-to-invoice');
    }
}