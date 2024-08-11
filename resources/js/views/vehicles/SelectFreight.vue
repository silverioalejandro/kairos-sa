<template>
	<div>
		<selected :isSelected="true" @selected="selected"/>
	</div>
</template>

<script>
import Selected from '../../views/freights/Freights.vue';

export default {
	name: "SelectFreight",
	components: {Selected},
	data: () => ({
	}),
	methods: {
		selected(item){
			this.$emit("isSelected", item);
		}
	}
};
</script>
