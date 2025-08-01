@include('layouts.dashboard.chart-card', [
    'card_title' => __("Compound wise Distribution of Buildings"), // Removed extra quotes
    'export_chart_btn_id' => "exportbuildingsPerWardChart",
    'canvas_id' => "buildingsPerWardChart"
])

@push('scripts')
<script>
var ctx = document.getElementById("buildingsPerWardChart");
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [<?php echo implode(',', $buildingsPerWardChart['labels']); ?>],
    datasets: [
        {
            label: "No. of buildings",
            backgroundColor: "rgba(54, 162, 235,0.5)",
            hoverBackgroundColor: "rgba(54, 162, 235,0.7)",
            data: [<?php echo implode(',', $buildingsPerWardChart['values']); ?>],
        }
    ]
},
  options: {
    animation:{
      animateScale:true
    },
    responsive: true,
      legend: {
         labels: {
              boxWidth: 10
          }
      },
    scales: {
        xAxes: [{

scaleLabel: {
                display: true,
                labelString: 'Wards'
            },
}],
        yAxes: [{
            ticks: {
                beginAtZero: true,
                userCallback: function(label, index, labels) {
                     // when the floored value is the same as the value we have a whole number
                     if (Math.floor(label) === label) {
                         return label;
                     }

                 }
            }
        }]
    }
  }
});
document.getElementById('exportbuildingsPerWardChart').addEventListener("click", downloadIMG);
  //donwload pdf from original canvas
  function downloadIMG() {
    var newCanvas = document.querySelector('#buildingsPerWardChart');

    //create image from dummy canvas
    var newCanvasImg = newCanvas.toDataURL("image/png", 1.0);
    var a = document.createElement('a');
    a.href =newCanvas.toDataURL("image/png", 1.0);

    a.download = 'Wardwise Distribution of Buildings.png';

    // Trigger the download
    a.click();
      }
</script>
@endpush
