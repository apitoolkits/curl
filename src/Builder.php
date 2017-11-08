<?php namespace Apitoolkits\Curl;

use stdClass;

class Builder {
	
	/** @var resource $curlObject       cURL request */
	protected $curlObject = null;
	
	protected $userAgentList = array('Mozilla/5.0 (compatible; MSIE 9.0; AOL 9.7; AOLBuild 4343.19; Windows NT 6.1; WOW64; Trident/5.0; FunWebProducts)',
                               'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; pl-PL; rv:1.0.1) Gecko/20021111 Chimera/0.6',
                               'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/535.7 (KHTML, like Gecko) Comodo_Dragon/16.1.1.0 Chrome/16.0.912.63 Safari/535.7',
                               'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/4.0; Deepnet Explorer 1.5.3; Smart 2x2; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)',
                               'Mozilla/4.0 (compatible; MSIE 5.23; Macintosh; PPC) Escape 5.1.8',
                               'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                               'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_1; nl-nl) AppleWebKit/532.3+ (KHTML, like Gecko) Fluid/0.9.6 Safari/532.3+',
                               'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; XH; rv:8.578.498) fr, Gecko/20121021 Camino/8.723+ (Firefox compatible)',
                               'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                               'Mozilla/5.0 (Future Star Technologies Corp.; Star-Blade OS; x86_64; U; en-US) iNet Browser 4.7',
                               'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                               'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1250.0 Iron/22.0.2150.0 Safari/537.4',
                               'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.4pre) Gecko/20070404 K-Ninja/2.1.3',
                               'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.0.7) Gecko Kazehakase/0.5.6',
                               'Mozilla/4.0 (compatible; MSIE 6.0; Windows XP 5.1) Lobo/0.98.4',
                               'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.1.17) Gecko/20110123 Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.2) Gecko/20070225 lolifox/0.32',
                               'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.28) Gecko/20120410 Firefox/3.6.28 Lunascape/6.7.1.25446',
                               'Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/533.1 (KHTML, like Gecko) Maxthon/3.0.8.2 Safari/533.1',
                               'Mozilla/5.0 (X11; U; Linux i686; fr-fr) AppleWebKit/525.1+ (KHTML, like Gecko, Safari/525.1+) midori/1.19',
                               'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
                               'Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.2a2pre) Gecko/20090908 Ubuntu/9.04 (jaunty) Namoroka/3.6a2pre GTB5 (.NET CLR 3.5.30729)',
                               'Mozilla/5.0 (Windows; U; Win 9x 4.90; SG; rv:1.9.2.4) Gecko/20101104 Netscape/9.1.0285',
                               'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                               '(Windows NT 6.2; WOW64) KHTML/4.11 Gecko/20130308 Firefox/33.0 (PaleMoon/25.1)',
                               'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A',
                               'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_6; en-us) AppleWebKit/528.16 (KHTML, like Gecko) Stainless/0.5.3 Safari/525.20.1',
                               'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                               'Mozilla/5.0 (BlackBerry; U; BlackBerry 9900; en) AppleWebKit/534.11+ (KHTML, like Gecko) Version/7.1.0.346 Mobile Safari/534.11+',
                               'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0)',
                               'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (S60; SymbOS; Opera Mobi/23.348; U; en) Presto/2.5.25 Version/10.54',
                               'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_7; en-us) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Safari/530.17 Skyfire/2.0',
                               'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.2; WOW64; Trident/4.0; uZardWeb/1.0; Server_USA)',
        );
	
	/** @var array $curlOptions         Array of cURL options */
	protected $curlOptions = array(
			'RETURNTRANSFER'        => true,
			'FAILONERROR'           => false,
			'FOLLOWLOCATION'        => false,
			'CONNECTTIMEOUT'        => '',
			'TIMEOUT'               => 30,
			'USERAGENT'             => array_rand($userAgentList),
			'URL'                   => '',
			'POST'                  => false,
			'HTTPHEADER'            => array(),
			'SSL_VERIFYPEER'        => false,
	);
	
	/** @var array $packageOptions      Array with options that are not specific to cURL but are used by the package */
	protected $packageOptions = array(
			'data'                  => array(),
			'files'                 => array(),
			'asJsonRequest'         => false,
			'asJsonResponse'        => false,
			'returnAsArray'         => false,
			'responseObject'        => false,
			'responseArray'         => false,
			'enableDebug'           => false,
			'xDebugSessionName'     => '',
			'containsFile'          => false,
			'debugFile'             => '',
			'saveFile'              => '',
	);
	
	
	/**
	 * Set the URL to which the request is to be sent
	 *
	 * @param $url string   The URL to which the request is to be sent
	 * @return Builder
	 */
	public function to($url)
	{
		return $this->withCurlOption( 'URL', $url );
	}
	
	/**
	 * Set the request timeout
	 *
	 * @param   float $timeout    The timeout for the request (in seconds, fractions of a second are okay. Default: 30 seconds)
	 * @return Builder
	 */
	public function withTimeout($timeout = 30.0)
	{
		return $this->withCurlOption( 'TIMEOUT_MS', ($timeout * 1000) );
	}
	
	/**
	 * Add GET or POST data to the request
	 *
	 * @param   mixed $data     Array of data that is to be sent along with the request
	 * @return Builder
	 */
	public function withData($data = array())
	{
		return $this->withPackageOption( 'data', $data );
	}
	
	/**
	 * Add a file to the request
	 *
	 * @param   string $key          Identifier of the file (how it will be referenced by the server in the $_FILES array)
	 * @param   string $path         Full path to the file you want to send
	 * @param   string $mimeType     Mime type of the file
	 * @param   string $postFileName Name of the file when sent. Defaults to file name
	 *
	 * @return Builder
	 */
	public function withFile($key, $path, $mimeType = '', $postFileName = '')
	{
		$fileData = array(
				'fileName'     => $path,
				'mimeType'     => $mimeType,
				'postFileName' => $postFileName,
		);
		
		$this->packageOptions[ 'files' ][ $key ] = $fileData;
		
		return $this->containsFile();
	}
	
	/**
	 * Allow for redirects in the request
	 *
	 * @return Builder
	 */
	public function allowRedirect()
	{
		return $this->withCurlOption( 'FOLLOWLOCATION', true );
	}
	
	/**
	 * Configure the package to encode and decode the request data
	 *
	 * @param   boolean $asArray    Indicates whether or not the data should be returned as an array. Default: false
	 * @return Builder
	 */
	public function asJson($asArray = false)
	{
		return $this->asJsonRequest()
		->asJsonResponse( $asArray );
	}
	
	/**
	 * Configure the package to encode the request data to json before sending it to the server
	 *
	 * @return Builder
	 */
	public function asJsonRequest()
	{
		return $this->withPackageOption( 'asJsonRequest', true );
	}
	
	/**
	 * Configure the package to decode the request data from json to object or associative array
	 *
	 * @param   boolean $asArray    Indicates whether or not the data should be returned as an array. Default: false
	 * @return Builder
	 */
	public function asJsonResponse($asArray = false)
	{
		return $this->withPackageOption( 'asJsonResponse', true )
		->withPackageOption( 'returnAsArray', $asArray );
	}
	
	//    /**
	//     * Send the request over a secure connection
	//     *
	//     * @return Builder
	//     */
	//    public function secure()
	//    {
	//        return $this;
	//    }
	
	/**
	 * Set any specific cURL option
	 *
	 * @param   string $key         The name of the cURL option
	 * @param   string $value       The value to which the option is to be set
	 * @return Builder
	 */
	public function withOption($key, $value)
	{
		return $this->withCurlOption( $key, $value );
	}
	
	/**
	 * Set Cookie File
	 *
	 * @param   string $cookieFile  File name to read cookies from
	 * @return Builder
	 */
	public function setCookieFile($cookieFile)
	{
		return $this->withOption( 'COOKIEFILE', $cookieFile );
	}
	
	/**
	 * Set Cookie Jar
	 *
	 * @param   string $cookieJar   File name to store cookies to
	 * @return Builder
	 */
	public function setCookieJar($cookieJar)
	{
		return $this->withOption( 'COOKIEJAR', $cookieJar );
	}
	
	/**
	 * Set any specific cURL option
	 *
	 * @param   string $key         The name of the cURL option
	 * @param   string $value       The value to which the option is to be set
	 * @return Builder
	 */
	protected function withCurlOption($key, $value)
	{
		$this->curlOptions[ $key ] = $value;
		
		return $this;
	}
	
	/**
	 * Set any specific package option
	 *
	 * @param   string $key       The name of the cURL option
	 * @param   string $value     The value to which the option is to be set
	 * @return Builder
	 */
	protected function withPackageOption($key, $value)
	{
		$this->packageOptions[ $key ] = $value;
		
		return $this;
	}
	
	/**
	 * Add a HTTP header to the request
	 *
	 * @param   string $header      The HTTP header that is to be added to the request
	 * @return Builder
	 */
	public function withHeader($header)
	{
		$this->curlOptions[ 'HTTPHEADER' ][] = $header;
		
		return $this;
	}
	
	/**
	 * Add multiple HTTP header at the same time to the request
	 *
	 * @param   array $headers      Array of HTTP headers that must be added to the request
	 * @return Builder
	 */
	public function withHeaders(array $headers)
	{
		$this->curlOptions[ 'HTTPHEADER' ] = array_merge(
				$this->curlOptions[ 'HTTPHEADER' ], $headers
				);
		
		return $this;
	}
	
	/**
	 * Add a content type HTTP header to the request
	 *
	 * @param   string $contentType    The content type of the file you would like to download
	 * @return Builder
	 */
	public function withContentType($contentType)
	{
		return $this->withHeader( 'Content-Type: '. $contentType )
		->withHeader( 'Connection: Keep-Alive' );
	}
	
	/**
	 * Return a full response object with HTTP status and headers instead of only the content
	 *
	 * @return Builder
	 */
	public function returnResponseObject()
	{
		return $this->withPackageOption( 'responseObject', true );
	}
	
	/**
	 * Return a full response array with HTTP status and headers instead of only the content
	 *
	 * @return Builder
	 */
	public function returnResponseArray()
	{
		return $this->withPackageOption( 'responseArray', true );
	}
	
	/**
	 * Enable debug mode for the cURL request
	 *
	 * @param   string $logFile    The full path to the log file you want to use
	 * @return Builder
	 */
	public function enableDebug($logFile)
	{
		return $this->withPackageOption( 'enableDebug', true )
		->withPackageOption( 'debugFile', $logFile )
		->withOption( 'VERBOSE', true );
	}
	
	/**
	 * Enable File sending
	 *
	 * @return Builder
	 */
	public function containsFile()
	{
		return $this->withPackageOption( 'containsFile', true );
	}
	
	/**
	 * Add the XDebug session name to the request to allow for easy debugging
	 *
	 * @param  string $sessionName
	 * @return Builder
	 */
	public function enableXDebug($sessionName = 'session_1')
	{
		$this->packageOptions[ 'xDebugSessionName' ] = $sessionName;
		
		return $this;
	}
	
	/**
	 * Send a GET request to a URL using the specified cURL options
	 *
	 * @return mixed
	 */
	public function get()
	{
		$this->appendDataToURL();
		
		return $this->send();
	}
	
	/**
	 * Send a POST request to a URL using the specified cURL options
	 *
	 * @return mixed
	 */
	public function post()
	{
		$this->setPostParameters();
		
		return $this->send();
	}
	
	/**
	 * Send a download request to a URL using the specified cURL options
	 *
	 * @param  string $fileName
	 * @return mixed
	 */
	public function download($fileName)
	{
		$this->packageOptions[ 'saveFile' ] = $fileName;
		
		return $this->send();
	}
	
	/**
	 * Add POST parameters to the curlOptions array
	 */
	protected function setPostParameters()
	{
		$this->curlOptions[ 'POST' ] = true;
		
		$parameters = $this->packageOptions[ 'data' ];
		if( !empty($this->packageOptions[ 'files' ]) ) {
			foreach( $this->packageOptions[ 'files' ] as $key => $file ) {
				$parameters[ $key ] = $this->getCurlFileValue( $file[ 'fileName' ], $file[ 'mimeType' ], $file[ 'postFileName'] );
			}
		}
		
		if( $this->packageOptions[ 'asJsonRequest' ] ) {
			$parameters = json_encode($parameters);
		}
		
		$this->curlOptions[ 'POSTFIELDS' ] = $parameters;
	}
	
	protected function getCurlFileValue($filename, $mimeType, $postFileName)
	{
		// PHP 5 >= 5.5.0, PHP 7
		if( function_exists('curl_file_create') ) {
			return curl_file_create($filename, $mimeType, $postFileName);
		}
		
		// Use the old style if using an older version of PHP
		$value = "@{$filename};filename=" . $postFileName;
		if( $mimeType ) {
			$value .= ';type=' . $mimeType;
		}
		
		return $value;
	}
	
	/**
	 * Send a PUT request to a URL using the specified cURL options
	 *
	 * @return mixed
	 */
	public function put()
	{
		$this->setPostParameters();
		
		return $this->withOption('CUSTOMREQUEST', 'PUT')
		->send();
	}
	
	/**
	 * Send a PATCH request to a URL using the specified cURL options
	 *
	 * @return mixed
	 */
	public function patch()
	{
		$this->setPostParameters();
		
		return $this->withOption('CUSTOMREQUEST', 'PATCH')
		->send();
	}
	
	/**
	 * Send a DELETE request to a URL using the specified cURL options
	 *
	 * @return mixed
	 */
	public function delete()
	{
		$this->appendDataToURL();
		
		return $this->withOption('CUSTOMREQUEST', 'DELETE')
		->send();
	}
	
	/**
	 * Send the request
	 *
	 * @return mixed
	 */
	protected function send()
	{
		// Add JSON header if necessary
		if( $this->packageOptions[ 'asJsonRequest' ] ) {
			$this->withHeader( 'Content-Type: application/json' );
		}
		
		if( $this->packageOptions[ 'enableDebug' ] ) {
			$debugFile = fopen( $this->packageOptions[ 'debugFile' ], 'w');
			$this->withOption('STDERR', $debugFile);
		}
		
		// Create the request with all specified options
		$this->curlObject = curl_init();
		$options = $this->forgeOptions();
		curl_setopt_array( $this->curlObject, $options );
		
		// Send the request
		$response = curl_exec( $this->curlObject );
		
		// Capture additional request information if needed
		$responseData = array();
		if( $this->packageOptions[ 'responseObject' ] || $this->packageOptions[ 'responseArray' ] ) {
			$responseData = curl_getinfo( $this->curlObject );
			
			if( curl_errno($this->curlObject) ) {
				$responseData[ 'errorMessage' ] = curl_error($this->curlObject);
			}
		}
		
		curl_close( $this->curlObject );
		
		if( $this->packageOptions[ 'saveFile' ] ) {
			// Save to file if a filename was specified
			$file = fopen($this->packageOptions[ 'saveFile' ], 'w');
			fwrite($file, $response);
			fclose($file);
		} else if( $this->packageOptions[ 'asJsonResponse' ] ) {
			// Decode the request if necessary
			$response = json_decode($response, $this->packageOptions[ 'returnAsArray' ]);
		}
		
		if( $this->packageOptions[ 'enableDebug' ] ) {
			fclose( $debugFile );
		}
		
		// Return the result
		return $this->returnResponse( $response, $responseData );
	}
	
	/**
	 * @param   mixed $content          Content of the request
	 * @param   array $responseData     Additional response information
	 * @return mixed
	 */
	protected function returnResponse($content, array $responseData = array())
	{
		if( !$this->packageOptions[ 'responseObject' ] && !$this->packageOptions[ 'responseArray' ] ) {
			return $content;
		}
		
		$object = new stdClass();
		$object->content = $content;
		$object->status = $responseData[ 'http_code' ];
		$object->contentType = $responseData[ 'content_type' ];
		if( array_key_exists('errorMessage', $responseData) ) {
			$object->error = $responseData[ 'errorMessage' ];
		}
		
		if( $this->packageOptions[ 'responseObject' ] ) {
			return $object;
		}
		
		if( $this->packageOptions[ 'responseArray' ] ) {
			return (array) $object;
		}
		
		return $content;
	}
	
	/**
	 * Convert the curlOptions to an array of usable options for the cURL request
	 *
	 * @return array
	 */
	protected function forgeOptions()
	{
		$results = array();
		foreach( $this->curlOptions as $key => $value ) {
			$arrayKey = constant( 'CURLOPT_' . $key );
			
			if( !$this->packageOptions[ 'containsFile' ] && $key == 'POSTFIELDS' && is_array( $value ) ) {
				$results[ $arrayKey ] = http_build_query( $value, null, '&' );
			} else {
				$results[ $arrayKey ] = $value;
			}
		}
		
		if( !empty($this->packageOptions[ 'xDebugSessionName' ]) ) {
			$char = strpos($this->curlOptions[ 'URL' ], '?') ? '&' : '?';
			$this->curlOptions[ 'URL' ] .= $char . 'XDEBUG_SESSION_START='. $this->packageOptions[ 'xDebugSessionName' ];
		}
		
		return $results;
	}
	
	/**
	 * Append set data to the query string for GET and DELETE cURL requests
	 *
	 * @return string
	 */
	protected function appendDataToURL()
	{
		$parameterString = '';
		if( is_array($this->packageOptions[ 'data' ]) && count($this->packageOptions[ 'data' ]) != 0 ) {
			$parameterString = '?'. http_build_query( $this->packageOptions[ 'data' ], null, '&' );
		}
		
		return $this->curlOptions[ 'URL' ] .= $parameterString;
	}
	
}

