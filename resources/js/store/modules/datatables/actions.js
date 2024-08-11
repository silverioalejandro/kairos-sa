import axios from "axios";

export default{
    fetchData(_, options) {
        return new Promise((resolve, reject) => {
			axios.post(options.pathApi, options.params)
            .then(rs => {
                resolve(rs.data);
            })
            .catch(e => {
                reject(e);
            });
		});
	},
    setDatatableView({ commit }, options) {
        commit("SET_STATE_DATATABLE_VIEW", options);
    },
}
