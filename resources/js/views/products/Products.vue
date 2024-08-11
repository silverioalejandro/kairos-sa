<template>
    <v-container>
        <v-row>
			<v-col>
                <ProductFilters
                    ref="filters"
                    @filter="filter"
                    :storeForm="storeForm"
                />
			</v-col>
		</v-row>

        <form-product
            ref="formProduct"
            :dialog.sync="dialogForm"
            :saveTitle.sync="saveTitle"
            @showForm="showFormClose"
            @refresData="refresData"
        />

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Productos"
                    :headers="itemHeader()"
                    :storeForm="storeForm"
                    :pathApi="`/api/admin/product`"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    :log="true"
                >
                    <template v-slot:[`item.select`]="{ item }">
                        <v-btn @click="selectItem(item)" class="ma-2" small color="success">
                            <v-icon>mdi-checkbox-marked-circle-outline</v-icon>
                        </v-btn>
                    </template>

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <template v-slot:[`item.price`]="{ item }">
                        <span style="">
                            ${{ item.price | formatPrice }}
                        </span>
                    </template>

                    <template v-slot:[`item.category`]="{ item }">
                        {{ item.category.description }}
                    </template>

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
import ProductFilters from "./ProductFilters";
import FormProduct from './FormProduct.vue';

export default {
    name: "Products",
    components : {ProductFilters, FormProduct},
    props: {
        isSelected: {
            type: null | Boolean,
            default: false
        },
    },
    data: () => ({
        dialogForm:false,
        loading: false,
        storeForm: "Products",
        saveTitle: null,
        headers: [],
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
			this.$refs.formProduct.setData(item);
		},
        showFormClose() {
			this.dialogForm = false;
		},
        refresData(){
            this.dialogForm = false;
            this.$refs[this.storeForm].requestData();
        },
        itemHeader() {
            let headers1 = [
                { text: "Id", value: "id" },
            ];

            if (this.isSelected) {
                headers1.push({ text: "Seleccionar", value: "select" });
            }

            const headers2 = [
                { text: "Nombre", value: "name" },
                { text: "Descrpción", value: "description" },
                { text: "Sku", value: "sku" },
                { text: "Categoria", value: "category.name" },
                { text: "Precio", value: "price" },
                { text: "Cantidad", value: "quantity" },
                { text: "Estado", value: "status_product.name" },
                { text: "Creado", value: "created_at" },
                { text: "Creado por", value: "operator.email", showColumn: false },
                { text: "Actions", value: "actions", sortable: false }
            ];

            return headers1.concat(headers2);
        }
    },
    created() {
        if (this.isSelected) {
            this.storeForm = "selectProduct";
        }
    }
}
</script>

