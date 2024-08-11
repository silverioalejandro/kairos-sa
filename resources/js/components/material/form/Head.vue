<template>
    <v-row>
        <v-col>
            <v-card-actions>
                <h4 class="headline">{{title}}</h4>
                <v-spacer></v-spacer>
                <slot name="buttonlink">
                </slot>
            </v-card-actions>
        </v-col>
    </v-row>
</template>

<script>
export default {
	name: "Head",
	props: {
		title: {
			type: String,
			required: true
		}
	}
};
</script>
