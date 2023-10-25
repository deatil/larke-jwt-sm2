<?php

declare (strict_types = 1);

namespace Larke\JwtSM2\Admin\Signer;

use Illuminate\Support\Collection;

use Larke\JWT\Signer\Key\InMemory;
use Larke\JWT\Contracts\Key as KeyContract;
use Larke\JWT\Contracts\Signer as SignerContract;

use Larke\Admin\Jwt\Contracts\Signer;

use Larke\JwtSM2\Jwt\Signer\HmacSM3 as HmacSM3Signer; 

/*
 * HmacSM3 签名
 *
 * @create 2023-10-25
 * @author deatil
 */
class HmacSM3 implements Signer
{
    /**
     * 签名方法
     */
    protected string $signingMethod = HmacSM3Signer::class;
    
    /**
     * 配置
     *
     * @var Collection
     */
    private Collection $config;
    
    /**
     * 构造方法
     * 
     * @param Collection $config 配置信息
     */
    public function __construct(Collection $config)
    {
        $this->config = $config;
    }
    
    /**
     * 签名类
     *
     * @return \Larke\JWT\Contracts\Signer
     */
    public function getSigner(): SignerContract
    {
        return new $this->signingMethod();
    }
    
    /**
     * 签名密钥
     *
     * @return Larke\JWT\Contracts\Key
     */
    public function getSignSecrect(): KeyContract
    {
        return $this->getSecrect();
    }
    
    /**
     * 验证密钥
     *
     * @return \Larke\JWT\Contracts\Key
     */
    public function getVerifySecrect(): KeyContract
    {
        return $this->getSecrect();
    }
    
    /**
     * 密钥
     *
     * @return \Larke\JWT\Contracts\Key
     */
    private function getSecrect(): KeyContract
    {
        $secrect = $this->config->get("secrect");
        
        // base64 秘钥数据解码
        $secrect = InMemory::base64Encoded($secrect);

        return $secrect;
    }
}
