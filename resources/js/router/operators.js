import Operators from "../views/operators/Operators";

export default [
	{
		path: "/operators",
		name: "Operadores",
		component: Operators,
		meta: {
			root: true,
			requiresAuth: true,
			role: [1]
		}
	}
];
