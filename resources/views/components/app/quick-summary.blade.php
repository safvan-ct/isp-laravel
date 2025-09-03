@props(['data', 'class' => 'p-0'])

<div class="{{ $class }}">
    <div class="ayah-card w-100">
        <h5 class="fw-bold text-primary mb-2">📌 Quick Summary</h5>
        <hr class="m-2">
        @isset($data['title'])
            <p class="fw-bold mb-2">{{ $data['title'] }}</p>
        @endisset

        @isset($data['notes'])
            <ul class="diamond-list m-0">
                @foreach ($data['notes'] as $item)
                    <li class="mb-1">{!! $item !!}</li>
                @endforeach
            </ul>
        @endisset
    </div>

    @if (isset($data['true']) || isset($data['good']) || isset($data['bad']))
        <div class="geo-divider my-2 d-none"></div>

        <div class="d-flex flex-column gap-2 mt-2">
            @isset($data['true'])
                <div class="card-surface text-white bg-success shadow-sm border-0 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-check-circle fa-lg mt-1"></i>
                        <p class="m-0">{!! $data['true'] !!}</p>
                    </div>
                </div>
            @endisset

            @isset($data['good'])
                <div class="card-surface bg-primary-subtle shadow-sm border-0 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-info-circle fa-lg mt-1" style="color: #0d6efd"></i>
                        <p class="m-0">{!! $data['good'] !!}</p>
                    </div>
                </div>
            @endisset

            @isset($data['bad'])
                <div class="card-surface bg-danger-subtle shadow-sm border-0 rounded-3">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fas fa-times-circle fa-lg mt-1 text-danger"></i>
                        <div class="m-0">{!! $data['bad'] !!}</div>
                    </div>
                </div>
            @endisset
        </div>
    @endif

    @isset($data['trust'])
        <div class="geo-divider my-2 d-none"></div>

        <div class="mb-3">
            <h6 class="fw-bold text-primary mb-2">📖 Trust & provenance</h6>
            <ul class="check-list m-0">
                @foreach ($data['trust'] as $item)
                    <li class="mb-1">{!! $item !!}</li>
                @endforeach
            </ul>
        </div>
    @endisset

    @isset($data['alert'])
        <div class="geo-divider my-2 d-none"></div>

        <div class="card-surface text-dark bg-warning-subtle shadow-sm border-0 rounded-3 mt-2">
            <div class="text-center gap-3">
                <i class="fas fa-exclamation-triangle fa-lg mt-1 text-center text-warning"></i>
                <p class="mb-0 text-center">{!! $data['alert'] !!}</p>
            </div>
        </div>
    @endisset
</div>
