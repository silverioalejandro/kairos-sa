<template>
<v-container>
    <v-row>
        <v-col>
            <material-datatable-table
                :ref="storeForm"
                tableName="Productos"
                :headers="headers"
                :storeForm="storeForm"
                :pathApi="`/api/admin/budget/detail/${budgetId}`"
                :showRefreshData="true"
                :showHideColumn="true"
                :log="true"
            >
                <template v-slot:[`item.product.price`]="{ item }">
                    <span style="">
                        ${{ item.product.price | formatPrice }}
                    </span>
                </template>

                <template v-slot:[`item.sub_total`]="{ item }">
                    <span style="">
                        ${{ (item.product.price * item.quantity) | formatPrice }}
                    </span>
                </template>

                <!-- <template v-slot:[`item.created_at`]="{ item }">
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
                </template> -->

            </material-datatable-table>
        </v-col>
    </v-row>
</v-container>
</template>

<script>

export default {
    name: "ProductDetail",
    props: [
        "budgetId"
    ],
    data: () => ({
        storeForm: "BudgetDetails",
        headers: [
            { text: "Id", value: "id" },
            { text: "Producto", value: "product.name" },
            { text: "Precio", value: "product.price" },
            { text: "Cantidad", value: "quantity" },
            { text: "Sub total", value: "sub_total" }
        ],
    }),
    computed: {
    },
    created(){
        console.log("Se inicio... budgetId...");
        console.log(this.budgetId);
    }
}
</script>
