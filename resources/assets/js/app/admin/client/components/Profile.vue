<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Stammdaten
                <span class="pull-right"><i @click="edit" class="fa fa-pencil pointer"></i></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Kundennummer</label>
                        <div>{{ client.id }}</div>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Status</label>
                        <div>{{ client.active ? 'Aktiv' : 'Inaktiv' }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Firmennanme</label>
                        <div>{{ client.name }}</div>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Firmenname (Kurzform)</label>
                        <div>{{ client.short_name }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>Vertragsart</label>
                        <div>{{ client.type_of_contract || '-' }}</div>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Standort</label>
                        <div>{{ client.location }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Weitere Daten
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-5 form-group">
                        <label>IBAN</label>
                        <div>{{ client.iban || '-' }}</div>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>BIC</label>
                        <div>{{ client.bic || '-' }}</div>
                    </div>
                    <div class="col-md-5 form-group">
                        <label>Steuernummer</label>
                        <div>{{ client.vat || '-' }}</div>
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
                client: this.data
            }
        },
        props: ['data'],

        methods: {
            edit() {
                let data = {
                    'client': this.client
                };

                modal('Edit Client Modal', 'Kunden bearbeiten', data);
            },

            reloadClient() {
                axios.get('/api/client/' + this.client.id).then((response) => this.client = response.data);
            }
        },

        mounted() {
            events.$on('client.updated', this.reloadClient);
        }
    }
</script>
