<template>
	<div>
		<v-dialog v-model="dialog" persistent width="1100px">
			<v-card>
				<v-card-title class="headline">{{ saveTitle }} operación transacción</v-card-title>
				<v-card-text>
					<v-container>
                        <material-form-loading-page :loadingPage="loadingPage"/>
						<v-form ref="form" v-model="valid" lazy-validation>

							<v-row>
								<!-- <v-col> -->
									<v-radio-group
										v-model="form.type_payment"
										row
									>
										<v-radio
											label="Egreso"
											:value="0"
										></v-radio>

										<v-radio
											label="Ingreso"
											:value="1"
										></v-radio>

										<v-text-field
											:counter="50"
											prepend-inner-icon="mdi-pound"
											label="Monto"
											type="number"
											v-model.trim="$v.form.amount.$model"
											:error-messages="amountErrors"
											@change="$v.form.amount.$touch()"
											@blur="$v.form.amount.$touch()"
											@keydown="clearValidServer('amount')"
											maxlength="50"
										>
											<template v-slot:prepend-inner>
												<v-icon :style="`color: ${selectIconAndColor.color}`">
													{{ selectIconAndColor.icon }}
												</v-icon>
											</template>
										</v-text-field>
									</v-radio-group>
								<!-- </v-col> -->

								<v-col>
									<v-menu
										v-model="paymentDateMenu"
										:close-on-content-click="false"
										:nudge-right="40"
										transition="scale-transition"
										offset-y
										min-width="290px"
									>
										<template v-slot:activator="{ on, attrs }">
											<v-text-field
												v-model="$v.form.payment_date.$model"
												:error-messages="paymentDateErrors"
												type="date"
												label="Fecha inicio"
												prepend-icon="mdi-calendar"
												readonly
												v-bind="attrs"
												v-on="on"
												hint="dd/mm/yyyy formato"
												clearable
												persistent-hint
												@blur="$v.form.payment_date.$touch()"
											></v-text-field>
										</template>
										<v-date-picker
											v-model="form.payment_date"
											@input="paymentDateMenu = false"
											locale="es-AR"
										></v-date-picker>
									</v-menu>
                                </v-col>

								<v-col>
									<v-text-field
										v-if="form.type_payment == 0"
										:counter="8"
										prepend-inner-icon="mdi-pound"
										label="Presupuesto Id."
										v-model.trim="$v.form.budget_id.$model"
										:error-messages="budgetIdErrors"
										@change="$v.form.budget_id.$touch()"
										@blur="$v.form.budget_id.$touch()"
										@keydown="clearValidServer('budget_id')"
										maxlength="8"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Observación"
										v-model.trim="$v.form.obs.$model"
										:error-messages="obsErrors"
										@change="$v.form.obs.$touch()"
										@blur="$v.form.obs.$touch()"
										@keydown="clearValidServer('obs')"
										maxlength="50"
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
import { required, numeric } from "vuelidate/lib/validators";

export default {
	name: "FormBalance",
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
			amount: { required },
			payment_date: { required },
			budget_id: {
				required,
				numeric
			},
			obs: { required },
		}
	},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		paymentDateMenu: false,
		startDateMenu: false,
		valid: false,
        validServer: [],
		form: {
			id: null,
			type_payment: 0,
			amount: null,
			payment_date: null,
			obs: null,
			budget_id: null,
		}
	}),
	computed: {
		...mapGetters(["getFilterResources"]),
		selectIconAndColor () {
			if (this.form.type_payment == 0) {
				return {icon: 'mdi-minus-circle', color: 'red'};
			}
			return { icon: 'mdi-plus-circle', color: 'green'};
        },
        amountErrors() {
			const errors = [];
			if (!this.$v.form.amount.$dirty) return errors;
			!this.$v.form.amount.required && errors.push("Es requerido");
            if (this.validServer && "amount" in this.validServer) errors.push(this.validServer.amount[0]);
			return errors;
		},
		paymentDateErrors() {
			const errors = [];
			if (!this.$v.form.payment_date.$dirty) return errors;
			!this.$v.form.payment_date.required && errors.push("Es requerido");
            if (this.validServer && "payment_date" in this.validServer) errors.push(this.validServer.payment_date[0]);
			return errors;
		},
		budgetIdErrors() {
			const errors = [];
			if (!this.$v.form.budget_id.$dirty) return errors;
			// !this.$v.form.budget_id.required && errors.push("Es requerido");
			!this.$v.form.budget_id.numeric && errors.push("Debe ser un número");
            if (this.validServer && "obs" in this.validServer) errors.push(this.validServer.budget_id[0]);
			return errors;
		},
		obsErrors() {
			const errors = [];
			if (!this.$v.form.obs.$dirty) return errors;
			!this.$v.form.obs.required && errors.push("Es requerido");
            if (this.validServer && "obs" in this.validServer) errors.push(this.validServer.obs[0]);
			return errors;
		}
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
			this.form.type_payment = item.type_payment.id;
			this.form.amount = Math.abs(item.amount);
			this.form.type_payment = item.type_payment;
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
				let url = `/api/admin/balances/update`;

				if (!this.form.id){
					url = `/api/admin/balances/create`;
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
