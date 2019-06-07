<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Zusätzliche Tätigkeiten</h4>
        </div>
        <div class="panel-body">
            <table v-if="items.length" class="table">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th>Typ</th>
                    <th>Stunden</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(entry, index) in visibleItems">
                    <td :title="'Eingetragen am ' + moment(entry.created_at).format('lll') + ' Uhr'">
                        {{ moment(entry.date).format('l') }}
                    </td>
                    <td>
                        <span v-if="options">{{ options[entry.type].name }}</span>
                        <div v-if="entry.information" class="small">{{ entry.information }}</div>
                    </td>
                    <td>
                        {{ hour(entry.hours) }}
                    </td>
                </tr>
                </tbody>
            </table>
            <p v-else>Keine Einträge</p>

            <pagination-links class="pull-right"
                    :items="items"
                    @paginate="updatePage"
                    :currentPage="currentPage"
                    :pageSize="pageSize">
            </pagination-links>
        </div>
    </div>
</template>

<script>
    import Pagination from '../../../mixins/Pagination';

    export default {
        data() {
            return {
                options: '',
                items: []
            }
        },

        mixins: [Pagination],

        methods: {
            getItems() {
                axios.get('/api/e/extra-business').then((response) =>
                    this.items = response.data
                ).then(this.updateVisibleItems);
            }
        },

        created() {
            axios.post('/api/settings/get', {name: 'extra_business'}).then((response) => this.options = response.data);
        },

        mounted() {
            this.getItems();
        }
    }
</script>
