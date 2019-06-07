<template>
    <form-wrapper :action="'/api/e/message'" enctype="multipart/form-data">
        <template slot-scope="form">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.subject }">
                            <label>Betreff</label>
                            <input class="form-control input-sm" name="subject" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 form-group" :class="{'has-error': form.errors.topic }">
                            <label>Bereich</label>
                            <select name="topic" class="form-control input-sm" v-model="email" required>
                                <option value="">Bitte auswählen...</option>
                                <option value="personal@servite.de">Personal</option>
                                <option value="personal@servite.de">Lohnbuchhaltung</option>
                                <option value="dispo@servite.de">Einsätze - Köln</option>
                                <option value="dpergola@servite.de">Einsätze - Düsseldorf</option>
                                <option value="pmonfared@servite.de">Feedback zur Software</option>
                                <option value="info@servite.de">Sonstiges</option>
                            </select>
                        </div>
                        <div v-if="email" class="col-md-5 col-md-offset-1">
                            <label>E-Mail</label>
                            <p v-text="email"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 form-group" :class="{'has-error': form.errors.body }">
                            <textarea name="body" cols="30" rows="10" class="form-control input-sm" placeholder="Ihre Nachricht" required></textarea>
                        </div>
                    </div>
                    <input type="file" name="attachment">
                </div>
            </div>

            <submit-button class="pull-right btn-md btn-success" text="Absenden" :loading="form.loading"></submit-button>
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {
                email: ''
            }
        },

        created() {
            this.$on('form.submitted', () => {
                flash('Anfrage verschickt!');

                this.$parent.$emit('close')
            })
        }
    }
</script>