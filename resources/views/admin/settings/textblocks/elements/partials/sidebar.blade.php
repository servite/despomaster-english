<div class="col-md-2">
    <ul class="nav nav-pills nav-stacked">
        <li {{ set_active('admin/settings/textblocks/element/signature') }}>
            <a href="{{ url('admin/settings/textblocks/element/signature') }}" role="tab">Allgemein</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/operation_plan') }}>
            <a href="{{ url('admin/settings/textblocks/element/operation_plan') }}" role="tab">Einsatzplan</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/attendance_list') }}>
            <a href="{{ url('admin/settings/textblocks/element/attendance_list') }}" role="tab">Stundenzettel</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/invoice') }}>
            <a href="{{ url('admin/settings/textblocks/element/invoice') }}" role="tab">Rechnung</a>
        </li>
        <li {{ set_active('admin/settings/textblocks/element/document') }}>
            <a href="{{ url('admin/settings/textblocks/element/document') }}" role="tab">Dokumente</a>
        </li>
    </ul>
</div>