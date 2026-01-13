<div class="flex flex-col flex-1">
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-4">
        <h1 class="text-xl font-semibold text-gray-900 dark:text-white text-center">ScanTrack</h1>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-center justify-center p-6">
        @if($showResult)
            <!-- Scan Result Card -->
            <div class="w-full max-w-sm bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 space-y-4">
                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-green-100 dark:bg-green-900/30 rounded-full">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <div class="text-center">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Scan Successful</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if($lastScannedFormat)
                            {{ $lastScannedFormat }}
                        @else
                            Code scanned
                        @endif
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                    <p class="text-sm text-gray-600 dark:text-gray-300 break-all">{{ $lastScannedContent }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    @if(in_array($lastScannedType, ['url', 'email', 'phone']))
                        <button wire:click="openContent" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
                            @if($lastScannedType === 'url')
                                Open Link
                            @elseif($lastScannedType === 'email')
                                Send Email
                            @elseif($lastScannedType === 'phone')
                                Call Number
                            @endif
                        </button>
                    @endif

                    <button wire:click="dismissResult" class="w-full py-3 px-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium rounded-xl transition-colors">
                        Scan Another
                    </button>
                </div>
            </div>
        @else
            <!-- Scan Prompt -->
            <div class="text-center space-y-6">
                <div class="w-32 h-32 mx-auto bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>

                <div class="space-y-2">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Ready to Scan</h2>
                    <p class="text-gray-500 dark:text-gray-400">Tap the button below to scan a QR code or barcode</p>
                </div>

                <button wire:click="startScan" class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-2xl shadow-lg shadow-indigo-500/30 transition-all active:scale-95">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Start Scanning
                </button>
            </div>
        @endif
    </main>
</div>
