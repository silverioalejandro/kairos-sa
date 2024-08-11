<template>
<v-container>
    <!-- <v-row>
        <v-col>
            <v-card class="d-flex mb-0" color="" flat tile>
                <p>Id.:</p>
                <p class="ml-3">
                    <router-link :to="`/budgetDetails/${budgetDetail.id}`">
                        {{ budgetDetail.id }}
                    </router-link>
                </p>
            </v-card>
        </v-col>
    </v-row> -->

    <v-row>
        <v-col>
            <v-text-field
                :value="budgetDetail.id"
                hint="Id.:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="budgetDetail.total_product"
                hint="Total de producto:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="budgetDetail.status_budget.name"
                hint="Estatus:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>
    </v-row>

    <v-row>
        <v-col>
            <v-text-field
                :value="budgetDetail.discount_amount | formatPrice"
                hint="Descuento"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
                prefix="$"
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="budgetDetail.iva_percentage | formatPrice"
                hint="Procentaje IVA:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
                prefix="$"
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="budgetDetail.iva_amount | formatPrice"
                hint="Monto IVA:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
                prefix="$"
            ></v-text-field>
        </v-col>
    </v-row>


    <v-row>
        <v-col>
            <v-text-field
                :value="budgetDetail.payment_type.name"
                hint="Método de pago:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="budgetDetail.total_amount | formatPrice"
                hint="Monto total:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>
    </v-row>

</v-container>
</template>

<script>
export default {
    name: "budgetDetailDetail",
    props: [
        "budgetDetail"
    ],
    data: () => ({
    }),
    computed: {
    },
    created(){
        console.log("Se inicio... budgetDetail...");
        console.log(this.budgetDetail);
    }
}
</script>
