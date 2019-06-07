<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Historie</th>
                <th>Gültig bis</th>
                <th>Erstellt am</th>
                <th>Erstellt durch</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="type == 'employee'">
                <td><a :href="'/admin/employee/' + model.id + '/document/base_data'" target="_blank">Stammdaten</a></td>
                <td></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
            <tr v-for="(document, index) in documents">
                <td><a :href="'/admin/' + type  + '/' + model.id + '/document/' + document.id" target="_blank">{{ document.name }}</a></td>
                <td></td>
                <td>{{ document.valid_to ? moment(document.valid_to).format('L') : '-' }}</td>
                <td>{{ moment(document.created_at).format('L LT') }} Uhr</td>
                <td>{{ document.user.name }}</td>
                <td>
                    <button @click="composeMail(document)" class="btn btn-sm btn-default margin-r-5">
                        <i class="fa fa-envelope"></i>
                    </button>
                    <button @click="edit(document)" class="btn btn-sm btn-default margin-r-5">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button @click="destroy(document, index)" class="btn btn-sm btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                documents: []
            }
        },

        props: ['type', 'model'],

        methods: {
            loadDocuments() {
                axios.get('/api/' + this.type + '/' + this.model.id + '/documents').then((response) => {
                   this.documents = response.data;
                });
            },

            composeMail(document) {
                let data = {
                    'type': this.type,
                    'employee': this.model,
                    'document': document
                };

                modal('Send ' + this.type + ' Document Modal', 'Dokument senden', data);
            },

            edit(document) {
                let data = {
                    'type': this.type,
                    'id': this.model.id,
                    'document': document
                };

                modal('Edit Document', 'Dokument bearbeiten', data);
            },

            destroy(document, index) {
                swal({text: 'Dokument wirklich löschen?'}).then(() => {
                    axios.delete('/api/' + this.type + '/' + this.model.id + '/document/' + document.id).then((response) =>
                        this.documents.splice(index, 1)
                    );
                }, (dismiss) => {
                    if (dismiss === 'cancel') {
                        flash('Vorgang abgebrochen.', 'warning')
                    }
                });
            }
        },

        created() {
            this.loadDocuments();

            events.$on(['document.created', 'document.updated', 'document.uploaded'], this.loadDocuments);
        }
    }
</script>