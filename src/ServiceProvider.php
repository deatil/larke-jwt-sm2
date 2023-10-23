<?php

declare (strict_types = 1);

namespace Larke\JwtSM2;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use Larke\Admin\Jwt\Signer;

use Larke\JwtSM2\Admin\Signer\SM2;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * 初始化
     */
    public function boot()
    {
        // 添加驱动
        Signer::addSigningMethod('GmSM2', SM2::class);
    }
    
}
