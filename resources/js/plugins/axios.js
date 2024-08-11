import Vue from "vue";

// Lib imports
import axios from "axios";

axios.defaults.headers.common = {
	Accept: "application/json"
};

Vue.prototype.$http = axios;
