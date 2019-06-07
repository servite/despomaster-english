<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <legend>Anschrift</legend>
            </div>
            <div class="col-md-2"><i @click="edit('address')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.company_name.label"></label>
                <p v-text="textblocks.company_name.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.street.label"></label>
                <p v-text="textblocks.street.value"></p>
            </div>
            <div class="col-md-4 form-group">
                <label v-text="textblocks.postal_code.label"></label>
                <p v-text="textblocks.postal_code.value"></p>
            </div>
            <div class="col-md-4 form-group">
                <label v-text="textblocks.city.label"></label>
                <p v-text="textblocks.city.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <legend>Kontaktdaten</legend>
            </div>
            <div class="col-md-2"><i @click="edit('contacts')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.phone.label"></label>
                <p v-text="textblocks.phone.value"></p>
            </div>
            <div class="col-md-4 col-md-offset-1 form-group">
                <label v-text="textblocks.fax.label"></label>
                <p v-text="textblocks.fax.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.email.label"></label>
                <p v-text="textblocks.email.value"></p>
            </div>
            <div class="col-md-4 col-md-offset-1 form-group">
                <label v-text="textblocks.website.label"></label>
                <p v-text="textblocks.website.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <legend>Bankdaten</legend>
            </div>
            <div class="col-md-2"><i @click="edit('bankAccount')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.iban.label"></label>
                <p v-text="textblocks.iban.value"></p>
            </div>
            <div class="col-md-4 col-md-offset-1 form-group">
                <label v-text="textblocks.bic.label"></label>
                <p v-text="textblocks.bic.value"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <legend>Steuerdaten</legend>
            </div>
            <div class="col-md-2"><i @click="edit('controlData')" class="fa fa-pencil fa-lg pointer"></i></div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label v-text="textblocks.tax_number.label"></label>
                <p v-text="textblocks.tax_number.value"></p>
            </div>
            <div class="col-md-4 col-md-offset-1 form-group">
                <label v-text="textblocks.tax_id.label"></label>
                <p v-text="textblocks.tax_id.value"></p>
            </div>
        </div>
    </div>
</template>

<script>
    import Textblock from '../mixins/Textblock'

    export default {
        data() {
            return {
                element: 'signature',
                modalName: 'Edit Signature Modal'
            }
        },

        mixins: [Textblock]
    }
</script>