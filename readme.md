
### 安装
 composer require lyxxxh/larapi
 

   注册`\Xxh\LarApi\LarApiMiddleWare`中间件 
   ```php
    /*App\Http\Kernel.php*/
    protected $middlewareGroups = [
            'web' => [
                ..............,
                \Xxh\LarApi\LarApiMiddleWare::class
            ]
```
 
### 使用
例如写好了轮播图接口
```
Route::get('article/{id}', function ($id) {
        return '你访问id='.$id.'的文章';
});
Route::get('banner',function(){
    return ['banner/1.png','banner/2.png','banner/3.png'];
});


在blade模板里
{{ $api->get('article/4') }}

@foreach($api->getc('banner') as $img)
    <img src="{{ $img }}">      
@endforeach
```


### get()与getc()区别
       getc() 有缓存则返回缓存，没有则调用get() 缓存数据再返回。
       get()  调用路由返回数据 
       
### 自定义
 新建中间件并注册。LarApiService是traits
 ```php

    use \Xxh\LarApi\LarApiService;
    public function handle($request, Closure $next)
    {
        view()->share('api',$this);
        return $next($request);
    }
   
    public function get()
    {
        dd("重写get方法");
    }
    
    public function gete()
    { 
        dd("扩展一个方法");
    }

   
```
        
### 作用
 由于是api,可以与其他的平台通用数据。

 适用于小规模网站前后分离;
 如果采用单页，seo将会是个麻烦的问题;
     
     
### 只有get请求
  需要提交表单，使用form表单 或者 ajax方式提交吧。
    
