<?php

namespace TransitPro\Providers;

use Illuminate\Support\ServiceProvider;
use TransitPro\View\ProThemeViewFinder;
use TransitPro\View\Composers;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app['view']->composer(['layouts.auth', 'layouts.backend', 'layouts.frontend'], Composers\AddStatusMessage::class);//makes status varible availble to this view
      $this->app['view']->composer('layouts.frontend', Composers\InjectPageNavigation::class);
      $this->app['view']->composer('layouts.frontend', Composers\AddAuthenticableUser::class);//makes admin varible availble to this view
      $this->app['view']->setFinder($this->app['theme.finder']); // add new view finder by overiding viewfinder with ThemeViewFinder
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      // -----------------------------------------------

      $this->app->singleton('theme.finder', function($app){//register theme finder as  singleton
        $finder = new ProThemeViewFinder($app['files'], $app['config']['view.paths']);//instatiate finder
        $config= $app['config']['pro.theme'];//get config
        //set theme base path and active theme
        $finder->setBasePath($app['path.public'].'/'.$config['folder']);
        $finder->setActiveTheme($config['active']);
        return $finder;
      });
      // ---------------------------------------

    }
}
