<?php

namespace Freecod\LaravelAdminExt\RuStyle;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class RuStyleServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(RuStyle $extension)
    {
        if (! RuStyle::boot()) {
            return ;
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/ru-style')],
                'ru-style'
            );
        }
	
	    Admin::booting(function () {
		
		    $baseCss = Admin::baseCss();
		    $key = array_search('vendor/laravel-admin/google-fonts/fonts.css', $baseCss);
		    if ($key !== false) {
			    $baseCss[$key] = 'vendor/laravel-admin-ext/ru-style/fonts/source-sans-pro/source-sans-pro.css';
			    Admin::baseCss($baseCss);
		    }
		
		    Admin::css('vendor/laravel-admin-ext/ru-style/css/laravel-admin.css');
	    });
    }
}
