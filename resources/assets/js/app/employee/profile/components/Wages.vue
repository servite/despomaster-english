<template>
    <div v-if="wages" class="box box-primary">
        <div class="box-header with-border">
            <h4>Lohn</h4>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Gültig ab</label>
                    <div>{{ moment(wages[0].valid_from).format('L') }}</div>
                </div>
                <div class="col-md-6 form-group">
                    <label>Betrag in €</label>
                    <div>{{ money(wages[0].amount) }} €</div>
                </div>
            </div>
            <table v-if="wages" class="table">
                <thead>
                <tr>
                    <th>Gültig von</th>
                    <th>Gültig bis</th>
                    <th>Betrag</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="wage in wages">
                    <td>
                        {{ moment(wage.valid_from).format('ll') }}
                    </td>
                    <td>
                        {{ wage.valid_to ? moment(wage.valid_to).format('ll') : '-' }}
                    </td>
                    <td>
                        {{ money(wage.amount) }} €
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['wages'],
    }
</script>
