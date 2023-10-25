<?php

declare (strict_types = 1);

namespace Larke\JwtSM2\Jwt\Signer;

use Larke\JWT\Contracts\Key;
use Larke\JWT\Signer\BaseSigner;

use Larke\JwtSM2\Jwt\HmacSM3 as HSSM3;

/**
 * HmacSM3 signers
 */
final class HmacSM3 extends BaseSigner
{
    public function getAlgorithmId(): string
    {
        return 'GmSM3';
    }
    
    public function createHash(string $payload, Key $key): string
    {
        return HSSM3::hmac($key->getContent(), $payload, 'sm3');
    }

    public function doVerify(string $expected, string $payload, Key $key): bool
    {
        $callback = function_exists('hash_equals') ? 'hash_equals' : [$this, 'hashEquals'];

        return call_user_func($callback, $expected, $this->createHash($payload, $key));
    }
    
    public function hashEquals(string $expected, string $generated): bool
    {
        $expectedLength = strlen($expected);

        if ($expectedLength !== strlen($generated)) {
            return false;
        }

        $res = 0;

        for ($i = 0; $i < $expectedLength; ++$i) {
            $res |= ord($expected[$i]) ^ ord($generated[$i]);
        }

        return $res === 0;
    }
}