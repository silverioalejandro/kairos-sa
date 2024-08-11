<template>
    <div>
        <template v-if="typeId">
            <v-chip
                class= "black--text text--darken-1"
                :color="isColor()"
                text
                small
            >
                {{ statusName() }}
            </v-chip>
        </template>
        <template v-else>
            <div align="center">
                --
            </div>
        </template>
    </div>
</template>

<script>
export default {
	name: "Types",
	props: {
		typeId: {
			type: null | Number
		},
        icon: {
            type: Boolean,
            default: false
        }
	},
    data: () => ({
        name: null,
        color: null,
        types: []
    }),
    methods:{
        statusName(){
            if (!this.typeId) return "--";
            const data = this.types.find(item => item.id == this.typeId);

            if(!data){
                console.log("no exisste");
                return "Not found"
            }
            return data.name;
        },
        isColor(){
            if (!this.typeId) return null;
            const data = this.types.find(item => item.id == this.typeId);
            if(!data) return "brown lighten-3"
            return data.color;
        },
        isIcon(){
            if (!this.typeId) return null;
            const data = this.types.find(item => item.id == this.typeId);
            if(!data) return "Not found"
            return data.icon;
        }
    },
    created(){
        this.types = this.$_types();
    }
};
</script>
