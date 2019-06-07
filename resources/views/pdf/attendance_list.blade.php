@extends('pdf.layouts.master')

@section('styles')
<style>
@page {
    margin: 240px 50px 320px;
}

#header {
    top: -240px;
    height: 240px;
}

#footer {
    bottom: -320px;
    height: 320px;
}

#footer h3 {
    text-align: center;
    margin: 4px;
}

</style>
@endsection

@section('header')

    @parent

    <div>
        <strong>Verleiher:</strong> {{ $textblocks['signature.company_name'] }},
        @if(auth()->user()->street && auth()->user()->postal_code && auth()->user()->city)
        {{ auth()->user()->street . ', ' .  auth()->user()->postal_code . ' ' .  auth()->user()->city }}
        @else
        {{ $textblocks['signature.street']  . ', ' .   $textblocks['signature.postal_code'] . ' ' .  $textblocks['signature.city'] }}
        @endif
    </div>
    <strong>Entleiher:</strong> {{ $client->name . ', ' . $client->street . ', ' . $client->postal_code . ', ' . $client->city }}

    {!! $textblocks['attendance_list.header'] !!}

@endsection

@section('footer')

        <h3>Der Servite GmbH Leiharbeitnehmer ist zur Unterzeichnung dieses Dokumentes in Vertretung berechtigt.</h3>

        <table class="table" style="font-size: 10px;">
            <tbody>
            <tr>
                <td>
                    <strong>Abschluss des AÜ-Vertrages</strong>
                </td>
                <td>
                    <div>Vor Einsatzbeginn <br> unterzeichnen!</div>
                </td>
                <td>
                    <span style="font-size:12px;font-weight: bold;">Bestätigung Stundennachweis</span>
                </td>
                <td>
                    <span>Nach Einsatzende <br> unterzeichnen!</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Es gelten die AGB d. Verleihers und die Konditonen bzgl. Vergütung, Anforderung und Tätigkeit zwischen Entleiher und Verleiher.
                </td>
                <td colspan="2">
                    Nachträgliche Einwendungen gegen den vorstehenden Stundennachweis sind vertraglich ausgeschlossen!
                </td>
            </tr>
            <tr style="vertical-align: bottom;">
                <td style="height: 35px;">Unterschrift Kunde/Entleiher</td>
                <td>Unterschrift i.V Verleiher</td>
                <td>Unterschrift Kunde/Entleiher</td>
                <td>Unterschrift i.V Verleiher</td>
            </tr>
            <tr style="vertical-align: bottom;">
                <td style="height: 35px">Name in Druckschrift</td>
                <td>Name in Druckschrift</td>
                <td>Name in Druckschrift</td>
                <td>Name in Druckschrift</td>
            </tr>
            </tbody>
        </table>

        <h3>Bitte mit Unterschrift an fax@servite.de oder an Faxnr. 0221 - 168 671 24 senden.</h3>

        @parent

@endsection

@section('content')
    <table class="table">
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td colspan="9" height="25px" style="border: none;font-size: 16px;">
                    <strong>Veranstaltung:</strong> {{ $order->title }}
                </td>
            </tr>
            <tr style="font-weight: bold;">
                <td width="55px" height="25px">Datum</td>
                <td>Name</td>
                <td width="75px">Rolle</td>
                <td width="75px">Bereich</td>
                <td width="50px">Start</td>
                <td width="50px">Ende</td>
                <td width="50px">Pause</td>
                <td width="50px">Gesamt</td>
                <td width="90px">Unterschrift</td>
            </tr>

            @php
                $diff_in_days = carbon($order->start_date)->diffInDays(carbon($order->end_date));
                $employees    = $order->employees()->approved()->get()
            @endphp

            @for ($i = 0; $i <= $diff_in_days; $i++)
                @foreach($employees as $employee)
                    <tr>
                        <td height="25px">{{ carbon($order->start_date)->addDays($i)->format('d.m.y') }}</td>
                        <td>{{ $employee->last_name . ', ' . $employee->first_name }}</td>
                        <td>{{ $employee->pivot->role == '-' ? '' : $employee->pivot->role }}</td>
                        <td>{{ Str::limit($employee->pivot->working_area, 11) }}</td>
                        <td>{{ Date::format($order->start_time, 'time') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endfor

        @endforeach
        </tbody>
    </table>
@endsection

