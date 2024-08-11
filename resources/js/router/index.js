import Vue from "vue";
import Router from "vue-router";

import Login from "./login";

import store from "../store";
import Dashboard from "./dashboard";
import Customers from "./customers";
import Products from "./products";
import Freights from "./freights";
import Vehicles from "./vehicles";
import Events from "./events";
import Budgets from "./budgets";
import Contacs from "./contacs";
import Mom from "./mom";
import Brother from "./brother";
import Hector from "./hector";

Vue.use(Router);

let routes = [
	...Login,
	...Dashboard,
	...Customers,
	...Products,
	...Freights,
	...Vehicles,
	...Events,
	...Budgets,
	...Contacs,
	...Mom,
	...Brother,
	...Hector
];

let router = new Router({
	mode: "history",
	routes
});

router.beforeEach((to, from, next) => {
	if (!to.matched.some(record => record.meta.requiresAuth)) {
		next();
		return;
	}
	if (!store.getters.isLoggedIn) {
		next("/login");
		return;
	}
	if (!to.hasOwnProperty("meta")) {
		next();
		return;
	}
	if (!to.meta.hasOwnProperty("root") && !to.meta.root) {
		store.commit("set_back_route_navigation", from);
		next();
		return;
	}
	store.commit("clear_back_route_navigation");
	next();
});


export default router;
