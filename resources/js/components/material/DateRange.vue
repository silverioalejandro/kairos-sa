<template>
	<div>
		<v-menu
			ref="menu"
			v-model="menu"
			:close-on-content-click="false"
			:return-value.sync="dates"
			transition="scale-transition"
			offset-y
			min-width="290px"
		>
			<template v-slot:activator="{ on, attrs }">
				<v-text-field
					v-model="dateRangeText"
					:label="label"
					v-bind="attrs"
					v-on="on"
                    readonly
					dense
				>
                    <template v-slot:prepend-inner>
                        <v-icon>
                            mdi-calendar
                        </v-icon>
                    </template>
					<v-icon
						v-if="dates.length"
						slot="append"
						@click="onClearClicked"
					>
						mdi-close
					</v-icon>
				</v-text-field>
			</template>
			<v-date-picker
				v-model="dates"
				no-title
				range
				scrollable
				:reactive="reactive"
				:min="this.min"
				:max="this.max"
				:maxDays="this.maxDays"
			>
				<v-spacer></v-spacer>
				<v-btn text @click="menu = false">Cancel</v-btn>
				<v-btn text @click="save(dates)">OK</v-btn>
			</v-date-picker>
		</v-menu>
	</div>
</template>

<script>
import { mapActions } from "vuex";

export default {
	name: "DateRange",
	props: {
		label: {
			type: String,
			required: true
		},
		max: {
			type: String,
			default: undefined
		},
		min: {
			type: String,
			default: undefined
		},
		maxDays: {
			type: Number,
			default: 365
		},
		formatDate: {
			type: String,
			default: "YYYY-MM-DD"
		},
        color: {
            type: String,
			default: "red"
        }
	},
	computed: {
		dateRangeText() {
			if (this.dates.length > 1) {
				return this.dates
					.map(item => moment(item, "YYYY-MM-DD"))
					.sort((a, b) => a - b)
					.map(item => moment(item).format(this.formatDate))
					.join(" ~ ");
			}

			return this.dates.map(item => moment(item).format(this.formatDate));
		}
	},
	data: () => ({
		menu: false,
		dates: [],
		minDate: null,
		maxDate: null,
		reactive: false,
        colorFrondEnd: "primary"
	}),
	methods: {
		...mapActions(["notificate"]),
		onClearClicked() {
			this.dates = [];
			this.$emit("selectedDates", this.dates);
		},
		save(dates) {
            if (dates.length == 0) return;
			if (dates.length == 1) dates.push(dates[0]);

			let rangeDate = dates
				.map(item => moment(item, "YYYY-MM-DD"))
				.sort((a, b) => a - b);

			const totaldays =
				rangeDate[1]
					.startOf("day")
					.diff(rangeDate[0].startOf("day"), "days", false) + 1;

			if (!(this.maxDays === undefined)) {
				if (totaldays > this.maxDays) {
					this.notificate({
						color: "warning",
						message: `Verifique, el rango máximo es de ${this.maxDays}`,
						timeout: 5000
					});
					this.dates = [];
					this.$emit("selectedDates", this.dates);
					return;
				}
			}

			rangeDate = rangeDate.map(item =>
				moment(item).format("YYYY-MM-DD")
			);

			this.$refs.menu.save(rangeDate);
			this.$emit("selectedDates", rangeDate);
		},
        setValues(values){
            this.dates = values;
        }
	}
};
</script>
