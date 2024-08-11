<template>
	<div>
		<customer :isSelectCustomer="true" @selectedCustomer="selectedCustomer"/>
	</div>
</template>

<script>
import Customer from '../../customers/Customers.vue';

export default {
	name: "SelectCustomer",
	components: {Customer},
	data: () => ({
	}),
	methods: {
		selectedCustomer(item){
			this.$emit("selectedCustomer", item);
		}
	}
};
</script>
