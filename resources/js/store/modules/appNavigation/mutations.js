export default {
	set_back_route_navigation(state, backTo) {
		setTimeout(() => {
			state.backTo = backTo;
		}, 100);
	},
	clear_back_route_navigation(state) {
		state.backTo = {};
	}
};
