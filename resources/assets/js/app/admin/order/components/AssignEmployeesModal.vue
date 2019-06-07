<template>
    <div class="row">
        <div class="col-md-4">
            <employee-list :order="order" :locations="['Bonn', 'Köln', 'Düsseldorf']"></employee-list>
        </div>

        <div class="col-md-8">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>Auftragsnr.:</strong> <a :href="'/admin/order/' + order.id + '/show'">{{ order.id }}</a>
                        </p>
                        <p>
                            <strong>Datum:</strong>
                            {{ order.start == order.end ? order.start : order.start + ' bis ' + order.end }}
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>Kunde:</strong> <a :href="'/admin/client/' + order.client.id + '/show'">{{ order.client.name }}</a>
                        </p>
                        <p>
                            <strong>Startzeit:</strong> {{ order.start_time }} Uhr
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <p>
                            <strong>Einsatzort:</strong> {{ order.work_location }}
                        </p>
                        <p>
                            <strong>Treffpunkt</strong> {{ order.meeting_time + ' Uhr - ' + order.meeting_point }}
                        </p>
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Einsatzinfos:</label>
                        <div>{{ order.requirements }}</div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="pull-left">Mitarbeiter für diesen Auftrag</h4>
                    <a class="btn btn-primary pull-right" :href="'/admin/operation-plan/send/order/' + order.id">Einsatzpläne senden</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <assigned-employees :order="order" username="payam"></assigned-employees>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                order: this.data.order
            }
        },
        props: ['data'],
        components: {
            'EmployeeList': require('./EmployeeList.vue'),
            'AssignedEmployees': require('./AssignedEmployees.vue')
        },
        methods: {}
    }
</script>