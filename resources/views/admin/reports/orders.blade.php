@extends('layouts.admin')

@section('content')
        @if (Gate::allows('financials'))
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Berichte</h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="pad">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <td>KW</td>
                                        <td>Aufträge</td>
                                        <td>Eingesetzte MA</td>
                                        <td>Geleistete Std.</td>
                                        <td>Netto-Umsatz</td>
                                        <td>Lohnkosten</td>
                                        <td>Einnahmen</td>
                                    </tr>
                                    </thead>
                                    @foreach($groupedOrders as $week => $weeklyOrders)
                                        <tr>
                                            <td>{{ (int) $week }}</td>
                                            <td>{{ count($weeklyOrders) }}</td>
                                            <td>{{ $weeklyOrders->sum('employees_count') }}</td>
                                            <td>{{ Time::output($weeklyOrders->sum('total_min'), false) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_income')) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_wage')) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_income') - $weeklyOrders->sum('total_wage')) }}</td>
                                        </tr>
                                    @endforeach
                                    <tfoot style="border-top: 2px solid black;">
                                    <tr>
                                        <td><i class="fa fa-plus-square" aria-hidden="true"></i></td>
                                        <td>{{ count($orders) }}</td>
                                        <td>{{ $orders->sum('employees_count') }}</td>
                                        <td>{{ Time::output($orders->sum('total_min'), false) }}</td>
                                        <td>{{ money($orders->sum('total_income')) }}</td>
                                        <td>{{ money($orders->sum('total_wage')) }}</td>
                                        <td>{{ money($orders->sum('total_income') - $orders->sum('total_wage')) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Berichte (letztes Jahr)</h3>
                        </div>
                        <div class="box-body no-padding">
                            <div class="pad">
                                <table class="table table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <td>KW</td>
                                        <td>Aufträge</td>
                                        <td>Eingesetzte MA</td>
                                        <td>Geleistete Std.</td>
                                        <td>Netto-Umsatz</td>
                                        <td>Lohnkosten</td>
                                        <td>Einnahmen</td>
                                    </tr>
                                    </thead>
                                    @foreach($groupedOrdersLastYear as $week => $weeklyOrders)
                                        <tr>
                                            <td>{{ (int) $week }}</td>
                                            <td>{{ count($weeklyOrders) }}</td>
                                            <td>{{ $weeklyOrders->sum('employees_count') }}</td>
                                            <td>{{ Time::output($weeklyOrders->sum('total_min'), false) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_income')) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_wage')) }}</td>
                                            <td>{{ money($weeklyOrders->sum('total_income') - $weeklyOrders->sum('total_wage')) }}</td>
                                        </tr>
                                    @endforeach
                                    <tfoot style="border-top: 2px solid black;">
                                    <tr>
                                        <td><i class="fa fa-plus-square" aria-hidden="true"></i></td>
                                        <td>{{ count($ordersLastYear) }}</td>
                                        <td>{{ $ordersLastYear->sum('employees_count') }}</td>
                                        <td>{{ Time::output($ordersLastYear->sum('total_min'), false) }}</td>
                                        <td>{{ money($ordersLastYear->sum('total_income')) }}</td>
                                        <td>{{ money($ordersLastYear->sum('total_wage')) }}</td>
                                        <td>{{ money($ordersLastYear->sum('total_income') - $ordersLastYear->sum('total_wage')) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
                <bar-chart url="/api/report/chart/orders" title="Aufträge" group-by="week"></bar-chart>
            </div>
            <div class="col-md-6">
                <bar-chart url="/api/report/chart/invoices" title="Rechnungen" group-by="week"></bar-chart>
            </div>
        </div>
    </div>
@endsection
