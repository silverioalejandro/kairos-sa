import Contacs from "../views/contacs/Contacs";

export default [
    {
        path: "/contacs",
        name: "Contactos",
        component: Contacs,
        meta: {
            root: true,
            requiresAuth: true,
            role: []
        }
    }
];