<template>
    <div>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <div class="pull-left">
                    <i v-if="employee.active" class="fa fa-circle text-success fa-lg"></i>
                    <i v-else class="fa fa-circle text-danger fa-lg"></i>
                </div>

                <h4 class="text-center clearfix">{{trans('admin.Personalnr')}} {{ employee.id }}</h4>

                <img v-if="employee.photo" class="profile-user-img img-responsive img-circle" :src="'/uploads/images/photos/employees/' + employee.photo" alt="Profilbild">

                <h3  class="profile-username text-center">{{ employee.first_name + ' ' + employee.last_name }}</h3>

                <p class="text-muted text-center">{{ employee.sex == 'm' ? trans('männlich') : trans('weiblich') }}</p>

                <p class="text-center"><b>{{trans('admin.Status')}}:</b> {{ employee.active ? trans('Aktiv') : trans('Inaktiv') }}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>{{trans('admin.E-Mail')}}</b>
                        <div class="pull-right">{{ employee.email }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('admin.Telefon')}}</b>
                        <div class="pull-right">{{ employee.phone }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('admin.Mobil')}}</b>
                        <div class="pull-right">{{ employee.mobile }}</div>
                    </li>
                    <li class="list-group-item">
                        <b>{{trans('admin.Alter')}}</b>
                        <div class="pull-right">
                            {{ moment().diff(moment(employee.date_of_birth, 'DD.MM.YYYY').format(), 'years') }} {{trans('admin.Jahre')}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('admin.Details')}}</h3>
            </div>
            <div class="box-body">
                <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('admin.Adresse')}}</strong>

                <div class="text-muted">
                    <div>{{ employee.street }}</div>
                    <div>{{ employee.postal_code + ' ' + employee.city }}</div>
                </div>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> {{trans('admin.Einsatzort')}}</strong>

                <p class="text-muted">
                    {{ JSON.parse(employee.locations).join(', ') }}
                </p>

                <hr>

                <strong><i class="fa fa-bank margin-r-5"></i> {{trans('admin.Beschäftiung')}}</strong>

                <div class="text-muted">
                    <div>
                        {{trans('admin.Eintrittsdatum')}}
                        <span class="pull-right">{{ employee.entry_date }}</span>
                    </div>
                    <div v-if="employee.exit_date">
                        {{trans('admin.Austrittsdatum')}}
                        <span class="pull-right">{{ employee.exit_date }}</span>
                    </div>
                    <div>
                        {{trans('admin.Beschäftigungsart')}}
                        <span class="pull-right">{{ employee.occupation_type == 'temporary' ? trans('Geringfügig') : trans('Teilzeit') }}</span>
                    </div>
                    <div>
                        {{trans('admin.Vereinbarte Arbeitszeit')}}
                        <span class="pull-right">{{ employee.contractual_working_hours }} {{trans('admin.Stunden')}}</span>
                    </div>
                </div>

                <hr>

                <strong><i class="fa fa-automobile margin-r-5"></i> {{trans('admin.Sonstiges')}}</strong>

                <div class="text-muted">
                    <div>
                        {{trans('admin.PKW')}}
                        <div class="pull-right">
                            <i v-if="employee.car" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                    <div>
                        {{trans('admin.Führerschein')}}
                        <div class="pull-right">
                            <i v-if="employee.driving_license" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                    <div>
                        {{trans('admin.Semesterticket')}}
                        <div class="pull-right">
                            <i v-if="employee.public_transportation" class="fa fa-check text-success"></i>
                            <i v-else class="fa fa-ban text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <wages :wages="employee.wages"></wages>
    </div>
</template>

<script>
    export default {
        props: ['employee']
    }
</script>
