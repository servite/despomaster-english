@if (isset($notes['orders']))
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Datum</th>
            <th>Information</th>
            <th>Auftragsnr.</th>
            <th>Bearbeiter</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notes['orders'] as $note)
            @continue(! $note->loggable)
            <tr>
                <td title="Eintrag vom {{ Date::format($note->created_at) . ' ' . Date::format($note->created_at, 'time') }} Uhr">{{ Date::monthYear($note->date, false) }}</td>
                <td title="{{ $note->information }}">{{ Str::limit($note->information, 65) }}</td>
                <td>
                    <a href="{{ url('admin/order/' . $note->loggable_id . '/show') }}">{{ $note->loggable_id }}</a>
                </td>
                <td>{{ $note->user->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>Keine Notizen</p>
@endif


