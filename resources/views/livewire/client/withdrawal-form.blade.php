<div class="p-6 mt-4 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Request Withdrawal</h3>
    <form wire:submit.prevent="submit" class="mt-4 space-y-4">
        @if ($successMessage)
            <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ $successMessage }}
            </div>
        @endif

        <div>
            <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount (€)</label>
            <input type="number" id="amount" wire:model="amount" class="block w-full mt-1 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
            @error('amount') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="requisites" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Your Bank Details</label>
            <textarea id="requisites" wire:model="requisites" rows="3" class="block w-full mt-1 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"></textarea>
            @error('requisites') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
            Submit Request
        </button>
    </form>
</div>
