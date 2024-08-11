<template>
    <v-tooltip v-if="isVisible" bottom>
        <template v-slot:activator="{ on, attrs }">

            <v-badge
                :content="countBadge"
                :value="countBadge"
                color="primary"
                overlap
            >
                <v-btn
                    v-bind="attrs"
                    v-on="on"
                    class="elevation-3 mx-2"
                    outlined
                    small
                    fab
                    text
                    color="primary"
                    @click="action"
                >
                    <v-icon class="mdi-30px">{{icon}}</v-icon>
                </v-btn>
            </v-badge>
        </template>
        <span>{{actionName}}</span>
    </v-tooltip>
</template>

<script>
export default {
	name: "Actions",
	props: {
		isVisible: {
			type: Boolean,
			required: true
		},
        icon: {
			type: String,
			required: true
		},
        actionName: {
			type: String,
			required: true
		},
        countBadge: {
            type: null | Number,
            default: null
        }
	},
    methods:{
        action(){
            this.$emit("action");
        }
    }
};
</script>
