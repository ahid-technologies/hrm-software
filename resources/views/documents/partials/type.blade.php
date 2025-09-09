@switch($document->document_type)
    @case('passport')
        <span class="badge bg-primary text-primary-fg">Passport</span>
    @break

    @case('visa')
        <span class="badge bg-info text-info-fg">Visa</span>
    @break

    @case('contract')
        <span class="badge bg-success text-success-fg">Contract</span>
    @break

    @case('other')
        <span class="badge bg-secondary text-secondary-fg">Other</span>
    @break
@endswitch
