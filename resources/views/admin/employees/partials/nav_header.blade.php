<ul class="nav nav-tabs">
    <li {{ set_active('admin/employee/*/show') }}>
        <a href="{{ url('admin/employee/' . $employee->id . '/show') }}">Übersicht</a>
    </li>
    @if (auth()->user()->can('view', $employee))
        <li {{ set_active('admin/employee/*/profile') }}>
            <a href="{{ url('admin/employee/' . $employee->id . '/profile') }}">Stammdaten</a>
        </li>
    @endif
    @if (Gate::allows('financials'))
        <li {{ set_active('admin/employee/*/financials') }}>
            <a href="{{ url('admin/employee/' . $employee->id . '/financials') }}">Lohn & Gehalt</a>
        </li>
    @endif
    <li {{ set_active('admin/employee/*/history') }}>
        <a href="{{ url('admin/employee/' . $employee->id . '/history') }}">Einsätze</a>
    </li>
    @if (Gate::allows('user'))
        <li {{ set_active('admin/employee/*/account') }}>
            <a href="{{ url('admin/employee/' . $employee->id . '/account') }}">Konto</a>
        </li>
    @endif
    @if (Gate::allows('documents'))
        <li {{ set_active('admin/employee/*/documents') }}>
            <a href="{{ url('admin/employee/' . $employee->id . '/documents') }}">Personalakte</a>
        </li>
    @endif
</ul>