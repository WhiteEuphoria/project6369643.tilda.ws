<?php

namespace App\Livewire\Client;

use App\Models\Withdrawal;
use Livewire\Component;

class WithdrawalForm extends Component
{
    public $amount;
    public $requisites;
    public $successMessage;

    protected $rules = [
        'amount' => 'required|numeric|min:1',
        'requisites' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        if ($this->amount > auth()->user()->main_balance) {
            $this->addError('amount', 'Insufficient balance.');
            return;
        }

        Withdrawal::create([
            'user_id' => auth()->id(),
            'amount' => $this->amount,
            'requisites' => $this->requisites,
            'status' => 'pending',
        ]);

        $this->reset(['amount', 'requisites']);
        $this->successMessage = 'Withdrawal request submitted successfully.';
    }

    public function render()
    {
        return view('livewire.client.withdrawal-form');
    }
}
