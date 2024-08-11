<template>
<v-container>
    <v-dialog
        v-model="dialogSelectCustomer"
        max-width="1100"
    >
        <v-card>
            <v-card-title class="text-h5">
                Seleccionar cliente
            </v-card-title>

            <v-card-text>
                <select-customer @selectedCustomer="selectedCustomer"/>
            </v-card-text>
        </v-card>
    </v-dialog>
    <v-row>
        <v-col>
            <v-card class="d-flex mb-0" color="" flat tile>
                <p>Id.:</p>
                <p class="ml-3">
                    <router-link :to="`/customers/${customer.id}`">
                        {{ customer.id }}
                    </router-link>
                </p>
            </v-card>

            <v-btn
                color="primary"
                text
                @click="dialogSelectCustomer = true"
            >
                Actualizar cliente
            </v-btn>
        </v-col>
    </v-row>

    <v-row>
        <v-col>
            <v-text-field
                :value="customer.name"
                hint="Nombre"
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
                :value="customer.cellphone"
                hint="Teléfono:"
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
                :value="customer.address"
                hint="Dirección:"
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
import SelectCustomer from "./SelectCustomer.vue";

export default {
    name: "CustomerDetail",
    components : {SelectCustomer},
    props: [
        "customer"
    ],
    data: () => ({
        dialogSelectCustomer: false
    }),
    methods: {
        async selectedCustomer(item){
            this.dialogSelectCustomer = false;

            if (this.customer.id != item.id){
                const msg = `¿Seguro desea cambiar de cliente?`;
                const res = await this.$confirm(msg);
                if (!res) return;
            }

            console.log("Va a cambiar de cliente");

        },
        // showFormClose(){
        //     console.log("Cerrar el formulario...");
        //     console.log("customer id anterior");
        //     console.log(this.customer.id);

        //     console.log("propuesto id nuevo");
        //     console.log(item.id);


        //     if (this.customer.id != item.id){
        //         const msg = `¿Seguro desea cambiar de cliente # ${this.form.id} `;
        //         if (!res) return;
        //     }

        //     this.dialogSelectCustomer = false;

        //     console.log("Va a cambiar de cliente");
        // }
    },
    created(){
        console.log("Se inicio... customer...");
        console.log(this.customer);
    }
}
</script>
