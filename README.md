### 在Laravel中使用

1.安装扩展包

```php
composer require zhukangs/BaseJwt:dev-master
```

2.发布src下的核心代码

```php
php artisan vendor:publish --provider="zhukangs\BaseJwt\ServiceProvider"
```

3.在.env下加上如下代码

```php
JWT_KEY='basejwt'
JWT_ACCESS_EXP=900
JWT_REFRESH_EXP=7200
```

4.编辑 app\Exceptions\Handler.php，添加如下代码

```php
public function render($request, Exception $exception)
{
    if (Config::get('app.debug') === false) {
        if ($request->ajax()) {
            $message = $exception->getMessage();
            $line    = $exception->getLine();
            $file    = $exception->getFile();
            $code    = $exception->getCode();
            return response()->json(['code' => 500, 'msg' => '请求发生错误!', 'data' => [
                'code'    => $code,
                'line'    => $line,
                'file'    => $file,
                'message' => $message,
            ]]);
        } else {
            return response()->view('base.404');
        }
    }

    //对api的request返回数据格式化
    if($request->is('api/*')){
        //表单验证
        if($exception instanceof ValidationException){
            $error = array_first($exception->errors());
            //return $this->message(array_first($error),$exception->status);
            return $this->message(array_first($error),'error');
        }
    }

    // 将方法拦截到自己的ExceptionReport
    $reporter = ExceptionReport::make($exception);

    if ($reporter->shouldReturn()){
        return $reporter->report();
    }

    return parent::render($request, $exception);
}
```

6.编辑app\Http\Kernel.php，添加如下代码

```php
protected $middleware = [
        ...
        \App\Http\Middleware\EnableCrossRequestMiddleware::class,
    ];
    
protected $routeMiddleware = [
        ..
        'auth.api' => \App\Http\Middleware\AuthApi::class,
    ];
```

7.移除扩展包

```php
 rm -rf vendor/zhukangs/BaseJwt/src/Api
```

8.登录例子

```php
public function toLogin(Request $request)
    {
        $token_data = [
            'user_id' => '$user->id',
            'email' => $request->email,
        ];
        $token = $this->createAccessToken($token_data);

        return $this->success([
            'token' => $token,
            'expires_at' => ($this->getPayload($token))['exp'],
            'email' => $request->email,
        ]);
    }
```

9.需要token的路由

```php
Route::group([
    'middleware' => 'auth.api'
    ], function () {
    Route::get('user', 'AuthController@user');//获取个人信息
});
```

