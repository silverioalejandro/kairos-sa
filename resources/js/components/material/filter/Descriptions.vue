<template>
    <v-card-actions class="py-0" ref="description-filter">
        <template v-if="descriptions != null">
        <span v-for="(filter, index) in descriptions" :key="index">
            <template>
            <v-chip small close @click:close="removeFilter(filter)">
                <strong> {{ filter.alias }}&#160; </strong>
                <span>
                {{ filter.description }}
                </span>
            </v-chip>
            &#160;
            </template>
        </span>
        </template>
    </v-card-actions>
</template>

<script>
export default {
    name: "Descriptions",
    props: {
        descriptions: {
        type: null | Object,
        required: true,
        }
    },
    data: () => ({
        loading: false,
    }),
    methods: {
        removeFilter(item) {
        this.$emit("removeFilter", item);
        },
    }
};
</script>
