<template>
    <v-row >
        <v-col>
            <v-skeleton-loader ref="skeleton" type="table" class="mx-auto" v-if="loading">
            </v-skeleton-loader>
        </v-col>
    </v-row>
</template>

<script>
export default {
	name: "Loading",
    props: {
		loading: {
			type: Boolean,
			required: true
		}
	}
};
</script>
