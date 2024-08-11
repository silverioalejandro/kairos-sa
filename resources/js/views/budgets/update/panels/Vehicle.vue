<template>
    <v-container>
        <v-dialog
            v-model="dialogSelect"
            max-width="1100"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Seleccionar Vehículo
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
                        label="Vehículo id."
                        outlined
                        dense
                        readonly
                        append-icon="mdi-file-search-outline"
                        @click:append="showFormSelected"
                    ></v-text-field>
                </v-col>
                <v-col>
                    <v-text-field
                        v-model= "freightName"
                        label="Nombre del Fletero"
                        outlined
                        dense
                        readonly
                        append-icon="mdi-file-search-outline"
                        @click:append="showFormSelected"
                    ></v-text-field>
                </v-col>
            </v-row>

            <v-row>
                <v-col>
                    <v-text-field
                        label="Teléfono"
                        :value="cellphone"
                        filled
                        dense
                        readonly
                    >
                    </v-text-field>
                </v-col>

                <v-col>
                    <v-text-field
                        label="Tipo de vehículo"
                        :value="vehicle_type"
                        filled
                        dense
                        readonly
                    >
                    </v-text-field>
                </v-col>

                <v-col>
                    <v-text-field
                        label="Patente"
                        :value="patent"
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
                        label="Precio"
                        v-model.trim="$v.form.price.$model"
                        :error-messages="priceErrors"
                        maxlength="20"
                        ref="price"
                    >
                        <template v-slot:append-outer>
                            <v-icon
                                @click="addVehicle"
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
                        :items="vehicles"
                        :items-per-page="5"
                        class="elevation-1"
                    >
                        <template v-slot:[`item.price`]="{ item }">
                            <div @click="editCell(item, 'price')">
                                <v-text-field
                                    v-if="item.editing && item.editingField === 'price'"
                                    v-model="item.price"
                                    label="Precio"
                                    hide-details
                                    single-line
                                    dense
                                    @blur="saveCell(item)"
                                    @keydown.enter="saveCell(item)"
                                ></v-text-field>
                                <span v-else>${{ item.price | formatPrice }} <v-icon color="primary">mdi-pencil-outline</v-icon></span>
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
import Selected from "./SelectVehicle.vue";

export default {
    name: "FormBudgetCreateVehicle",
    validations: {
		form: {
			id: { required },
            price: { required }
		}
	},
    components : {Selected},
    data: () => ({
		loadingPage: false,
		valid: false,
        dialogSelect: false,
        freightName: null,
        vehicle: null,
		form: {
			id: null,
            price: null,
		},
        cellphone: null,
        patent: null,
        vehicle_type: null,
        headers: [
            { text: 'Id', value: 'vehicle_id' },
            { text: 'Fletero', align: 'start', value: 'freight' },
            { text: 'Teléfono', value: 'cellphone' },
            { text: 'Patente', value: 'patent' },
            { text: 'Precio', value: 'price' },
            { text: 'Tipo vehículo', value: 'vehicle_type' },
            { text: 'Eliminar', value: 'actions', sortable: false },
        ],
        newVehicle: {
            vehicle_id: null,
            price: null,
            freight: null,
            cellphone: null,
            patent: null,
            vehicle_type: null,
            editingField: '',
            editing: false
        },
        vehicles: [],
	}),
    computed: {
        ...mapGetters(["getBudgetToUpdate"]),
        priceErrors() {
			const errors = [];
			if (!this.$v.form.price.$dirty) return errors;
			!this.$v.form.price.required && errors.push("Es requerido");
            if (this.validServer && "price" in this.validServer) errors.push(this.validServer.price[0]);
			return errors;
		},
        validNext() {
            return false;
        }
    },
	methods: {
		...mapActions(["message"]),
        editCell(item, field) {
            this.vehicles.forEach(i => {
                i.editing = false;
                i.editingField = '';
            });
            item.editing = true;
            item.editingField = field;
        },
        saveCell(item) {
            item.editing = false;
            item.editingField = '';
        },
        backStep() {
            this.$emit('backStep');
        },
        isSelected(item) {
            this.vehicle = item;
			this.form.id = item.id;
			this.dialogSelect = false;
			this.freightName = item.freight.name;
            this.cellphone = item.freight.cellphone;
            this.patent = item.patent;
            this.form.price = item.price;
            this.vehicle_type = item.vehicle_type.name;
		},
        deleteItem(item){
            const idToDelete = item.vehicle_id;
            this.vehicles = this.vehicles.filter(item => item.vehicle_id != idToDelete);
        },
        addVehicle(){
            let idExists = this.vehicles.some(item => item.vehicle_id === this.vehicle.id);
            if (idExists){
                this.message({type:"warning", message:"Verifique ya existe el vehículo"});
                return ;
            }

            this.newVehicle.vehicle_id = this.vehicle.id;
            this.newVehicle.price = this.form.price;
            this.newVehicle.freight = this.vehicle.freight.name;
            this.newVehicle.cellphone = this.vehicle.freight.cellphone;
            this.newVehicle.patent = this.vehicle.patent;
            this.newVehicle.vehicle_type = this.vehicle.vehicle_type.name;

            this.vehicles.push({ ...this.newVehicle });
        },
        showFormSelected(){
			this.dialogSelect = true;
		},
        async save() {
            this.$emit('nextStep');
		},
	},
    created(){
        const data = this.getBudgetToUpdate;
        const dataVehicles = data.budget_vehicles.map(item => {
            return {
                vehicle_id: item.vehicle.id,
                price: item.price,
                freight: item.vehicle.freight.name,
                cellphone: item.vehicle.freight.cellphone,
                patent: item.patent,
                vehicle_type: item.vehicle.vehicle_type,
            };
        });

        this.vehicles = dataVehicles;
    }
};
</script>