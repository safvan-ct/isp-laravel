<div class="filter-toolbar">
    <div id="filterContent" class="collapse d-md-block  mt-3">
        {{ $slot }}
    </div>


    <div class="d-flex justify-content-end">
        <button id="filterFab" class="btn btn-success filter-fab d-md-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#filterContent" aria-expanded="false" aria-controls="filterContent">
            <i class="fas fa-filter"></i>
        </button>
    </div>
</div>
