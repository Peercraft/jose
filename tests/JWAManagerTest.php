<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use SpomkyLabs\Jose\Algorithm\Signature\ES256;
use SpomkyLabs\Jose\Algorithm\Signature\ES384;
use SpomkyLabs\Test\TestCase;

/**
 * Class JWAManagerTest.
 */
class JWAManagerTest extends TestCase
{
    /**
     *
     */
    public function testAlgorithmIsSupported()
    {
        $jwa_manager = $this->getJWAManager();

        $this->assertTrue($jwa_manager->isAlgorithmSupported('ES256'));
        $this->assertTrue($jwa_manager->isAlgorithmSupported('ES384'));

        $jwa_manager->removeAlgorithm('ES256');
        $jwa_manager->removeAlgorithm(new ES384());

        $this->assertFalse($jwa_manager->isAlgorithmSupported('ES256'));
        $this->assertFalse($jwa_manager->isAlgorithmSupported('ES384'));

        $jwa_manager->addAlgorithm(new ES256());
        $jwa_manager->addAlgorithm(new ES384());
    }

    /**
     *
     */
    public function testListAlgorithms()
    {
        if ($this->isCryptoExtensionAvailable()) {
            $expected_list = [
                'HS256',
                'HS384',
                'HS512',
                'RS256',
                'RS384',
                'RS512',
                'PS256',
                'PS384',
                'PS512',
                'none',
                'ES256',
                'ES384',
                'ES512',
                'A128CBC-HS256',
                'A192CBC-HS384',
                'A256CBC-HS512',
                'A128KW',
                'A192KW',
                'A256KW',
                'dir',
                'ECDH-ES',
                'ECDH-ES+A128KW',
                'ECDH-ES+A192KW',
                'ECDH-ES+A256KW',
                'PBES2-HS256+A128KW',
                'PBES2-HS384+A192KW',
                'PBES2-HS512+A256KW',
                'RSA1_5',
                'RSA-OAEP',
                'RSA-OAEP-256',
                'A128GCM',
                'A192GCM',
                'A256GCM',
                'A128GCMKW',
                'A192GCMKW',
                'A256GCMKW',
            ];
        } else {
            $expected_list = [
                'HS256',
                'HS384',
                'HS512',
                'RS256',
                'RS384',
                'RS512',
                'PS256',
                'PS384',
                'PS512',
                'none',
                'ES256',
                'ES384',
                'ES512',
                'A128CBC-HS256',
                'A192CBC-HS384',
                'A256CBC-HS512',
                'A128KW',
                'A192KW',
                'A256KW',
                'dir',
                'ECDH-ES',
                'ECDH-ES+A128KW',
                'ECDH-ES+A192KW',
                'ECDH-ES+A256KW',
                'PBES2-HS256+A128KW',
                'PBES2-HS384+A192KW',
                'PBES2-HS512+A256KW',
                'RSA1_5',
                'RSA-OAEP',
                'RSA-OAEP-256',
            ];
        }
        $this->assertEquals($expected_list, $this->getJWAManager()->listAlgorithms());
    }

    /**
     * @return bool
     */
    private function isCryptoExtensionAvailable()
    {
        return class_exists('\Crypto\Cipher');
    }
}
