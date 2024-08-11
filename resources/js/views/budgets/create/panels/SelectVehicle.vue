<template>
	<div>
		<selected :isSelected="true" @selected="selected"/>
	</div>
</template>

<script>
import Selected from '../../../vehicles/Vehicles.vue';

export default {
	name: "SelectVehicle",
	components: {Selected},
	methods: {
		selected(item){
			this.$emit("isSelected", item);
		}
	}
};
</script>
