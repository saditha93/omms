<ul>
    @foreach($childs as $child)
        @if($child->is_bar == 1)
            <li class="child">
                <a href="{{ route('barCategory.edit', $child->id) }}">{{ $child->name }}</a>
                @if(count($child->childs))
                    @include('stock.category.manageChild',['childs' => $child->childs])
                @endif
            </li>
        @else
            <li class="child">
                <a href="{{ route('stockCategory.edit', $child->id) }}">{{ $child->name }}</a>
                @if(count($child->childs))
                    @include('stock.category.manageChild',['childs' => $child->childs])
                @endif
            </li>
        @endif
    @endforeach
</ul>
