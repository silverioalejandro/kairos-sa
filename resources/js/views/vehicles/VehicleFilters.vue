<template>
	<v-card class="mb-2">
		<material-datatable-filters
            ref="filters"
            :storeForm="storeForm"
            :filterFields="filters"
            :showSelect="true"
            @filter="filter"
            :multipleSelectionFields="multipleSelectionFields"
        >
            <template #filters>
                <v-row class="pb-0 pt-2">
                    <v-col class="py-0">
                        <v-text-field
                            dense
                            label="Id."
                            clearable
                            v-model.trim="filters.id"
                        ></v-text-field>
                    </v-col>
                    <v-col class="py-0">
                        <v-text-field
                            dense
                            label="Nombre"
                            clearable
                            v-model.trim="filters.name"
                        ></v-text-field>
                    </v-col>
                    <v-col class="py-0">
                        <v-autocomplete
                            label="Estado"
                            item-text="name"
                            item-value="id"
                            multiple
                            small-chips
                            clearable
                            dense
                            :items="getFilterResources.statusVehicle"
                            v-model="filters.status_vehicle_code"
                        ></v-autocomplete>
                    </v-col>
                </v-row>
            </template>
        </material-datatable-filters>
	</v-card>
</template>
<script>
import { descriptionFilterOption } from "../../module/HeartUiTable";
import { mapGetters } from "vuex";

export default {
    name:"VehicleFilters",
    props: {
        storeForm: {
            type: String,
            required: true
        }
    },
    data: () => ({
        panel: [0],
        multipleSelectionFields:["id"],
        filters: {
            id: null,
            name: null,
            status_vehicle_code: null,
        }
    }),
    computed: {
        ...mapGetters(["getFilterResources"])
    },
    methods: {
        filter: function() {
			this.$emit("filter");
		},
		clearFilters(){
			this.$refs.filters.removeFilters();
		},
		formatValueFilter(obj) {
			// if (obj.name == "status_id") {
			// 	return descriptionFilterOption(obj.value, this.getFilterResources.status);
			// }

			if(this.multipleSelectionFields.includes(obj.name) && !Array.isArray(obj.value)){
				return obj.value.split(',');
			}

			if (["created_at", "update_at", "due_date", "payment_date", "import_file_date"].includes(obj.name)) {
				return obj.value
					.map(item => moment(item).format("DD-MM-YYYY"))
					.join(" ~ ");
			}

			return obj.value;
		},
    },
    mounted() {
        console.log(this.getFilterResources);
    }
};
</script>