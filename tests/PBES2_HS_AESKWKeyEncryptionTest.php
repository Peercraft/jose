<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

use Base64Url\Base64Url;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\PBES2HS256A128KW;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\PBES2HS384A192KW;
use SpomkyLabs\Jose\Algorithm\KeyEncryption\PBES2HS512A256KW;
use SpomkyLabs\Jose\JWK;

/**
 * Class PBES2_HS_AESKWKeyEncryptionTest.
 *
 * @group PBES2HSAESKW
 */
class PBES2_HS_AESKWKeyEncryptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @see https://tools.ietf.org/html/rfc7517#appendix-C
     */
    public function testPBES2HS256A128KW()
    {
        $header = [
          'alg' => 'PBES2-HS256+A128KW',
          'p2s' => '2WCTcJZ1Rvd_CJuJripQ1w',
          'p2c' => 4096,
          'enc' => 'A128CBC-HS256',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $expected_cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS256A128KW();

        $wrapped_cek = Base64Url::decode('TrqXOwuNUfDV9VPTNbyGvEJ9JMjefAVn-TR1uIxR9p6hsRQh9Tk7BA');

        $this->assertEquals($expected_cek, $pbes2->decryptKey($key, $wrapped_cek, $header));
    }

    /**
     *
     */
    public function testPBES2HS256A128KW_Bis()
    {
        $header = [
          'alg' => 'PBES2-HS256+A128KW',
          'enc' => 'A128CBC-HS256',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS256A128KW();
        $encrypted_cek = $pbes2->encryptKey($key, $cek, $header);
        $this->assertTrue(isset($header['p2s']));
        $this->assertEquals(4096, $header['p2c']);
        $this->assertEquals($cek, $pbes2->decryptKey($key, $encrypted_cek, $header));
    }

    /**
     *
     */
    public function testPBES2HS384A192KW()
    {
        $header = [
          'alg' => 'PBES2-HS384+A192KW',
          'enc' => 'A192CBC-HS384',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS384A192KW();
        $encrypted_cek = $pbes2->encryptKey($key, $cek, $header);
        $this->assertTrue(isset($header['p2s']));
        $this->assertEquals(4096, $header['p2c']);
        $this->assertEquals($cek, $pbes2->decryptKey($key, $encrypted_cek, $header));
    }

    /**
     *
     */
    public function testPBES2HS512A256KW()
    {
        $header = [
          'alg' => 'PBES2-HS512+A256KW',
          'enc' => 'A256CBC-HS512',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS512A256KW();
        $encrypted_cek = $pbes2->encryptKey($key, $cek, $header);
        $this->assertTrue(isset($header['p2s']));
        $this->assertEquals(4096, $header['p2c']);
        $this->assertEquals($cek, $pbes2->decryptKey($key, $encrypted_cek, $header));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The key is not valid
     */
    public function testBadKeyType()
    {
        $header = [
          'alg' => 'PBES2-HS512+A256KW',
          'enc' => 'A256CBC-HS512',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty'   => 'dir',
            'dir'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS512A256KW();
        $pbes2->encryptKey($key, $cek, $header);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The key is not valid
     */
    public function testInvalidKeyType()
    {
        $header = [
          'alg' => 'PBES2-HS512+A256KW',
          'enc' => 'A256CBC-HS512',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty'   => 'oct',
            'dir'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS512A256KW();
        $pbes2->encryptKey($key, $cek, $header);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The header parameter 'alg' is missing or invalid.
     */
    public function testAlgorithmParameterIsMissing()
    {
        $header = [
          'enc' => 'A256CBC-HS512',
          'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $cek = $this->convertArrayToBinString([111, 27, 25, 52, 66, 29, 20, 78, 92, 176, 56, 240, 65, 208, 82, 112, 161, 131, 36, 55, 202, 236, 185, 172, 129, 23, 153, 194, 195, 48, 253, 182]);

        $pbes2 = new PBES2HS512A256KW();
        $pbes2->encryptKey($key, $cek, $header);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The header is not valid. 'p2s' or 'p2c' parameter is missing or invalid.
     */
    public function testP2CParameterIsMissing()
    {
        $header = [
            'alg' => 'PBES2-HS256+A128KW',
            'p2c' => 4096,
            'enc' => 'A128CBC-HS256',
            'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $pbes2 = new PBES2HS256A128KW();

        $wrapped_cek = Base64Url::decode('TrqXOwuNUfDV9VPTNbyGvEJ9JMjefAVn-TR1uIxR9p6hsRQh9Tk7BA');

        $pbes2->decryptKey($key, $wrapped_cek, $header);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The header is not valid. 'p2s' or 'p2c' parameter is missing or invalid.
     */
    public function testP2SParameterIsMissing()
    {
        $header = [
            'alg' => 'PBES2-HS256+A128KW',
            'p2s' => '2WCTcJZ1Rvd_CJuJripQ1w',
            'enc' => 'A128CBC-HS256',
            'cty' => 'jwk+json',
        ];
        $key = new JWK([
            'kty' => 'oct',
            'k'   => Base64Url::encode($this->convertArrayToBinString([84, 104, 117, 115, 32, 102, 114, 111, 109, 32, 109, 121, 32, 108, 105, 112, 115, 44, 32, 98, 121, 32, 121, 111, 117, 114, 115, 44, 32, 109, 121, 32, 115, 105, 110, 32, 105, 115, 32, 112, 117, 114, 103, 101, 100, 46])),
        ]);

        $pbes2 = new PBES2HS256A128KW();

        $wrapped_cek = Base64Url::decode('TrqXOwuNUfDV9VPTNbyGvEJ9JMjefAVn-TR1uIxR9p6hsRQh9Tk7BA');

        $pbes2->decryptKey($key, $wrapped_cek, $header);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function convertArrayToBinString(array $data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }

        return hex2bin(implode('', $data));
    }
}
