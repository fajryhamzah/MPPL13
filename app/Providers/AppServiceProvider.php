<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app['validator']->extend('is_png',function($attribute, $value, $params, $validator) {
          $explode = explode(',', $value);
          $allow = ['png', 'jpg'];
          $format = str_replace(
              [
                  'data:image/',
                  ';',
                  'base64',
              ],
              [
                  '', '', '',
              ],
              $explode[0]
          );
          // check file format
          if (!in_array($format, $allow)) {
              return false;
          }
          // check base64 format
          if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $explode[1])) {
              return false;
          }
          return true;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
