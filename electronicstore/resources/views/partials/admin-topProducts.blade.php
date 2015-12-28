<div class="row mt chart">
      <!--CUSTOM CHART START -->
      <div class="border-head">
          <h3>Top 5 best sale products of the Store</h3>
      </div>
      <div class="custom-bar-chart">
          <ul class="y-axis">
              <li><span>10</span></li>
              <li><span>8</span></li>
              <li><span>6</span></li>
              <li><span>4</span></li>
              <li><span>2</span></li>
              <li><span>0</span></li>
          </ul>

          @foreach($top_products as $top_product)
          <div class="bar">
              <div class="title">{{ $top_product->product_name }}</div>
              <div class="value tooltips" data-original-title="{{ $top_product->total_quantity }}" data-toggle="tooltip" data-placement="top">{{ $top_product->total_quantity*10 }}%</div>
          </div>
          @endforeach
      </div>
      <!--custom chart end-->
</div><!-- /row -->	