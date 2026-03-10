<?php

namespace Sharmindar\Core\Admin\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class Locale
{
    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * The middleware instance.
     *
     * @return void
     */
    public function __construct(
        Application $app,
        Request $request
        )
    {
        $this->app = $app;

        $this->request = $request;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(
            core()->getConfigData('general.general.locale_settings.locale')
            ?: app()->getLocale()
        );

        return $next($request);
    }
}
