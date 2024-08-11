<template>
    <v-snackbar
        class="snackbar-messsage"
        :value="messageShow"
        multi-line="multi-line"
        :timeout="messageTimeout"
        @input="closeMessage"
        buttom
        :color="messageColorComputed"
        outlined
        text
    >
        <v-layout align-center pr-4>
            <v-icon class="pr-3" :color="messageColorComputed" dark large>{{messageIconComputed}}</v-icon>
            <v-layout column>
            <div>
                <strong>{{ titleComputed }}</strong>
            </div>
            <div>{{ message }}</div>
            </v-layout>
            <v-btn v-if="true" :color="messageColorComputed" icon @click="closeMessage" class="snackbar__button--close">
            <v-icon class="">mdi-close</v-icon>
            </v-btn>
        </v-layout>
    </v-snackbar>
</template>

<script>
  import { mapGetters, mapActions } from "vuex";

  export default {
    name: 'Message',
    computed:{
      ...mapGetters([
        "messageShow",
        "messageType",
        "messageTimeout",
        "messageTitle",
        "messageIcon",
        "message"
      ]),
      messageColorComputed(){
        let color = "primary";
        if(this.messageType == "success") color = "mdi-shield-check";
        if(this.messageType == "error") color = "mdi-shield-remove";
        if(this.messageType == "info") color = "mdi-chat-alert-outline";
        if(this.messageType == "warning") color = "mdi-shield-alert";
        if(this.messageType) color = this.messageType;
        return color;
      },
      messageIconComputed(){
        let icon = "";
        if(this.messageType == "success") icon = "mdi-shield-check";
        if(this.messageType == "error") icon = "mdi-shield-remove";
        if(this.messageType == "info") icon = "mdi-chat-alert-outline";
        if(this.messageType == "warning") icon = "mdi-shield-alert";
        if(this.messageIcon) icon = this.messageIcon;
        return icon;
      },
      titleComputed(){
        let title = "";
        if(this.messageType == "success") title = "";
        if(this.messageType == "error") title = "Error";
        if(this.messageType == "info") title = "Informative";
        if(this.messageType == "warning") title = "Warning";
        if(this.messageTitle) title = this.messageTitle;
        return title;
      }
    },
    methods:{
      ...mapActions([
        "closeMessage"
      ])
    }
  }
</script>

<style scoped lang="css">
  .snackbar__button--close{
    margin-right:-30px;
  }
</style>
