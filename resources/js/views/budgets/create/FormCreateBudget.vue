<template>
    <v-app>
        <v-container>
            <v-stepper v-model="e1">
            <v-stepper-header>
                <v-stepper-step :complete="e1 > 1" step="1">
                    Evento
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step :complete="e1 > 2" step="2">
                    Productos
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step :complete="e1 > 3" step="3">
                    Vehículos
                </v-stepper-step>

                <v-divider></v-divider>

                <v-stepper-step :complete="e1 > 4" step="4">
                    Presupuesto
                </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
                <v-stepper-content step="1">
                    <event ref="formEvent" @nextStep="nextStep" @backStep="backStep"></event>
                </v-stepper-content>

                <v-stepper-content step="2">
                    <product ref="formProduct" @nextStep="nextStep" @backStep="backStep"></product>
                </v-stepper-content>

                <v-stepper-content step="3">
                    <vehicle ref="formVehicle" @nextStep="nextStep" @backStep="backStep"></vehicle>
                </v-stepper-content>

                <v-stepper-content step="4">
                    <budget ref="formBudget" :details.sync="details" @nextStep="saveAll" @backStep="backStep" ></budget>
                </v-stepper-content>

            </v-stepper-items>
            </v-stepper>
        </v-container>
    </v-app>
</template>

<script>
import { mapActions } from "vuex";
import Event from './panels/Event.vue';
import Product from './panels/Product.vue';
import Vehicle from './panels/Vehicle.vue';

import Budget from './panels/Budget.vue';

export default {
    name: "FormCreateBudget",
    components: {
        Event,
        Product,
        Vehicle,
        Budget,
    },
    data: () => ({
        e1: 1,
        dialogSelect: false,
        details: {},
    }),
    methods: {
        ...mapActions(["setBudgetDetails"]),
        nextStep() {
            this.e1++;

            const total_products = this.$refs.formProduct.products.reduce((acumulador, objetoActual) => {
                return acumulador + objetoActual.sub_total;
            }, 0);

            const nro_products = this.$refs.formProduct.products.reduce((acumulador, objetoActual) => {
                return acumulador + parseFloat(objetoActual.product_quantity);
            }, 0);

            const total_vehicles = this.$refs.formVehicle.vehicles.reduce((acumulador, objetoActual) => {
                return acumulador + parseFloat(objetoActual.price);
            }, 0);

            this.details = { total_products, total_vehicles, nro_products, nro_vehicles: this.$refs.formVehicle.vehicles.length };

            this.setBudgetDetails(this.details);
        },
        backStep() {
            this.e1--;
        },
        isSelected(item) {
			this.form.customer_id = item.id;
			this.dialogSelect = false;
			this.customerName = item.name;
		},
        async saveAll() {
            const msg = "¿Seguro desea crear el producto?";
			const res = await this.$confirm(msg);
			if (!res) return;

            try {
				this.loadingPage = true;
				const url = `/api/admin/budget/create`;

                let input = {
                    event_id: this.$refs.formEvent.form.id,
                    products: this.$refs.formProduct.products,
                    vehicles: this.$refs.formVehicle.vehicles,
                    budget: this.$refs.formBudget.form
                };

				await this.$_executePost({
					url: url,
					data: input
				});

				this.$router.push({ path: '/budgets' });
			} catch (e) {
				this.loadingPage = false;
				if (e.response && e.response.status == 422) {
                    this.message({
                        type: "warning",
                        message: "Registro invalido"
                    });
                    this.validServer = e.response.data.errors;
				}
				this.loadingPage = false;
			}

        },
    },
};
</script>

<style scoped>
.v-btn {
    margin: 10px 0;
}
</style>
