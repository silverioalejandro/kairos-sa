<template>
    <div>
        <v-row>
            <v-col>
                <v-data-table
                    :show-select="showSelectComputed"
                    v-model="selectedRecords"
                    :single-select="false"
                    :item-key="itemKey"
                    :headers="tableHeadersComputed"
                    :items="dataTable"
                    :server-items-length="pageDetails.total" class="elevation-1 mt-0 pt-0"
                    :options.sync="tableOptions"
                    multi-sort
                    :loading="loadingDatatable"
                    loading-text="Loading... Please wait"
                    hide-default-footer
                >
                    <template v-slot:top>
						<v-toolbar flat>
							<v-toolbar-title>{{tableName}}</v-toolbar-title>
							<v-spacer></v-spacer>

                            <material-datatable-actions
                                :isVisible="showSelectComputed" icon="mdi-check-all"
                                actionName="Procesar"
                                :countBadge="selectedRecords.length"
                                @action="exposeSelectedRecords"/>

                            <material-datatable-actions
                                :isVisible="actions.newRow" icon="mdi-plus"
                                actionName="Create" @action="newRow"/>

                            <material-datatable-actions
                                :isVisible="actions.importFile" icon="mdi-file-upload-outline"
                                actionName="Importar" @action="importFile"/>

                            <material-datatable-actions
                                :isVisible="actions.exportFileRaw" icon="mdi-alpha-r-circle-outline"
                                actionName="Export Raw" @action="exportFileRaw"/>

                            <material-datatable-actions
                                :isVisible="actions.exportFile" icon="mdi-file-download-outline"
                                actionName="Export" @action="exportFile"/>

                            <template v-if="showHideColumn">
                                <material-datatable-show-hide-columns :fields="tableHeaders"/>
                            </template>

                            <template v-if="showRefreshData">
                                <material-datatable-refresh-data
                                @refreshData="refreshData"
                                :items="tableHeaders"/>
                            </template>

						</v-toolbar>
					</template>

                    <template
                        v-for="header in headers"
                        v-slot:[`item.${header.value}`]="{ item }"
                    >
                        <slot :name="[`item.${header.value}`]" :item="item">
                            {{ getVal(item, header.value) }}
                        </slot>
                    </template>

                    <template v-slot:footer>
                        <material-datatable-footer
                            :page="page"
                            :pageDetails="pageDetails" @paginationHandler="paginationHandler"
                        />
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import {
    initializeParameters,
    pageDetails,
    getStatusView
} from "../../../module/HeartUiTable";
import { mapActions, mapGetters } from "vuex";

export default {
	name: "Table",
    props: {
		tableName:{
            type: String,
            required: true
        },
        headers: {
			type: Array,
			required: true
		},
        pathApi:{
            type: String,
            required: true
        },
        storeForm:{
            type: String,
            required: true
        },
        options:{
            type: null | Object,
            default: null
        },
        showHideColumn:{
            type: null | Boolean,
            default: false
        },
        showRefreshData:{
            type: null | Boolean,
            default: false
        },
        showSelect: {
            type: Boolean,
            default: true
        },
        itemKey: {
            type: String,
            default: "id"
        },
        log:{
            type: null | Boolean,
            default: false
        },
        showDateColumn: {
            type: Boolean,
            required: false,
            default: null
        },
	},
    data: () => ({
        value: null,
        loadingDatatable: false,
        tableHeaders: null,
        tableOptions: {
            sortBy: ["id"],
            sortDesc: [true],
        },
        search: null,
        filters: null,
        noSync: true,
        selectedRecords: [],
        page: 1,
        pageDetails: {},
        dataTable: [],
        actions:{
            newRow: false,
            importFile: false,
            exportFile: false,
            exportFileRaw: false,
            exposeSelectedRecords: false
        }
    }),
    computed: {
        ...mapGetters(["getDatatableView"]),
        tableHeadersComputed() {
            this.setDatatableViewStore({
                headers: this.tableHeaders
            });
            if (false === this.showDateColumn) {
                this.tableHeaders.forEach((item, index) => {
                    if (item.text === "Days") {
                        this.tableHeaders[index].showColumn = false;
                    }
                });
            } else if(true === this.showDateColumn) {
                this.tableHeaders.forEach((item, index) => {
                    if (item.text === "Days") {
                        this.tableHeaders[index].showColumn = true;
                    }
                });
            }
            return this.tableHeaders.filter(item => item.showColumn == true);
        },
        selectedRecordsComputed() {
			return this.selectedRecords.length > 0;
		},
        showSelectComputed(){
            return this.actions.exposeSelectedRecords && this.showSelect;
        }
    },
    watch: {
        tableOptions: {
            handler() {
                if (this.noSync) return;
                this.setDatatableViewStore({
                    sort: this.tableOptions
                });
                this.requestData();
            },
            deep: true
        },
    },
    methods: {
        getVal(item, path) {
            return path.split(".").reduce((res, prop) => res[prop], item);
        },
        ...mapActions(["message", "setDatatableView", "fetchData"]),
        async getAllStatusView(){
            const status = Object.assign({}, await this.getInitializeParameters());
            status.header = await this.tableHeaders;
            return status;
        },
        getInitializeParameters(){
            return Object.assign({}, initializeParameters(
                this.getDatatableView[this.storeForm],
                this.page,
                this.tableOptions
            ));
        },
        async requestData() {
            const currentOptions = {};
            currentOptions["params"] = this.getInitializeParameters();
            currentOptions["pathApi"] = this.pathApi;
            this.loadingDatatable = true;
            this.dataTable = [];
            this.pageDetails = {};
            await this.fetchData(currentOptions)
            .then(rs => {
                this.dataTable = rs.data.data;
                this.page = rs.data.current_page;
                this.pageDetails = pageDetails(rs.data);
                this.log && console.log(this.dataTable);
                if(this.page > rs.data.last_page){
                    this.paginationHandler(rs.data.last_page);
                }
                this.loadingDatatable = false;

                if ('extras' in rs.data) {
                    this.$emit("extras", rs.data.extras);
                }
            })
            .catch((err) => {
                this.loadingDatatable = false;
                this.message({type:"error", message:err});
            });
        },
        getStateView() {
            const dataStateView = getStatusView(
                this.getDatatableView[this.storeForm],
                this.tableOptions,
                this.tableHeaders
            );
            this.tableHeaders = dataStateView.headers;
            this.page = dataStateView.page;
            this.tableOptions = dataStateView.options;
            this.tableHeaders = dataStateView.headers;
            this.filters = dataStateView.filters;
        },
        paginationHandler: function (page) {
            this.page = page;
            this.setDatatableViewStore({ page });
            this.requestData();
        },
        filter: function (filters) {
            this.filters = Object.assign({}, filters);
            this.page = 1;
            this.setDatatableViewStore({
                filters: this.filters,
                page: this.page
            });
            this.requestData();
        },
        removeFilters(){
            this.$emit("removeFilters");
        },
        setDatatableViewStore(data) {
            this.setDatatableView({
                view: this.storeForm,
                data,
            });
        },
        newRow(){
            this.$emit("newRow");
        },
        exportFile(){
            this.$emit("exportFile");
        },
        exportFileRaw(){
            this.$emit("exportFileRaw");
        },
        importFile(){
            this.$emit("importFile");
        },
        exposeSelectedRecords(){
            this.$emit("exposeSelectedRecords", this.selectedRecords);
        },
        async refreshData(){
            setTimeout(async () => {
                this.loadingDatatable = true;
                this.noSync = true;
                await this.requestData();
                this.noSync = false;
            }, 100);
        }
    },
    async created() {
        this.actions.newRow = !!this.$listeners.newRow;
        this.actions.importFile = !!this.$listeners.importFile;
        this.actions.exportFile = !!this.$listeners.exportFile;
        this.actions.exportFileRaw = !!this.$listeners.exportFileRaw;
        this.actions.exposeSelectedRecords = !!this.$listeners.exposeSelectedRecords;
        if(this.options) {
            this.tableOptions = Object.assign({}, this.options);
        }
        this.tableHeaders = this.headers.map(item => {
            return {...item, showColumn: "showColumn" in item ? item.showColumn : true};
        });
        this.getStateView();
    },
    async mounted(){
        await this.requestData();
        this.noSync = false;
    }
};
</script>
