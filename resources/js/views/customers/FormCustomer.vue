<template>
	<div>
		<v-dialog v-model="dialog" persistent width="1100px">
			<v-card>
				<v-card-title class="headline">{{ saveTitle }} Cliente</v-card-title>
				<v-card-text>
					<v-container>
                        <material-form-loading-page :loadingPage="loadingPage"/>
						<v-form ref="form" v-model="valid" lazy-validation>
							<v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Nombre"
										v-model.trim="$v.form.name.$model"
										:error-messages="nameErrors"
										@change="$v.form.name.$touch()"
										@blur="$v.form.name.$touch()"
										@keydown="clearValidServer('name')"
										maxlength="50"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Dni"
										v-model.trim="$v.form.identification_number.$model"
										:error-messages="identificationNumberErrors"
										@change="$v.form.identification_number.$touch()"
										@blur="$v.form.identification_number.$touch()"
										@keydown="clearValidServer('identification_number')"
										maxlength="20"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="80"
										prepend-inner-icon="mdi-email-send-outline"
										label="Email"
										v-model.trim="$v.form.email.$model"
										:error-messages="emailErrors"
										@change="$v.form.email.$touch()"
										@blur="$v.form.email.$touch()"
										maxlength="80"
										@keydown="clearValidServer('email')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Teléfono"
										v-model.trim="$v.form.cellphone.$model"
										:error-messages="cellphoneErrors"
										@change="$v.form.cellphone.$touch()"
										@blur="$v.form.cellphone.$touch()"
										@keydown="clearValidServer('cellphone')"
										maxlength="50"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Dirección"
										v-model.trim="$v.form.address.$model"
										:error-messages="addressErrors"
										@change="$v.form.address.$touch()"
										@blur="$v.form.address.$touch()"
										@keydown="clearValidServer('address')"
										maxlength="50"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Provincia"
										v-model.trim="$v.form.province.$model"
										:error-messages="provinceErrors"
										@change="$v.form.province.$touch()"
										@blur="$v.form.province.$touch()"
										@keydown="clearValidServer('province')"
										maxlength="50"
									></v-text-field>
								</v-col>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Barrio"
										v-model.trim="$v.form.neighborhood.$model"
										:error-messages="neighborhoodErrors"
										@change="$v.form.neighborhood.$touch()"
										@blur="$v.form.neighborhood.$touch()"
										@keydown="clearValidServer('neighborhood')"
										maxlength="50"
									></v-text-field>
								</v-col>
								<v-col>
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="Estado"
										item-value="id"
										:items="getFilterResources.statusCustomer"
										v-model="$v.form.status_customer_code.$model"
										:error-messages="statusCustomerCodeErrors"
										:return-object="false"
										@blur="$v.form.status_customer_code.$touch()"
										@change="$v.form.status_customer_code.$touch()"
									></v-autocomplete>
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
import { required, email } from "vuelidate/lib/validators";

export default {
	name: "FormCustomer",
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
			name: { required },
			email: { email },
			cellphone: { required },
			address: { required },
			province: { required },
			neighborhood: { required },
			identification_number: { required },
			status_customer_code: { required },
		}
	},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
		form: {
			id: null,
			name: null,
			email: null,
			cellphone: null,
			address: null,
			province: null,
			neighborhood: null,
			identification_number: null,
			status_customer_code: 101
		}
	}),
	computed: {
		...mapGetters(["getFilterResources"]),
        nameErrors() {
			const errors = [];
			if (!this.$v.form.name.$dirty) return errors;
			!this.$v.form.name.required && errors.push("Es requerido");
            if (this.validServer && "name" in this.validServer) errors.push(this.validServer.name[0]);
			return errors;
		},
        identificationNumberErrors() {
			const errors = [];
			if (!this.$v.form.identification_number.$dirty) return errors;
			!this.$v.form.identification_number.required && errors.push("Es requerido");
            if (this.validServer && "identification_number" in this.validServer) errors.push(this.validServer.identification_number[0]);
			return errors;
		},
		emailErrors() {
			const errors = [];
			if (!this.$v.form.email.$dirty) return errors;
			!this.$v.form.email.required && errors.push("Es requerido");
			!this.$v.form.email.email && errors.push("Debe ser de tipo email");
            if (this.validServer && "email" in this.validServer) errors.push(this.validServer.email[0]);
			return errors;
		},
		cellphoneErrors() {
			const errors = [];
			if (!this.$v.form.cellphone.$dirty) return errors;
			// !this.$v.form.cellphone.required && errors.push("Es requerido");
            if (this.validServer && "cellphone" in this.validServer) errors.push(this.validServer.cellphone[0]);
			return errors;
		},
		addressErrors() {
			const errors = [];
			if (!this.$v.form.address.$dirty) return errors;
			!this.$v.form.address.required && errors.push("Es requerido");
            if (this.validServer && "address" in this.validServer) errors.push(this.validServer.address[0]);
			return errors;
		},
		provinceErrors() {
			const errors = [];
			if (!this.$v.form.province.$dirty) return errors;
			!this.$v.form.province.required && errors.push("Es requerido");
            if (this.validServer && "province" in this.validServer) errors.push(this.validServer.province[0]);
			return errors;
		},
		neighborhoodErrors() {
			const errors = [];
			if (!this.$v.form.neighborhood.$dirty) return errors;
			!this.$v.form.neighborhood.required && errors.push("Es requerido");
            if (this.validServer && "neighborhood" in this.validServer) errors.push(this.validServer.neighborhood[0]);
			return errors;
		},
		statusCustomerCodeErrors() {
			const errors = [];
			if (!this.$v.form.status_customer_code.$dirty) return errors;
			!this.$v.form.status_customer_code.required && errors.push("Es requerido");
            if (this.validServer && "status_customer_code" in this.validServer) errors.push(this.validServer.status_customer_code[0]);
			return errors;
		},
	},
	methods: {
		...mapActions(["message"]),
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
				let url = `/api/admin/customer/update`;

				if (!this.form.id){
					url = `/api/admin/customer/create`;
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
