export default {
	SHOW_MESSAGE(state, properties) {
		state.show = true;
		state.type = (properties != undefined && properties.type !== undefined) ? properties.type : "success";
		state.timeout = (properties != undefined && properties.timeout !== undefined) ? properties.timeout : 5000;
		state.message = (properties != undefined && properties.message !== undefined) ? properties.message : "Processed successfully";
		state.icon = (properties != undefined && properties.icon !== undefined) ? properties.icon : null;
		state.title = (properties != undefined && properties.title !== undefined) ? properties.title : null;
	},
	HIDE_MESSAGE(state) {
		state.show = false;
	}
};
