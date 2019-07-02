@extends('layouts.employee')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Auftragshistorie</h4>
                </div>
                <div class="panel-body">
                    <employee-history :items="{{ $orders }}"></employee-history>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Einsätze beim Kunden</h4>
                </div>
                <div class="panel-body">
                    @if (count($timetrackings_by_client))
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Kunde</th>
                                <th>Zeiterfasst</th>
                                <th>Einsätze</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timetrackings_by_client as $timetracking)
                                <tr>
                                    <td>{{ $timetracking->name }}</td>
                                    <td>{{ Time::output($timetracking->total_min) }}</td>
                                    <td>{{ $timetracking->no_of_orders }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>{{trans('admin.Keine_zeiterfassten_Aufträg')}}</p>
                    @endif
                </div>
            </div>

            @if (count($timetrackings_by_date))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Erfasste Stunden pro Monat</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Monat</th>
                                <th>Zeiterfasst</th>
                                <th>Einsätze</th>
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
@stop