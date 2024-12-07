<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Party;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentCreate extends Component
{
    public $search = ''; 
    public $customers = []; 
    public $customer_id;
    public $amount;
    public $reduction;
    public $payment_method = 'Cash';
    public $reference;
    public $no_customers_found = false; 

    public function mount()
    {
    
        $this->customers = Customer::all()->take(10); 
    }

    public function updatedSearch()
    {
        // Fetch customers based on search query
        if ($this->search) {
            $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')
                ->take(10)
                ->get();
        } else {
            // Show initial list if search is empty
            $this->customers = Customer::all()->take(10);
        }

        // Check if no customers found
    }

    public function clearCustomerSearch()
    {
        $this->reset(['search']);
        $this->customers = Party::where('type', 'customer')->limit(50)->get();
    }
    public function relationSearch(): array
    {
        return [
            "Party" => [
                'name',
                'phone',
            ]
        ];
    }

    public function submit()
    {
        $this->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'reduction' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'reference' => 'nullable|string|max:255',
        ]);

        // Create the payment record
        Payment::create([
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'reduction' => $this->reduction,
            'payment_method' => $this->payment_method,
            'reference' => $this->reference,
        ]);

        // Reset the form
        $this->reset(['customer_id', 'amount', 'reduction', 'payment_method', 'reference']);

        session()->flash('success', 'Payment added successfully!');
    }

    public function render()
    {
        
        return view('livewire.payment-create', [
            'filteredCustomers' => Customer::whereNotIn('id', $this->customers)->get(),
        ]);
    }
}
