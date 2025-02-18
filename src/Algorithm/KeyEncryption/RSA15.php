<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Algorithm\KeyEncryption;

use phpseclib\Crypt\RSA as PHPSecLibRSA;

/**
 * Class RSA15.
 */
class RSA15 extends RSA
{
    /**
     * {@inheritdoc}
     */
    protected function getEncryptionMode()
    {
        return PHPSecLibRSA::ENCRYPTION_PKCS1;
    }

    /**
     * {@inheritdoc}
     * 
     * @codeCoverageIgnore
     */
    protected function getHashAlgorithm()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAlgorithmName()
    {
        return 'RSA1_5';
    }
}
