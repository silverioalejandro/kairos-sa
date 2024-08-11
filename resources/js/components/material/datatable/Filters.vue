<template>
    <v-expansion-panels
        v-model="panel"
        multiple
        class="py-0"
    >
        <v-expansion-panel>
            <v-expansion-panel-header class="py-0">
                Filters
            </v-expansion-panel-header>
            <v-expansion-panel-content class="py-0">
                <material-datatable-filter-description :descriptions.sync="descriptions" @removeFilter="removeFilter"/>

                <v-card-text class="ma-2 py-0">
                    <slot name="filters"></slot>
                </v-card-text>

                <v-card-actions class="py-0">
                    <v-btn v-if="showRemoveFiltersComputed" class="py-1"
                    text color="primary" @click="removeFilters">
                        <v-icon class="pr-1">mdi-filter-remove</v-icon>
                        Remove filters
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn class="py-1" text color="primary" @click="filter">
                        <v-icon class="pr-1">mdi-filter</v-icon>
                        Filter
                    </v-btn>
                </v-card-actions>
                <v-overlay :value="loading">
                    <v-progress-circular indeterminate color="green"></v-progress-circular>
                </v-overlay>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>
</template>
<script>
import aliasDatatable from "../../../data/aliasDatatable.json";
import { descriptionFiltered, currentFilter } from "../../../module/HeartUiTable";
import { mapActions, mapGetters } from "vuex";

export default {
    name:"AmountFilters",
    computed: {
        ...mapGetters(["getDatatableView", "getFilterResources"]),
        showRemoveFiltersComputed(){
            const fields = this.filters;
            const isVisible = false;
            for (let field in fields){
                if(fields[field] != null) return true;
            }
            return isVisible;
        }
    },
    props: {
        storeForm: {
            type: String,
            required: true
        },
        filterFields:{
            type: Object,
            required: true
        },
        aliasFields:{
            type: null | Object,
            default: null
        },
        multipleSelectionFields: {
            type: null | Array,
            default: null
        }
    },
    data: () => ({
        alias: null,
        aliasDefault : aliasDatatable,
        panel: [0],
        filters: {},
        loading: false,
        descriptions: null,
        noSync: true
    }),
    methods: {
        ...mapActions(["setDatatableView"]),
        setDatatableViewStore(data) {
            this.setDatatableView({
                view: this.storeForm,
                data
            });
        },
        removeFilter: function(item) {
            this.filters[item.name] = null;
            this.filter();
        },
        setCurrentFilter() {
            const filtered = currentFilter(this.filters, this.multipleSelectionFields);
            this.page = 1;

            this.setDatatableViewStore({
                filters: filtered,
                page: this.page
            });

            this.descriptions = this.detailDescription(filtered);

        },
        filter: function() {
            this.setCurrentFilter();
            this.$emit("filter");
        },
        removeFilters(){
            const fields = this.filters;
            let filtersInArray = Object.entries(this.filters);

            filtersInArray = filtersInArray.map(item => {
                this.filters[item[0]] = null;
                return [ item[0], null ];
            });

            const obj = Object.fromEntries(filtersInArray);
            this.page = 1;
            this.setDatatableViewStore({
                filters: obj,
                page: this.page,
            });

            this.descriptions = this.detailDescription(this.filters);
            this.setCurrentFilter();
            this.$emit("filter");
        },
        aliasFilter() {
            return { ...this.aliasDefault, ...this.alias };
        },
        formatValueFilter(obj) {
            return this.$_formatValueFilter(obj);
        },
        getDescription(item){
            let description;
            if ('formatValueFilter' in this.$parent) {
                description = this.$parent.formatValueFilter(item);
                if (typeof description == typeof item.value) return this.formatValueFilter(item);

                return description;
            }

            return this.formatValueFilter(item);
        },
        detailDescription(filters){
            return descriptionFiltered(filters).map(item => {
                const description = this.getDescription(item);
                const alias = this.aliasFilter()[item.name];
                return { ...item, description, alias};
            });
        },
        getStatusViewFiltered() {
            const stateView = this.getDatatableView[this.storeForm];
            if (stateView != undefined && stateView.filters != undefined) {
                const fields = stateView.filters;
                for (const field in fields) {
                    this.filters[field] = fields[field];
                }

                this.descriptions = this.detailDescription(fields);

                return;
            }

            const filtered = currentFilter(this.filters, this.multipleSelectionFields);
            this.setCurrentFilter();
        }
    },
    async mounted() {
        this.filters = this.filterFields;
        this.alias = this.aliasFields ? this.aliasFields : {};
        this.getStatusViewFiltered(this.filters);
    }
};
</script>
