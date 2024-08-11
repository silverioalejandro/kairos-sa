import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import VueAxios from "vue-axios";
import App from "./App.vue";
import Rollbar from 'rollbar';
import router from "./router";
import vuetify from "./plugins/vuetify";
import store from "./store";
import mixin from "./mixins";

import "./plugins";
import "./components";
import "./filters";

import interceptors from "./helpers/interceptors";

interceptors();

Vue.config.productionTip = false;
Vue.use(Vuex);
Vue.use(VueAxios, axios);
Vue.mixin(mixin);

Vue.prototype.$rollbar = new Rollbar({
    accessToken: process.env.ROLLBAR_CLIENT_TOKEN,
    captureUncaught: true,
    captureUnhandledRejections: true,
});

Vue.config.devtools = false

new Vue({
	vuetify,
	router,
	store,
	render: h => h(App)
}).$mount("#app");
