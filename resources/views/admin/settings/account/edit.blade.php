@extends('layouts.admin')
@section('content-header', 'Nutzer')

@section('content')
    <div>
        <div class="nav-tabs-custom">
            @include('admin.settings.account.partials.nav_header')
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h2>Nutzer bearbeiten</h2>
                                </div>
                                <div class="panel-body">
                                    <form action="{{ url('admin/settings/user/' . $user->id . '/update') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <label>Angelegt am</label>
                                                <div>{{ Date::format($user->created_at, 'datetime_short') }} Uhr</div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Angelegt durch</label>
                                                <div>{{ $user->user->name }}</div>
                                            </div>
                                        </div>

                                        <br>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-5 form-group" :class="{'has-error': errors.username }">
                                                <label>Name</label>
                                                <input class="form-control input-sm" name="username" value="{{ $user->name }}">
                                                <span v-if="errors.username" class="help-block">@{{ errors.username[0] }}</span>
                                            </div>
                                            <div class="col-md-7 form-group" :class="{'has-error': errors.email }">
                                                <label>E-Mail Adresse</label>
                                                <input class="form-control input-sm" name="email" value="{{ $user->email }}">
                                                <span v-if="errors.email" class="help-block">@{{ errors.email[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group" :class="{'has-error': errors.user_role }">
                                                <label>Rolle</label>
                                                <select name="role" class="form-control input-sm">
                                                    <option value="">Auswählen...</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected="selected"' : '' }}>{{ $role->display_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span v-if="errors.user_role" class="help-block">@{{ errors.user_role[0] }}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Status</label>
                                                <br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" {{ $user->active ? 'checked' : ''}}>Aktiv
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" {{ ! $user->active ? 'checked' : ''}}>Inaktiv
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Standort</label>
                                                @foreach(config('settings.locations') as $location)
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="locations" value="{{ $location }}" {{ str_contains($user->locations, $location) ? 'checked' : '' }}>
                                                            {{ $location }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="submit" value="Speichern" class="btn btn-success btn-sm pull-right">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection