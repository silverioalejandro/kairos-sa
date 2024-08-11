import Freights from "../views/freights/Freights";

export default [
	{
		path: "/freights",
		name: "Freights",
		component: Freights,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
