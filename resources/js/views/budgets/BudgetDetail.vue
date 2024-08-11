<template>
    <v-container fluid>
        <v-row v-if="loadingPage">
			<v-col cols="12" md="12">
				<v-skeleton-loader
					ref="skeleton"
					type="table"
					class="mx-auto"
				></v-skeleton-loader>
			</v-col>
		</v-row>

        <v-tabs v-if="!loadingPage && budget != undefined" :show-arrows="true">
            <v-tab>
				<h3>
					<v-icon left color="blue darken-1">
						mdi-smart-card-outline
					</v-icon>
					Presupuesto
				</h3>
			</v-tab>

            <v-tab>
				<h3>
					<v-icon left color="blue darken-2">
						mdi-smart-card-outline
					</v-icon>
					Cliente
				</h3>
			</v-tab>

            <v-tab>
				<h3>
					<v-icon left color="blue darken-1">
						mdi-fire-truck
					</v-icon>
					Evento
				</h3>
			</v-tab>

            <v-tab>
				<h3>
					<v-icon left color="blue darken-1">
						mdi-arrange-send-to-back
					</v-icon>
					Productos
				</h3>
			</v-tab>

            <v-tab>
				<h3>
					<v-icon left color="blue darken-1">
						mdi-fire-truck
					</v-icon>
					Fletes
				</h3>
			</v-tab>

            <v-tab-item key="1">
                <budget-detail :budgetDetail.sync="budgetDetail" />
            </v-tab-item>

            <v-tab-item key="2">
                <customer-detail :customer.sync="customer" />
            </v-tab-item>

            <v-tab-item key="3">
                <event-detail :event.sync="event" />
            </v-tab-item>

            <v-tab-item key="4">
                <product-detail :budgetId.sync="budgetId" />
            </v-tab-item>

            <v-tab-item key="5">
                <freight-detail :budgetId.sync="budgetId" />
            </v-tab-item>
        </v-tabs>
    </v-container>
</template>

<script>
import BudgetDetail from "./panels/BudgetDetail.vue";
import CustomerDetail from "./panels/CustomerDetail.vue";
import EventDetail from "./panels/EventDetail.vue";
import ProductDetail from "./panels/ProductDetail.vue";
import FreightDetail from "./panels/FreightDetail.vue";

export default {
    name: "FormBudgetDetail",
    components: {
		CustomerDetail,
        EventDetail,
        BudgetDetail,
        ProductDetail,
        FreightDetail
	},
    data() {
        return {
            loadingPage: false,
            budget: null,
            budgetDetail: null,
            customer: null,
            event: null,
            budgetId: null
        };
    },
    async created() {
        this.budget = await this.getBudget(this.$route.params.id);
    },
    methods: {
        async getBudget(id) {
            const {data} = await this.$_executeGet({
                url: `/api/admin/budget/${id}`
            });

            this.customer = data.data.event.customer;
            this.event = data.data.event;
            this.budgetDetail = data.data;
            this.budgetId = data.data.id;

            return data;
        }
    },
}
</script>

