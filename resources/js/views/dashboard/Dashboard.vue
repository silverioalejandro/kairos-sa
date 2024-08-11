<template>
	<v-container fluid>
		<v-row>

			<v-col cols="12" sm="6" lg="4">
				<material-stats-card
					color="green"
					icon="mdi-store"
					title="Eventos Activos"
					value="120"
					sub-icon="mdi-calendar"
					sub-text="Mes Actual"
				/>
			</v-col>

			<v-col cols="12" sm="6" lg="4">
				<material-stats-card
					color="orange"
					icon="mdi-content-copy"
					title="Eventos Pendientes"
					value="50"
					sub-icon="mdi-alert"
					sub-icon-color="error"
					sub-text="Activar pendientes..."
					sub-text-color="text-primary"
				/>
			</v-col>

			<v-col cols="12" sm="6" lg="4">
				<material-stats-card
					color="red"
					icon="mdi-information-outline"
					title="Eventos cancelados"
					value="2"
					sub-icon="mdi-calendar"
					sub-text="Mes Actual"
				/>
			</v-col>

			<v-col cols="12" lg="6">
				<material-card
					color="orange"
					title="Ultimos clientes"
					text="Cliente mes Actual"
				>
					<v-data-table
						:headers="headers"
						:items="items"
						hide-default-footer
					/>
				</material-card>
			</v-col>

			<v-col cols="12" lg="6">
				<material-card
					color="orange"
					title="Proximos Eventos"
					text="Eventos mes Actual"
				>
					<v-data-table
						:headers="headers"
						:items="items"
						hide-default-footer
					/>
				</material-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
export default {
	data() {
		return {
			dailySalesChart: {
				data: {
					labels: ["M", "T", "W", "T", "F", "S", "S"],
					series: [[12, 17, 7, 17, 23, 18, 38]]
				},
				options: {
					lineSmooth: this.$chartist.Interpolation.cardinal({
						tension: 0
					}),
					low: 0,
					high: 50,
					chartPadding: {
						top: 0,
						right: 0,
						bottom: 0,
						left: 0
					}
				}
			},
			dataCompletedTasksChart: {
				data: {
					labels: [
						"12am",
						"3pm",
						"6pm",
						"9pm",
						"12pm",
						"3am",
						"6am",
						"9am"
					],
					series: [[230, 750, 450, 300, 280, 240, 200, 190]]
				},
				options: {
					lineSmooth: this.$chartist.Interpolation.cardinal({
						tension: 0
					}),
					low: 0,
					high: 1000,
					chartPadding: {
						top: 0,
						right: 0,
						bottom: 0,
						left: 0
					}
				}
			},
			emailsSubscriptionChart: {
				data: {
					labels: [
						"Ja",
						"Fe",
						"Ma",
						"Ap",
						"Mai",
						"Ju",
						"Jul",
						"Au",
						"Se",
						"Oc",
						"No",
						"De"
					],
					series: [
						[
							542,
							443,
							320,
							780,
							553,
							453,
							326,
							434,
							568,
							610,
							756,
							895
						]
					]
				},
				options: {
					axisX: {
						showGrid: false
					},
					low: 0,
					high: 1000,
					chartPadding: {
						top: 0,
						right: 5,
						bottom: 0,
						left: 0
					}
				},
				responsiveOptions: [
					[
						"screen and (max-width: 640px)",
						{
							seriesBarDistance: 5,
							axisX: {
								labelInterpolationFnc: function(value) {
									return value[0];
								}
							}
						}
					]
				]
			},
			headers: [
				{
					sortable: false,
					text: "ID",
					value: "id"
				},
				{
					sortable: false,
					text: "Nombre",
					value: "name"
				},
				{
					sortable: false,
					text: "Ubicacion",
					value: "street",
					align: "right"
				},
				{
					sortable: false,
					text: "Pais",
					value: "country",
					align: "right"
				},
				{
					sortable: false,
					text: "Ciudad",
					value: "city",
					align: "right"
				}
			],
			items: [
				{
					id: 1,
					name: "Dakota Rice",
					country: "Niger",
					city: "Oud-Tunrhout",
					salary: "$35,738"
				},
				{
					id: 2,
					name: "Minerva Hooper",
					country: "Curaçao",
					city: "Sinaai-Waas",
					salary: "$23,738"
				},
				{
					id: 3,
					name: "Sage Rodriguez",
					country: "Netherlands",
					city: "Overland Park",
					salary: "$56,142"
				},
				{
					id: 4,
					name: "Philip Chanley",
					country: "Korea, South",
					city: "Gloucester",
					salary: "$38,735"
				},
				{
					id: 5,
					name: "Doris Greene",
					country: "Malawi",
					city: "Feldkirchen in Kārnten",
					salary: "$63,542"
				}
			],
			tabs: 0,
			list: {
				0: false,
				1: false,
				2: false
			}
		};
	},
	methods: {
		complete(index) {
			this.list[index] = !this.list[index];
		}
	}
};
</script>
