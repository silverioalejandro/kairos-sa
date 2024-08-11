<template>
    <v-container>
        <v-row>
			<v-col>
                <opetator-filters
                        ref="filters"
                        @filter="filter"
                        :storeForm="storeForm"
                    />
			</v-col>
		</v-row>

        <form-operators
            ref= "formOperators"
            :dialog.sync="dialogForm"
            :saveTitle.sync="saveTitle"
            @showForm="showFormClose"
            @refresData="refresData"
        />

        <v-row>
            <v-col>
                <material-datatable-table
                    :ref="storeForm"
                    tableName="Operadores"
                    :headers="headers"
                    :storeForm="storeForm"
                    :pathApi="`/api/admin/operator`"
                    :showRefreshData="true"
                    :showHideColumn="true"
                    @newRow="newRow"
                    :log="true"
                >

                    <template v-slot:[`item.created_at`]="{ item }">
                        {{ item.created_at | formatDate("DD-MM-YYYY hh:mm")}}
                    </template>

                    <template v-slot:[`item.is_active`]="{ item }">
						<template v-if="item.is_active == 0">
							<v-icon>mdi-checkbox-blank-outline</v-icon>
						</template>
						<template v-else>
							<v-icon color="success">
								mdi-check-box-outline
							</v-icon>
						</template>
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

                                <v-list-item v-if="isValidResetPassword(item)" dense @click="restarPassword(item)">
                                    <v-list-item-icon>
                                        <v-icon>
                                            mdi-lock-reset
                                        </v-icon>
                                    </v-list-item-icon>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Reinicial password
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
import OpetatorFilters from "./OperatorFilters";
import FormOperators from './FormOperators.vue';
import { mapActions, mapGetters } from "vuex";

export default {
    name: "Operators",
    components : {OpetatorFilters ,FormOperators},
    data: () => ({
        dialogForm:false,
        loading: false,
        storeForm: "Operators",
        saveTitle: null,
        headers: [
            { text: "Id", value: "id" },
            { text: "Nombre", value: "name" },
            { text: "Email", value: "email" },
            { text: "Teléfono", value: "cellphone" },
            { text: "Perfil", value: "rol.name" },
            { text: "Estado", value: "is_active" },
            { text: "Creado", value: "created_at" },
            { text: "Actions", value: "actions", sortable: false }
        ],
    }),
    computed: {
		...mapGetters(["getBackTo","getAuthUser"])
    },
    methods: {
        ...mapActions(["message"]),
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
			this.$refs.formOperators.setData(item);
		},
        showFormClose() {
			this.dialogForm = false;
		},
        refresData(){
            this.dialogForm = false;
            this.$refs[this.storeForm].requestData();
        },
        async restarPassword(item){
            console.log('this.getAuthUser email');
            console.log(this.getAuthUser.email);
            console.log('Restar Password');
            console.log(item.email);


            const msg = `¿Seguro desea reiniciar el password del registro # ${item.id} `;
			const res = await this.$confirm(msg);
			if (!res) return;

			try {
				this.loadingPage = true;
				let input = { email: item.email };
				let url = `/api/admin/operator/reset-password`;

				await this.$_executePost({
					url: url,
					data: input
				});

                this.message();

			} catch (e) {
				this.loadingPage = false;
				if (e.response && e.response.status == 422) {
                    this.message({
                        type: "warning",
                        message: "Registro invalido"
                    });
                    this.validServer = e.response.data.errors;
				}
				this.loadingPage = false;
			}
        },
        isValidResetPassword(item){
            return !(this.getAuthUser.email == item.email);
        }
    }
}
</script>

