<template>
	<div>
        <v-row justify="center">
            <v-dialog
                v-model="dialog"
                scrollable
                max-width="300px"
            >
                <template #activator="{ on: dialog }">
                    <v-tooltip bottom>
                        <template #activator="{ on: tooltip }">
                            <v-btn
                                v-on="{ ...tooltip, ...dialog }"
                                class="elevation-3 mx-2"
                                fab
                                text
                                outlined
                                small
                                color="primary"
                            >
                                <v-icon class="mdi-30px">mdi-eye-settings-outline</v-icon>
                            </v-btn>
                        </template>
                        <span>Show/Hide column</span>
                    </v-tooltip>
                </template>

                <v-card>
                    <v-card-title>Show/Hide column</v-card-title>
                    <v-divider class="mb-3"></v-divider>
                    <v-card-text style="height: 300px;">
                        <div class="mt-0 py-0" v-for="header in headers" :key="header.value">
                            <v-checkbox
                                class="my-0 py-0"
                                dense
                                :label="header.text" v-model="header.showColumn"
                            ></v-checkbox>
                        </div>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <v-btn
                            v-if="!showSelectAllComputed"
                            color="primary darken-6"
                            text
                            @click="selectAll"
                        >
                            select all
                        </v-btn>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="primary darken-1"
                            text
                            @click="dialog = false"
                        >
                            Close
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-row>
    </div>
</template>

<script>
export default {
	name: "ShoeHideColumns",
	props: {
		fields: {
			type: Array,
			required: true
		}
	},
	data: () => ({
        item:null,
		dialogm1: '',
        checkbox: true,
        dialog: false,
        headers: []
	}),
	computed: {
        showSelectAllComputed(){
            return this.headers.every(item => item.showColumn == true);
        }
	},
    methods:{
        selectAll(){
            this.headers.map(item => item.showColumn = true);
        }
    },
    created(){
        this.headers = this.fields;
    }
};
</script>
