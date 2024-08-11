import ImageTemplate from "../views/imageTemplate/ImageTemplate";

export default [
	{
		path: "/image-template",
		name: "ImageTemplate",
		component: ImageTemplate,
		meta: {
			root: true,
			requiresAuth: true,
			role: [1]
		}
	}
];
