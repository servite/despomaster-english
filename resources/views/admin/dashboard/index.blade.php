@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary" style="height: 480px;">
                <div class="box-header with-border">
                    <h3 class="pull-right box-title"><a href="{{ url('admin/calendar') }}">Übersicht</a></h3>
                    <h3 class="box-title"><a href="{{ url('admin/calendar/orders/by/week') }}">Auftragskalender</a></h3>
                </div>
                <div class="box-body">
                    <dashboard-calendar></dashboard-calendar>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="nav-tabs-custom" style="height: 480px;">
                <ul class="nav nav-tabs pull-right">
                    @if (Gate::allows('orders'))
                        <li><a href="#orders" data-toggle="tab">Aufträge</a></li>
                    @endif
                    @if (Gate::allows('clients'))
                        <li><a href="#clients" data-toggle="tab">Kunden</a></li>
                    @endif
                    <li class="active"><a href="#employees" data-toggle="tab">Mitarbeiter</a></li>
                    <li class="pull-left header">Notizen</li>
                </ul>
                <div class="tab-content" style="height: 410px; overflow-y: scroll;">
                    <div class="tab-pane active" id="employees">
                        @include('admin.dashboard.partials.employee')
                    </div>
                    @if (Gate::allows('orders'))
                        <div class="tab-pane" id="orders">
                            @include('admin.dashboard.partials.order')
                        </div>
                    @endif
                    @if (Gate::allows('clients'))
                        <div class="tab-pane" id="clients">
                            @include('admin.dashboard.partials.client')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <bar-chart
                    title="Aufträge"
                    url="/api/report/chart/orders"
                    group-by="week">
            </bar-chart>
        </div>
        <div class="col-md-6">
            <div class="box box-primary" style="height: 400px;">
                <div class="box-header with-border">
                    <h3 class="box-title"><a href="{{ url('admin/reports/employees') }}">Mitarbeiterpool</a></h3>
                </div>
                <div class="box-body no-padding">
                    <div class="row">
                        <div class="col-md-5">
                            <pie-chart
                                    title="Mitarbeiter nach Geschlecht"
                                    url="/api/report/chart/employee-pool/gender"
                                    width="300" height="300"
                            >
                            </pie-chart>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <pie-chart
                                    title="Mitarbeiter nach Beschäftigungsart"
                                    url="/api/report/chart/employee-pool/occupation"
                                    width="300" height="300"
                            >
                            </pie-chart>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
