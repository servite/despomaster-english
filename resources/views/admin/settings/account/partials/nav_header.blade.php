<ul class="nav nav-tabs">
    <li {{ set_active('admin/settings/account/credentials') }}>
        <a href="{{ url('admin/settings/account/credentials') }}">Kontodaten</a>
    </li>
    @can('update', \App\Models\User\User::class)
    <li {{ set_active('admin/settings/account/address') }}>
        <a href="{{ url('admin/settings/account/address') }}">Anschrift</a>
    </li>
    @endcan
    <li {{ set_active('admin/settings/account/signature') }}>
        <a href="{{ url('admin/settings/account/signature') }}">Signatur</a>
    </li>
</ul>