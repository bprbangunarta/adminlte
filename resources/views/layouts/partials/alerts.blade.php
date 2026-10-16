@foreach (['success' => 'check', 'info' => 'info', 'warning' => 'warning', 'danger' => 'ban'] as $type => $icon)
    @if (session($type))
        <div class="alert alert-{{ $type }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-{{ $icon }}"></i> {{ session($type) }}
        </div>
    @endif
@endforeach

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
