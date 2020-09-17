@extends('layouts.app')
@section('content')
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
                  <img style="width:60px;margin-bottom:15px;" src="${wximg}" alt="{{ $data->wx_num }}">
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
@endsection


@section('jq')
    @include('script')
@endsection




