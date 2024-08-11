<template>
	<router-link
		:to="item.to"
		v-slot="{
			href,
			route,
			navigate
		}"
	>
		<v-list-item :href="href" @click="navigate">
			<v-list-item-icon class="mr-4">
				<v-icon>{{ item.icon }}</v-icon>
			</v-list-item-icon>
			<v-list-item-content>
				<v-list-item-title>
					{{ item.text }}
				</v-list-item-title>
			</v-list-item-content>
		</v-list-item>
	</router-link>
</template>
<script>
export default {
	props: {
		item: {
			type: Object,
			default: () => ({})
		}
	}
};
</script>
