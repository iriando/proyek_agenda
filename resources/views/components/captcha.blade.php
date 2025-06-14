<div class="space-y-2">
    <img src="{{ url('/captcha-image') }}" id="captcha" class="rounded border">
    <button
        type="button"
        onclick="document.getElementById('captcha').src = '/captcha-image?' + Math.random();"
        class="text-sm text-blue-600 hover:underline"
    >
        Refresh Captcha
    </button>
</div>
