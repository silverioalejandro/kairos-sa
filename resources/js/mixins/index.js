import axios from "axios";

const methods = {
    $_formatPrice(value){
        const val = (value / 1).toFixed(2).replace(".", ",");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    async $_executeAxios(config) {
		return await axios.request(config);
	},
	async $_executeGet(config) {
		return await axios.get(config.url);
	},
	async $_executePost(config) {
		return await axios.post(config.url, config.data);
	},
	async $_executePut(config) {
		return await axios.executePut(config.url, config.data);
	},
	async $_executeDelete(config) {
		return await axios.delete(config.url, config.data);
	},
    $_fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            var successful = document.execCommand("copy");
            var msg = successful ? "successful" : "unsuccessful";
        } catch (err) {
            console.error("Fallback: Oops, unable to copy", err);
        }

        document.body.removeChild(textArea);
    },
    $_copyClipboard(text) {
        if (!navigator.clipboard) {
            this.$_fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(
            function () {
                console.log("Async: Copying to clipboard was successful!");
            },
            function (err) {
                console.error("Async: Could not copy text: ", err);
            }
        );
    },
    $_formatValueFilter(obj) {
        if (obj.name == "status_id") {
            return descriptionFilterOption(obj.value, this.getFilterResources.status);
        }

        if (obj.name == "bank_id") {
            return descriptionFilterOption(obj.value, this.getFilterResources.banks);
        }

        if (["active", "is_active", "is_renovation", "request_cancellation"].includes(obj.name)) {
            return obj.value ? "SI" : "NO";
        }

        if (obj.name == "referral_id") {
            return descriptionFilterOption(obj.value, this.getFilterResources.referrals);
        }

        if (["created_at", "payment_date", "updated_at"].includes(obj.name)) {
            return obj.value
                .map(item => moment(item).format("DD-MM-YYYY"))
                .join(" ~ ");
        }

        if (this.multipleSelectionFields.includes(obj.name) && !Array.isArray(obj.value)) {
            return obj.value.split(',');
        }

        return obj.value;
    },
    $_status_all() {
        const categories = [
            { id: "201", name: "Mesas", color: "yellow lighten-3", icon: "mdi-text-box-search-outline" },
            { id: "202", name: "Sillas", color: "yellow lighten-1", icon: "mdi-text-box-check-outline" },
            { id: "203", name: "Vehiculos", color: "amber lighten-3", icon: "mdi-text-box-check-outline" },
        ];

        const state = [
            { id: 1, name: 'CREATED', color: 'light-blue accent-2', icon: 'mdi-shield-check-outline' },
            { id: 2, name: 'PENDING', color: 'yellow lighten-3', icon: 'mdi-shield-refresh-outline' },
            { id: 3, name: 'GENERATED', color: 'light-green lighten-2', icon: 'mdi-shield-check-outline' },
            { id: 4, name: 'RECEIVED', color: 'teal darken-2', icon: 'mdi-check-circle-outline' },
            { id: 5, name: 'PROCESSED', color: 'yellow lighten-3', icon: 'mdi-check-circle-outline' },
            { id: 6, name: 'FINISHED', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 7, name: 'CANCELLED', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 8, name: 'EXCEPTION', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 9, name: 'RETRY', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 10, name: 'FAIL_WITH_ERRORS', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 11, name: 'SENDED', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 12, name: 'ACCREDITED', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 13, name: 'RETURN', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 14, name: 'PENDING_INFORMATION', color: 'deep-orange lighten-1', icon: 'mdi-bookmark-remove' },
            { id: 15, name: 'ERROR_IN_PROCESS', color: 'deep-orange lighten-1', icon: 'mdi-restore-alert' },
            { id: 16, name: 'REPROCESSED', color: 'deep-orange lighten-1', icon: 'mdi-restore-alert' },
            { id: 17, name: 'REPROCESSED_ERROR', color: 'deep-orange lighten-1', icon: 'mdi-restore-alert' },
        ];

        const data = {
            stateProcess: categories,
            state: state
        };
        return data;
    }
};

export default {
	methods
};
