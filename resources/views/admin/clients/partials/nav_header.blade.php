<ul class="nav nav-tabs">
    <li {{ set_active('admin/client/*/show') }}>
        <a href="{{ url('admin/client/' . $client->id . '/show') }}">Übersicht</a>
    </li>
    @if (auth()->user()->can('view', $client))
        <li {{ set_active('admin/client/*/profile') }}>
            <a href="{{ url('admin/client/' . $client->id . '/profile') }}">Stammdaten</a>
        </li>
    @endif
    <li {{ set_active('admin/client/*/history') }}>
        <a href="{{ url('admin/client/' . $client->id . '/history') }}">Historie</a>
    </li>
    @if (Gate::allows('financials'))
        <li {{ set_active('admin/client/*/invoice') }}>
            <a href="{{ url('admin/client/' . $client->id . '/invoice') }}">Rechnungen</a>
        </li>
    @endif
    @if (Gate::allows('user'))
        <li {{ set_active('admin/client/*/account') }}>
            <a href="{{ url('admin/client/' . $client->id . '/account') }}">Konto</a>
        </li>
    @endif
    @if (Gate::allows('documents'))
        <li {{ set_active('admin/client/*/documents') }}>
            <a href="{{ url('admin/client/' . $client->id . '/documents') }}">Kundenakte</a>
        </li>
    @endif
</ul>