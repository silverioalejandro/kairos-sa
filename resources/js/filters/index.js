import Vue from "vue";

Vue.filter("formatPrice", value => {
	const val = (value / 1).toFixed(2).replace(".", ",");
	return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

Vue.filter("formatNumber", value => {
	const val = (value / 1).toFixed(0).replace(".", ",");
	return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

Vue.filter("formatNumberDecimals", value => {
	const val = (value / 1).toFixed(2);
	return val.toString()
});

Vue.filter("formatDate", (date, outPutFormat) => {
	if (!date) return null;
	return moment(date).format(outPutFormat);
});

Vue.filter("pretty", value => {
	return JSON.stringify(value, null, 2);
});

Vue.filter("iconBrowser", agent => {
	if (agent == "Google Chrome" || agent == "Chrome") return "mdi-google-chrome";
	if (agent == "Mobile Safari" || agent == "Safari")
		return "mdi-apple-safari";
	if (agent == "Firefox") return "mdi-firefox";
	if (agent == "Internet Explorer") return "mdi-internet-explorer";
	if (agent == "Android Browser") return "mdi-android-head";
	if (agent == "Opera") return "mdi-opera";
	return "mdi-comment-search-outline";
});

Vue.filter("iconDevice", kind => {
	if (kind == "Computer") return "mdi-laptop-mac";
	return "mdi-cellphone-iphone";
});

Vue.filter("iconPlatform", platform => {
	if (platform == "Windows") return "mdi-windows-classic";
	if (platform == "AndroidOS") return "mdi-android-head";
	if (platform == "iOS") return "mdi-apple-ios";
	if (platform == "Linux") return "mdi-linux";
	if (platform == "OS X") return "mdi-apple";
	return "mdi-comment-search-outline";
});
