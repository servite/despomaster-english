<template>
    <div class="box box-primary">
        <div class="box-body box-profile">
            <div class="pull-left">
                <div v-if="data.applicant" >
                    <i class="fa fa-circle text-warning fa-lg"></i>
                </div>
                <div v-else>
                    <i v-if="data.active" class="fa fa-circle text-success fa-lg"></i>
                    <i v-else class="fa fa-circle text-danger fa-lg"></i>
                </div>
            </div>
            <div class="pull-right">
                <i v-if="! editMode" @click="editMode = true" class="fa fa-pencil fa-lg pointer"></i>
                <div v-else>
                    <i @click="save" class="fa fa-save fa-lg margin-r-5 pointer"></i>
                    <i @click="abort" class="fa fa-times fa-lg text-danger pointer"></i>
                </div>
            </div>

            <h4 class="text-center clearfix"><a class="text-muted pointer" @click="navigate">Personalnr. {{ employee.id }}</a></h4>

            <employee-photo :employee="employee"></employee-photo>

            <h3 v-if="! editMode" class="profile-username text-center">{{ data.first_name + ' ' + data.last_name }}</h3>

            <div v-else class="row">
                <div class="col-md-6 form-group" :class="{'has-error': errors.first_name }">
                    <label>Vorname</label>
                    <i v-if="errors.first_name" class="fa fa-exclamation-triangle text-danger" :title="errors.first_name[0]"></i>
                    <input class="form-control input-sm" v-model="input.first_name">
                </div>
                <div class="col-md-6 form-group" :class="{'has-error': errors.last_name }">
                    <label>Nachname</label>
                    <i v-if="errors.last_name" class="fa fa-exclamation-triangle text-danger" :title="errors.last_name[0]"></i>
                    <input class="form-control input-sm" v-model="input.last_name">
                </div>
            </div>

            <p v-if="! editMode" class="text-muted text-center">{{ data.sex == 'm' ? 'männlich' : 'weiblich' }}</p>

            <div v-else class="row">
                <div class="col-md-offset-2 form-group">
                    <label class="radio">
                        <input type="radio" name="sex" value="m" v-model="input.sex">
                        Männlich
                    </label>
                    <label class="radio">
                        <input type="radio" name="sex" value="f" v-model="input.sex">
                        Weiblich
                    </label>
                </div>
            </div>

            <p class="text-center">
                <b>Status:</b>
                <span v-if="data.applicant">Bewerber</span>
                <span v-else>{{ data.active ? 'Aktiv' : 'Inaktiv' }}</span>
            </p>

            <ul v-if="! editMode" class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>E-Mail</b>
                    <div class="pull-right">
                        {{ data.email }}
                    </div>
                </li>
                <li v-if="data.phone" class="list-group-item">
                    <b>Telefon</b>
                    <div class="pull-right">
                        {{ data.phone }}
                    </div>
                </li>
                <li v-if="data.mobile" class="list-group-item">
                    <b>Mobil</b>
                    <div class="pull-right">
                        {{ data.mobile }}
                    </div>
                </li>
                <li class="list-group-item">
                    <b>Alter</b>
                    <div class="pull-right">
                        {{ moment().diff(moment(data.date_of_birth, 'DD.MM.YYYY').format(), 'years') }} Jahre
                    </div>
                </li>
                <li class="list-group-item">
                    <b>Wohnort</b>
                    <div class="pull-right">
                        {{ data.city || '-' }}
                    </div>
                </li>
            </ul>

            <ul v-else class="list-group list-group-unbordered">
                <li class="form-group list-group-item" :class="{'has-error': errors.email}">
                    <label>E-Mail</label>
                    <i v-if="errors.email" class="fa fa-exclamation-triangle text-danger" :title="errors.email[0]"></i>
                    <div class="pull-right">
                        <input class="form-control input-sm" v-model="input.email">
                    </div>
                </li>
                <li class="form-group list-group-item" :class="{'has-error': errors.phone}">
                    <label>Telefon</label>
                    <i v-if="errors.phone" class="fa fa-exclamation-triangle text-danger" :title="errors.phone[0]"></i>
                    <div class="pull-right">
                        <input class="form-control input-sm" v-model="input.phone">
                    </div>
                </li>
                <li class="form-group list-group-item" :class="{'has-error': errors.mobile}">
                    <label>Mobil</label>
                    <i v-if="errors.mobile" class="fa fa-exclamation-triangle text-danger" :title="errors.mobile[0]"></i>
                    <div class="pull-right">
                        <input class="form-control input-sm" v-model="input.mobile">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: {},
                editMode: false,

                data: Object.assign({}, this.employee),
                input: Object.assign({}, this.employee),
                employees: []
            }
        },
        components: {
            'EmployeePhoto': require('./Photo.vue')
        },
        props: ['employee'],
        methods: {
            navigate () {
                modal('Navigate', '', {});
            },

            save () {
                let data = {
                    'first_name': this.input.first_name,
                    'last_name': this.input.last_name,
                    'sex': this.input.sex,
                    'email': this.input.email,
                    'phone': this.input.phone,
                    'mobile': this.input.mobile
                };

                axios.post('/api/employee/' + this.employee.id + '/update', data).then((response) => {
                    this.editMode = false;
                    this.errors = '';

                    this.data = response.data;

                    events.$emit('client.updated');
                }).catch((error) => this.errors = error.response.data.errors);
            },

            abort() {
                this.editMode = false;
                this.errors = '';

                Object.assign(this.input, this.data)
            },

            reloadEmployee() {
                axios.get('/api/employee/' + this.employee.id).then((response) =>
                    this.data = response.data
                )
            }
        },

        created() {
            events.$on('employee.updated', this.reloadEmployee);
        }
    }
</script>
