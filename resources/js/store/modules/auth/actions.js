import axios from "axios";

import router from "./../../../router";

export default {
	async login({ commit }, user) {
		return new Promise((resolve, reject) => {
			axios
				.post("/api/admin/operators/login", user)
				.then(rs => {
					commit("LOGIN_OPERATOR", rs.data);
					axios.defaults.headers.common = {
						Authorization: "Bearer " + rs.data.token
					};
                    this.dispatch('loadAllDataFilterResources');
					router.push({ name: "dashboard" });
                    // router.go();
				})
				.catch(e => {
					reject(e);
				});
		});
	},
	logout({ commit }) {
		commit("LOGOUT_OPERATOR");
		router.push({ name: "login" });
	}
};
