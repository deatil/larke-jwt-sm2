<?php

declare (strict_types = 1);

namespace Larke\JwtSM2\Jwt;

/**
 * HmacSM3 哈希
 */
final class HmacSM3
{
    // $key = '123456'; // 密钥
    // $data = 'Hello,world!'; // 要进行HMAC计算的数据
    // $hmac = HmacSM3::hmac($key, $data, 'sm3');
    public static function hmac(
        string $key, 
        string $data, 
        string $algorithm = 'sha256', 
        bool   $binary    = false
    ): string {
        $blockSize = 64;

        if (strlen($key) > $blockSize) {
            return "";
        }

        $key = str_pad($key, $blockSize, chr(0x00));

        $innerPad = str_repeat(chr(0x36), $blockSize);
        $outerPad = str_repeat(chr(0x5C), $blockSize);

        $innerKey = $key ^ $innerPad;
        $inner = $innerKey . $data;
        $hash = static::digestHash($inner, $algorithm, true);

        $outerKey = $key ^ $outerPad;
        $outer = $outerKey . $hash;

        $hmac = static::digestHash($outer, $algorithm, $binary);

        return $hmac;
    }

    public static function digestHash(
        string $data, 
        string $digest_algo, 
        bool   $binary = false
    ): string {
        // 有些版本的php的套件自带了sm3, 
        // 就可以用这个openssl_digest方法做，
        // 如不支持，就用相关的函数实现就可
        return openssl_digest($data, $digest_algo, $binary);
    }
}