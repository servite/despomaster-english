<template>
    <div class="row">
        <div class="col-md-12">

            <div v-if="data.type == 'invoiceData'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input name="name" class="form-control input-sm" v-model="invoiceData.name">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Strasse</label>
                            <input name="street" class="form-control input-sm" v-model="invoiceData.street" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Adresse - Zusatz</label>
                            <input name="address_addition" class="form-control input-sm" v-model="invoiceData.address_addition">
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Postleitzahl</label>
                            <input name="postal_code" class="form-control input-sm" v-model="invoiceData.postal_code" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Stadt</label>
                            <input name="city" class="form-control input-sm" v-model="invoiceData.city" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Land</label>
                            <input name="country" class="form-control input-sm" v-model="invoiceData.country" required>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'invoiceTexts'" class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-10 form-group">
                            <label>Einleitungstext</label>
                            <html-editor name="intro" :model="invoiceData.intro" @change="value => { invoiceData.intro = value }"></html-editor>
                        </div>
                        <div class="col-md-10 form-group">
                            <label>Schlusstext</label>
                            <html-editor name="outro" :model="invoiceData.outro" @change="value => { invoiceData.outro = value }"></html-editor>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>Zahlungsfrist</label>
                            <input name="payment_period" class="form-control input-sm" v-model="invoiceData.payment_period" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pull-right">
                <div class="checkbox-inline margin-r-10">
                    <input type="checkbox" value="1" v-model="asDefault">Als Standard festlegen
                </div>
                <button @click="save" class="btn btn-success btn-md">Speichern</button>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                asDefault: 0,
                invoiceData: Object.assign({}, this.data.invoiceData)
            }
        },
        props: ['data'],

        methods: {
            save() {
                if (this.asDefault) {
                    axios.post('/api/client/' + this.data.client.id + '/invoice-data', this.invoiceData);
                }

                events.$emit('invoiceData.saved', this.invoiceData);
                flash('Daten erfolgreich bearbeitet.');

                this.$parent.$emit('close')

            }
        }
    }
</script>