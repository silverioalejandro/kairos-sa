export default {
	LOGIN_OPERATOR(state, data) {
		state.auth_user = data.user;
		state.token = data.token;
	},
	LOGOUT_OPERATOR(state) {
		state.auth_user = null;
		state.token = null;
	}
};
