<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAccount extends CreateRecord
{
    protected static string $resource = AccountResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Если тип счета - Транзитный, а поле 'name' пустое,
        // мы принудительно задаем ему значение по умолчанию.
        if (isset($data['type']) && $data['type'] === 'Транзитный' && empty($data['name'])) {
            $data['name'] = 'Транзитный счет';
        }

        // Если поле 'status' не заполнено, устанавливаем 'Active' по умолчанию.
        // Это нужно для всех типов счетов, чтобы удовлетворить требование базы данных.
        if (empty($data['status'])) {
            $data['status'] = 'Active';
        }

        return $data;
    }
}
