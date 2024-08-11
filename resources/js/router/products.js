import Products from "../views/products/Products";

export default [
	{
		path: "/products",
		name: "Products",
		component: Products,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	}
];
