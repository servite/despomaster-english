@extends('layouts.employee')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <employee-info :employee="{{ $employee }}"></employee-info>
        </div>
        <div class="col-md-7">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li {{ set_active('e/profile*') }}>
                        <a href="{{ url('/e/profile') }}">Stammdaten</a>
                    </li>
                    <li {{ set_active('e/documents*') }}>
                        <a href="{{ url('/e/documents') }}">Personalakte</a>
                    </li>
                </ul>
                <div class="tab-content">

                    <div class="row">
                        <div class="col-md-7">

                            <p>Innerhalb von zwei Wochen nach Erstellung des Dokumentes, kann gegen dieses Widerspruch eingelegt werden.</p>

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Gültig bis</th>
                                    <th>Erstellt am</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="{{ url('/e/document/base_data') }}" target="_blank">Stammdaten</a></td>
                                    <td></td>
                                    <td>-</td>
                                </tr>
                                @foreach($employee->documents as $document)
                                    <tr>
                                        <td><a href="{{ url('/e/document/' . $document->id) }}" target="_blank">{{ $document->name }}</a></td>
                                        <td>{{ $document->valid_to ? Date::format($document->valid_to) : '-' }}</td>
                                        <td>{{ $document->created_at ? Date::format($document->created_at) : '-' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <payroll-modification></payroll-modification>

                            <extra-business></extra-business>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop