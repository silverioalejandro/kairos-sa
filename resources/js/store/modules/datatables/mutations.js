export default {
    SET_STATE_DATATABLE_VIEW(state, data){
        Object.entries(data.data).forEach(([k, v]) => {
            if(state.views[data.view] == undefined){
                state.views[data.view] = {};
            }
            state.views[data.view][k] = v;
        });
    }
}
