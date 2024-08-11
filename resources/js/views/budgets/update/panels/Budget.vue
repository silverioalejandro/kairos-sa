<template>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
            <v-col>
                <v-text-field
                    label="Nro de vehículos"
                    :value="getDetailBudget.nro_vehicles | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>

            <v-col>
                <v-text-field
                    label="sub total vehículos"
                    :value="getDetailBudget.total_vehicles | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-text-field
                    label="Nro de productos"
                    :value="getDetailBudget.nro_products | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>

            <v-col>
                <v-text-field
                    label="sub total productos"
                    :value="getDetailBudget.total_products | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-text-field
                    :counter="50"
                    prepend-inner-icon="mdi-pound"
                    label="Iva %"
                    v-model.trim="$v.form.iva_percentage.$model"
                    :error-messages="ivaPercentageErrors"
                    @change="$v.form.iva_percentage.$touch()"
                    @blur="$v.form.iva_percentage.$touch()"
                    @keydown="clearValidServer('iva_percentage')"
                    maxlength="50"
                ></v-text-field>
            </v-col>

            <v-col>
                <v-text-field
                    label="Monto iva"
                    :value="ivaAmountComputed | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-text-field
                    :counter="50"
                    prepend-inner-icon="mdi-pound"
                    label="Retención %"
                    v-model.trim="$v.form.retention_percentage.$model"
                    :error-messages="retentionPercentageErrors"
                    @change="$v.form.retention_percentage.$touch()"
                    @blur="$v.form.retention_percentage.$touch()"
                    @keydown="clearValidServer('retention_percentage')"
                    maxlength="50"
                ></v-text-field>
            </v-col>

            <v-col>
                <v-text-field
                    label="Monto retención"
                    :value="retentionAmountComputed | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-text-field
                    :counter="50"
                    prepend-inner-icon="mdi-pound"
                    label="Descuento %"
                    v-model.trim="$v.form.discount_percentage.$model"
                    :error-messages="discountPercentageErrors"
                    @change="$v.form.discount_percentage.$touch()"
                    @blur="$v.form.discount_percentage.$touch()"
                    @keydown="clearValidServer('discount_percentage')"
                    maxlength="50"
                ></v-text-field>
            </v-col>

            <v-col>
                <v-text-field
                    label="Monto descuento"
                    :value="discountAmountComputed | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-autocomplete
                    prepend-inner-icon="mdi-web"
                    item-text="name"
                    label="Tipo de pago"
                    item-value="id"
                    :items="getFilterResources.paymentTypes"
                    v-model="$v.form.payment_type_code.$model"
                    :error-messages="paymentTypeCodeErrors"
                    :return-object="false"
                    @blur="$v.form.payment_type_code.$touch()"
                    @change="$v.form.payment_type_code.$touch()"
                ></v-autocomplete>
            </v-col>

            <v-col>
                <v-text-field
                    label="Monto total"
                    :value="form.total_amount | formatNumber"
                    filled
                    dense
                    readonly
                >
                </v-text-field>
            </v-col>
        </v-row>

        <v-row>
            <v-col>
                <v-autocomplete
                    prepend-inner-icon="mdi-web"
                    item-text="name"
                    label="Estado"
                    item-value="id"
                    :items="getFilterResources.statusBudget"
                    v-model="$v.form.status_budget_code.$model"
                    :error-messages="statusBudgetCodeErrors"
                    :return-object="false"
                    @blur="$v.form.status_budget_code.$touch()"
                    @change="$v.form.status_budget_code.$touch()"
                ></v-autocomplete>
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
                :disabled="$v.form.$invalid"
            >
                Guardar
            </v-btn>
        </v-card-actions>
    </v-form>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";

export default {
    name: "FormCreateBudget",
    validations: {
		form: {
			status_budget_code: { required },
			iva_percentage: { required },
			iva_amount: { required },
			retention_percentage: { required },
			discount_percentage: { required },
			total_amount: { required },
			payment_type_code: { required },
		}
	},
    props: {
        details: {
            type: null | Object,
            required: true,
        },
    },
    data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
		form: {
            nro_vehicles: null,
            total_vehicles: null,
            nro_products: null,
            total_products: null,
			iva_percentage: 0,
			iva_amount: null,
			retention_percentage: 0,
			retention_amount: null,
			discount_percentage: 0,
			discount_amount: null,
			total_amount: null,
			status_budget_code: 701,
			payment_type_code: 801,
		}
	}),
    computed: {
		...mapGetters(["getFilterResources","getBudgetToUpdate", "getDetailBudget"]),
        ivaAmountComputed(){
            this.form.iva_amount = this.getDetailBudget.total_products * this.form.iva_percentage / 100;
            this.calculateTotalAmount();
            return this.form.iva_amount;
        },
        retentionAmountComputed(){
            this.form.retention_amount = this.getDetailBudget.total_products * this.form.retention_percentage / 100;
            this.calculateTotalAmount();
            return this.form.retention_amount;
        },
        discountAmountComputed(){
            this.form.discount_amount = this.getDetailBudget.total_products * this.form.discount_percentage / 100;
            this.calculateTotalAmount();
            return this.form.discount_amount;
        },
        statusBudgetCodeErrors() {
			const errors = [];
			if (!this.$v.form.status_budget_code.$dirty) return errors;
			!this.$v.form.status_budget_code.required && errors.push("Es requerido");
            if (this.validServer && "status_budget_code" in this.validServer) errors.push(this.validServer.status_budget_code[0]);
			return errors;
		},
		ivaPercentageErrors() {
			const errors = [];
			if (!this.$v.form.iva_percentage.$dirty) return errors;
			!this.$v.form.iva_percentage.required && errors.push("Es requerido");
            if (this.validServer && "iva_percentage" in this.validServer) errors.push(this.validServer.iva_percentage[0]);
			return errors;
		},
		ivaAmountErrors() {
			const errors = [];
			if (!this.$v.form.iva_amount.$dirty) return errors;
			!this.$v.form.iva_amount.required && errors.push("Es requerido");
            if (this.validServer && "iva_amount" in this.validServer) errors.push(this.validServer.iva_amount[0]);
			return errors;
		},
		retentionPercentageErrors() {
			const errors = [];
			if (!this.$v.form.retention_percentage.$dirty) return errors;
			!this.$v.form.retention_percentage.required && errors.push("Es requerido");
            if (this.validServer && "retention_percentage" in this.validServer) errors.push(this.validServer.retention_percentage[0]);
			return errors;
		},
		discountPercentageErrors() {
			const errors = [];
			if (!this.$v.form.discount_percentage.$dirty) return errors;
			!this.$v.form.discount_percentage.required && errors.push("Es requerido");
            if (this.validServer && "discount_percentage" in this.validServer) errors.push(this.validServer.discount_percentage[0]);
			return errors;
		},
        totalAmountErrors() {
			const errors = [];
			if (!this.$v.form.total_amount.$dirty) return errors;
			!this.$v.form.total_amount.required && errors.push("Es requerido");
            if (this.validServer && "total_amount" in this.validServer) errors.push(this.validServer.total_amount[0]);
			return errors;
		},
		paymentTypeCodeErrors() {
			const errors = [];
			if (!this.$v.form.payment_type_code.$dirty) return errors;
			!this.$v.form.payment_type_code.required && errors.push("Es requerido");
            if (this.validServer && "payment_type_code" in this.validServer) errors.push(this.validServer.payment_type_code[0]);
			return errors;
		},
	},
	methods: {
		...mapActions(["message"]),
        backStep() {
            this.$emit('backStep');
        },
        calculateTotalAmount(){
            this.form.total_amount = (this.getDetailBudget.total_products + this.getDetailBudget.total_vehicles + this.form.iva_amount + this.form.retention_amount) - this.form.discount_amount;
        },
        resetForm(){
            this.loadingPage = false;
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

            console.log("this.form");
            console.log(this.form);

            this.$emit('nextStep');
		},
		clearValidServer(field) {
			delete this.validServer[field];
		}
	},
    async created() {
        const dataBudget = await this.getBudgetToUpdate;

        this.form.nro_vehicles = this.getDetailBudget.nro_vehicles;
        this.form.total_vehicles = this.getDetailBudget.total_vehicles;
        this.form.nro_products = this.getDetailBudget.nro_products;
        this.form.total_products = this.getDetailBudget.total_products;

        this.form.iva_percentage = dataBudget.iva_percentage;
        this.form.retention_percentage = dataBudget.retention_percentage;
        this.form.discount_percentage = dataBudget.discount_percentage;
        this.form.total_amount = dataBudget.total_amount;
        this.form.status_budget_code = dataBudget.status_budget_code;
        this.form.payment_type_code = dataBudget.payment_type_code;
    }
};
</script>