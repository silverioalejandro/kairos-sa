<template>
  <v-list-group no-action>
    <template v-slot:activator>
      <v-list-item-icon class="mr-4">
        <v-icon>{{ item.icon }}</v-icon>
      </v-list-item-icon>

      <v-list-item-content>
        <v-list-item-title>
          {{ item.text }}
        </v-list-item-title>
      </v-list-item-content>
    </template>

    <div v-for="(subMenu, i) in item.subMenu" :key="i">
      <router-link :to="subMenu.to" v-slot="{
					href,
					route,
					navigate
				}">
        <v-list-item :href="href" @click="navigate">
          <v-list-item-content class="ml-6">
            <v-list-item-title class="ml-6" v-text="subMenu.text"></v-list-item-title>
          </v-list-item-content>
          <v-list-item-action>
            <v-icon v-text="subMenu.icon"></v-icon>
          </v-list-item-action>
        </v-list-item>
      </router-link>
    </div>
  </v-list-group>
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
