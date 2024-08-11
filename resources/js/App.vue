<template>
	<v-app id="inspire">
		<template v-if="$route.name == 'login'">
			<v-main>
				<v-container class="fill-height" fluid>
					<v-fade-transition mode="out-in">
						<router-view></router-view>
					</v-fade-transition>
				</v-container>
			</v-main>
		</template>

		<template v-else>
			<!-- <core-drawer v-if="isLoggedIn" />
			<core-toolbar @handler="handleDrawer" />
			<v-main :class="mainClass">
				<v-row v-if="hasBack" align="start">
					<router-link :to="getBackTo" v-slot="{ href, route, navigate }" alig>
						<v-icon :href="href" @click="navigate" large class="mt-2 pl-5">
							mdi-arrow-left-bold-box-outline
						</v-icon>
					</router-link>
					<h1>{{ routeName }}</h1>
				</v-row>
				<v-fade-transition mode="out-in">
					<router-view></router-view>
				</v-fade-transition>
			</v-main> -->
            <v-main>
                <core-drawer v-if="isLoggedIn" />
                <core-toolbar @handler="handleDrawer" />
                <v-card flat v-if="hasBack">
                    <v-toolbar color="blue lighten-1" dark extended flat>
                        <router-link :to="getBackTo" v-slot="{ href, route, navigate }">
                            <v-btn
                                class="ma-2"
                                outlined
                                fab
                                small
                                color="white"
                                @click="navigate"
                            >
                                <v-icon>mdi-arrow-left</v-icon>
                            </v-btn>
                        </router-link>
                    </v-toolbar>

                    <v-card
                        elevation="4"
                        class="mx-auto"
                        max-width="88%"
                        style="margin-top: -64px;"
                    >
                        <v-toolbar>
                            <v-toolbar-title>
                                {{ routeName }}
                            </v-toolbar-title>
                        </v-toolbar>

                        <v-divider></v-divider>

                        <v-card-text outlined>
                            <v-fade-transition mode="out-in">
                                <router-view></router-view>
                            </v-fade-transition>
                        </v-card-text>
                    </v-card>
                </v-card>
                <v-container fluid v-if="!hasBack">
                    <v-fade-transition mode="out-in">
                        <router-view></router-view>
                    </v-fade-transition>
                </v-container>
            </v-main>
			<v-footer app color="primary">
                <span class="white--text">&copy; 2024</span>
            </v-footer>
		</template>

		<material-message />
	</v-app>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
	name: "App",
	methods: {
		...mapActions(["switchDrawer"]),
		handleDrawer: function () {
			this.switchDrawer();
		},
	},
	computed: {
		...mapGetters([
			"getBackTo",
			"isLoggedIn",
		]),
		toolbarColor: function () {
			if (this.$vuetify.theme.dark) {
				return "grey darken-2";
			}
			return "blue lighten-4";
		},
		hasBack: function () {
			return Object.keys(this.getBackTo).length !== 0;
		},
		mainClass: function () {
			if (this.$vuetify.theme.dark) {
				return "mainDark";
			}
			return "grey lighten-2";
		},
		routeName: function () {
			let name = this.$route.name;

			Object.keys(this.$route.params).forEach((param) => {
				name = name.replace(":" + param, this.$route.params[param]);
			});

			return name;
		},
	}

};
</script>
<style lang="scss" scoped>
.v-application {
	font-family: "Quicksand", sans-serif;
}
.mainDark {
	background: #111c26;
}
</style>
