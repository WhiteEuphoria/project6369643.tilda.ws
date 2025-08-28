<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Transit Accounts
        </x-slot>

        @if($transitAccounts && $transitAccounts->isNotEmpty())
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">Name</th>
                            <th scope="col" class="py-3 px-6">Type</th>
                            <th scope="col" class="py-3 px-6">Balance</th>
                            <th scope="col" class="py-3 px-6">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transitAccounts as $account)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $account->name }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $account->type }}
                                </td>
                                <td class="py-4 px-6">
                                    €{{ number_format($account->balance, 2, ',', ' ') }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $account->status }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>You have no transit accounts.</p>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
