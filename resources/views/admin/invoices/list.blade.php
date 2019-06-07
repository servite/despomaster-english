@extends('layouts.admin')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                Rechnungsliste
                <a class="btn btn-primary pull-right" href="{{ url('admin/invoice/new') }}">Neue Rechnung</a>
            </h2>
        </div>
        <div class="panel-body">
            <invoice-table
                    source="invoice"
                    :clients="{{ $clients }}"
                    can-update="true"
                    can-delete="true"
            >
            </invoice-table>
        </div>
    </div>
@endsection