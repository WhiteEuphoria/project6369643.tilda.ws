<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Illuminate\Http\Request;

class Authenticate extends FilamentAuthenticate
{
    // In recent Filament versions this override is unnecessary
    // because the logic exists in the parent class already.
    // Keeping this file ensures Laravel uses the correct
    // Filament authentication middleware.
}
