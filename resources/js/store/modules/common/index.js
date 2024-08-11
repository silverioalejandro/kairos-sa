import axios from "axios";

export default {
	state: {
		asset_url: window.ASSET_URL,
		drawer: false,
		dark: false,
		appName: process.env.MIX_APP_NAME,
		barColor: process.env.MIX_BAR_COLOR,
		barColorDarkMode: process.env.MIX_BAR_COLOR_DARK
	},
	getters: {
		assetUrl: state => state.asset_url,
		darkModeOn: state => state.dark,
		drawerOn: state => state.drawer,
		getAPPName: state => state.appName,
		getBarColor: state => state.barColor,
		getBarColorDarkMode: state => state.barColorDarkMode
	},
	mutations: {
		SET_DARK(state, darkModeOn) {
			state.dark = darkModeOn;
		},
		SET_DRAWER(state, drawer) {
			state.drawer = drawer;
		}
	},
	actions: {
		setDarkMode({ commit }, darkModeOn) {
			this.dark = darkModeOn;
			commit("SET_DARK", this.dark);
		},
		switchDrawer({ commit }) {
			this.drawer = !this.drawer;
			commit("SET_DRAWER", this.drawer);
		},
		exportFile(_, data) {
            return new Promise((resolve, reject) => {
                axios({
                    url: data.url,
                    data: data.filters,
                    method: "POST",
                    responseType: "blob",
                    headers: { Accept: "application/vnd.ms-excel" }
                })
                    .then(response => {
                        const url = window.URL.createObjectURL(
                            new Blob([response.data], {
                                type: "application/vnd.ms-excel"
                            })
                        );
                        const link = document.createElement("a");

                        link.href = url;
                        link.setAttribute("download", data.nameFile);
                        document.body.appendChild(link);
                        link.click();
                        resolve();
                    })
                    .catch(e => {
                        reject(e);
                    });
            });
        },
		
	}
};
