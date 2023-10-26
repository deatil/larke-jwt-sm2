<?php

declare (strict_types = 1);

namespace Larke\JwtSM2\Admin\Signer;

use Illuminate\Support\Collection;

use Rtgm\util\MyAsn1;

use Larke\JWT\Signer\Key\InMemory;
use Larke\JWT\Contracts\Key as KeyContract;
use Larke\JWT\Contracts\Signer as SignerContract;

use Larke\Admin\Jwt\Contracts\Signer;

use Larke\JwtSM2\Jwt\Signer\SM2 as SM2Signer; 

/*
 * SM2 签名
 *
 * @create 2023-10-23
 * @author deatil
 */
class SM2 implements Signer
{
    /**
     * 签名方法
     */
    protected string $signingMethod = SM2Signer::class;
    
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
     * @return \Larke\JWT\Contracts\Key
     */
    public function getSignSecrect(): KeyContract
    {
        $privateKey = $this->config->get("private_key");
        
        if (file_exists($privateKey)) {
            $der = MyAsn1::decode_file($privateKey);
            
            $secrect = InMemory::plainText($der[1] ?: '');
        } else {
            $secrect = InMemory::plainText($privateKey);
        }
        
        return $secrect;
    }
    
    /**
     * 验证密钥
     *
     * @return \Larke\JWT\Contracts\Key
     */
    public function getVerifySecrect(): KeyContract
    {
        $publicKey = $this->config->get("public_key");

        if (file_exists($publicKey)) {
            $der = MyAsn1::decode_file($publicKey);
            
            $secrect = InMemory::plainText($der[1] ?: '');
        } else {
            $secrect = InMemory::plainText($publicKey);
        }
        
        return $secrect;
    }
}
