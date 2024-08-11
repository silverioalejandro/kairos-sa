<template>
	<v-container fluid>
		<v-row align="center" justify="center">
            <v-overlay :value="loadingPage">
                <v-progress-circular
                    indeterminate
                    color="primary"
                    size="70"
                ></v-progress-circular>
            </v-overlay>
			<v-col cols="12" sm="8" md="4">
				<v-card class="elevation-12">
					<v-toolbar color="primary" dark flat>
						<v-toolbar-title class="ml-3">Login</v-toolbar-title>
						<v-spacer />
					</v-toolbar>
					<v-card-text>
						<v-form ref="form">
							<v-text-field
								label="Email"
								name="email"
								v-model.trim="form.email"
								prepend-icon="mdi-account-key"
								type="text"
								:error-messages="emailErrors"
								@input="$v.form.email.$touch()"
								@blur="$v.form.email.$touch()"
							/>

							<v-text-field
								label="Password"
								name="password"
								v-model.trim="form.password"
								prepend-icon="mdi-key-variant"
								type="password"
								:error-messages="passwordErrors"
								@input="$v.form.password.$touch()"
								@blur="$v.form.password.$touch()"
							/>
						</v-form>
					</v-card-text>
					<v-card-actions>
						<v-spacer />
						<v-btn color="primary" dark @click.prevent="loginHandler">
							Login
						</v-btn>
					</v-card-actions>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import { required, email, minLength } from "vuelidate/lib/validators";
import { mapActions } from "vuex";

export default {
	data: () => ({
        loadingPage: false,
		valid: true,
		form: {
			email: null,
			password: null,
		},
	}),
	validations: {
		form: {
			email: {
				required,
				email,
			},
			password: {
				required,
				minLength: minLength(4),
			},
		},
	},
	computed: {
		emailErrors() {
			const errors = [];
			if (!this.$v.form.email.$dirty) return errors;

			!this.$v.form.email.required && errors.push("This field is required");
			!this.$v.form.email.email && errors.push("Debe ser de tipo email");

			return errors;
		},
		passwordErrors() {
			const errors = [];
			if (!this.$v.form.password.$dirty) return errors;

			!this.$v.form.password.required && errors.push("This field is required");
			!this.$v.form.password.minLength &&
				errors.push("Debe tener más de 4 dígitos");
			return errors;
		},
	},
	methods: {
		...mapActions(["login", "message"]),
		async loginHandler() {
			this.$v.$touch();
			if (this.$v.$invalid) return;
			this.loadingPage = true;
			await this.login(this.form)
				.then(() => {
                    this.loadingPage = false;
					window.open("/", "_self");
				})
				.catch((e) => {
                    this.loadingPage = false;
					if (e.response && e.response.status == 401) {
						this.message({ type: "error", message: e.response.data.error });
					}
				});
		},
	}
};
</script>
