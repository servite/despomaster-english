<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/textblocks/document/contract_parttime') }}>
            <a href="{{ url('admin/settings/textblocks/document/contract_parttime') }}" role="tab">Vertrag - Teilzeit</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/contract_temporary') }}>
            <a href="{{ url('admin/settings/textblocks/document/contract_temporary') }}" role="tab">Vertrag - Geringfügigi</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/warning') }}>
            <a href="{{ url('admin/settings/textblocks/document/warning') }}" role="tab">Abmahnung</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/reminder') }}>
            <a href="{{ url('admin/settings/textblocks/document/reminder') }}" role="tab">Erinnerung</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination') }}" role="tab">Kündigung</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination_without_notice') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination_without_notice') }}" role="tab">Kündigung - Fristlos</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/termination_within_probation') }}>
            <a href="{{ url('admin/settings/textblocks/document/termination_within_probation') }}" role="tab">Kündigung - Probezeit</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/document/withdrawal_receipt') }}>
            <a href="{{ url('admin/settings/textblocks/document/withdrawal_receipt') }}" role="tab">Kündigungsbestätigung</a>
        </li>
    </ul>
</div>