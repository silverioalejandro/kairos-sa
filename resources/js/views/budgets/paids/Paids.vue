<template>
    <v-container>
        <v-row>
			<v-col>
                <paid-Filters
                        ref="filters"
                        @filter="filter"
                        :storeForm="storeForm"
                    />
			</v-col>
		</v-row>

        <form-paid
            ref="formPaid"
            :dialog.sync="dialogForm"
            :saveTitle.sync="saveTitle"
            @showForm="showFormClose"
            @refresData="refresData"
        />

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Pagos"
                    :headers="headers"
                    :storeForm="storeForm"
                    :pathApi="url"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    :log="true"
                >
                    <template v-slot:[`item.payment_date`]="{ item }">
                        {{ item.payment_date | formatDate("DD-MM-YYYY")}}
                    </template>

                    <template v-slot:[`item.amount`]="{ item }">
                        <span style="">
                            ${{ item.amount | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <!-- <template v-slot:[`item.select`]="{ item }">
                        <v-btn @click="selectItem(item)" class="ma-2" small color="success">
                            <v-icon>mdi-checkbox-marked-circle-outline</v-icon>
                        </v-btn>
                    </template> -->

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-menu top>
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
import PaidFilters from "./PaidFilters";
import FormPaid from './FormPaid.vue';

export default {
    name: "Paids",
    components : {PaidFilters, FormPaid},
    data: () => ({
        dialogForm:false,
        loading: false,
        storeForm: "Paids",
        saveTitle: null,
        url: null,
        headers: [
            { text: "Id", value: "id" },
            { text: "Forma de pago", value: "payment_type_code.name" },
            { text: "Fecha pago", value: "payment_date" },
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
        showForm(optionTitle = "Create", item = {}) {
			this.dialogForm = true;
			if (optionTitle == "Create") {
				this.saveTitle = "Crear";
				return;
			}

			this.saveTitle = "Actualizar";
			this.$refs.formPaid.setData(item);
		},
        showFormClose() {
			this.dialogForm = false;
		},
        refresData(){
            this.dialogForm = false;
            this.$refs[this.storeForm].requestData();
        }
    },
    created() {
        console.log(this.$route.params.id);
        const budgetId = this.$route.params.id;
        this.url = `/api/admin/budget/paids/${budgetId}`;
    }
}
</script>

