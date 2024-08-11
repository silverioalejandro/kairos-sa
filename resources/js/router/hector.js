import Hector from "../views/hector/hector";

export default [
    {
        path: "/hector",
        name: "Hector",
        component: Hector,
        meta: {
            root: true,
            requiresAuth: true,
            role: []
        }
    }
];