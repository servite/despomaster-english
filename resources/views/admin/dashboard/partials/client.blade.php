@if (isset($notes['clients']))
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>{{trans('admin.Datum')}}</th>
            <th>{{trans('admin.Information')}}</th>
            <th>{{trans('admin.Kunde')}}</th>
            <th>{{trans('admin.Bearbeiter')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notes['clients'] as $note)
            @continue(! $note->loggable)
            <tr>
                <td title="{{trans('admin.Eintrag vom')}} {{ Date::format($note->created_at) . ' ' . Date::format($note->created_at, 'time') }} {{trans('admin.Uhr')}}">{{ Date::monthYear($note->dat, false) }}</td>
                <td title="{{ $note->information }}">{{ Str::limit($note->information, 65) }}</td>
                <td><a href="{{ url('admin/client/' . $note->loggable_id . '/show') }}">{{ $note->loggable->short_name}}</a></td>
                <td>{{ $note->user->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <p>{{trans('admin.Keine Notizen')}}</p>
@endif


