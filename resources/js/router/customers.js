import Customers from "../views/customers/Customers";

export default [
	{
		path: "/customers",
		name: "Customers",
		component: Customers,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
