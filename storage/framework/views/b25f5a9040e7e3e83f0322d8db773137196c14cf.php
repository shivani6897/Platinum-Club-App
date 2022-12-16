<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script type="text/javascript">
  var revenueX =  <?php echo json_encode($revenue_earned['x']); ?>;
  var revenueY =  <?php echo json_encode($revenue_earned['y']); ?>;

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

  var ad_spendsX =  <?php echo json_encode($ad_spends['x']); ?>;
  var ad_spendsY =  <?php echo json_encode($ad_spends['y']); ?>;

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

  var overheadsX =  <?php echo json_encode($overheads['x']); ?>;
  var overheadsY =  <?php echo json_encode($overheads['y']); ?>;

  var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'Overhead',
      data: overheadsY
    }],
    xaxis: {
      categories: overheadsX
    }
  }

  var chart = new ApexCharts(document.querySelector("#overheadsChart"), options);
  chart.render();

  var net_profitX =  <?php echo json_encode($net_profit['x']); ?>;
  var net_profitY =  <?php echo json_encode($net_profit['y']); ?>;

  var options = {
    chart: {
      type: 'line'
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
</script><?php /**PATH /home/vagrant/web/platinum-club-app/Platinum-Club-App/resources/views/customer/business/chartJs.blade.php ENDPATH**/ ?>