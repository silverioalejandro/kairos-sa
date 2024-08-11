<template>
<v-container>
    <v-row>
        <v-col>
            <v-card class="d-flex mb-0" flat tile>
                <p>Id.:</p>
                <p class="ml-3">
                    <router-link :to="`/events/${event.id}`">
                        {{ event.id }}
                    </router-link>
                </p>
            </v-card>
        </v-col>
    </v-row>
    <v-row>
        <v-col>
            <v-text-field
                :value="event.event_date | formatDate('DD-MM-YYYY hh:mm a')"
                hint="Fecha y hora del evento"
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
                :value="event.status_event.name"
                hint="Estatus"
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
                :value="event.event_start | formatDate('DD-MM-YYYY')"
                hint="Fecha inicio"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>

        <v-col>
            <v-text-field
                :value="event.event_end | formatDate('DD-MM-YYYY')"
                hint="Fecha fin"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>
    </v-row>

    <v-row>
        <v-col>
            <v-text-field
                :value="event.address"
                hint="Dirección:"
                persistent-hint
                readonly
                solo-inverted
                flat
                dense
            ></v-text-field>
        </v-col>
    </v-row>

</v-container>
</template>

<script>
// import "../../../../Styles/event/eventCard.css";
// import eventBehavior from "../panels/eventBehavior.vue";

export default {
    name: "EventDetail",
    props: [
        "event"
    ],
    data: () => ({
    }),
    computed: {
    },
    created(){
        console.log("Se inicio... event...");
        console.log(this.event);
        
    }
}
</script>
