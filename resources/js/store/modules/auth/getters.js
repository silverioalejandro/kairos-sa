export default {
	isLoggedIn: state => state.auth_user !== null,
	authToken: state => state.token,
	getAuthUser: state => state.auth_user,
};
