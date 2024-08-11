import Mom from "../views/mom/Mom";

export default [
    {
        path: "/mom",
        name: "Mamá",
        component: Mom,
        meta: {
            root: true,
            requiresAuth: true,
            role: []
        }
    }
];