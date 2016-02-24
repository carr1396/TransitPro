(function(window) {
  'use strict';
  // Chart.defaults.global.responsive = true;
  var ctxd = document.getElementById('log-chart-day');
  var ctxy = document.getElementById('log-chart-year');

  var logs = window.view_logs;
  if (logs) {
    if (logs['day']) {
      var dayLogs = logs['day'];
      var labels = [];
      var data = [];
      for (var lb in dayLogs) {
        labels.push(lb);
        data.push(dayLogs[lb]);
      }
      if (ctxd) {
        labels.forEach(function(lb) {
          ctxd.innerHTML = ctxd.innerHTML +
                           '<div class="data-column text-center">' +
                           '<h4>' + lb + '</h4>' +
                           '<span>' + dayLogs[lb] + '</span>' +
                           '</div>'
        });
      }
    }
    if (logs['year']) {
      var yearLogs = logs['year'];
      var labels = [];
      var data = [];
      for (var lb in yearLogs) {
        labels.push(lb);
        data.push(yearLogs[lb]);
      }
      if (ctxy) {
        labels.forEach(function(lb) {
          ctxy.innerHTML = ctxy.innerHTML +
                           '<div class="data-column text-center">' +
                           '<h4>' + lb + '</h4>' +
                           '<span>' + yearLogs[lb] + '</span>' +
                           '</div>'
        });
      }
    }
  }
})(window);
