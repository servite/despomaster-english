@extends('admin.employees.partials.layout')

@section('tab_content')
    <div class="row">

        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Letzte Aufträge')}}</h4>
                </div>
                <div class="panel-body">
                    <employee-history :items="{{ $orders }}"></employee-history>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{trans('admin.Einsätze beim Kunden')}}</h4>
                </div>
                <div class="panel-body">
                    @if (count($timetrackings_by_client))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{trans('admin.Kunde')}}</th>
                                <th>{{trans('admin.Zeiterfasst')}}</th>
                                <th>{{trans('admin.Einsätze')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timetrackings_by_client as $timetracking)
                                <tr>
                                    <td>
                                        <a href="{{ url('admin/client/' . $timetracking->client_id . '/show') }}">
                                            {{ $timetracking->name }}
                                        </a>
                                    </td>
                                    <td>{{ Time::output($timetracking->total_min) }}</td>
                                    <td>{{ $timetracking->no_of_orders }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{trans('admin.Keine zeiterfassten Aufträg')}}e</p>
                    @endif
                </div>
            </div>

            @if (count($timetrackings_by_date))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>{{trans('admin.Erfasste Stunden pro Monat')}}</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{trans('admin.Monat')}}</th>
                                <th>{{trans('admin.Zeiterfasst')}}</th>
                                <th>{{trans('admin.Einsätze')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timetrackings_by_date as $timetracking)
                                <tr>
                                    <td>{{ Date::monthName($timetracking->month) . ' ' . $timetracking->year }}</td>
                                    <td>{{ Time::output($timetracking->total_min) }}</td>
                                    <td>{{ $timetracking->no_of_orders }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection