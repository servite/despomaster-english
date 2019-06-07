<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-7 panel-title">
                    Lohn
                </div>
                <div class=" col-md-5">
                    <div class="pull-right margin-t-5">
                        <i v-if="! showForm" @click="showForm = true" class="fa fa-plus text-primary pointer"></i>
                        <i v-else @click="showForm = false" class="fa fa-minus text-primary pointer"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" v-show="showForm || items.length">
            <div v-if="items.length">
                <b>Aktueller Lohn</b> <span class="pull-right">{{ money(items[0].amount) }} € (Gültig ab {{ moment(items[0].valid_from).format('ll') }})</span>

                <hr>
            </div>
            <form-wrapper v-show="showForm" :action="'/api/employee/' + this.model.id + '/wage'">
                <template slot-scope="form">
                    <div class="row">
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.valid_from }">
                            <label>Gültig ab</label> <i v-if="form.errors.valid_from" class="fa fa-warning text-danger" :title="form.errors.valid_from"></i>
                            <datepicker name="valid_from"></datepicker>
                        </div>
                        <div class="col-md-6 form-group" :class="{'has-error': form.errors.amount }">
                            <label>Betrag in €</label> <i v-if="form.errors.amount" class="fa fa-warning text-danger" :title="form.errors.amount"></i>
                            <input class="form-control input-sm" name="amount">
                        </div>
                    </div>

                    <submit-button class="pull-right btn-sm btn-primary" text="Neu" :loading="form.loading"></submit-button>
                </template>
            </form-wrapper>
            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>Gültig von</th>
                    <th>Gültig bis</th>
                    <th>Betrag</th>
                    <th v-if="canDelete"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in items">
                    <td :title="'Eingetragen am ' + moment(entry.created_at).format('lll') + ' Uhr'">
                        {{ moment(entry.valid_from).format('ll') }}
                    </td>
                    <td>
                        {{ entry.valid_to ? moment(entry.valid_to).format('ll') : '-' }}
                    </td>
                    <td>
                        {{ money(entry.amount) }} €
                    </td>
                    <td v-if="canDelete">
                        <span @click="edit(entry)"><i class="fa fa-pencil pointer"></i></span>
                        <span v-if="index == 0" @click="destroy(entry, index)"><i class="fa fa-times text-danger pointer"></i></span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import Collection from '../../../mixins/Collection';

    export default {
        data() {
            return {
                modelType: 'employee',
                resource: 'wage'
            }
        },

        mixins: [Collection],

        methods: {

            edit(entry) {
                let data = {
                    'wage': entry,
                    'employee': this.model
                };

                modal('Wage Modal', 'Lohn bearbeiten', data);
            }

        },

        created() {
            events.$on('wage.updated', this.getItems)
        }

    }
</script>
