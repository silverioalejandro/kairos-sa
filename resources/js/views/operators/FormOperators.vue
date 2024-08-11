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

							</v-row>

							<v-row>
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
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="80"
										prepend-inner-icon="mdi-email-send-outline"
										label="Teléfono"
										v-model.trim="$v.form.cellphone.$model"
										:error-messages="cellphoneErrors"
										@change="$v.form.cellphone.$touch()"
										@blur="$v.form.cellphone.$touch()"
										maxlength="80"
										@keydown="clearValidServer('cellphone')"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row v-if="isVisiblePassword">
								<v-col>
									<v-text-field
										ref= "operators"
										:counter="80"
										prepend-inner-icon="mdi-email-send-outline"
										label="Password"
										v-model.trim="$v.form.password.$model"
										:error-messages="passwordErrors"
										@change="$v.form.password.$touch()"
										@blur="$v.form.password.$touch()"
										maxlength="20"
										@keydown="clearValidServer('password')"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="Perfil"
										item-value="id"
										:items="getFilterResources.rols"
										v-model="$v.form.role_id.$model"
										:error-messages="roleIdErrors"
										:return-object="false"
										@blur="$v.form.role_id.$touch()"
										@change="$v.form.role_id.$touch()"
									></v-autocomplete>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="Estado"
										item-value="value"
										:items="getFilterResources.statusOperator"
										v-model="$v.form.is_active.$model"
										:error-messages="isActiveErrors"
										:return-object="false"
										@blur="$v.form.is_active.$touch()"
										@change="$v.form.is_active.$touch()"
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
	name: "FormOperators",
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
			email: { required, email },
			cellphone: { required },
			password: { required },
			role_id: { required },
			is_active: { required }
		}
	},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
		isVisiblePassword: true,
		form: {
			id: null,
			name: null,
			email: null,
			cellphone: null,
			role_id: null,
			is_active: true,
			password: null,
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
			!this.$v.form.cellphone.required && errors.push("Es requerido");
            if (this.validServer && "cellphone" in this.validServer) errors.push(this.validServer.cellphone[0]);
			return errors;
		},
		passwordErrors() {
			const errors = [];
			if (!this.$v.form.password.$dirty) return errors;
			!this.$v.form.password.required && errors.push("Es requerido");
            if (this.validServer && "password" in this.validServer) errors.push(this.validServer.password[0]);
			return errors;
		},
		roleIdErrors() {
			const errors = [];
			if (!this.$v.form.role_id.$dirty) return errors;
			!this.$v.form.role_id.required && errors.push("Es requerido");
            if (this.validServer && "role_id" in this.validServer) errors.push(this.validServer.role_id[0]);
			return errors;
		},
		isActiveErrors() {
			const errors = [];
			if (!this.$v.form.is_active.$dirty) return errors;
			!this.$v.form.is_active.required && errors.push("Es requerido");
            if (this.validServer && "is_active" in this.validServer) errors.push(this.validServer.is_active[0]);
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

			this.form.password = '123456';
			this.isVisiblePassword = false;
			this.form.is_active = item.is_active == 1;
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
				let url = `/api/admin/operator/update`;

				if (!this.form.id){
					url = `/api/admin/operator/create`;
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
	},
	created(){
		console.log("this.getFilterResources");
		console.log(this.getFilterResources);
	}
};
</script>
