@if ($rating)
    @for ($i = 1; $i <= 5; $i++)
        @if ($i <= floor($rating))
            <span class="star">★</span>
        @elseif ($i - 0.5 <= $rating)
            <span class="star-half"><span>★</span></span>
        @else
            <span class="star-empty">☆</span>
        @endif
    @endfor
@else
    No Rating have been added yet.
@endif

<style>
    .star-half {
        position: relative;
        display: inline-block;
        color: inherit;
    }
    .star-half span {
        position: absolute;
        left: 0;
        width: 50%;
        overflow: hidden;
    }
    .star-half::before {
        content: '☆';
    }
</style>