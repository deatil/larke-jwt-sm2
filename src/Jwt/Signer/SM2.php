<?php

declare (strict_types = 1);

namespace Larke\JwtSM2\Jwt\Signer;

use Exception;

use Rtgm\sm\RtSm2;

use Larke\JWT\Signer\BaseSigner;

use Larke\JWT\Contracts\Key;
use Larke\JWT\Exception\InvalidKeyProvided;

/**
 * SM2 signers
 */
final class SM2 extends BaseSigner
{
    public function getAlgorithmId(): string
    {
        return 'GmSM2';
    }
    
    public function createHash(string $payload, Key $key): string
    {
        try {
            $sm2 = new RtSm2('hex', false);
            
            // 默认使用 ASN1 编码
            $signed = $sm2 ->doSign($payload, $key->getContent());
            
            return hex2bin($signed);
        } catch (Exception $e) {
            throw new InvalidKeyProvided("JwtSM2 Create error: " . $e->getMessage(), 0, $sodiumException);
        }
    }

    public function doVerify(string $expected, string $payload, Key $key): bool
    {
        try {
            $sm2 = new RtSm2('hex', false);
            
            $expected = bin2hex($expected);

            return $sm2 ->verifySign($payload, $expected, $key->getContent());
        } catch (Exception $e) {
            throw new InvalidKeyProvided("JwtSM2 Verify error: " . $e->getMessage(), 0, $sodiumException);
        }
    }
}