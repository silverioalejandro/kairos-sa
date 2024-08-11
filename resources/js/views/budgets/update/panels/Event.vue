<template>
    <v-container>
        <v-dialog
            v-model="dialogSelect"
            max-width="1100"
        >
            <v-card>
                <v-card-title class="text-h5">
                    Seleccionar Evento
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
                        v-model.trim="form.id"
                        label="Event id."
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
                    <v-text-field
                        :value="address"
                        hint="Dirección"
                        persistent-hint
                        readonly
                        solo-inverted
                        flat
                        dense
                    >
                    </v-text-field>
                </v-col>
            </v-row>

            <v-row>
                <v-col>
                    <v-text-field
                        :value="event_start | formatDate('DD-MM-YYYY')"
                        hint="Fecha inicio del evento"
                        persistent-hint
                        readonly
                        solo-inverted
                        flat
                        dense
                    >
                    </v-text-field>
                </v-col>

                <v-col>
                    <v-text-field
                        :value="event_end | formatDate('DD-MM-YYYY')"
                        hint="Fecha fin del evento"
                        persistent-hint
                        readonly
                        solo-inverted
                        flat
                        dense
                    >
                    </v-text-field>
                </v-col>

                <v-col>
                    <v-text-field
                        :value="event_date | formatDate('DD-MM-YYYY')"
                        hint="Fecha del evento"
                        persistent-hint
                        readonly
                        solo-inverted
                        flat
                        dense
                    >
                    </v-text-field>
                </v-col>
            </v-row>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="green darken-1"
                    text
                    @click="save"
                    :disabled="$v.form.$invalid"
                >
                    Siguiente
                </v-btn>
            </v-card-actions>
        </v-form>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { required } from "vuelidate/lib/validators";
import Selected from "./SelectEvent.vue";

export default {
    name: "FormBudgetCreateEvent",
    validations: {
		form: {
			id: { required }
		}
	},
    components : {Selected},
    computed: {
		...mapGetters(["getBudgetToUpdate"]),
    },
    data: () => ({
		loadingPage: false,
		valid: false,
        dialogSelect: false,
        customerName: null,
		form: {
			id: null,
            event_data: null,
		},
        address: null,
        event_start: null,
        event_end: null,
        event_date: null,
	}),
	methods: {
		...mapActions(["message","setBudgetToUpdate"]),
        isSelected(item) {
			this.form.id = item.id;
			this.dialogSelect = false;
			this.customerName = item.customer.name;
            this.address = item.address;
            this.event_start = item.event_start;
            this.event_end = item.event_end;
            this.event_date = item.event_date;
		},
        showFormSelected(){
			this.dialogSelect = true;
		},
        async save() {
			this.$v.$touch();
			if (this.$v.$invalid) return;

            this.$emit('nextStep');
		},
	},
    async mounted(){
    },
    async created() {
        const dataEvent = await this.getBudgetToUpdate;
        this.form.id = dataEvent.event.id;
        this.customerName = dataEvent.event.customer.name;
        this.address = dataEvent.event.address;
        this.event_start = dataEvent.event.event_start;
        this.event_end = dataEvent.event.event_end;
        this.event_date = dataEvent.event.event_date;
    }
};
</script>