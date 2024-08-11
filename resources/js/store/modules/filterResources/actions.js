import axios from "axios";

export default {
	async loadAllDataFilterResources({commit}){
        console.log('url');

		const urls = [
            'api/admin/filters/status/customer',
            'api/admin/filters/status/product',
            'api/admin/filters/categories',
            'api/admin/filters/status/freight',
            'api/admin/filters/status/vehicle',
            'api/admin/filters/status/event',
            'api/admin/filters/status/budget',
            'api/admin/filters/payment-types',
            'api/admin/filters/vehicle-types',
		];

        const requests = urls.map(URL => axios.get(URL).catch(err => null));
        try {
            const [
                dataStatusCustomer,
                dataStatusProduct,
                dataCategories,
                dataStatusFreight,
                dataStatusVehicle,
                dataStatusEvent,
                dataStatusBudget,
                dataPaymentTypes,
                dataVehicleTypes,
			] = await axios.all(requests);

			const data = {};

            data['statusCustomer'] = dataStatusCustomer.data.data;
            data['statusProduct'] = dataStatusProduct.data.data;
            data['categories'] = dataCategories.data.data;
            data['statusFreight'] = dataStatusFreight.data.data;
            data['statusVehicle'] = dataStatusVehicle.data.data;
            data['statusEvent'] = dataStatusEvent.data.data;
            data['statusBudget'] = dataStatusBudget.data.data;
            data['paymentTypes'] = dataPaymentTypes.data.data;
            data['vehicleTypes'] = dataVehicleTypes.data.data;

            data["booleans"] = [
                { value: true, name: 'SI' },
                { value: false, name: 'NO' }
            ];

            data["statusOperator"] = [
                { value: true, name: 'Activo' },
                { value: false, name: 'Inactivo' }
            ];

            data["rols"] = [
                { id: 1, name: 'Admin' },
                { id: 2, name: 'Operador' }
            ];

			commit("SET_DATA_FILTER_RESOURCES", data);
        }
        catch (err) {
            console.log(err.message);
        }
	}
};
