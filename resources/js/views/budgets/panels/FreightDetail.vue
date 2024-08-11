<template>
<v-container>
    <v-row>
        <v-col>
            <material-datatable-table
                :ref="storeForm"
                tableName="Fletes"
                :headers="headers"
                :storeForm="storeForm"
                :pathApi="`/api/admin/budget/vehicle/${budgetId}`"
                :showRefreshData="true"
                :showHideColumn="true"
                :log="true"
            >
                <template v-slot:[`item.price`]="{ item }">
                    <span style="">
                        ${{ item.price | formatPrice }}
                    </span>
                </template>

            </material-datatable-table>
        </v-col>
    </v-row>
</v-container>
</template>

<script>

export default {
    name: "FreightDetail",
    props: [
        "budgetId"
    ],
    data: () => ({
        storeForm: "FreightDetail",
        headers: [
            { text: "Id", value: "id" },
            { text: "Nombre", value: "vehicle.freight.name" },
            { text: "Teléfono", value: "vehicle.freight.cellphone" },
            { text: "Contacto", value: "vehicle.freight.contact" },
            { text: "Tipo Vehículo", value: "vehicle.vehicle_type.name" },
            { text: "Patente", value: "vehicle.patent" },
            { text: "Precio", value: "price" },
            { text: "Status Vehículo", value: "vehicle.status_vehicle.name" },
            { text: "Observación", value: "vehicle.obs.name" },
        ],
    }),
    computed: {
    },
    created(){
        console.log("Se inicio... fletes budgetId...");
        console.log(this.budgetId);
    }
}
</script>
