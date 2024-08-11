<template>
	<div>
		<v-dialog v-model="dialog" persistent width="1100px">
			<v-card>
				<v-card-title class="headline">{{ saveTitle }} Producto</v-card-title>
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
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										item-text="name"
										label="Categoria"
										item-value="id"
										:items="getFilterResources.categories"
										v-model="$v.form.category_code.$model"
										:error-messages="categoryCodeErrors"
										:return-object="false"
										@blur="$v.form.category_code.$touch()"
										@change="$v.form.category_code.$touch()"
									></v-autocomplete>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="20"
										prepend-inner-icon="mdi-email-send-outline"
										label="Precio"
										v-model.trim="$v.form.price.$model"
										:error-messages="priceErrors"
										@change="$v.form.price.$touch()"
										@blur="$v.form.price.$touch()"
										maxlength="20"
										@keydown="clearValidServer('price')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="20"
										prepend-inner-icon="mdi-email-send-outline"
										label="Cantidad"
										v-model.trim="$v.form.quantity.$model"
										:error-messages="quantityErrors"
										@change="$v.form.quantity.$touch()"
										@blur="$v.form.quantity.$touch()"
										maxlength="20"
										@keydown="clearValidServer('quantity')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Stock fabrica"
										v-model.trim="$v.form.quantity_factory.$model"
										:error-messages="quantityFactoryErrors"
										@change="$v.form.quantity_factory.$touch()"
										@blur="$v.form.quantity_factory.$touch()"
										@keydown="clearValidServer('quantity_factory')"
										maxlength="50"
									></v-text-field>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="20"
										prepend-inner-icon="mdi-email-send-outline"
										label="Precio cobertura"
										v-model.trim="$v.form.cover_price.$model"
										:error-messages="coverPriceErrors"
										@change="$v.form.cover_price.$touch()"
										@blur="$v.form.cover_price.$touch()"
										maxlength="20"
										@keydown="clearValidServer('cover_price')"
									></v-text-field>
								</v-col>

								<v-col>
									<v-text-field
										:counter="20"
										prepend-inner-icon="mdi-pound"
										label="Sku"
										v-model.trim="$v.form.sku.$model"
										:error-messages="skuErrors"
										@change="$v.form.sku.$touch()"
										@blur="$v.form.sku.$touch()"
										@keydown="clearValidServer('sku')"
										maxlength="20"
									></v-text-field>
								</v-col>

								<v-col>
									<v-autocomplete
										prepend-inner-icon="mdi-web"
										label="Estatus producto"
										item-text="name"
										item-value="id"
										:items="getFilterResources.statusProduct"
										v-model="$v.form.status_product_code.$model"
										:error-messages="statusProductCodeErrors"
										:return-object="false"
										@blur="$v.form.status_product_code.$touch()"
										@change="$v.form.status_product_code.$touch()"
									></v-autocomplete>
								</v-col>
							</v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="150"
										prepend-inner-icon="mdi-pound"
										label="Descripción"
										v-model.trim="$v.form.description.$model"
										:error-messages="descriptionErrors"
										@change="$v.form.description.$touch()"
										@blur="$v.form.description.$touch()"
										@keydown="clearValidServer('description')"
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

export default {
	name: "FormProduct",
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
			description: { required },
			sku: { required },
			category_code: { required },
			price: { required },
			cover_price: { required },
			quantity: { required },
			quantity_factory: { required },
			status_product_code: { required },
		}
	},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
		form: {
			name: null,
			description: null,
			sku: null,
			category_code: null,
			price: null,
			cover_price: null,
			quantity: null,
			quantity_factory: null,
			status_product_code: 201,
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
		categoryCodeErrors() {
			const errors = [];
			if (!this.$v.form.category_code.$dirty) return errors;
			// !this.$v.form.category_code.required && errors.push("Es requerido");
            if (this.validServer && "category_code" in this.validServer) errors.push(this.validServer.category_code[0]);
			return errors;
		},
		priceErrors() {
			const errors = [];
			if (!this.$v.form.price.$dirty) return errors;
			!this.$v.form.price.required && errors.push("Es requerido");
            if (this.validServer && "price" in this.validServer) errors.push(this.validServer.price[0]);
			return errors;
		},
		quantityErrors() {
			const errors = [];
			if (!this.$v.form.quantity.$dirty) return errors;
			!this.$v.form.quantity.required && errors.push("Es requerido");
            if (this.validServer && "quantity" in this.validServer) errors.push(this.validServer.quantity[0]);
			return errors;
		},
		quantityFactoryErrors() {
			const errors = [];
			if (!this.$v.form.quantity_factory.$dirty) return errors;
			!this.$v.form.quantity_factory.required && errors.push("Es requerido");
            if (this.validServer && "quantity_factory" in this.validServer) errors.push(this.validServer.quantity_factory[0]);
			return errors;
		},
		coverPriceErrors() {
			const errors = [];
			if (!this.$v.form.cover_price.$dirty) return errors;
			!this.$v.form.cover_price.required && errors.push("Es requerido");
            if (this.validServer && "cover_price" in this.validServer) errors.push(this.validServer.cover_price[0]);
			return errors;
		},
		skuErrors() {
			const errors = [];
			if (!this.$v.form.sku.$dirty) return errors;
			!this.$v.form.sku.required && errors.push("Es requerido");
            if (this.validServer && "sku" in this.validServer) errors.push(this.validServer.sku[0]);
			return errors;
		},
		statusProductCodeErrors() {
			const errors = [];
			if (!this.$v.form.status_product_code.$dirty) return errors;
			!this.$v.form.status_product_code.required && errors.push("Es requerido");
            if (this.validServer && "status_product_code" in this.validServer) errors.push(this.validServer.status_product_code[0]);
			return errors;
		},
		descriptionErrors() {
			const errors = [];
			if (!this.$v.form.description.$dirty) return errors;
			!this.$v.form.description.required && errors.push("Es requerido");
            if (this.validServer && "description" in this.validServer) errors.push(this.validServer.description[0]);
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
				let url = `/api/admin/product/update`;

				if (!this.form.id){
					url = `/api/admin/product/create`;
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
