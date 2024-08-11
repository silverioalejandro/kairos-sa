import Balances from "../views/balances/Balances";

export default [
	{
		path: "/balances",
		name: "Balances",
		component: Balances,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
