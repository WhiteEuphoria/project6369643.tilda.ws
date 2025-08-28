<div>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Upload Document</h3>
        <form wire:submit.prevent="save" class="mt-4 space-y-4">
            @if (session()->has('message'))
                <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File</label>
                <input type="file" id="file" wire:model="file" class="block w-full mt-1 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                <div wire:loading wire:target="file" class="mt-1 text-sm text-gray-500">Uploading...</div>
                @error('file') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="px-4 py-2 font-bold text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                Upload
            </button>
        </form>
    </div>

    <div class="p-6 mt-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Your Documents</h3>
        <div class="mt-4 space-y-4">
            @forelse ($documents as $document)
                @php
                    $isImage = in_array(strtolower(pathinfo($document->path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                @endphp
                <div class="flex items-center justify-between p-3 border-b dark:border-gray-700">
                    <div>
                        <p class="font-medium dark:text-white">{{ $document->original_name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status: <span class="font-semibold">{{ $document->status }}</span></p>
                    </div>
                    <div>
                        @if ($isImage)
                            <img src="{{ Storage::url($document->path) }}" alt="Preview" class="object-cover w-24 h-16 rounded-md">
                        @else
                            <a href="{{ Storage::url($document->path) }}" target="_blank" class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">Download</a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-gray-400">You have not uploaded any documents yet.</p>
            @endforelse
        </div>
    </div>
</div>
