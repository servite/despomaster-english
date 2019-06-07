<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                Kundenliste
                <a @click="newClient" class="btn btn-primary pull-right">Neuer Kunde</a>
            </h2>
        </div>
        <div class="panel-body">

            <ul class="nav nav-tabs margin-b-10">
                <li role="presentation" :class="{ 'active' : query.state }"><a href="#" @click.prevent="setState('active')">Aktiv</a></li>
                <li role="presentation" :class="{ 'active' : ! query.state }"><a href="#" @click.prevent="setState('inactive')">Inaktiv</a></li>
            </ul>

            <div class="table-view">
                <div class="table-view__header">
                    <div>
                        <i class="pointer fa fa-refresh text-primary" @click.prevent="reset"></i>
                    </div>
                    <div class="table-view__header-columns">
                        <input class="form-control input-sm" v-model="query.search_input" @keyup.enter="search" placeholder="Suche...">
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.location" @change="search">
                            <option value="">Standort auswählen...</option>
                            <option value="Bonn">Bonn</option>
                            <option value="Köln">Köln</option>
                            <option value="Düsseldorf">Düsseldorf</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.id" @change="search">
                            <option value="">Kunde...</option>
                            <option v-for="client in clients" :value="client.id">{{ client.name }}</option>
                        </select>
                    </div>
                    <div class="table-view__header-columns">
                        <select class="form-control input-sm" v-model="query.state" @change="search">
                            <option value="">Status...</option>
                            <option value="1">Aktiv</option>
                            <option value="0">Inaktiv</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btm-default btn-sm" @click="search">Filtern</button>
                    </div>
                </div>
                <div class="table-view__body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="pointer" @click="toggleOrder('id')">
                                Kundennr. <i v-html="getSortingIcon('id')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('name')">
                                Kunde <i v-html="getSortingIcon('name')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('postal_code')">
                                PLZ <i v-html="getSortingIcon('postal_code')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('city')">
                                Stadt <i v-html="getSortingIcon('city')"></i>
                            </th>
                            <th class="pointer" @click="toggleOrder('location')">
                                Standort <i v-html="getSortingIcon('location')"></i>
                            </th>
                            <th>Status</th>
                            <th v-if="canUpdate || canDelete">Aktion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="row in model.data">
                            <td><a :href="source + '/' + row.id + '/show'">{{ row.id }}</a></td>
                            <td><a :href="source + '/' + row.id + '/show'">{{ row.short_name }}</a></td>
                            <td>{{ row.postal_code }}</td>
                            <td>{{ row.city }}</td>
                            <td>{{ row.location }}</td>
                            <td>
                                <span v-if="row.active == 1" class="label label-success">Aktiv</span><span v-if="row.active == 0" class="label label-danger">Inaktiv</span>
                            </td>
                            <td v-if="canUpdate || canDelete">
                                <a v-if="canUpdate" @click="editClient(row)" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a v-if="canDelete" class="btn btn-sm btn-default" @click="deleteRessource(row.id)">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-view__footer">
                    <div class="table-view__footer-item">
                        <span>{{model.from}} - {{model.to}} von {{model.total}}</span>
                    </div>
                    <div class="table-view__footer-item">
                        <div class="table-view__footer-sub">
                            <i class="btn fa fa-angle-double-left" @click="prev()"></i>
                            <input v-model="query.page" class="form-control input-sm" @keyup.enter="fetchData">
                            <i class="btn fa fa-angle-double-right" @click="next()"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Table from '../../../mixins/Table'

    export default {
        data() {
            return {
                query: {
                    id: '',
                    location: '',
                    state: 1
                }
            }
        },
        props: ['clients'],
        mixins: [Table],

        methods: {
            newClient() {
                modal('New Client Modal', 'Neuer Kunde', {});
            },

            editClient(client) {
                let data = {
                    'client': client
                };

                modal('Edit Client Modal', 'Kunden bearbeiten', data);
            },


            setState(state) {
                this.query.state = +(state == 'active');

                this.search();
            },
        },

        created() {
            events.$on(['client.created', 'client.updated'], this.fetchData);
        }
    }
</script>