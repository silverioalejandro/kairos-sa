<template>
    <v-container>
        <v-row>
			<v-col>
                <balance-Filters
                        ref="filters"
                        @filter="filter"
                        :storeForm="storeForm"
                    />
			</v-col>
		</v-row>

        <form-balance
            ref="formBalance"
            :dialog.sync="dialogForm"
            :saveTitle.sync="saveTitle"
            @showForm="showFormClose"
            @refresData="refresData"
        />

        <v-alert
            text
            icon="mdi-home-currency-usd"
            border="left"
            dense
            type="info"
        >
            <strong>Total monto: ${{ extrasDetail | formatPrice }} </strong>
        </v-alert>

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Balance financiero"
                    :headers="headers"
                    :storeForm="storeForm"
                    :pathApi="`/api/admin/balances`"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    @extras="extras"
                    :log="true"
                >
                    <template v-slot:[`item.type_payment`]="{ item }">
                        <v-chip
                            style="text-align:right!important"
                            v-if="item.type_payment == 1"
                            color="#9ccc65"
                        >
                            Ingreso
                        </v-chip>
                        <v-chip
                            style="text-align:right!important"
                            v-else
                            color="#f79394"
                        >
                            Egreso
                        </v-chip>
                    </template>

                    <template v-slot:[`item.payment_date`]="{ item }">
                        {{ item.payment_date | formatDate("ddd, DD-MM-YYYY")}}
                    </template>

                    <template v-slot:[`item.amount`]="{ item }">
                        <v-chip
                                style="text-align:right!important"
                                v-if="item.amount < 0"
                                color="#f79394"
                            > ${{ item.amount | formatPrice }} </v-chip>
                            <span v-else style="text-align:right!important">
                                ${{ item.amount | formatPrice }}
                            </span>
                    </template>

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-menu top v-if="!item.paid_id > 0">
                            <template v-slot:activator="{ on }">
                                <v-icon small fab class="mr-2" v-on="on">
                                    mdi-dots-vertical
                                </v-icon>
                            </template>

                            <v-list color="blue-grey lighten-3">
                                <v-subheader dense class="font-weight-bold">Id.: {{ item.id }}
                                </v-subheader>

                                <v-list-item dense @click="showForm('update', item)">
                                    <v-list-item-icon>
                                        <v-icon>
                                            mdi-account-edit-outline
                                        </v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Modificar
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </template>
                </material-datatable-table>
            </v-col>
		</v-row>
    </v-container>
</template>

<script>
import BalanceFilters from "./BalanceFilters";
import FormBalance from './FormBalance.vue';

export default {
    name: "Balances",
    components : {BalanceFilters, FormBalance},
    props: {
        isSelected: {
            type: null | Boolean,
            default: false
        },
    },
    data: () => ({
        dialogForm:false,
        loading: false,
        storeForm: "Balances",
        saveTitle: null,
        extrasDetail: null,
        headers: [
            { text: "Id", value: "id" },
            { text: "Tipo de operation", value: "type_payment" },
            { text: "Fecha pago", value: "payment_date" },
            { text: "Presupuesto Id.", value: "budget_id" },
            { text: "Monto", value: "amount" },
            { text: "Observación", value: "obs" },
            { text: "Creado", value: "created_at" },
            { text: "Creado por", value: "operator.email", showColumn: false },
            { text: "Acción", value: "actions", sortable: false }
        ],
    }),
    methods: {
        selectItem(item){
            this.$emit("selected", item);
        },
        async filter() {
            this.$refs[this.storeForm].requestData();
        },
        newRow(){
            this.showForm();
        },
        extras(extras) {
            this.extrasDetail = extras.total;
        },
        showForm(optionTitle = "Create", item = {}) {
			this.dialogForm = true;
			if (optionTitle == "Create") {
				this.saveTitle = "Crear";
				return;
			}

			this.saveTitle = "Actualizar";
			this.$refs.formBalance.setData(item);
		},
        showFormClose() {
			this.dialogForm = false;
		},
        refresData(){
            this.dialogForm = false;
            this.$refs[this.storeForm].requestData();
        }
    }
}
</script>

