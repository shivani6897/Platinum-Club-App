<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
  var revenueX =  {!! json_encode($revenue_earned['x']) !!};
  var revenueY =  {!! json_encode($revenue_earned['y']) !!};

  var options = {
    chart: {
      type: 'bar'
    },
    series: [{
      name: 'Revenue',
      data: revenueY
    }],
    xaxis: {
        // type: 'datetime',
        categories: revenueX
    }
  }

  var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
  chart.render();

  var ad_spendsX =  {!! json_encode($ad_spends['x']) !!};
  var ad_spendsY =  {!! json_encode($ad_spends['y']) !!};

  var options = {
    chart: {
      type: 'bar'
    },
    series: [{
      name: 'Ad Spends',
      data: ad_spendsY
    }],
    xaxis: {
        // type: 'datetime',
        categories: ad_spendsX
    }
  }

  var chart = new ApexCharts(document.querySelector("#adSpendChart"), options);
  chart.render();

  var overheadsX =  {!! json_encode($overheads['x']) !!};
  var overheadsY =  {!! json_encode($overheads['y']) !!};

  var options = {
    chart: {
      type: 'bar'
    },
    series: [{
      name: 'Overhead',
      data: overheadsY
    }],
    xaxis: {
        // type: 'datetime',
        categories: overheadsX
    }
  }

  var chart = new ApexCharts(document.querySelector("#overheadsChart"), options);
  chart.render();

  var net_profitX =  {!! json_encode($net_profit['x']) !!};
  var net_profitY =  {!! json_encode($net_profit['y']) !!};

  var options = {
    chart: {
      type: 'bar'
    },
    series: [{
      name: 'Profit',
      data: net_profitY
    }],
    xaxis: {
      categories: net_profitX
    }
  }

  var chart = new ApexCharts(document.querySelector("#netProfitChart"), options);
  chart.render();
</script>
