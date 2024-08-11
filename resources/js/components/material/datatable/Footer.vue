<template>
    <div>
        <hr/>
        <v-row>
            <v-col :cols="8" :offset="2">
            <v-pagination
                class="mt-3 mb-3"
                v-model="pageComputed"
                :length="pageDetails.last_page"
                :total-visible="pageDetails.per_page"
                @input="paginationHandler"></v-pagination>
            </v-col>
            <v-col :cols="2" class="pt-8">
            <span>
                {{ pageDetails.from }} -
                {{ pageDetails.to }} of
                {{ pageDetails.total }}
            </span>
            </v-col>
        </v-row>
    </div>

</template>

<script>
export default {
	name: "Footer",
	props: {
		pageDetails: {
			type: Object,
			required: true
		},
		page:{
            type: Number,
            required: true
        },
	},
    computed: {
        pageComputed:{
            get: function(){
                return this.page;
            },
            set: function(){
                return this.page;
            }
        }
    },
	methods: {
		paginationHandler(page) {
            this.$emit("paginationHandler", page );
		}
	}
};
</script>
