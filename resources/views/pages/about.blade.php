@extends('layout')

@section('content')
        <div class="container">
        <h1 section="title">About Exchanges</h1>
        <div section="content">
            <span id="view_clock"></span>
        </div>
        <div class="content">
            <div>
                <h2>Zaif</h2>
            </div>
                <h4>Last: {{$zaif['last']}} JPY/BTC</h4>
                <h4>High: {{$zaif['high']}} JPY/BTC</h4>
                <h4>Low: {{$zaif['low']}} JPY/BTC</h4>
                <h4>Vwap: {{$zaif['vwap']}} JPY/BTC</h4>
                <h4>Volume: {{$zaif['volume']}} </h4>
                <h4>Bid: {{$zaif['bid']}} JPY/BTC</h4>
                <h4>Ask: {{$zaif['ask']}} JPY/BTC</h4>
            </div>
            <br>
            </div>
                <h4>Invoice +1.0% (TTS): {{ floor($zaif['ask'] * 1.010) }} JPY/BTC </h4>
                <h4>Invoice -1.0% (TTB): {{ floor($zaif['bid'] * 0.990) }} JPY/BTC </h4>
            </div>
        </div>
        <br>
        <div  class="content">
            <div>
                <h2>bitFlyer</h2>
            </div>
            <div>
                <div>
                    <h4>Ask: {{$bitflyer['ask']}} JPY/BTC</h4>
                    <h4>Bid: {{$bitflyer['bid']}} JPY/BTC</h4>
                    <h4>Mid: {{$bitflyer['mid']}} JPY/BTC</h4>
                </div>
            </div>
        </div>
        <br>
        <div  class="content">
            <div>
                <h2>coincheck</h2>
            </div>
            <div>
                <div>
                    <h4>Last: {{$coincheck['last']}} JPY/BTC</h4>
                    <h4>Ask: {{$coincheck['ask']}} JPY/BTC</h4>
                    <h4>Bid: {{$coincheck['bid']}} JPY/BTC</h4>
                </div>
            </div>
        </div>
        <br>
        <div  class="content">
            <div>
                <h2>coinbase</h2>
            </div>
            <div>
                <div>
                    <h4>Exchange rates: {{$coinbase['data']['rates']['JPY']}} JPY/BTC</h4>
                </div>
            </div>
        </div>
        <br>
        <div  class="content">
            <div>
                <h2>bitstamp</h2>
            </div>
            <div>
                <h5>Currancy {{$usd_rates['JPY']}} JPY/USD</h5>
                <div>
                    <h4>Last: {{ floor($bitstamp['last'] * $usd_rates['JPY']) }} JPY/BTC</h4>
                    <h4>Ask: {{ floor($bitstamp['ask'] * $usd_rates['JPY']) }} JPY/BTC</h4>
                    <h4>Bid: {{ floor($bitstamp['bid'] * $usd_rates['JPY']) }} JPY/BTC</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
timerID = setInterval('clock()',500); //0.5秒毎にclock()を実行

function clock() {
    document.getElementById("view_clock").innerHTML = getNow();
}

function getNow() {
    var now = new Date();
    var year = now.getFullYear();
    var mon = now.getMonth()+1; //１を足すこと
    var day = now.getDate();
    var hour = now.getHours();
    var min = now.getMinutes();
    var sec = now.getSeconds();

    //出力用
    var s = year + "年" + mon + "月" + day + "日" + hour + "時" + min + "分" + sec + "秒"; 
    return s;
}

</script>




