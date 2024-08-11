<template>
    <div>
        <v-tooltip right>
            <template v-slot:activator="{ on, attrs }">
                <v-badge
                    bordered
                    :color="is_renovation ? 'success' :'info'"
                    :icon="is_renovation ? 'mdi-account' :'mdi-plus'"
                    overlap
                >
                    <v-btn
                        depressed
                        v-bind="attrs"
                            v-on="on"
                    >
                        {{fullname}}</v-btn>
                </v-badge>
            </template>
            <h3>{{ is_renovation ? 'Renovador' :'Cliente Nuevo' }}</h3>
            <p class="my-1">Cuil: <b>{{unique_identifier}}</b></p>
            <p class="my-1">Teléfono: <b>{{cellphone}}</b></p>
            <p class="my-1">Email: <b>{{publisher_email}}</b></p>
            <p class="my-1">Creado: <b>{{publisher_created_at | formatDate("DD/MM/YYYY hh:mm a") }}</b></p>
        </v-tooltip>
    </div>
</template>

<script>
export default {
	name: "PublisherDetail",
	props: {
		fullname: {
			type: String,
			required: true
		},
        unique_identifier: {
			type: String,
			required: true
		},
        publisher_email: {
			type: String,
			required: true
		},
        cellphone: {
			type: null | String,
			default: null
		},
        is_renovation: {
			type: Boolean,
			required: true
		},
        publisher_created_at: {
			type: String,
			required: true
		},
	}
};
</script>
