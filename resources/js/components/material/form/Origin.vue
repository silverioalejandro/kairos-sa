<template>
	<div>
		<v-chip class="black--text text--darken-1" :color="isColor()" text small>
			<v-icon v-if="icon">{{ isIcon() }}</v-icon>
			{{ originName() }}
		</v-chip>
	</div>
</template>

<script>
export default {
	name: "Origin",
	props: {
		originId: {
			type: null | Number,
			required: true,
		},
		icon: {
			type: Boolean,
			default: false,
		},
	},
	data: () => ({
		name: null,
		color: null,
		origins: {},
	}),
	methods: {
		originName() {
			if (!this.originId) return null;

			const data = this.origins.find((item) => item.id == this.originId);
			if (!data) return "Not assigned";
			return data.name;
		},
		isColor() {
			if (!this.originId) return null;
			const data = this.origins.find((item) => item.id == this.originId);
			if (!data) return "blue-grey lighten-4";
			return data.color;
		},
		isIcon() {
			if (!this.originId) return null;
			const data = this.origins.find((item) => item.id == this.originId);
			if (!data) return "";
			return data.icon;
		},
	},
	created() {
		this.origins = this.$_origins();
	},
};
</script>
