@if (isset($item['header']))
    <li class="header">{{ $item['header'] }}</li>
@else
    @php
        $isActive = request()->routeIs(...($item['active'] ?? []));
        $hasChildren = ! empty($item['children']);
    @endphp
    <li class="{{ $hasChildren ? 'treeview' : '' }} {{ $isActive ? 'active' : '' }}">
        <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}">
            <i class="fa {{ $item['icon'] ?? 'fa-circle-o' }}"></i> <span>{{ $item['text'] }}</span>
            @if ($hasChildren)
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
            @endif
        </a>
        @if ($hasChildren)
            <ul class="treeview-menu">
                @foreach ($item['children'] as $child)
                    @include('layouts.partials.menu-item', ['item' => $child])
                @endforeach
            </ul>
        @endif
    </li>
@endif
