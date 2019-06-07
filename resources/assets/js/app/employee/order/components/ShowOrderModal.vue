<template>
    <div>
        <div class="row margin-b-10">
            <div class="col-md-6">
                <div v-if="order.status == 'canceled'" class="label label-warning margin-l-10">Storniert</div>
            </div>
        </div>

        <div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Veranstaltungsname</label>
                            <p>{{ order.title }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Beginn</label>
                            <p>{{ moment(order.start_date).format('L') }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Ende</label>
                            <p>{{ moment(order.end_date).format('L') }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Startzeit</label>
                            <p>{{ order.start_time ? order.start_time + ' Uhr' : '-' }}</p>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Endzeit</label>
                            <p>{{ order.end_time ? order.end_time + ' Uhr' : '-' }}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Einsatzort</label>
                            <p>{{ order.work_location }}</p>

                            <div class="row">
                                <div class="col-md-7 form-group">
                                    <label>Treffpunkt: Ort</label>
                                    <p>{{ order.meeting_point }}</p>
                                </div>
                                <div class="col-md-5 form-group">
                                    <label>Zeit</label>
                                    <p>{{ order.meeting_time ? order.meeting_time + ' Uhr' : '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Einsatzinfos</label>
                            <p>{{ order.requirements }}</p>
                        </div>
                    </div>

                    <hr>

                    <div v-if="data.showFeedback">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Rückmeldung an den Dispo-Manager</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <p>Sind Sie bereit an diesen Termin zu arbeiten?</p>
                            </div>
                            <div class="col-md-5">
                                <button @click.prevent="accept" class="btn btn-success btn-sm margin-l-10">Zusagen</button>
                                <button @click.prevent="deny" class="btn btn-danger btn-sm">Absagen</button>
                            </div>
                        </div>
                    </div>

                    <div v-if="data.showTimetracking && order.timetrackings.length">
                        <h4>Erfasste Zeit</h4>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>Start</label>
                                <div>{{ hour(order.timetrackings[0].start_time) + ' Uhr' }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Ende</label>
                                <div>{{ hour(order.timetrackings[0].end_time) + ' Uhr' }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Pause</label>
                                <div>{{ order.timetrackings[0].break ? order.timetrackings[0].break + ' Minuten' : '-' }}</div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Erfasst</label>
                                <div>{{ hour(order.timetrackings[0].total_min/60) + ' Stunden' }}</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="pull-right">
                <a @click.prevent="$parent.$emit('close')" class="btn btn-danger btn-md">Schliessen</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: Object.assign({}, this.data.order)
            }
        },
        props: ['data'],

        methods: {
            accept() {
                axios.post('/api/e/order/' + this.order.id + '/accept').then(() => {
                    flash('Erfolgreich gespeichert');
                    events.$emit('availability.changed');

                    this.$parent.$emit('close');
                });
            },

            deny() {
                axios.post('/api/e/order/' + this.order.id + '/deny').then(() => {
                    flash('Erfolgreich gespeichert');
                    events.$emit('availability.changed');

                    this.$parent.$emit('close');
                });

            }
        }

    }
</script>