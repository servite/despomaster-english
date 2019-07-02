@extends('layouts.employee')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary" style="height: 480px;">
                <div class="box-header with-border">
                    <h3 class="pull-right box-title"><a href="{{ '/e/calendar' }}">Übersicht</a></h3>
                </div>
                <div class="box-body">
                    <calendar-by-week></calendar-by-week>
                </div>
            </div>

            <requested-orders></requested-orders>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Monatliche Lohnabrechnungen</h4>
                </div>
                <div class="panel-body">
                    <form class="form-inline" action="{{ url('/e/payroll') }}" method="GET" target="_blank">
                        <div class="form-group">
                            <select name="month" id="month" class="form-control input-sm" required>
                                <option value="">Monat..</option>
                                @foreach(config('settings.months') as $key => $month)
                                    <option value="{{ $key }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="year" id="year" class="form-control input-sm" required>
                                <option value="">Jahr..</option>
                                @for($i = date('Y'); $i >= 2017; $i--)
                                    <option value="{{ $i }}">{{ $i}}</option>
                                @endfor
                            </select>
                        </div>
                        <input type="submit" value="{{trans('admin.Lohnabrechnung anzeigen')}}" class="btn btn-default btn-sm">
                    </form>
                </div>
            </div>
            <div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Der Dispo-Manager erstellt die endgültige Einsatzplanung.</p>
                        <hr>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg margin-r-10"></i> Ihr Einsatz wurde vom Disponent weder bestätigt noch abgesagt
                        </div>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg text-success margin-r-10"></i> Sie sind für diesen Einsatz <strong>eingeplant</strong>
                        </div>
                        <div class="margin-b-10">
                            <i class="fa fa-circle fa-lg text-danger margin-r-10"></i> Sie sind für diesen Einsatz <strong>nicht eingeplant</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
