
<template>
	<div>
		<v-dialog v-model="dialog" persistent width="1100px">
			<v-card>
				<v-dialog
					v-model="dialogSelect"
					max-width="1100"
				>
					<v-card>
						<v-card-title class="text-h5">
							Seleccionar Fletero
						</v-card-title>

						<v-card-text>
							<selected @isSelected="isSelected"/>
						</v-card-text>
					</v-card>
				</v-dialog>

				<v-card-title class="headline">{{ saveTitle }} Vehículo</v-card-title>
				<v-card-text>
					<v-container>
                        <material-form-loading-page :loadingPage="loadingPage"/>
						<v-form ref="form" v-model="valid" lazy-validation>
							<v-row>
								<v-col>
									<v-text-field
										v-model.trim="form.freight_id"
										label="Fletero id."
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
										label="Fletero"
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
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="tipo de vehículo"
										item-value="id"
										:items="getFilterResources.vehicleTypes"
										v-model="$v.form.vehicle_type_id.$model"
										:error-messages="vehicleTypeIdErrors"
										:return-object="false"
										@blur="$v.form.vehicle_type_id.$touch()"
										@change="$v.form.vehicle_type_id.$touch()"
									></v-autocomplete>
								</v-col>

								<v-col>
									<v-text-field
										:counter="10"
										prepend-inner-icon="mdi-email-send-outline"
										label="Patente"
										v-model.trim="$v.form.patent.$model"
										:error-messages="patentErrors"
										@change="$v.form.patent.$touch()"
										@blur="$v.form.patent.$touch()"
										maxlength="10"
										@keydown="clearValidServer('patent')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="10"
										prepend-inner-icon="mdi-email-send-outline"
										label="Precio"
										v-model.trim="$v.form.price.$model"
										:error-messages="priceErrors"
										@change="$v.form.price.$touch()"
										@blur="$v.form.price.$touch()"
										maxlength="10"
										@keydown="clearValidServer('price')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="Estado"
										item-value="id"
										:items="getFilterResources.statusVehicle"
										v-model="$v.form.status_vehicle_code.$model"
										:error-messages="statusVehicleCodeErrors"
										:return-object="false"
										@blur="$v.form.status_vehicle_code.$touch()"
										@change="$v.form.status_vehicle_code.$touch()"
									></v-autocomplete>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="150"
										prepend-inner-icon="mdi-pound"
										label="Observación"
										v-model.trim="$v.form.obs.$model"
										:error-messages="obsErrors"
										@change="$v.form.obs.$touch()"
										@blur="$v.form.obs.$touch()"
										@keydown="clearValidServer('obs')"
										maxlength="150"
									></v-text-field>
								</v-col>
							</v-row>

						</v-form>
					</v-container>
				</v-card-text>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red darken-1" text @click="closeForm">
						Cancelar
					</v-btn>
					<v-btn
						color="green darken-1"
						text
						@click="save"
						:disabled="$v.form.$invalid"
					>
						{{ saveTitle }}
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";
import Selected from "./SelectFreight.vue";


export default {
	name: "FormVehicle",
	props: {
		dialog: {
			required: true
		},
		saveTitle: {
			required: true
		}
	},
	validations: {
		form: {
			freight_id: { required },
			vehicle_type_id: { required },
			patent: { required },
			obs: { required },
			price: { required },
			status_vehicle_code: { required },
		}
	},
	components : {Selected},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
		dialogSelect: false,
		freightName: null,
		form: {
			id: null,
			freight_id: null,
			vehicle_type_id: null,
			patent: null,
			obs: null,
			price: null,
			status_vehicle_code: 501,
		}
	}),
	computed: {
		...mapGetters(["getFilterResources"]),
        freightIdErrors() {
			const errors = [];
			if (!this.$v.form.freight_id.$dirty) return errors;
			!this.$v.form.freight_id.required && errors.push("Es requerido");
            if (this.validServer && "freight_id" in this.validServer) errors.push(this.validServer.freight_id[0]);
			return errors;
		},
        vehicleTypeIdErrors() {
			const errors = [];
			if (!this.$v.form.vehicle_type_id.$dirty) return errors;
			!this.$v.form.vehicle_type_id.required && errors.push("Es requerido");
            if (this.validServer && "vehicle_type_id" in this.validServer) errors.push(this.validServer.vehicle_type_id[0]);
			return errors;
		},
		patentErrors() {
			const errors = [];
			if (!this.$v.form.patent.$dirty) return errors;
			!this.$v.form.patent.required && errors.push("Es requerido");
            if (this.validServer && "patent" in this.validServer) errors.push(this.validServer.patent[0]);
			return errors;
		},
		priceErrors() {
			const errors = [];
			if (!this.$v.form.price.$dirty) return errors;
			!this.$v.form.price.required && errors.push("Es requerido");
            if (this.validServer && "price" in this.validServer) errors.push(this.validServer.price[0]);
			return errors;
		},
		statusVehicleCodeErrors() {
			const errors = [];
			if (!this.$v.form.status_vehicle_code.$dirty) return errors;
			!this.$v.form.status_vehicle_code.required && errors.push("Es requerido");
            if (this.validServer && "status_vehicle_code" in this.validServer) errors.push(this.validServer.status_vehicle_code[0]);
			return errors;
		},
		obsErrors() {
			const errors = [];
			if (!this.$v.form.obs.$dirty) return errors;
			!this.$v.form.obs.required && errors.push("Es requerido");
            if (this.validServer && "obs" in this.validServer) errors.push(this.validServer.obs[0]);
			return errors;
		},
	},
	methods: {
		...mapActions(["message"]),
		showFormSelected(){
			this.dialogSelect = true;
		},
		isSelected(item) {
			this.form.freight_id = item.id;
			this.dialogSelect = false;
			this.freightName = item.name;
		},
        resetForm(){
            this.loadingPage = false;
			this.form.id = null;
			this.$refs.form.reset();
			this.$v.$reset();
        },
		closeForm() {
			this.resetForm();
			this.$emit("showForm");
		},
        refresData(){
            this.resetForm();
			this.$emit("refresData");
        },
		getDataForm() {
			let StrInputs = "";
			for (const key in this.form) StrInputs += this.form[key];
			return StrInputs;
		},
		setData(item) {
			for (const key in this.form) this.form[key] = item[key]
			this.freightName = item.freight.name;
			this.validChangeInput = this.getDataForm();
		},
        afterExecute(){
            this.loadingPage = false;
            this.message();
            this.refresData();
        },
		async save() {
			this.$v.$touch();
			if (this.$v.$invalid) return;

			if (this.validChangeInput == this.getDataForm()) {
				this.message({type:"warning", message:"No existen cambios"});
				return;
			}

			const msg = this.form.id
				? `¿Seguro desea actualizar el registro # ${this.form.id} `
				: "¿Seguro desea crear el registro?";
			const res = await this.$confirm(msg);
			if (!res) return;

			try {
				this.loadingPage = true;
				let input = structuredClone(this.form);
				let url = `/api/admin/vehicle/update`;

				if (!this.form.id){
					url = `/api/admin/vehicle/create`;
					delete input.id;
				}

				await this.$_executePost({
					url: url,
					data: input
				});

				this.afterExecute();

			} catch (e) {
				this.loadingPage = false;
				if (e.response && e.response.status == 422) {
                    this.message({
                        type: "warning",
                        message: "Registro invalido"
                    });
                    this.validServer = e.response.data.errors;
				}
				this.loadingPage = false;
			}
		},
		clearValidServer(field) {
			delete this.validServer[field];
		}
	}
};
</script>
