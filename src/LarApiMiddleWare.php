<?php

namespace Xxh\LarApi;

use Closure;

class LarApiMiddleWare
{



    use \Xxh\LarApi\LarApiService;
    public function handle($request, Closure $next)
    {

        view()->share('api',$this);
        return $next($request);
    }

}
