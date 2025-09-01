@props(['title'])

<h4 class="text-primary fw-bold mb-2">{{ $title }}</h4>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start small text-muted mb-2">
    <p class="mb-1">✍️ Author: <strong>Author Name</strong> • Reviewed • Verified</p>
    <p class="mb-0">
        ⏱️ Last review:
        <time datetime="{{ now()->toDateString() }}">{{ now()->format('M d, Y') }}</time>
        by <strong>Reviewer Name</strong>
    </p>
</div>
