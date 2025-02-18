<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Algorithm\ContentEncryption;

/**
 * Class A128CBCHS256.
 */
class A128CBCHS256 extends AESCBCHS
{
    /**
     * {@inheritdoc}
     */
    protected function getHashAlgorithm()
    {
        return 'sha256';
    }

    /**
     * {@inheritdoc}
     */
    public function getCEKSize()
    {
        return 256;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlgorithmName()
    {
        return 'A128CBC-HS256';
    }
}
