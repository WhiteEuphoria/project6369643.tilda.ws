<?php

namespace App\Http\Middleware;

use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Illuminate\Http\Request;

class Authenticate extends FilamentAuthenticate
{
    // В новых версиях Filament этот метод не требуется,
    // так как логика встроена в родительский класс.
    // Оставляя этот файл, мы гарантируем, что Laravel
    // будет использовать правильную логику аутентификации Filament.
}
