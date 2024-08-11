<template>
	<div>
		<selected :isSelected="true" @selected="selected"/>
	</div>
</template>

<script>
import Selected from '../customers/Customers.vue';

export default {
	name: "SelectCustomer",
	components: {Selected},
	methods: {
		selected(item){
			this.$emit("isSelected", item);
		}
	}
};
</script>
