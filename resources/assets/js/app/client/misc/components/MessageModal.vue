<template>
    <form-wrapper :action="'/api/c/message'" enctype="multipart/form-data">
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
                            <select name="topic" class="form-control input-sm" required>
                                <option value="">Bitte auswählen...</option>
                                <option value="personal">Personal</option>
                                <option value="finance">Buchhaltung</option>
                                <option value="orders">Einsätze</option>
                                <option value="others">Sonstiges</option>
                            </select>
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

            <input type="submit" value="Absenden" class="btn btn-success btn-md pull-right">
        </template>
    </form-wrapper>
</template>

<script>
    export default {
        data() {
            return {}
        },

        methods: {},

        created() {
            this.$on('form.submitted', () => {
                flash('Anfrage verschickt!');

                this.$parent.$emit('close')
            })
        }
    }
</script>