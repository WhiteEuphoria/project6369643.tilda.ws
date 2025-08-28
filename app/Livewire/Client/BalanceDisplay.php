<?php

namespace App\Livewire\Client;

use Livewire\Component;

class BalanceDisplay extends Component
{
    public function render()
    {
        // Просто передаем баланс текущего пользователя в шаблон
        return view('livewire.client.balance-display', [
            'balance' => auth()->user()->main_balance
        ]);
    }
}
