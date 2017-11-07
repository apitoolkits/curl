<?php namespace Apitoolkits\Curl;

class CurlService{
	/**
	 * @param $url string   The URL to which the request is to be sent
	 * @return \Atk\Curl\Builder
	 */
	public function to($url)
	{
		$builder = new Builder();
		
		return $builder->to($url);
	}
}