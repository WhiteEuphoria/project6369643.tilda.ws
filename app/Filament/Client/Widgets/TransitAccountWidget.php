<?php

namespace App\Filament\Client\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class TransitAccountWidget extends Widget
{
    protected static string $view = 'filament.client.widgets.transit-account-widget';

    public ?Collection $transitAccounts = null;

    public function mount(): void
    {
        if (Auth::check() && method_exists(Auth::user(), 'transitAccounts')) {
            $this->transitAccounts = Auth::user()->transitAccounts()->get();
        }
    }
}
