<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Наши новые компоненты -->
            <div class="mt-6">
                @livewire('client.balance-display')
            </div>

            <div class="mt-6">
                @livewire('client.withdrawal-form')
            </div>

            <div class="mt-6">
                @livewire('client.document-upload-form')
            </div>
            
            <!-- Форму для FraudClaim добавим позже, если она понадобится, чтобы не перегружать интерфейс -->

        </div>
    </div>
</x-app-layout>
