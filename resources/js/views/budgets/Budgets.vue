<template>
    <v-container>
        <v-row>
			<v-col>
                <BudgetFilters
                    ref="filters"
                    @filter="filter"
                    :storeForm="storeForm"
                />
			</v-col>
		</v-row>

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Presupuesto"
                    :headers="headers"
                    :storeForm="storeForm"
                    :pathApi="`/api/admin/budget`"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    :log="true"
                >
                    <template v-slot:[`item.id`]="{ item }">
                        <button @click="linkUpdate(item)" rol="link">
                            {{item.id}}
                        </button>
                    </template>

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <template v-slot:[`item.discount_amount`]="{ item }">
                        <span style="">
                            ${{ item.discount_amount | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.iva_amount`]="{ item }">
                        <span style="">
                            ${{ item.iva_amount | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.retention_amount`]="{ item }">
                        <span style="">
                            ${{ item.retention_amount | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.total_amount`]="{ item }">
                        <span style="">
                            ${{ item.total_amount | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.total_amount_paid`]="{ item }">
                        <span style="">
                            ${{ item.total_amount_paid | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-btn icon @click="viewBill(item)">
                            <v-icon color="blue">mdi-file-table-outline</v-icon>
                        </v-btn>
                    </template>

                    <template v-slot:[`item.payments`]="{ item }">
                        <v-btn icon @click="payments(item)">
                            <v-icon color="green">mdi-credit-card-plus-outline</v-icon>
                        </v-btn>
                    </template>

                </material-datatable-table>
            </v-col>
		</v-row>
    </v-container>
</template>

<script>
import { mapActions } from "vuex";
import BudgetFilters from "./BudgetFilters";

export default {
    name: "Budget",
    components : {BudgetFilters},
    data() {
        return {
            loading: false,
            storeForm: "Budget",
            headers: [
                { text: "Id", value: "id" },
                { text: "Estado presupuesto", value: "status_budget.name" },
                { text: "Fecha del evento", value: "event.event_date" },
                { text: "Direción", value: "event.address" },
                { text: "Cliente", value: "event.customer.name" },
                { text: "Dni", value: "event.customer.identification_number" },
                { text: "Monto descuento", value: "discount_amount", align: "right"},
                { text: "Monto iva", value: "iva_amount", align: "right"},
                { text: "Monto retención", value: "retention_amount", align: "right"},
                { text: "Monto total", value: "total_amount", align: "right"},
                { text: "Monto abonado", value: 'total_amount_paid', sortable: false },
                { text: "Factura", value: 'actions', sortable: false },
                { text: "Abonar", value: 'payments', sortable: false },
            ],
        };
    },
    created() {
    },
    methods: {
        ...mapActions(["message","setBudgetToUpdate","exportFile"]),
        async filter() {
            this.$refs[this.storeForm].requestData();
        },
        newRow(){
            this.$router.push({ path: "/budget/create" });
        },
        async linkUpdate(item) {
            const url = `/api/admin/budget/${item.id}`;
            const {data} = await this.$_executeGet({
                url: url
            });
            await this.setBudgetToUpdate(data.data);
            this.$router.push({ path: '/budget/update/' + item.id });
        },
        async viewBill(item) {
            const ruta = this.$router.resolve({ path: '/bill/' + item.id  }).href;
            window.open(ruta, '_blank');
        },
        payments(item) {
            this.$router.push({ path: '/budget-paids/' + item.id });
        }
    },
}
</script>

