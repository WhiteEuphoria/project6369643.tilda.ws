<?php

namespace App\Filament\Resources\FraudClaimResource\Pages;

use App\Filament\Resources\FraudClaimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFraudClaims extends ListRecords
{
    protected static string $resource = FraudClaimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
