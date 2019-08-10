<?php
namespace Xxh\LarApi;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
trait LarApiService
{



    //发送get请求到路由
    public function get($url)
    {


        $res = $this->dispatch($url,'get');
        return $this->format($res);
    }



    //接口有缓存则从缓存读取
    public function getc($url)
    {

        $res = resolve('cache')->get($url);
        if( null != $res)
            return $res;

        $data = $this->get($url);
        resolve('cache')->put($url,$data,$this->config()['cache_time']);
        return $data;
    }


    //执行路由
    public function dispatch($url,$method,$header=  null)
    {

        $request = Request::create($url, $method);
        return app('router')->dispatchToRoute($request);  //执行laravel路由
    }


    //配置
    public function config()
    {
        return [
          'cache_time' => 3600   //缓存时间
        ];
    }


    //格式化数据
    public function format($content,$type = 'data')
    {

        switch ($type) {
            case  'data':
                return $content->getContent();

            case 'code':
                return $content->getStatusCode();

            case 'version':
                return $content->getProtocolVersion();
        }

    }



}
