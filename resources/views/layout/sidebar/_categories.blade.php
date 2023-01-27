@if ($items->count())
    <ul>
        @foreach($items as $item)
            <li>
                <a href="{{ route('blog.category', ['category' => $item->slug]) }}">{{ $item->name }}</a>
            </li>
        @endforeach
    </ul>
@endif
