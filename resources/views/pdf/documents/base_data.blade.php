@extends('pdf.documents.layouts.default')

@section('styles')
    <style>
        @page {
            margin: 150px 50px 225px;
        }

        #footer {
            bottom: -225px;
            height: 225px;
        }

    </style>
@endsection

@section('content')
    <h2>Stammdaten</h2>

    <table>
        <tr>
            <td colspan="3">
                {{ $employee->first_name . ' ' . $employee->last_name }}<br>
                * {{ $employee->date_of_birth }} in {{ $employee->place_of_birth }}<br><br>
                {{ $employee->street }}<br>
                {{ $employee->postal_code . ' ' . $employee->city }}<br>
                {{ $employee->country }}<br>
            </td>

            <td colspan="1">
                @if($employee->photo)
                    <img style="height: 150px; width: auto;" src="{{ asset('/uploads/images/photos/employees/' . $employee->photo ) }}" alt="">
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td class="emphasize">Staatsangehörigkeit:</td>
            <td>{{ $employee->nationality }}</td>
            <td class="emphasize">Schulbildung:</td>
            <td>{{ $employee->education }}</td>
        </tr>
        <tr>
            <td class="emphasize">Geschlecht:</td>
            <td>{{ $employee->sex == 'm' ? 'männlich' : 'weiblich' }}</td>
            <td class="emphasize">Konfession:</td>
            <td>{{ $employee->religion }}</td>
        </tr>
        <tr>
            <td class="emphasize">Familienstand:</td>
            <td>{{ $employee->married ? 'verheiratet' : 'ledig' }}</td>
            <td class="emphasize">Kinder:</td>
            <td>{{ $employee->children }}</td>
        </tr>
        <tr>
            <td class="emphasize">Behinderung:</td>
            <td>{{ $employee->disability or 'Keine' }}</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td class="emphasize">Steuer-ID:</td>
            <td>{{ $employee->tax_id }}</td>
            <td class="emphasize">Steuerklasse:</td>
            <td>{{ $employee->tax_class }}</td>
        </tr>
        <tr>
            <td class="emphasize">Art der KrankenVers.:</td>
            <td>{{ $employee->type_of_health_insurance == 'statutory' ? 'Gesetzlich' : 'Privat' }}</td>
            <td class="emphasize">Krankenkasse:</td>
            <td>{{ $employee->health_insurance }}</td>
        </tr>
        <tr>
            <td class="emphasize">Sozialversicherungsnr:</td>
            <td>{{ $employee->social_security_number }}</td>
            <td class="emphasize">KV-Nr.:</td>
            <td></td>
        </tr>

        {{--<tr>--}}
        {{--<td colspan="4">--}}
        {{--<h3>Weitere Beschäftigung</h3>--}}
        {{--</td>--}}
        {{--</tr>--}}
        {{--@if($employee->furtherOccupation()->exists())--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Monatl. Bruttolohn:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->monthly_wage }}</td>--}}
        {{--<td class="emphasize">Beschäftigt seit:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->employed_since }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Tätigkeit als:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->occupation }}</td>--}}
        {{--<td class="emphasize">Arbeitgeber:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->employer }}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td class="emphasize">Monatl. Arbeitszeit:</td>--}}
        {{--<td>{{ $employee->furtherOccupation->monthly_working_time }}</td>--}}
        {{--<td></td>--}}
        {{--<td></td>--}}
        {{--</tr>--}}
        {{--@else--}}
        {{--<tr>--}}
        {{--<td colspan="4">Keine weitere Beschäftigung</td>--}}
        {{--</tr>--}}
        {{--@endif--}}
        <tr>
            <td colspan="4" height="25px"></td>
        </tr>
        <tr>
            <td colspan="4">
                <h3>Bankverbindung des Arbeitnehmers</h3>
            </td>
        </tr>
        <tr>
            <td class="emphasize">Kontoinhaber:</td>
            <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
            <td class="emphasize">Institut:</td>
            <td>{{ $employee->institute }}</td>
        </tr>
        <tr>
            <td class="emphasize">IBAN:</td>
            <td>{{ $employee->iban }}</td>
            <td class="emphasize">BIC:</td>
            <td>{{ $employee->bic }}</td>
        </tr>
    </table>

@endsection

@section('footer')
    <div style="font-size: 13px;">
        <table>
            <tr>
                <td width="400px">
                    <table>
                        <tr>
                            <td colspan="2"><h4>Bitte folgende Unterlagen beifügen</h4></td>
                        </tr>
                        <tr>
                            <td>- ein Foto</td>
                            <td>- Kopie der Arbeitserlaubnis</td>
                        </tr>
                        <tr>
                            <td>- Kopie EC-Karte</td>
                            <td>- Kopie Sozialversicherungsbescheid</td>
                        </tr>
                        <tr>
                            <td colspan="2">- Bescheinigung über die Mitgliedschaft in einer Krankenkasse</td>
                        </tr>
                    </table>

                </td>
                <td class="emphasize">
                    Unterschrift: <br>
                    @if ($employee->signature)
                        <img src="{{ asset('/uploads/images/signature/' . $employee->signature) }}" style="height: auto;width: 200px;">
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @parent
@endsection