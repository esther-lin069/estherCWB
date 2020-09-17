<script>
    $(function(){
        console.log('EEE');
    })
</script>

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