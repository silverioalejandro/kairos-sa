<template>
    <v-overlay :value="loadingPage">
        <v-progress-circular
            indeterminate
            color="primary"
            size="70"
        ></v-progress-circular>
	</v-overlay>
</template>

<script>
export default {
	name: "loadingPage",
	props: {
		loadingPage: {
			type: Boolean,
			required: true
		}
	}
};
</script>
