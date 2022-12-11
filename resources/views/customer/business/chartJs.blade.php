<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
  var revenueX =  {!! json_encode($revenue_earned['x']) !!};
  var revenueY =  {!! json_encode($revenue_earned['y']) !!};

  var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'Revenue',
      data: revenueY
    }],
    xaxis: {
      categories: revenueX
    }
  }

  var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
  chart.render();

  var ad_spendsX =  {!! json_encode($ad_spends['x']) !!};
  var ad_spendsY =  {!! json_encode($ad_spends['y']) !!};

  var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'Ad Spends',
      data: ad_spendsY
    }],
    xaxis: {
      categories: ad_spendsX
    }
  }

  var chart = new ApexCharts(document.querySelector("#adSpendChart"), options);
  chart.render();
</script>