import Budgets from "../views/budgets/Budgets";
import BudgetDetail from "../views/budgets/BudgetDetail";
import BudgetCreate from "../views/budgets/create/FormCreateBudget";
import BudgetUpdate from "../views/budgets/update/FormUpdateBudget";
import BudgetPaids from "../views/budgets/paids/Paids";


export default [
	{
		path: "/budgets",
		name: "Budgets",
		component: Budgets,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	},
	{
		path: "/budget-detail/:id",
		name: "BudgetDetail",
		component: BudgetDetail,
		meta: {
			root: true,
			requiresAuth: true,
			role: []
		}
	},
	{
		path: "/budget/update/:id",
		name: "Actualizar presupuesto",
		component: BudgetUpdate,
		meta: {
			requiresAuth: true,
			role: []
		}
	},
	{
		path: "/budget/create",
		name: "Crear presupuesto",
		component: BudgetCreate,
		meta: {
			requiresAuth: true,
			role: []
		}
	},
	{
		path: "/budget-paids/:id",
		name: "Pagos",
		component: BudgetPaids,
		meta: {
			// root: true,
			requiresAuth: true,
			role: []
		}
	},
];
