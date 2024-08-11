<template>
    <div>
        <v-chip
            class= "black--text text--darken-1"
            :color="isColor()"
            text
            small
        >
            <v-icon v-if="icon">{{ isIcon() }}</v-icon>
            {{ statusName() }}
        </v-chip>
    </div>
</template>

<script>
export default {
	name: "Status",
	props: {
		statusId: {
			type: null | Number,
			required: true
		},
        icon: {
            type: Boolean,
            default: false
        },
        typeStatus: {
            type: String,
            default: 'state'
        }
	},
    data: () => ({
        name: null,
        color: null,
        status: {}
    }),
    methods:{
        statusName(){
            if (!this.statusId) return null;
            const data = this.status.find(item => item.id == this.statusId);
            if(!data) return "Not found"
            return data.name;
        },
        isColor(){
            if (!this.statusId) return null;
            const data = this.status.find(item => item.id == this.statusId);
            if(!data) return "Not found"
            return data.color;
        },
        isIcon(){
            if (!this.statusId) return null;
            const data = this.status.find(item => item.id == this.statusId);
            if(!data) return "Not found"
            return data.icon;
        }
    },
    created(){
        const allState = this.$_status_all();
        const currentType = this.typeStatus; 
        if (currentType in allState) { 
            this.status = allState[currentType];
            return;
        }
        //cambiar
        this.status = this.$_status_all();
    }
};
</script>
