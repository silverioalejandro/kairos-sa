 <template>
	<div>
		<v-dialog v-model="dialog" persistent width="1100px">
			<v-card>
				<v-card-title class="headline">{{ saveTitle }} Evento</v-card-title>
				<v-card-text>
					<v-container>
                        <material-form-loading-page :loadingPage="loadingPage"/>

                        <v-dialog
                            v-model="dialogSelect"
                            max-width="1100"
                        >
                            <v-card>
                                <v-card-title class="text-h5">
                                    Seleccionar cliente
                                </v-card-title>

                                <v-card-text>
                                    <selected @isSelected="isSelected"/>
                                </v-card-text>
                            </v-card>
                        </v-dialog>

						<v-form ref="form" v-model="valid" lazy-validation>
                            <v-row>
								<v-col>
									<v-text-field
										v-model.trim="form.customer_id"
										label="Cliente id."
										outlined
										dense
										readonly
										append-icon="mdi-file-search-outline"
										@click:append="showFormSelected"
									></v-text-field>
								</v-col>
								<v-col>
									<v-text-field
										v-model= "customerName"
										label="Cliente"
										outlined
										dense
										readonly
										append-icon="mdi-file-search-outline"
										@click:append="showFormSelected"
									></v-text-field>
								</v-col>
							</v-row>

                            <v-row>
                                <v-col>
                                    <v-menu
                                        v-model="eventStartMenu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="$v.form.event_start.$model"
                                                type="date"
                                                label="Fecha inicio"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                hint="DD-MM-YYYY format"
                                                persistent-hint
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="form.event_start"
                                            @input="eventStartMenu = false"
                                            locale="es-AR"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>

                                <v-col>
                                    <v-menu
                                        v-model="eventEndMenu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="$v.form.event_end.$model"
                                                type="date"
                                                label="Fecha fin"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                hint="DD-MM-YYYY format"
                                                persistent-hint
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="form.event_end"
                                            @input="eventEndMenu = false"
                                            locale="es-AR"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>

								<v-col>
                                    <v-menu
                                        v-model="eventDateMenu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="290px"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-text-field
                                                v-model="$v.form.event_date.$model"
                                                type="date"
                                                label="Fecha evento"
                                                prepend-icon="mdi-calendar"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                                hint="DD-MM-YYYY format"
                                                persistent-hint
                                            ></v-text-field>
                                        </template>
                                        <v-date-picker
                                            v-model="form.event_date"
                                            @input="eventDateMenu = false"
                                            locale="es-AR"
                                        ></v-date-picker>
                                    </v-menu>
                                </v-col>
                            </v-row>

							<v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Dirección"
										v-model.trim="$v.form.address.$model"
										:error-messages="addressErrors"
										@change="$v.form.address.$touch()"
										@blur="$v.form.address.$touch()"
										@keydown="clearValidServer('address')"
										maxlength="50"
									></v-text-field>
								</v-col>
							</v-row>

                            <v-row>
								<v-col>
									<v-text-field
										:counter="50"
										prepend-inner-icon="mdi-pound"
										label="Código"
										v-model.trim="$v.form.code.$model"
										:error-messages="codeErrors"
										@change="$v.form.code.$touch()"
										@blur="$v.form.code.$touch()"
										@keydown="clearValidServer('code')"
										maxlength="50"
									></v-text-field>
								</v-col>

                                <v-col>
                                    <v-autocomplete
                                        prepend-inner-icon="mdi-web"
                                        item-text="name"
                                        label="Estado"
                                        item-value="id"
                                        :items="getFilterResources.statusEvent"
                                        v-model="$v.form.status_event_code.$model"
                                        :error-messages="statusEventCodeErrors"
                                        :return-object="false"
                                        @blur="$v.form.status_event_code.$touch()"
                                        @change="$v.form.status_event_code.$touch()"
                                    ></v-autocomplete>
                                </v-col>
                            </v-row>

						</v-form>
					</v-container>
				</v-card-text>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="red darken-1" text @click="closeForm">
						Cancelar
					</v-btn>
					<v-btn
						color="green darken-1"
						text
						@click="save"
						:disabled="$v.form.$invalid"
					>
						{{ saveTitle }}
					</v-btn>
				</v-card-actions>
			</v-card>
		</v-dialog>
	</div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";
import Selected from "./SelectCustomer.vue";

export default {
	name: "FormEvent",
	props: {
		dialog: {
			required: true
		},
		saveTitle: {
			required: true
		}
	},
	validations: {
		form: {
			customer_id: { required },
			address: { required },
			code: { required },
			event_start: { required },
            event_end: { required },
            event_date: { required },
            code: { required },
			status_event_code: { required },
		}
	},
    components : {Selected},
	data: () => ({
		loadingPage: false,
		validChangeInputs: null,
		valid: false,
        validServer: [],
        dialogSelect: false,
        customerName: null,
		eventStartMenu: false,
		eventEndMenu: false,
		eventDateMenu: false,
		form: {
			id: null,
            customer_id: null,
            address: null,
            event_start: null,
            event_end: null,
            event_date: null,
            code: null,
            status_event_code: 601,
		}
	}),
	computed: {
		...mapGetters(["getFilterResources"]),
        addressErrors() {
			const errors = [];
			if (!this.$v.form.address.$dirty) return errors;
			!this.$v.form.address.required && errors.push("Es requerido");
            if (this.validServer && "address" in this.validServer) errors.push(this.validServer.address[0]);
			return errors;
		},
		codeErrors() {
			const errors = [];
			if (!this.$v.form.code.$dirty) return errors;
			!this.$v.form.code.required && errors.push("Es requerido");
            if (this.validServer && "code" in this.validServer) errors.push(this.validServer.code[0]);
			return errors;
		},
		statusEventCodeErrors() {
			const errors = [];
			if (!this.$v.form.status_event_code.$dirty) return errors;
			!this.$v.form.status_event_code.required && errors.push("Es requerido");
            if (this.validServer && "status_event_code" in this.validServer) errors.push(this.validServer.status_event_code[0]);
			return errors;
		}
	},
	watch: {
		dialog(val) {
			if (val && this.saveTitle == "Crear") {
				this.form.event_start = this.getCurrentDate();
				this.form.event_end = this.getCurrentDate();
				this.form.event_date = this.getCurrentDate();
			}
		}
	},
	methods: {
		...mapActions(["message"]),
		getCurrentDate() {
			const today = new Date();
			const yyyy = today.getFullYear();
			const mm = String(today.getMonth() + 1).padStart(2, '0');
			const dd = String(today.getDate()).padStart(2, '0');

			return `${yyyy}-${mm}-${dd}`;
		},
        showFormSelected(){
			this.dialogSelect = true;
		},
		isSelected(item) {
			this.form.customer_id = item.id;
			this.dialogSelect = false;
			this.customerName = item.name;
		},
        resetForm(){
            this.loadingPage = false;
			this.form.id = null;
			this.$refs.form.reset();
			this.$v.$reset();
        },
		closeForm() {
			this.resetForm();
			this.$emit("showForm");
		},
        refresData(){
            this.resetForm();
			this.$emit("refresData");
        },
		getDataForm() {
			let StrInputs = "";
			for (const key in this.form) StrInputs += this.form[key];
			return StrInputs;
		},
		setData(item) {
			for (const key in this.form) this.form[key] = item[key]
            this.customerName = item.customer.name;
			this.validChangeInput = this.getDataForm();
		},
        afterExecute(){
            this.loadingPage = false;
            this.message();
            this.refresData();
        },
		async save() {
			this.$v.$touch();

			if (this.$v.$invalid) return;

			if (this.validChangeInput == this.getDataForm()) {
				this.message({type:"warning", message:"No existen cambios"});
				return;
			}

			const msg = this.form.id
				? `¿Seguro desea actualizar el registro # ${this.form.id} `
				: "¿Seguro desea crear el registro?";

			const res = await this.$confirm(msg);
			if (!res) return;

			try {
				this.loadingPage = true;
				let input = structuredClone(this.form);
				let url = `/api/admin/event/update`;

				if (!this.form.id){
					url = `/api/admin/event/create`;
					delete input.id;
				}

				await this.$_executePost({
					url: url,
					data: input
				});

				this.afterExecute();

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
		clearValidServer(field) {
			delete this.validServer[field];
		}
	}
};
</script>
