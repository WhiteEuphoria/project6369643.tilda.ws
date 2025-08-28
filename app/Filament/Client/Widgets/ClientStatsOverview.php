<?php
namespace App\Filament\Client\Widgets;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
class ClientStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();
        return [
            Stat::make('Main Balance', number_format($user->main_balance, 2) . ' USD')
                ->description('Your current available funds')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Accounts', $user->accounts()->count())
                ->description('Total number of your accounts')
                ->color('info'),
            Stat::make('Verification Status', ucfirst($user->verification_status))
                ->description('Your account status')
                ->color($user->verification_status === 'approved' ? 'success' : 'warning'),
        ];
    }
}
