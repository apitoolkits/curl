<?php namespace Apitoolkits\Curl;

use Illuminate\Support\ServiceProvider;

class CurlServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('apitoolkits/curl');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['curl']=$this->app->share(function($app){
			return new Curl;
		});
		
		$this->app->singleton('Curl', function () {
                return new Curl();
            }
        );
		
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Curl', 'Apitoolkits\Curl\Facades\Curl');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('Curl');
	}

}
