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
	// BLOCKCHSIN info - Exchange Rates API
	static $blockchain_info_url = "https://blockchain.info/ticker";


	public function about()
	{
		// $api = new api_get_contents();
		$zaif_json = $this -> api_get_contents(self::$zaif_url);
		$bitflyer_json = $this -> api_get_contents(self::$bitflyer_url);
		$coincheck_json = $this -> api_get_contents(self::$coincheck_url);
		$coinbase_json = $this -> api_get_contents(self::$coinbase_url);
		$bitstamp_json = $this -> api_get_contents(self::$bitstamp_url);
		$blockchain_info_json = $this -> api_get_contents(self::$blockchain_info_url);

		$zaif = new Catch_Zaif_ExchangeRates(); 

		$zaif["buy"] = $zaif -> match_buy_string();
		$zaif["sell"] = $zaif -> match_sell_string();
		$zaif["json"] = $this -> get_array_from_json($zaif_json);
		
		$bitflyer = $this -> get_array_from_json($bitflyer_json); 
		$coincheck = $this -> get_array_from_json($coincheck_json);
		$coinbase  = $this -> get_array_from_json($coinbase_json);
		$bitstamp = $this -> get_array_from_json($bitstamp_json);
		$blockchain_info = $this -> get_array_from_json($blockchain_info_json);
		$usd_rates = NationalCurruncy::show_usd_rates();

		return view('pages.about', compact('zaif', 'bitflyer', 'coincheck', 'coinbase', 'bitstamp', 'blockchain_info' , 'usd_rates'));
	}


	/**
 	* @param $url 
 	* @return $json 取得したJSONデータを返す
 	*/
	public function api_get_contents($url)
	{
		$json = file_get_contents($url); 

		return $json;
	}


	public function get_array_from_json($json)
	{
		return json_decode($json, true);
	}


}


/**
 * The static class which provides the national currency rate between USD and JPY 
 */
class NationalCurruncy extends PagesController
{
	static $usd_currency_url = "http://api.aoikujira.com/kawase/json/usd";

	public static function show_usd_rates()
	{
		$usd_rates_json = PagesController::api_get_contents(self::$usd_currency_url);

		$usd_rates = PagesController::get_array_from_json($usd_rates_json); 

		return $usd_rates;
	}

}

/**
 * Parent class about the collection data scraped from the specific webapege
 */
Class Catch_exchangeRates_Controller 
{
	static $html_url = ''; 
	static $buy_price_match = '';
	static $sell_price_match = '';

	public function match_buy_string($url)
	{
		$html = self::catch_html($url);
		
		preg_match(self::$buy_price_match, $html, $string);
	
		return $string[1];
	}

	public function match_sell_string($url)
	{
		$html = self::catch_html($url);
		
		preg_match(self::$sell_price_match, $html, $string);
	
		return $string[1];
	}

	private function catch_html($url)
	{
		$html = file_get_contents($url);

		return self::convert_html($html); 
	}

	private function convert_html($file_contents)
	{
		return mb_convert_encoding($file_contents, mb_internal_encoding(), "auto");
	}

}


/**
 *  The rxchange rate prices scraped From 'Zaif' 
 */
Class Catch_Zaif_ExchangeRates extends Catch_exchangeRates_Controller
{
	static $html_url = "https://zaif.jp/instant_exchange_btc_jpy/1"; 
	static $buy_price_match = '/<span id="btc_ask" style="display: inline;">(.*?)<\/span>/u';
	static $sell_price_match = '/<span id="btc_bid" style="display: inline;">(.*?)<\/span>/u';

	public function match_buy_string()
	{
		return Parent::match_buy_string(self::$html_url);
	}

	public function match_sell_string()
	{
		return Parent::match_sell_string(self::$html_url);
	}

}


/**
 *  The rxchange rate prices scraped From 'bitFlyer' 
 */
Class Catch_bitFlyer_ExchangeRates extends Catch_exchangeRates_Controller
{
	static $html_url = "https://bitflyer.jp/ex/Price";
	static $buy_price_match = '/<strong class="bfPriceAsk">(.*?)<\/strong>/u';
	static $sell_price_match = '/<strong class="bfPriceBid">(.*?)<\/strong>/u';

	// private static function catch_html($url) {}

	// private static function convert_html($file_contents) {}

	// public static function match_buy_string() {}

	// public static function match_sell_string() {}
}



/**
 * 
 */
class JPYBTCRateModel {

	private $exchange_JPY_BTC_rate = "";

	private $exchange_bid = "";

	private $exchange_ask = "";

	private $exchange_mid = "";

	private $last_price = "";

	private $currancy_buy = "";

	private $currancy_sell = "";
	
}





