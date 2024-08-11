<template>
    <div>
        <template v-if="active">
            <v-icon color="success">
                mdi-check-box-outline
            </v-icon>
        </template>
        <template v-else>
            <v-icon>mdi-checkbox-blank-outline</v-icon>
        </template>
    </div>
</template>

<script>
export default {
	name: "Active",
	props: {
		active: {
			type: Boolean,
			required: true
		}
	}
};
</script>
