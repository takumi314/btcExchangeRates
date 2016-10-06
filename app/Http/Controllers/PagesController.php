<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
 	// Zaif Last API
	static $zaif_url = "https://api.zaif.jp/api/1/ticker/btc_jpy";  	
	// bitFlyer API
	static $bitflyer_url = "https://bitflyer.jp/api/echo/price";
	// conincheck
	static $coincheck_url = "https://coincheck.com/api/ticker";
	// coinbase
	static $coinbase_url = "https://api.coinbase.com/v2/exchange-rates?currency=BTC";
	// BITSTAMP
	static $bitstamp_url = "https://www.bitstamp.net/api/v2/ticker/btcusd/";


	public function about()
	{
		// $api = new api_get_contents();
		$zaif_json = PagesController::api_get_contents(self::$zaif_url);
		$bitflyer_json = PagesController::api_get_contents(self::$bitflyer_url);
		$coincheck_json = PagesController::api_get_contents(self::$coincheck_url);
		$coinbase_json = PagesController::api_get_contents(self::$coinbase_url);
		$bitstamp_json = PagesController::api_get_contents(self::$bitstamp_url);

		$zaif = $this -> get_array_from_json($zaif_json);
		$bitflyer = $this -> get_array_from_json($bitflyer_json); 
		$coincheck = $this -> get_array_from_json($coincheck_json);
		$coinbase  = $this -> get_array_from_json($coinbase_json);
		$bitstamp = $this -> get_array_from_json($bitstamp_json);
		$usd_rates = NationalCurruncy::show_usd_rates();

		return view('pages.about', compact('zaif', 'bitflyer', 'coincheck', 'coinbase', 'bitstamp', 'usd_rates'));
	}


	public static function api_get_contents($url)
	{
		$json = file_get_contents($url); 

		return $json;
	}


	public static function get_array_from_json($json)
	{
		return json_decode($json, true);
	}


}


class JPYBTCRateModel {

	private $exchange_JPY_BTC_rate = "";

	private $exchange_bid = "";

	private $exchange_ask = "";

	private $exchange_mid = "";

	private $last_price = "";

	private $currancy_buy = "";

	private $currancy_sell = "";
	
}


class NationalCurruncy 
{
	static $usd_currency_url = "http://api.aoikujira.com/kawase/json/usd";

	public static function show_usd_rates()
	{
		$usd_rates_json = PagesController::api_get_contents(self::$usd_currency_url);
		$usd_rates = PagesController::get_array_from_json($usd_rates_json); 

		return $usd_rates;

	}

}