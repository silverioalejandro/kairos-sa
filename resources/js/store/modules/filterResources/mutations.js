export default {
	SET_DATA_FILTER_RESOURCES(state, data) {
		state.getFilterResources = data;
	},
    SET_DATA_FILTER_RESOURCES_TEMPLATE_TYPES(state, data){
        const templateTypes = { templateType: data };
        state.getFilterResources =  { ...state.getFilterResources, ...templateTypes };
    },
    SET_DATA_FILTER_RESOURCES_TEMPLATE_ADM(state, data){
        const templateAdm = { templateAdm: data };
        state.getFilterResources =  { ...state.getFilterResources, ...templateAdm };
    },
    SET_DATA_FILTER_RESOURCES_DOMAINS(state, data){
        const domains = { domains: data };
        state.getFilterResources =  { ...state.getFilterResources, ...domains };
    }
};