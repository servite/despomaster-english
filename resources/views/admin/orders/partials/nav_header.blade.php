<ul class="nav nav-tabs">
    <li {{ set_active('admin/order/*/show') }}>
        <a href="{{ url('admin/order/' . $order->id . '/show') }}">Übersicht</a>
    </li>
    <li {{ set_active('admin/order/*/attendance-list*') }}>
        <a href="{{ url('admin/order/' . $order->id . '/attendance-list') }}">Stundenzettel</a>
    </li>
    @if (Gate::allows('timetracking'))
        <li {{ set_active('admin/order/*/timetracking*') }}>
            <a href="{{ url('admin/order/' . $order->id . '/timetracking') }}">Zeiterfassung</a>
        </li>
    @endif
</ul>