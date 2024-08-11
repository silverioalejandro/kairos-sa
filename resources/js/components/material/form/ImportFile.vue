<template>
	<v-container>
        <material-form-loading-page :loadingPage="loadingPage"/>
		<template v-if="!fileCreated">
            <v-card>
                <v-card class="py-3 px-6" outlined>
                    <v-row>
                        <v-col>
                            <v-file-input
                                label="Seleccione el archivo"
                                counter
                                show-size
                                chips
                                :accept="typeFile"
                                v-model="file"
                                truncate-length="50"
                                @change="refreshFile"/>
                        </v-col>
                    </v-row>
                    <v-row v-if="error != null">
                        <v-col>
                            <v-alert
                                @input="close"
                                dismissible
                                transition="scale-transition"
                                type="error">{{ error }}</v-alert>
                        </v-col>
                    </v-row>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        @click="upload"
                        :disabled="!file"
                        show-size
                    >
                        Subir archivo
                    </v-btn>
                </v-card-actions>
                </v-card>
            </v-card>
		</template>
		<template v-else>
			<v-row>
				<v-col>
					<v-alert
                        @input="close"
                        dismissible
                        transition="scale-transition"
                        type="success">
						Se importo el archivo con éxito
					</v-alert>
				</v-col>
			</v-row>
		</template>
    </v-container>
</template>
<script>
import { mapActions } from "vuex";
export default {
    name: "ImportFile",
    props: {
		typeFile: {
			type: null | String,
			default: ".csv"
		},
        pathApi:{
            type: String,
            required: true
        },
        confirm: {
            type: null | Boolean,
            default: false
        }
	},
	data: () => ({
		loadingPage: false,
		loadingText: "",
		fileCreated: false,
		file: null,
		error: null
	}),
	methods: {
		...mapActions(["uploadFile"]),
        close(){
            this.fileCreated = false;
            this.error = null;
            this.file = null;
        },
        refreshFile(){
            this.error = null;
        },
        validFileSize(){
            if (this.file.size > 730) {
                this.error = 'File size exceeds 730 kb';
                return true;
            }
            return false;
        },
		async upload() {
            if(this.confirm){
                const msg = "¿Are you sure you want to import this file?";
                const res = await this.$confirm(msg);
                if (!res) return;
            }

            this.loadingPage = true;
            let formData = new FormData();
			formData.append("file", this.file);
			this.loadingPage = true;

            const params = {};
            params["file"] = formData;
            params["pathApi"] = this.pathApi;

			await this.uploadFile(params)
				.then(rs => {
                    this.fileCreated = true;
                    this.loadingPage = false;
                    return rs.data;
				})
				.catch(e => {
					this.loadingPage = false;
					this.error = e;
                    return this.error;
				});
		}
	}
};
</script>
