@props(['title'])
<article class="card-surface mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h6 class="text-primary fw-bold mb-0">{{ $title }}</h6>
            <small class="d-block text-muted mt-1">
                Asked by <strong>admin</strong> • {{ now()->format('M d, Y') }}
            </small>
        </div>

        <button type="button" class="btn btn-outline-secondary btn-sm">
            Share
        </button>
    </div>
</article>
