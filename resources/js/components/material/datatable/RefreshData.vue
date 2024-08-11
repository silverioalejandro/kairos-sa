<template>
	<div>
        <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    v-bind="attrs"
                    v-on="on"
                    class="elevation-3 mx-2"
                    small
                    fab
                    text
                    outlined
                    color="primary"
                    @click="refreshData"
                >
                    <v-icon class="mdi-30px">mdi-database-refresh</v-icon>
                </v-btn>
            </template>
            <span>Refresh</span>
        </v-tooltip>
    </div>
</template>

<script>
export default {
	name: "RefreshData",
    methods:{
        refreshData(){
            this.$emit("refreshData");
        }
    }
};
</script>
