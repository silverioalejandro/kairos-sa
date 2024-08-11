import Brother from "../views/brother/brother";

export default [
    {
        path: "/brother",
        name: "Hermano",
        component: Brother,
        meta: {
            root: true,
            requiresAuth: true,
            role: []
        }
    }
];