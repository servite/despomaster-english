<template>
    <order-form
            :model="data.order"
            action="/api/order/store"
            type="copy"
    >
    </order-form>
</template>

<script>
    import OrderForm from './OrderForm.vue';

    export default {

        components: {
            'order-form' : OrderForm
        },
        props: ['data'],

        created() {
            this.$on('form.submitted', () => {
                events.$emit('order.created');

                flash(trans('Neuen Auftrag angelegt'));

                this.$parent.$emit('close')
            })
        }
    }
</script>