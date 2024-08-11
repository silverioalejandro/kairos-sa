<template>
	<v-app-bar app clipped-left :color="barColor" dark>
		<v-app-bar-nav-icon v-if="isLoggedIn" @click.stop="resetPassword" />
		<v-toolbar-title>{{getAPPName}}</v-toolbar-title>
		<v-spacer></v-spacer>

		<!-- <v-btn class="mr-3" @click.stop="resetPassword" icon >
			<v-icon>mdi-cloud-lock-outline</v-icon>
        </v-btn> -->

		<!-- <v-dialog v-model="dialogPassword" persistent max-width="400" v-if="isLoggedIn">
			<template v-slot:activator="{ on, attrs }">
				<v-btn text v-bind="attrs" v-on="on">
					<v-icon>mdi-cloud-lock-outline</v-icon>
				</v-btn>
			</template>
			<v-card>
                <v-toolbar
                    color="primary"
                    dark
                >
                    <v-icon class="mr-2">mdi-exit-run</v-icon>
                    <b>
                        Reiniciar password
                    </b>
                </v-toolbar>
				<v-card-title>
					Para modificar el password, debe ingresar el password actual.
				</v-card-title>
				<v-card-actions>
					<v-row>
						<v-col>
							<v-text-field
								:counter="50"
								prepend-inner-icon="mdi-pound"
								label="Password"
								maxlength="20"
								v-model.trim="$v.password.$model"
								:error-messages="passwordErrors"
								@change="$v.password.$touch()"
								@blur="$v.password.$touch()"
							></v-text-field>
						</v-col>
					</v-row>

					<v-row>
						<v-col>
							<v-btn color="green darken-1" outlined text @click="logoutOperator">
								Yes
							</v-btn>
						</v-col>
					</v-row>
				</v-card-actions>
			</v-card>
		</v-dialog> -->

		<v-switch
			v-model="$vuetify.theme.dark"
			hide-details
			inset
			append-icon="mdi-theme-light-dark"
			@change="setDarkMode($vuetify.theme.dark)"
		></v-switch>

		<v-dialog v-model="dialog" persistent max-width="400" v-if="isLoggedIn">
			<template v-slot:activator="{ on, attrs }">
				<v-btn text v-bind="attrs" v-on="on">
					<v-icon>mdi-power</v-icon>
				</v-btn>
			</template>
			<v-card>
                <v-toolbar
                    color="primary"
                    dark
                >
                    <v-icon class="mr-2">mdi-exit-run</v-icon>
                    <b>
                        Confirmation
                    </b>
                </v-toolbar>
				<v-card-title>
					Are you sure you want to exit the app?
				</v-card-title>
				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red darken-1" outlined text @click="dialog = false">
						No
					</v-btn>
					<v-btn color="green darken-1" outlined text @click="logoutOperator">
						Yes
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</v-app-bar>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
	data: () => ({
		dialog: false,
		dialogPassword: false,
		password: null
	}),
	methods: {
		...mapActions(["setDarkMode", "switchDrawer", "logout"]),
		logoutOperator: function() {
			this.dialog = false;
			this.logout();
		},
		resetPassword(){
			console.log("vamos a reiniciar el password");
		}
	},
	computed: {
		...mapGetters(["darkModeOn", "isLoggedIn", "getAPPName", "getBarColor", "getBarColorDarkMode"]),
		barColor: function() {
			if (this.$vuetify.theme.dark) {
				return "#050a0b";
			}
			return "primary";
		},
		passwordErrors() {
			const errors = [];
			if (!this.$v.password.$dirty) return errors;
			!this.$v.password.required && errors.push("Es requerido");
            if (this.validServer && "password" in this.validServer) errors.push(this.validServer.password[0]);
			return errors;
		},
	},
	mounted() {
		this.$vuetify.theme.dark = this.darkModeOn;
	}
};
</script>
