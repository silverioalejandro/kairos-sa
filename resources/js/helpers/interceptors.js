import axios from "axios";
import store from "../store";

export default function setup() {
	axios.defaults.headers.common = {
		Accept: "application/json",
		"Content-Type": "application/json",
		"X-Requested-With": "XMLHttpRequest"
	};

	if (store.getters.isLoggedIn) {
		axios.defaults.headers.common = {
			...axios.defaults.headers.common,
			Authorization: "Bearer " + store.getters.authToken
		};
	}

	axios.interceptors.response.use(
		success => {
			return success;
		},
		error => {
			if (error.response.status === 401) {
				store.dispatch("logout");
				return;
			}
			return Promise.reject(error);
		}
	);
}
