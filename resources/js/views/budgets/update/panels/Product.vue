<template>
    <v-container>
        <v-dialog
            v-model="dialogSelect"
            max-width="1100"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Seleccionar Producto
                </v-card-title>

                <v-card-text>
                    <selected @isSelected="isSelected"/>
                </v-card-text>
            </v-card>
        </v-dialog>

        <v-form ref="form" v-model="valid" lazy-validation>
            <v-row>
                <v-col>
                    <v-text-field
                        v-model.trim="form.id"
                        label="Producto id."
                        outlined
                        dense
                        readonly
                        append-icon="mdi-file-search-outline"
                        @click:append="showFormSelected"
                    ></v-text-field>
                </v-col>
                <v-col>
                    <v-text-field
                        v-model= "productName"
                        label="Nombre del producto"
                        outlined
                        dense
                        readonly
                        append-icon="mdi-file-search-outline"
                        @click:append="showFormSelected"
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-row dense>
                <v-col >
                    <v-text-field
                        label="Disponible"
                        :value="form.product_available | formatNumber"
                        filled
                        dense
                        readonly
                    >
                    </v-text-field>
                </v-col>

                <v-col >
                    <v-text-field
                        label="Precio"
                        :value="form.price | formatPrice"
                        filled
                        dense
                        readonly
                    >
                    </v-text-field>
                </v-col>

                <v-col>
                    <v-text-field
                        :counter="20"
                        prepend-inner-icon="mdi-email-send-outline"
                        label="Cantidad"
                        v-model.trim="$v.form.quantity.$model"
                        :error-messages="quantityErrors"
                        maxlength="20"
                        ref="quantity"
                    >
                        <template v-slot:append-outer>
                            <v-icon
                                @click="addProduct"
                                color="green"
                                :disabled="$v.form.$invalid"
                            >
                                mdi-plus
                            </v-icon>
                        </template>
                    </v-text-field>
                </v-col>
            </v-row>

            <v-row>
                <v-col>
                    <v-data-table
                        :headers="headers"
                        :items="products"
                        :items-per-page="10"
                        class="elevation-1"
                    >
                        <template v-slot:[`item.product_price`]="{ item }">
                            <span>
                                ${{ item.product_price | formatPrice }}
                            </span>
                        </template>

                        <template v-slot:[`item.product_available`]="{ item }">
                            <span>
                                {{ item.product_available | formatNumber }}
                            </span>
                        </template>

                        <template v-slot:[`item.sub_total`]="{ item }">
                            <span>
                                ${{ item.sub_total | formatPrice }}
                            </span>
                        </template>

                        <template v-slot:[`item.product_quantity`]="{ item }">
                            <div @click="editCell(item, 'product_quantity')">
                                <v-text-field
                                    v-if="item.editing && item.editingField === 'product_quantity'"
                                    v-model="item.product_quantity"
                                    label="Cantidad de Producto"
                                    hide-details
                                    single-line
                                    dense
                                    @blur="saveCell(item)"
                                    @keydown.enter="saveCell(item)"
                                ></v-text-field>
                                <span v-else>{{ item.product_quantity | formatNumber }} <v-icon color="primary">mdi-pencil-outline</v-icon></span>
                            </div>
                        </template>

                        <template v-slot:[`item.actions`]="{ item }">
                            <v-btn icon @click="deleteItem(item)">
                                <v-icon color="red">mdi-delete</v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>
                </v-col>
            </v-row>

            <v-card-actions>
                <v-btn text color="red darken-1" @click="backStep">
                    Volver
                </v-btn>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="save"
                    :disabled="validNext"
                >
                    Siguiente
                </v-btn>
            </v-card-actions>
        </v-form>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";
import Selected from "./SelectProduct.vue";

export default {
    name: "FormBudgetCreateProduct",
    validations: {
		form: {
			id: { required },
            price: { required },
			quantity: { required },
			product_available: { required },
		}
	},
    components : {Selected},
    data: () => ({
		loadingPage: false,
		valid: false,
        dialogSelect: false,
        productName: null,
        product: null,
		form: {
			id: null,
            price: null,
            quantity: null,
            product_available: null
		},
        product_name: null,
        headers: [
            { text: 'Id', value: 'product_id' },
            { text: 'Producto', align: 'start', value: 'product_name' },
            { text: 'Disponible', value: 'product_available' },
            { text: 'Precio', value: 'product_price' },
            { text: 'Cantidad', value: 'product_quantity' },
            { text: 'Sub-consultas', value: 'sub_total' },
            { text: 'Eliminar', value: 'actions', sortable: false },
        ],
        newProduct: {
            product_id: null,
            product_name: null,
            product_available: null,
            product_price: null,
            product_quantity: null,
            sub_total: null,
            editingField: '',
            editing: false
        },
        products: [],
	}),
    computed: {
        ...mapGetters(["getBudgetToUpdate"]),
        quantityErrors() {
			const errors = [];
			if (!this.$v.form.quantity.$dirty) return errors;
			!this.$v.form.quantity.required && errors.push("Es requerido");
            if (this.validServer && "quantity" in this.validServer) errors.push(this.validServer.quantity[0]);
			return errors;
		},
        validNext() {
            return this.products.length == 0;
        }
    },
	methods: {
        ...mapActions(["message","setBudgetToUpdate"]),
        editCell(item, field) {
            console.log("si llama edit...");
            this.products.forEach(i => {
                i.editing = false;
                i.editingField = '';
            });
            item.editing = true;
            item.editingField = field;
        },
        saveCell(item) {
            console.log("si llama save...");
            item.editing = false;
            item.editingField = '';
        },
        backStep() {
            this.$emit('backStep');
        },
        isSelected(item) {
            this.product = item;
			this.form.id = item.id;
			this.dialogSelect = false;
			this.productName = item.name;
            this.form.price = item.price;
            this.form.product_available = item.quantity;

            this.$refs.quantity.focus();
		},
        deleteItem(item){
            const idToDelete = item.product_id;
            this.products = this.products.filter(item => item.product_id != idToDelete);
        },
        addProduct(){
            let idExists = this.products.some(item => item.product_id === this.product.id);
            if (idExists){
                this.message({type:"warning", message:"Verifique ya existe el producto"});
                return ;
            }

            this.newProduct.product_id = this.product.id;
            this.newProduct.product_name = this.product.name;
            this.newProduct.product_price = this.product.price;
            this.newProduct.product_quantity = this.form.quantity;
            this.newProduct.product_available = this.product.quantity;
            this.newProduct.sub_total = this.product.price * this.form.quantity;
            this.newProduct.editingField = '';
            this.newProduct.editing = false;
            this.products.push({ ...this.newProduct });
        },
        showFormSelected(){
			this.dialogSelect = true;
		},
        async save() {
            this.$emit('nextStep');
		},
	},
    async created(){
        const data = this.getBudgetToUpdate;
        const dataProducts = data.budget_details.map(item => {
            return {
                product_id: item.product_id,
                product_name: item.product.name,
                product_price: item.price,
                product_quantity: item.quantity,
                product_available: item.product.quantity_factory,
                sub_total: item.price * item.quantity,
                editingField: '',
                editing: false,
            };
        });

        this.products = dataProducts;
    }
};
</script>