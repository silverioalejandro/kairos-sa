import Vue from "vue";
import Vuetify from "vuetify/lib";

import VuetifyConfirm from "vuetify-confirm";

const vuetify = new Vuetify({});
Vue.config.productionTip = false;

Vue.use(Vuetify);
Vue.use(VuetifyConfirm, {
	vuetify,
	color: "info",
	icon: "mdi-android-messages",
	title: "Confirmation",
	buttonTrueText: "Continue",
	buttonFalseText: "Cancel"
});
