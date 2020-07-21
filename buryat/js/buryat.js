new Vue({
  el: '#app',
  data() {
    return {
      info: null,
      loading: true,
      errored: false
    };
  },
  mounted() { 
    axios
      .get('https://api.coindesk.com/v1/bpi/currentprice.json')
      .then(response => (this.info = response.data.chartName))
      .catch(error => {
        console.log(error);
        this.error = true;
      })
      .finally(() => (this.loading = false));
  }
});

/*
var request = new new XMLHttpRequest();
request.open('GET', 'vocabular.php', true);
request.addEventListener('onreadystatechange', function() {
  if ((request.readyState == 4) && (request.status == 200)) {
    console.log(request);
    console.log(request.responseText);
    var result =  document.getElementById('result');
    result.innerHTML = request.responseText;
  }
})
request.send();
*/

function requestAjax(e) {
  e.preventDefault();
  var data = {
    action: 'appendWord',
    whatever: 1234
  };

  jQuery.post(myajax.url, data, function(response) {
    document.getElementById('result').innerHTML = ('Получено с сервера: ' + response);
  })
}