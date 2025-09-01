@props(['data'])

<div class="card-surface">
    <h6 class="fw-bold text-primary">Related topics</h6>
    <ul class="small ps-3">
        @foreach ($data as $key => $item)
            <li class="py-1">
                <a class="text-primary"
                    href="{{ route('answers.show', ['menu_slug' => 'festival', 'module_slug' => 'meelad', 'question_slug' => $key]) }}">
                    {{ $item }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
