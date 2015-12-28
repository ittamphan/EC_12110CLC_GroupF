<div class="row mt">
	<div class="col-md-12">
		<div id="chartContainer" style="height: 500px; width: 50%; float: left"></div>
		<div id="chartContainer2" style="height: 500px; width: 50%; float: right"></div>
	</div>
</div>
<script type="text/javascript">
    window.onload = function () {
      var chart = new CanvasJS.Chart("chartContainer",
      {
        title:{
          text: "Product types sold in this month"
        },
                    animationEnabled: true,
        legend:{
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        data: [
        {        
          indexLabelFontSize: 20,
          indexLabelFontFamily: "Monospace",       
          indexLabelFontColor: "darkgrey", 
          indexLabelLineColor: "darkgrey",        
          indexLabelPlacement: "outside",
          type: "pie",       
          showInLegend: true,
          toolTipContent: "{y} - <strong>#percent%</strong>",
          dataPoints: [
          @foreach($top_types_this_month as $top)
            {  y: {{ $top->total_quantity }}, legendText:"{{ $top->brand_name }}", indexLabel: "{{ $top->type_name }}" },
          @endforeach
          ]
        }
        ]
      });
      chart.render();
      //Chart number 2
      var chart = new CanvasJS.Chart("chartContainer2",
      {
        title:{
          text: "Product brands sold in this month"
        },
                    animationEnabled: true,
        legend:{
          verticalAlign: "bottom",
          horizontalAlign: "center"
        },
        data: [
        {        
          indexLabelFontSize: 20,
          indexLabelFontFamily: "Monospace",       
          indexLabelFontColor: "darkgrey", 
          indexLabelLineColor: "darkgrey",        
          indexLabelPlacement: "outside",
          type: "pie",       
          showInLegend: true,
          toolTipContent: "{y} - <strong>#percent%</strong>",
          dataPoints: [
          @foreach($top_brands_this_month as $top)
            {  y: {{ $top->total_quantity }}, legendText:"{{ $top->type_name }}", indexLabel: "{{ $top->brand_name }}" },
          @endforeach
          ]
        }
        ]
      });
      chart.render();
    }
    </script>
    <script type="text/javascript" src="{{ asset('public/js/canvasjs.min.js') }}"></script>