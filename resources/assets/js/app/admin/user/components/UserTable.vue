<template>
    <div class="table-view">
        <div class="table-view__header">
            <div>
                <i class="pointer fa fa-refresh text-primary" @click.prevent="reset"></i>
            </div>
            <div class="table-view__header-columns">
                <input class="form-control input-sm" v-model="query.search_input" placeholder="Suche nach..." @keyup.enter="search">
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.usertype" @change="search">
                    <option value="">Typ...</option>
                    <option value="internal">Intern</option>
                    <option value="client">Kunde</option>
                    <option value="employee">Mitarbeiter</option>
                </select>
            </div>
            <div class="table-view__header-columns">
                <select class="form-control input-sm" v-model="query.role" @change="search">
                    <option value="">Rolle...</option>
                    <option value="master_admin">Master Admin</option>
                    <option value="manager">Manager</option>
                    <option value="local_manager">Filialleiter</option>
                    <option value="accountant">Lohnbuchhalter</option>
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
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span class="sortable" @click="toggleOrder('id')">ID</span>
                        <span class="sortable" @click="toggleOrder('id')">Kundennr.</span>
                        <i v-if="query.column != 'invoice_date'">&uarr;&darr;</i>
                        <span v-else>
                            <i v-if="query.direction === 'desc'">&darr;</i>
                            <i v-else>&uarr;</i>
                        </span>
                    </th>
                    <th>
                        <span class="sortable" @click="toggleOrder('invoice_date')">Name</span>
                        <span class="sortable" @click="toggleOrder('invoice_date')">Kundennr.</span>
                        <i v-if="query.column != 'invoice_date'">&uarr;&darr;</i>
                        <span v-else>
                            <i v-if="query.direction === 'desc'">&darr;</i>
                            <i v-else>&uarr;</i>
                        </span>
                    </th>
                    <th>E-Mail</th>
                    <th>Typ</th>
                    <th>Rolle</th>
                    <th>Status</th>
                    <th v-if="canUpdate || canDelete">Aktion</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="row in model.data">
                    <td><a :href="'/admin/settings/' + source + '/' + row.id + '/show'">{{ row.id }}</a></td>
                    <td><a :href="'/admin/settings/' + source + '/' + row.id + '/show'">{{ row.name }}</a></td>
                    <td>{{ row.email }}</td>
                    <td>{{ row.usertype }}</td>
                    <td>{{ row.roleName }}</td>
                    <td>
                        <span v-if="row.active == 1" class="label label-success">Aktiv</span>
                        <span v-else class="label label-warning">Inaktiv</span>
                    </td>
                    <td v-if="canUpdate || canDelete">
                        <a :href="'/admin/settings/' + source + '/' + row.id + '/show'" v-if="canUpdate" class="btn btn-sm btn-primary">
                            <span class="fa fa-pencil"></span>
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
                    <input v-model="query.page" class="form-control input-sm" @keyup.enter="search">
                    <i class="btn fa fa-angle-double-right" @click="next()"></i>
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
                    state: '',
                    role: '',
                    usertype: ''
                }
            }
        },
        props: ['users'],
        mixins: [Table]
    }
</script>