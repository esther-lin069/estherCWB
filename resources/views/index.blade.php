{{-- <div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Location</th>
            <th scope="col">Time</th>
            <th scope="col">Wx</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($weeks as $data)
        <tr>
            <th scope="row">{{ $data->id }}</th>
            <td>{{ $data->location }}</td>
            <td>{{ $data->date }}</td>
            <td>{{ $data->wx }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <META HTTP-EQUIV="pragma" CONTENT="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!-- icons -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css'>

    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- needs for bootstrap-select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.js"></script>
    
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <!-- bootstrap-select additional library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/css/bootstrap-select.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.17/js/bootstrap-select.min.js"></script>

    <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>


    <link rel="stylesheet" href="scss/main.css?v=<?=time()?>">
    <title>Weather</title>
</head>
<body>
  <!-- nav -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">EstherWeather</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <button id="btn-update" type="button" class="btn btn-outline-info">更新資料</button>
          <li class="nav-item active">
        </ul>
        <ul class="navbar-nav ml-auto">
            <a class="nav-link" href="#">首頁
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">降雨觀測</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">縣市天氣</a>
          </li>                    
        </ul>
        <select id="citys" class="selectpicker" data-live-search="true">
          <option value="雲林縣">雲林縣</option>
          <option value="南投縣">南投縣</option>
          <option value="連江縣">連江縣</option>
          <option value="臺東縣">臺東縣</option>
          <option value="金門縣">金門縣</option>
          <option value="宜蘭縣">宜蘭縣</option>
          <option value="屏東縣">屏東縣</option>
          <option value="苗栗縣">苗栗縣</option>
          <option value="澎湖縣">澎湖縣</option>
          <option value="臺北市">臺北市</option>
          <option value="新竹縣">新竹縣</option>
          <option value="花蓮縣">花蓮縣</option>
          <option value="高雄市">高雄市</option>
          <option value="彰化縣">彰化縣</option>
          <option value="新竹市">新竹市</option>
          <option value="新北市">新北市</option>
          <option value="基隆市">基隆市</option>
          <option value="臺中市" selected>臺中市</option>
          <option value="臺南市">臺南市</option>
          <option value="桃園市">桃園市</option>
          <option value="嘉義縣">嘉義縣</option>
          <option value="嘉義市">嘉義市</option>
        </select>
        
      </div>
    </div>
</nav>
<!-- end nav -->

<main role="main" class="container">
  <div class="page-content">
    <div style="height: 100px;"></div>
    <!-- chart -->
    <div class="row">
      <div class="col-sm-5">
        <section class="weatherBox">
          <div id="weather-content">
            <h4 id="box-location">location</h4>
            <p id="box-dataTime"></p>
            <h1 id="box-t"></h1>
            <p id="box-wx"></p>
            <i class="fa fa-umbrella"></i>&nbsp;<span id="box-rain"></span>
          </div>
        </section>
      </div>
      <div class="col-sm-7">
        <h5 class="title">今明溫度與降雨機率</h5>   
        <div id="chart">
          <canvas id="chartCanvas"><!-- 統計圖畫在這裡 --></canvas>
        </div>
        <div class="pop">
          <table>
            <tr>
              <!-- pop6h -->              
            </tr>
          </table>
        </div>
      </div>
    </div>
    <!-- weeks card -->
    <h5 class="title">一週白天天氣預報</h5>
    <div class="card-group">
        @foreach ($weeks as $data)
        <div class="card border-secondary week-card ">
            <div class="card-body text-center">
                <h5 class="card-title">{{ $data->date }}</h5>
                <img style="width:60px;margin-bottom:15px;" src="${wximg}" alt="${wx}">
                <p class="card-text">
                  <p style="font-size:10pt;">{{ $data->wx }}</p>
                  <span>{{ $data->minT }} - {{ $data->maxT }}°C</sapn><br>
                  <span>{{ $data->pop6h }}</sapn>
                </p>
              </div>
            </div>
            @endforeach
    </div>
    <!-- cards end -->
    <div id="rain">
      <h5 class="title">各區域雨量觀測數據</h5>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">搜尋</span>
        </div>
        <input id="rain-search" type="text" class="form-control">
      </div>
      <table class="table table-hover table-sm rain-table">
        <thead>
          <tr class="table-secondary">
            <th scope="col"></th>
            <th scope="col">區域名稱</th>
            <th scope="col">過去 1H 雨量</th>
            <th scope="col">過去 24H 累計雨量</th>
            <th scope="col">測站代號</th>
          </tr>
        </thead>
        <tbody>
          <!-- rain -->
        </tbody>
      </table>
    </div>
  </div>
</main>

</body>

{{-- <script>
    $(function(){

      
      changCity('臺中市');

      //調整nowBox的尺寸為正方
      var cw = $(".weatherBox").width();
      $(".weatherBox").css({'height': cw +'px'});
      //這裡不知道為什麼用不了
      // var test = ['123','456','789'];
      // for(var t in test){
      //   var o = `<option value="${t}">${test[t]}</option>`;
      //   $("#citys").append($(o));
      // }
      
      $("#btn-update").click(function(){
        $.get("http://localhost:8888/RD1-Assignment/apis/getCwb.php?update=1");
      })

      $("#citys").change(function(){
        $(".pop table").empty();
        $(".card-group").empty();
        $("#rain table tbody").empty();
        $location = $("#citys").val();        
        changCity($location);

      })

      $("#rain-search").on("keyup",function(){
        var value = $(this).val();
        $(".rain-table tbody tr").filter(function(){
          $(this).toggle($(this).text().indexOf(value) > -1)
        })
      })

      function changCity(city){
        getWeek(city);
        getTwoDays(city);
        setNow(city);
        getRain(city);
        initMap();
      }

      //var x = $("#box-location");
      var lat, lng;
      function initMap() {
          navigator.geolocation.getCurrentPosition((position) => {
              console.log(position.coords);
              lat = position.coords.latitude;
              lng = position.coords.longitude;
          });
      }
  

      function getRain(location){
        $.get(`http://localhost:8888/RD1-Assignment/apis/getCwb.php?location=${location}&type=rain`,function(result){
          var obj = JSON.parse(result);

          $.each(obj, function(index, value) {
            if(value.hour < -990)
              value.hour = "-";
            //console.log(value);
            $("#rain table tbody").append($(`<tr>
            <th scope="row">${parseInt(index)+1}</th>
            <td>${value.location}</td>
            <td>${value.hour}</td>
            <td>${value.day}</td>
            <td>${value.stationId}</td>
            </tr>`));
          }); 

        })
        
      }
      
      function setNow(location){
        $.get(`http://localhost:8888/RD1-Assignment/apis/getCwb.php?location=${location}&type=now`,function(result){
          var obj = JSON.parse(result);
          var data = JSON.parse("{"+ obj.data + "}");

          $("#box-location").text(location);
          $("#box-dataTime").text(obj.dataTime);
          $("#box-t").text(data['T'] + "°C");
          $("#box-wx").text(data['Wx']);
          $("#box-rain").text(data['PoP6h']);

          var imgUrl = `http://localhost:8888/RD1-Assignment/images/${location}.jpg`;
          $(".weatherBox").css('background-image',"url(" + imgUrl + ")");
        })
      }

      function getWeek(location){
        $.get(`http://localhost:8888/RD1-Assignment/apis/getCwb.php?location=${location}&type=week`,function(result){
          var obj = JSON.parse(result);

          for(let days in obj){
            var day = obj[days]['Date'];
            var data = JSON.parse(obj[days]['data']);
            setWeek (day,data);
          }
        })
      }

      function getTwoDays(location){
        $.get(`http://localhost:8888/RD1-Assignment/apis/getCwb.php?location=${location}&type=72h`,function(result){
          var obj = JSON.parse(result);
          var timeList = [];
          var TList = [];
          var ATList = [];
          for(let times in obj){
            var time = obj[times]['dataTime'];
            var data = JSON.parse(obj[times]['data']);
            timeList.push(time);
            TList.push(data['T']);
            ATList.push(data['AT']);
            
            if(data['PoP6h'] !== undefined)
              setPoP6h(data['PoP6h']);
          }
          $("#chart").empty();
          setDayChart(timeList,TList,ATList);

        })
      }
      
      function getWxImg(id){
        var img = null;
        $.ajax({
          type: "get",
          url: `http://localhost:8888/RD1-Assignment/apis/getCwb.php?img-id=${id}`,
          async : false,
          success: function(result){
            img =  result;
          }
        })
        return img;

      }

      function setWeek (day,data){
        var wx = getWxImg(data['Wx'].split(",")[1]);
        if(wx > 29){
          wx = 29;
        }
        var wximg = `http://localhost:8888/RD1-Assignment/images/${wx}`;
        var content = `<div class="card border-secondary week-card ">
          <div class="card-body text-center">
            <h5 class="card-title">${day}</h5>
            <img style="width:60px;margin-bottom:15px;" src="${wximg}" alt="${wx}">
            <p class="card-text">
              <p style="font-size:10pt;">${data['Wx'].split(",")[0]}</p>
              <span>${data['MinT']} - ${data['MaxT']}°C</sapn><br>
              <span>${data['PoP12h']}％</sapn>
            </p>
          </div>
        </div>`;
          $(".card-group").append($(content));

        //這裏有空可以做星期
      }
      //var week = ['一','二','三','四','五','六','日'];

      function setPoP6h(data){
        
        var td = `<td>&nbsp;<i class="fa fa-umbrella"></i>&nbsp;${data}</td>`;
        $(".pop table").append($(td));
      }

      function setDayChart(timeList,TList,ATList){
        //取陣列中的最小值
        var CminT = Math.min(...TList);

        
        $("#chart").append($(`<canvas id="chartCanvas"></canvas>`));
        var ctx = document.getElementById("chartCanvas");

        var WeatherChart = new Chart(ctx,{
            type: "line",
            data: {
                labels: timeList,
                datasets: [
                    {
                        label: "溫度",
                        data: TList,
                        fill: true,
                        // 著色:
                        backgroundColor: "rgba(14,72,100,0.2)",
                        borderColor: "rgba(14,72,100,1.0)",
                        borderWidth: 1
                    },
                    {
                        label: "體感溫度",
                        data: ATList,
                        fill: false,
                        // 著色:
                        backgroundColor: "rgba(255,99,132,0.2)",
                        borderColor: "rgba(255,99,132,1.0)",
                        borderWidth: 1
                    }
                ]
            },
            options: {
              hover: {animationDuration: 0},
              // title: {
              //     display: true,
              //     text: '今明溫度曲線'
              // },
              "animation": {
                "duration": 600,
                "onComplete": function() {
                  var chartInstance = this.chart,
                    ctx = chartInstance.ctx;
                  //這裡還要研究字體顏色
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                  this.data.datasets.forEach(function(dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function(bar, index) {
                      var data = dataset.data[index];
                      ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                  });
                }
              },
              scales: { 
                xAxes: [{ 
                  gridLines: { 
                    display : false, 
                  }, 
                }], 
                yAxes: [{ 
                  ticks: {
                    //display: false, 
                    suggestedMin: CminT-5,
                    suggestedMax: 45,
                    stepSize: 5
                  },
                  gridLines: { 
                    display : false, 
                  } 
                }] 
              }, 
            }
            
            
        })
      }


      

    })


</script> --}}

</html>