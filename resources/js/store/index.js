import Vue from "vue";
import Vuex from "vuex";
import appNavigation from "./modules/appNavigation";

import auth from "./modules/auth";
import common from "./modules/common";
import filterResources from "./modules/filterResources";
import datatables from "./modules/datatables";
import message from "./modules/message";


import createPersistedState from "vuex-persistedstate";
import SecureLS from "secure-ls";
import budget from "./modules/budget";

const ls = new SecureLS({ isCompression: false });

Vue.use(Vuex);

let initialState = {
	appNavigation: appNavigation.state,
	auth: auth.state,
	common: common.state,
};

export default new Vuex.Store({
	modules: {
		appNavigation,
		auth,
		common,
        filterResources,
        datatables,
        message,
		budget,
	},
	mutations: {
		reset(state) {
			Object.keys(state).forEach(key => {
				Object.assign(state[key], initialState[key]);
			});
		}
	},
	plugins: [
		createPersistedState({
			storage: {
				getItem: key => ls.get(key),
				setItem: (key, value) => ls.set(key, value),
				removeItem: key => ls.remove(key)
			}
		})
	]
});
