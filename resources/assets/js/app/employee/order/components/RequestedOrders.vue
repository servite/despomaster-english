<template>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Angefrage Aufträge</h4>
        </div>
        <div class="panel-body">
            <div v-if="orders.length">
                <p>Der Dispo-Manager erstellt die endgültige Einsatzplanung. Geben Sie hier an an welchen Terminen Sie arbeiten möchten.</p>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Veranstaĺtung</th>
                        <th>Kunde</th>
                        <th>Datum</th>
                        <th>Treffpunkt</th>
                        <th>Treffpunkt: Zeit</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders">
                        <td>{{ order.title }}</td>
                        <td>{{ order.client.name }}</td>
                        <td>{{ moment(order.start_date).format('L') }}</td>
                        <td>{{ order.meeting_point }}</td>
                        <td>{{ order.meeting_time }} Uhr</td>
                        <td>
                            <span v-if="order.pivot.employee_available" @click="withdraw(order, 'Zusage')" class="label label-success pointer">Zugesagt</span>
                            <span v-if="order.pivot.employee_not_available" @click="withdraw(order, 'Absage')" class="label label-danger pointer">Abgesagt</span>
                            <button v-if="! order.pivot.employee_available && ! order.pivot.employee_not_available" class="btn btn-sm btn-primary" @click="showOrder(order)">Rückmeldung</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <p v-else>
                Keine angefragten Aufträge.
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                orders: []
            }
        },

        methods: {

            showOrder(order) {
                let data = {
                    'order': order,
                    'showFeedback' : true
                };

                modal('Show Order Modal', 'Auftrag anzeigen', data);
            },

            getOrders() {
                axios.get('/api/e/orders/requested').then((response) =>
                    this.orders = response.data
                );
            },

            withdraw(order, type) {
                if (moment(order.start_date).format('L') > moment().add(4, 'days').format('L')) {
                    swal({
                        text: type + ' zurückziehen?',
                        confirmButtonText: 'Bestätigen'
                    }).then(() =>
                        axios.post('/api/e/order/' + order.id + '/withdraw').then(() => events.$emit('availability.changed'))
                    )
                } else {
                    swal({
                        text: 'Änderungen sind nicht mehr möglich. Bitte wenden Sie sich an Ihren Dispo-Manager.',
                        type: 'info',
                        showCancelButton: false,
                    })
                }
            }
        },

        mounted() {
            this.getOrders();

            events.$on('availability.changed', this.getOrders);
        }
    }
</script>