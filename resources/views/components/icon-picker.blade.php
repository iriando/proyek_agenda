<div class="w-full px-2">
    <label class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 block">
        Pilih Icon
    </label>

    <div class="flex flex-wrap justify-start gap-4">
        @foreach ($icons as $icon => $label)
            <div class="w-1/3 flex flex-col items-center space-y-1 text-center">
                <input type="radio" id="icon-{{ $loop->index }}" name="icon" value="{{ $icon }}"
                    class="sr-only icon-radio"
                    @checked($getRecord()?->icon === $icon)
                    onchange="window.dispatchEvent(new CustomEvent('icon-selected', { detail: '{{ $icon }}' }))">

                <label for="icon-{{ $loop->index }}" class="cursor-pointer flex flex-col items-center space-y-1">
                    <div class="p-3 border rounded-lg transition-all hover:bg-gray-100" data-icon="{{ $icon }}">
                        <x-dynamic-component :component="$icon" class="w-6 h-6 text-gray-700" />
                    </div>
                    <span class="text-xs text-gray-600">{{ $label }}</span>
                </label>
            </div>
        @endforeach
    </div>
</div>

<script>
    window.addEventListener('icon-selected', event => {
        const selectedIcon = event.detail;
        const hiddenInput = document.querySelector('input[name="data.icon"]');
        if (hiddenInput) {
            hiddenInput.value = selectedIcon;
            hiddenInput.dispatchEvent(new Event('input'));
        }

        document.querySelectorAll('[data-icon]').forEach(el => {
            el.classList.remove('ring', 'ring-primary-500');
        });
        const selectedBox = document.querySelector(`[data-icon="${selectedIcon}"]`);
        if (selectedBox) {
            selectedBox.classList.add('ring', 'ring-primary-500');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const currentIcon = document.querySelector('input[name="data.icon"]')?.value;
        const currentBox = document.querySelector(`[data-icon="${currentIcon}"]`);
        if (currentBox) {
            currentBox.classList.add('ring', 'ring-primary-500');
        }
    });
</script>
