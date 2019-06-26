@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li {{ set_active('admin/invoice/*/prepare') }}><a href="{{ url('admin/invoice/' . $invoice->id . '/prepare') }}">{{trans('admin.Rechnung')}}</a></li>
                    <li {{ set_active('admin/invoice/*/warning') }}><a href="{{ url('admin/invoice/' . $invoice->id . '/warning') }}">{{trans('admin.Zahlungserinnerung')}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="pull-left">{{trans('admin.Rechnung verschicken')}}</h4>
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ url('admin/invoice/' . $invoice->id . '/show') }}" target="_blank">{{trans('admin.Rechnung')}}</a>
                                    <a class="btn btn-primary" href="{{ url('admin/invoice/' . $invoice->id . '/proof-of-work') }}" target="_blank">{{trans('admin.Stundennachweis')}}</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div id="content">
                                    @if (count($mails))
                                        <div class="row">
                                            <div class="col-md-5">
                                                <p>{{trans('admin.Rechnung bereits versendet')}}</p>
                                            </div>
                                            <div class="col-md-7">
                                                <ul>
                                                    @foreach($mails as $entry)
                                                        <li>
                                                            {{ Date::format($entry->created_at) }}
                                                            um {{ Date::format($entry->created_at, 'time') }} Uhr
                                                            durch {{ $entry->user->name }}
                                                            <br>
                                                            {{ $entry->information ? '(' . $entry->information . ')' : '' }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>

                                        <hr>

                                    @endif
                                    <form-wrapper action="{{ url('admin/invoice/' . $invoice->id . '/warning') }}">
                                        <template slot-scope="form">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <p>{{trans('admin.Wird versendet an')}}</p>

                                                    <div class="form-group" :class="{'has-error': form.errors.contacts }">
                                                        @foreach($contacts as $contact)
                                                            @continue(! $contact->accounting)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" name="contacts[]" value="{{ $contact->email }}" checked="checked"> {{ $contact->last_name . ', ' . $contact->first_name }}
                                                                </label> (<i>{{ $contact->email  }}</i>)
                                                            </div>
                                                        @endforeach
                                                        <span v-if="form.errors.contacts" class="help-block">@{{ form.errors.contacts }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group" :class="{'has-error': form.errors.mail_subject }">
                                                        <label>{{trans('admin.Betreff')}}</label>
                                                        <input class="form-control input-sm" name="mail_subject" value="{{ 'Servite GmbH: Zahlungserinnerung - Rechnungsnr. ' . $invoice->id }}">
                                                        <span v-if="form.errors.mail_subject" class="help-block">@{{ form.errors.mail_subject }}</span>
                                                    </div>
                                                    <div class="form-group" :class="{'has-error': form.errors.mail_body }">
                                                        <label>{{trans('admin.E-Mail - Nachricht')}}</label>
                                                        <html-editor name="mail_body" model="{{ $textblocks['reminder']['value'] }}"></html-editor>
                                                        <span v-if="form.errors.mail_body" class="help-block">@{{ form.errors.mail_body }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="submit" value="Senden" class="btn btn-default btn-md pull-right">
                                        </template>
                                    </form-wrapper>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


