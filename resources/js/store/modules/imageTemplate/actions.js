import axios from "axios";

export default{
    saveImageTemplate(_, row) {
		return new Promise((resolve, reject) => {
			axios
				.post(row.url, row.data, {
					headers: {
						"Content-Type": "multipart/form-data"
					}
				})
				.then(rs => {
					resolve(rs.data.images);
				})
				.catch(e => {
					reject(e);
				});
		});
	},


}