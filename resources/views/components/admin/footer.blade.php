<footer {{ $attributes->merge(['class' => 'footer-content']) }}>
    <div class="footer-text">
        <div class="row">
            <div class="col-md-6">
                <div class="copy">
                    © {{ date('Y') }} <a class="text-capitalize text-black" href="{{ config('app.url') }}"
                        target="_blank">{{ __(config('app.name')) }}</a>.
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="credit">
                    @lang('Developed by') <a class="text-capitalize" href="https://iqbalhasan.dev/"
                        target="_blank">{{ __('IQBAL HASAN') }}<a>
                </div>
            </div>
        </div>
    </div>
</footer>
