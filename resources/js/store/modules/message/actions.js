export default {
	message({ commit }, params) {
		commit("SHOW_MESSAGE", params);
	},
	closeMessage({ commit }) {
		commit("HIDE_MESSAGE");
	}
};
