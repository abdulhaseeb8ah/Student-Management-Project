<div class="navbar">
        @foreach ($sidebarItems as $item)
            @php
                $menuName = url(strtolower(str_replace(' ', '_', $item)));
                $linkname = str_replace(' ', '', $item);
            @endphp
            <li id="{{ $linkname }}"  class="menu-item">{{ $item }}</li>
        @endforeach
</div>