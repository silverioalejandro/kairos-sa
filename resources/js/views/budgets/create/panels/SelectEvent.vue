<template>
	<div>
		<selected :isSelected="true" @selected="selected"/>
	</div>
</template>

<script>
import Selected from '../../../events/Events.vue';

export default {
	name: "SelectEvent",
	components: {Selected},
	methods: {
		selected(item){
			this.$emit("isSelected", item);
		}
	}
};
</script>
