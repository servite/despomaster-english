<template>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Persönliche Daten
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('personalData')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Geburtsdatum</label>
                            <div>{{ employee.date_of_birth }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Geburtsort</label>
                            <div>{{ employee.place_of_birth || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Nationalität</label>
                            <div>{{ employee.nationality || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Konfession/Religion</label>
                            <div>{{ employee.religion || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Behinderung</label>
                            <div>{{ employee.disability || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Schulbildung</label>
                            <div>{{ employee.education_level || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Zahl der Kinder</label>
                            <div>{{ employee.children || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Familienstand</label>
                            <div>{{ employee.married ? 'Verheiratet' : ' Ledig' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vertragsdaten
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('contractData')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Status</label>
                            <div>{{ employee.active ? 'Aktiv' : 'Inaktiv' }}</div>
                        </div>
                        <div v-if="employee.applicant" class="col-md-4 form-group">
                            <label>Bewerber</label>
                            <div><i class="fa fa-check text-success"></i></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Eintrittsdatum</label>
                            <div>{{ employee.entry_date }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Austrittsdatum</label>
                            <div>{{ employee.exit_date || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Steuernummer</label>
                            <div>{{ employee.tax_id || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Steuerklasse</label>
                            <div>{{ employee.tax_class || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>SV Nr.</label>
                            <div>{{ employee.social_security_number || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Art der Krankenversicherung</label>
                            <div v-if="employee.type_of_health_insurance == 'statutory'">Gesetzlich</div>
                            <div v-if="employee.type_of_health_insurance == 'private'">Privat</div>
                            <div v-if="! employee.type_of_health_insurance">-</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Krankenkasse</label>
                            <div>{{ employee.health_insurance || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label>Beschäftigungsart</label>
                            <div v-if="employee.occupation_type == 'full_time'">Vollzeit</div>
                            <div v-if="employee.occupation_type == 'part_time'">Teilzeit</div>
                            <div v-if="employee.occupation_type == 'temporary'">Geringfügig</div>
                            <div v-if="! employee.occupation_type">-</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Vereinbarte Arbeitszeit</label>
                            <div>{{ employee.contractual_working_hours || '-' }}</div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>AZK-Startwert</label>
                            <div>{{ employee.working_time_account || '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Adresse
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('address')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label>Strasse</label>
                            <div>{{ employee.street || '-' }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>PLZ</label>
                            <div>{{ employee.postal_code || '-' }}</div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Stadt</label>
                            <div>{{ employee.city || '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Kontodaten
                    <span v-if="canUpdate" class="pull-right"><i @click="editEmployee('bankAccount')" class="fa fa-pencil pointer"></i></span>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>Kontoinhaber</label>
                        <div>{{ employee.account_holder || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>Institut</label>
                        <div>{{ employee.institute || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>IBAN</label>
                        <div>{{ employee.iban || '-' }}</div>
                    </div>
                    <div class="form-group">
                        <label>BIC</label>
                        <div>{{ employee.bic || '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                employee: this.model
            }
        },

        props: ['model', 'countries', 'canUpdate'],

        methods: {

            editEmployee(type) {
                let data = {
                    'employee': this.employee,
                    'countries': this.countries,
                    'type': type
                };

                modal('Edit Employee Modal', 'Mitarbeiter bearbeiten', data);
            },

            reloadEmployee() {
                axios.get('/api/employee/' + this.employee.id).then((response) =>
                    this.employee = response.data
                )
            }
        },

        created() {
            events.$on('employee.updated', this.reloadEmployee);
        }
    }
</script>
