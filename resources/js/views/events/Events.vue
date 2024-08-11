<template>
    <v-container>
        <v-row>
			<v-col>
                <EventFilters
                        ref="filters"
                        @filter="filter"
                        :storeForm="storeForm"
                    />
			</v-col>
		</v-row>

        <form-event
            ref="formEvent"
            :dialog.sync="dialogForm"
            :saveTitle.sync="saveTitle"
            @showForm="showFormClose"
            @refresData="refresData"
        />

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Eventos"
                    :headers="itemHeader()"
                    :storeForm="storeForm"
                    :pathApi="`/api/admin/event`"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    :log="true"
                >
                    <template v-slot:[`item.event_start`]="{ item }">
                        {{ item.event_start | formatDate("DD-MM-YYYY")}}
                    </template>

                    <template v-slot:[`item.event_end`]="{ item }">
                        {{ item.event_end | formatDate("DD-MM-YYYY")}}
                    </template>

                    <template v-slot:[`item.event_date`]="{ item }">
                        {{ item.event_date | formatDate("DD-MM-YYYY")}}
                    </template>

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <template v-slot:[`item.select`]="{ item }">
                        <v-btn @click="selectItem(item)" class="ma-2" small color="success">
                            <v-icon>mdi-checkbox-marked-circle-outline</v-icon>
                        </v-btn>
                    </template>

                    <template v-slot:[`item.actions`]="{ item }">
                        <v-menu top>
                            <template v-slot:activator="{ on }">
                                <v-icon small fab class="mr-2" v-on="on">
                                    mdi-dots-vertical
                                </v-icon>
                            </template>

                            <v-list color="blue-grey lighten-3">
                                <v-subheader dense class="font-weight-bold">Id.: {{ item.id }}
                                </v-subheader>

                                <v-list-item dense @click="showForm('update', item)">
                                    <v-list-item-icon>
                                        <v-icon>
                                            mdi-account-edit-outline
                                        </v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Modificar
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </template>
                </material-datatable-table>
            </v-col>
		</v-row>
    </v-container>
</template>

<script>
import EventFilters from "./EventFilters.vue";
import FormEvent from './FormEvent.vue';

export default {
    name: "Customers",
    components : {EventFilters, FormEvent},
    props: {
        isSelected: {
            type: null | Boolean,
            default: false
        },
    },
    data: () => ({
        dialogForm:false,
        loading: false,
        storeForm: "Events",
        saveTitle: null,
        headers: [],
    }),
    methods: {
        selectItem(item){
            this.$emit("selected", item);
        },
        async filter() {
            this.$refs[this.storeForm].requestData();
        },
        newRow(){
            this.showForm();
        },
        showForm(optionTitle = "Create", item = {}) {
			this.dialogForm = true;
			if (optionTitle == "Create") {
				this.saveTitle = "Crear";
				return;
			}

			this.saveTitle = "Actualizar";
			this.$refs.formEvent.setData(item);
		},
        showFormClose() {
			this.dialogForm = false;
		},
        refresData(){
            this.dialogForm = false;
            this.$refs[this.storeForm].requestData();
        },
        itemHeader() {
            let headers1 = [
                { text: "Id", value: "id" },
            ];

            if (this.isSelected) {
                headers1.push({ text: "Seleccionar", value: "select" });
            }

            const headers2 = [
                { text: "Cliente", value: "customer.name" },
                { text: "Dni", value: "customer.identification_number" },
                { text: "Dirección", value: "address" },
                { text: "Fecha inicia", value: "event_start" },
                { text: "Fecha culmina", value: "event_end" },
                { text: "Fecha evento", value: "event_date" },
                { text: "Código", value: "code" },
                { text: "Estado", value: "status_event.name" },
                { text: "Creado", value: "created_at" },
                { text: "Creado por", value: "operator.email", showColumn: false },
                { text: "Actions", value: "actions", sortable: false }
            ];

            return headers1.concat(headers2);
        }
    },
    created() {
        if (this.isSelected) {
            this.storeForm = "selectEvents";
        }
    }
}
</script>

