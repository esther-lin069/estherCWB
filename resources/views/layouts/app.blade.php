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


    <link rel="stylesheet" href="css/main.css">
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

    @yield('content')

</body>
    @yield('jq')
</html>