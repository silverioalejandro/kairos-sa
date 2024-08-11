<template>
    <div>
        <router-link :to="link">
		<v-btn class="elevation-3 mr-2 ml-2" large color="primary">
			<v-icon class="white--text mr-2" small>
                {{nameIcon}}
			</v-icon>
			{{title}}
		</v-btn>
		</router-link>
    </div>
</template>

<script>
export default {
	name: "HeadButtonLink",
	props: {
		title: {
			type: String,
			required: true
		},
		nameIcon: {
			type: String,
			default: undefined
		},
		link: {
			type: String,
			default: undefined
		}
	}
};
</script>
