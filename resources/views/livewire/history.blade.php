<div class="flex flex-col flex-1">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-4">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white">History</h1>
            @if($items->isNotEmpty())
                <button wire:click="clearAll" wire:confirm="Are you sure you want to clear all history?" class="text-sm text-red-600 dark:text-red-400 font-medium">
                    Clear All
                </button>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        @if($items->isEmpty())
            <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No Scans Yet</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Start scanning to see your history here</p>
            </div>
        @else
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($items as $item)
                    <li class="bg-white dark:bg-gray-800" wire:key="scan-{{ $item->id }}">
                        <div class="px-4 py-4 flex items-start gap-3">
                            <!-- Icon -->
                            <div class="shrink-0 w-10 h-10 rounded-full flex items-center justify-center
                                @if($item->type === 'url') bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                                @elseif($item->type === 'email') bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400
                                @elseif($item->type === 'phone') bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400
                                @else bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400
                                @endif">
                                @if($item->type === 'url')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                @elseif($item->type === 'email')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @elseif($item->type === 'phone')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ Str::limit($item->content, 50) }}
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($item->format)
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $item->format }}</span>
                                        <span class="text-gray-300 dark:text-gray-600">&middot;</span>
                                    @endif
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="shrink-0 flex items-center gap-2">
                                @if(in_array($item->type, ['url', 'email', 'phone']))
                                    <button wire:click="openItem({{ $item->id }})" class="p-2 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </button>
                                @endif
                                <button wire:click="deleteItem({{ $item->id }})" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</div>
