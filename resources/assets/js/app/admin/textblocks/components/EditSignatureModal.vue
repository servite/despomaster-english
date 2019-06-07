<template>
    <form-wrapper :action="'/api/textblocks/element/' + this.data.element">
        <template slot-scope="form">

            <div v-if="data.type == 'address'">
                <legend>Anschrift</legend>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.company_name }">
                        <label v-text="textblocks.company_name.label"></label>
                        <input name="company_name" class="form-control input-sm" v-model="textblocks.company_name.value">
                        <span v-if="form.errors.company_name" class="help-block">{{ form.errors.company_name }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 form-group" :class="{'has-error': form.errors.street }">
                        <label v-text="textblocks.street.label"></label>
                        <input name="street" class="form-control input-sm" v-model="textblocks.street.value">
                        <span v-if="form.errors.street" class="help-block">{{ form.errors.street }}</span>
                    </div>
                    <div class="col-md-3 form-group" :class="{'has-error': form.errors.postal_code }">
                        <label v-text="textblocks.postal_code.label"></label>
                        <input name="postal_code" class="form-control input-sm" v-model="textblocks.postal_code.value">
                        <span v-if="form.errors.postal_code" class="help-block">{{ form.errors.postal_code }}</span>
                    </div>
                    <div class="col-md-3 form-group" :class="{'has-error': form.errors.city }">
                        <label v-text="textblocks.city.label"></label>
                        <input name="city" class="form-control input-sm" v-model="textblocks.city.value">
                        <span v-if="form.errors.city" class="help-block">{{ form.errors.city }}</span>
                    </div>
                </div>
            </div>

            <div v-if="data.type == 'contacts'">
                <legend>Kontaktdaten</legend>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.phone }">
                        <label v-text="textblocks.phone.label"></label>
                        <input name="phone" class="form-control input-sm" v-model="textblocks.phone.value">
                        <span v-if="form.errors.phone" class="help-block">{{ form.errors.phone }}</span>
                    </div>
                    <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.fax }">
                        <label v-text="textblocks.fax.label"></label>
                        <input name="fax" class="form-control input-sm" v-model="textblocks.fax.value">
                        <span v-if="form.errors.fax" class="help-block">{{ form.errors.fax }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.email }">
                        <label v-text="textblocks.email.label"></label>
                        <input name="email" class="form-control input-sm" v-model="textblocks.email.value">
                        <span v-if="form.errors.email" class="help-block">{{ form.errors.email }}</span>
                    </div>
                    <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.website }">
                        <label v-text="textblocks.website.label"></label>
                        <input name="website" class="form-control input-sm" v-model="textblocks.website.value">
                        <span v-if="form.errors.website" class="help-block">{{ form.errors.website }}</span>
                    </div>
                </div>
            </div>
            <div v-if="data.type == 'bankAccount'">
                <legend>Bankdaten</legend>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.iban }">
                        <label v-text="textblocks.iban.label"></label>
                        <input name="iban" class="form-control input-sm" v-model="textblocks.iban.value">
                        <span v-if="form.errors.iban" class="help-block">{{ form.errors.iban }}</span>
                    </div>
                    <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.bic }">
                        <label v-text="textblocks.bic.label"></label>
                        <input name="bic" class="form-control input-sm" v-model="textblocks.bic.value">
                        <span v-if="form.errors.bic" class="help-block">{{ form.errors.bic }}</span>
                    </div>
                </div>
            </div>
            <div v-if="data.type == 'controlData'">
                <legend>Steuerdaten</legend>
                <div class="row">
                    <div class="col-md-4 form-group" :class="{'has-error': form.errors.tax_number }">
                        <label v-text="textblocks.tax_number.label"></label>
                        <input name="tax_number" class="form-control input-sm" v-model="textblocks.tax_number.value">
                        <span v-if="form.errors.tax_number" class="help-block">{{ form.errors.tax_number }}</span>
                    </div>
                    <div class="col-md-4 col-md-offset-1 form-group" :class="{'has-error': form.errors.tax_id }">
                        <label v-text="textblocks.tax_id.label"></label>
                        <input name="tax_id" class="form-control input-sm" v-model="textblocks.tax_id.value">
                        <span v-if="form.errors.tax_id" class="help-block">{{ form.errors.tax_id }}</span>
                    </div>
                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" text="Speichern" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    import TextblockModal from '../mixins/TextblockModal'

    export default {
        mixins: [TextblockModal]
    }
</script>