<script>
import { Pie } from "vue-chartjs";

export default {
  extends: Pie,
//   props: ['data','labels','nom_datos','nom'],
  mounted() {
    this.renderChart(
      {
        labels: [
					'Red',
					'Orange',
					'Yellow',
					'Green',
					'Blue'
				],
        datasets: [
          {
            label: [
					'Red',
					'Orange',
					'Yellow',
					'Green',
					'Blue'
				],
            data: [
						100,
						200,
						400,
						500,
						200,
					],
            backgroundColor: [
                   'Red',
					'Orange',
					'Yellow',
					'Green',
					'Blue'
            ],
          }
        ]
      },
      {
        responsive: true,
        maintainAspectRatio: false,
        title: {
          display: true,
          text: "Hola"
        },
        // scales: {
        //     yAxes: [{
        //         ticks: {
        //             beginAtZero: true
        //         }
        //     }]
        // }
      }
    );
  }
};
</script>
