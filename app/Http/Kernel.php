<?php

namespace App\Http;

use App\Http\Middleware\Authenticated;
use App\Http\Middleware\DoctorMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Foundation\Http\Kernel as KernelAlias;

class Kernel extends KernelAlias
{
 protected $middlewareAliases = [
     "auth" =>Authenticated::class,
     "doctor" =>DoctorMiddleware::class,
        "web"  => UserMiddleware::class,
     "guest" => RedirectIfAuthenticated::class
 ];
}
