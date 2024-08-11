import Dashboard from "../views/dashboard/Dashboard";

export default [
	{
		path: "/",
		name: "dashboard",
		component: Dashboard,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
