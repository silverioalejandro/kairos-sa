export default{
	setBudgetDetails({ commit }, details) {
		commit("SET_DATA_BUDGET_DETAILS", details);
	},
	setBudgetToUpdate({ commit }, details) {
		commit("SET_DATA_BUDGET_UPDATE", details);
	}
}