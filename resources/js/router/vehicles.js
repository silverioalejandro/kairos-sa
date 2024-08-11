import Vehicles from "../views/vehicles/Vehicles";

export default [
	{
		path: "/vehicles",
		name: "Vehicles",
		component: Vehicles,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
