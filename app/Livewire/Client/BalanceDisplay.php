<?php

namespace App\Livewire\Client;

use Livewire\Component;

class BalanceDisplay extends Component
{
    public function render()
    {
        // Pass the current user's balance to the view
        return view('livewire.client.balance-display', [
            'balance' => auth()->user()->main_balance
        ]);
    }
}
