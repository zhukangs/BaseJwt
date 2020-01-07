<?php
/**
 * Created by PhpStorm.
 * User: zhukang.
 * Date: 2020/1/6.
 * Time: 17:05.
 */
namespace zhukangs\BaseJwt;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    /**
     * 在注册后启动服务
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/jwt.php' => config_path('jwt.php'),
            __DIR__.'/Api/Helpers/ApiResponse.php' => app_path('/Api/Helpers/ApiResponse.php'),
            __DIR__.'/Api/Helpers/ExceptionReport.php' => app_path('/Api/Helpers/ExceptionReport.php'),
            __DIR__.'/Api/Helpers/Jwt.php' => app_path('/Api/Helpers/Jwt.php'),
            __DIR__ . '/Api/Controller/ApiController.php' => app_path('/Http/Controllers/Api/ApiController.php'),
            __DIR__ . '/Api/Middleware/AuthApi.php' => app_path('/Http/Middleware/AuthApi.php'),
            __DIR__ . '/Api/Middleware/EnableCrossRequestMiddleware.php' => app_path('/Http/Middleware/EnableCrossRequestMiddleware.php'),
        ]);
    }

    /*public function register()
    {
        $this->app->singleton(Jwt::class, function(){
            return new Jwt(config('jwt.key'),config('jwt.access_exp'),config('jwt.refresh_exp'));
        });

        $this->app->alias(Jwt::class, 'BaseJwt');
    }

    public function provides()
    {
        return [Jwt::class, 'BaseJwt'];
    }*/
}