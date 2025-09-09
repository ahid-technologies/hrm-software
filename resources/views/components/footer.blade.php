<footer class="footer footer-transparent d-print-none py-3">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto d-none d-md-block">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        <a href="mailto:info@ahidtechnologies.com?subject=Support Request - {{ config('app.name', 'HR System') }}&body=Hello, I need support with the {{ config('app.name', 'HR System') }} system.%0D%0A%0D%0APlease describe your issue:"
                            class="link-secondary" title="Get Support">
                            <i class="ti ti-help-circle me-1"></i>
                            Support
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="mailto:info@ahidtechnologies.com?subject=Feature Request - {{ config('app.name', 'HR System') }}&body=Hello, I would like to request a new feature for the {{ config('app.name', 'HR System') }} system.%0D%0A%0D%0AFeature Description:%0D%0A%0D%0ABusiness Justification:%0D%0A%0D%0AUrgency Level:"
                            class="link-secondary" title="Request New Feature">
                            <i class="ti ti-bulb me-1"></i>
                            Request Feature
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="mailto:info@ahidtechnologies.com?subject=Bug Report - {{ config('app.name', 'HR System') }}&body=Hello, I found a bug in the {{ config('app.name', 'HR System') }} system.%0D%0A%0D%0ASteps to reproduce:%0D%0A1. %0D%0A2. %0D%0A3. %0D%0A%0D%0AExpected behavior:%0D%0A%0D%0AActual behavior:%0D%0A%0D%0ABrowser/Device info:"
                            class="link-secondary" title="Report Bug">
                            <i class="ti ti-bug me-1"></i>
                            Report Bug
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://wa.me/+923437753509?text=Hello, I need assistance with the {{ config('app.name', 'HR System') }} system."
                            target="_blank" class="link-success" title="WhatsApp Support">
                            <i class="ti ti-brand-whatsapp me-1"></i>
                            WhatsApp
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://ahidtechnologies.com" target="_blank" class="link-secondary" rel="noopener">
                            Made with
                            <i class="ti ti-heart font-1xl text-warning"></i>
                            by
                            <strong>
                                Ahid Technologies
                            </strong>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright &copy; {{ now()->year }}
                        <a href="{{ route('dashboard') }}" class="link-secondary">{{ config('app.name') }}</a>.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
