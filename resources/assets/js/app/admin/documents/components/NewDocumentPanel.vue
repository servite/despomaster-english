<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Neues Dokument</h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <select class="form-control input-sm" v-model="type">
                    <option value="">Dokumententyp auswählen...</option>
                    <option v-for="(document, key) in documentTypes" :value="key">{{ document }}</option>
                </select>
            </div>

            <div class="clearfix">
                <button @click="create" class="btn btn-sm btn-primary pull-right">Auswählen</button>
            </div>

            <hr>

            <div v-if="signature" class="text-center">
                <img class="col-md-12" :src="'/uploads/images/signature/' + signature" alt="Signatur">
            </div>

            <button @click="editSignature" class="btn btn-sm btn-primary btn-block">Signatur bearbeiten</button>

        </div>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                type: '',
                signature: this.employee.signature,
                documentTypes: {
                    'warning': 'Abmahnung',
                    'pension': 'Befreiung Rentenversicherungspflicht',
                    'withdrawal_receipt': 'Kündigungsbestätigung',
                    'contract_parttime': 'Arbeitsvertrag - Teilzeit',
                    'contract_temporary': 'Arbeitsvertrag - Geringfügig',
                    'termination': 'Ordentliche Kündigung',
                    'termination_without_notice': 'Fristlose Kündigung',
                    'termination_within_probation': 'Kündigung in der Probezeit'
                }
            }
        },

        props: ['employee'],

        methods: {
            create() {
                if (this.type == '') return;

                let data = {
                    'type': this.type,
                    'employee': this.employee
                };

                modal('Create Document Modal', this.documentTypes[this.type], data);

                this.type = '';
            },

            editSignature() {
                let data = {
                    'employee': this.employee,
                    'signature': this.signature
                }

                modal('Create Signature Modal', 'Mitarbeiter - Unterschrift', data);
            }
        },

        created() {
            events.$on('signature.created', (data) => this.signature = data);

            events.$on('signature.deleted', () => this.signature = '');
        }
    }
</script>