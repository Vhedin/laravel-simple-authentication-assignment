@props(['fullUrlCheck' => false])
<li class="{{ Request::url() == $attributes['href'] ? 'mm-active' : '' }}">
    <a class="text-capitalize" href="{{ $attributes['href'] ?? 'javascript: void(0);' }}"
        target="{{ $attributes['target'] ?? '_self' }}">
        {{ $slot }}
    </a>
</li>
