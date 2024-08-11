<template>
	<div>
		<selected :isSelected="true" @selected="selected"/>
	</div>
</template>

<script>
import Selected from '../../../products/Products.vue';

export default {
	name: "SelectProduct",
	components: {Selected},
	methods: {
		selected(item){
			this.$emit("isSelected", item);
		}
	}
};
</script>
