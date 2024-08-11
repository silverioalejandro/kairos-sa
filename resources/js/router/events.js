import Events from "../views/events/Events";

export default [
	{
		path: "/events",
		name: "Events",
		component: Events,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
