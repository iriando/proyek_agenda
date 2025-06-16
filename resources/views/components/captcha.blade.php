<div class="flex flex-col items-start space-y-2">
    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Kode Keamanan</label>
    <div class="flex items-center space-x-2">
        <img src="{{ captcha_src() }}" alt="captcha" class="h-12 rounded" id="captcha-image">
        <button
            type="button"
            onclick="document.getElementById('captcha-image').src='{{ captcha_src('flat') }}&' + Math.random();"
            class="inline-flex items-center px-2 py-1 border rounded text-sm text-gray-700 hover:bg-gray-100"
            title="Refresh Captcha"
        >
            <x-heroicon-o-arrow-path class="w-5 h-5" />
        </button>
    </div>
</div>
