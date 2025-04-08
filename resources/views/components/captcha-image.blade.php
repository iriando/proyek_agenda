<div class="mb-4">
    <img
        src="{{ captcha_src() }}"
        alt="captcha"
        onclick="this.src='{{ captcha_src() }}'+Math.random()"
        class="cursor-pointer mb-2"
    />
</div>
