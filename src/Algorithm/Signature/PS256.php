<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Algorithm\Signature;

use phpseclib\Crypt\RSA as PHPSecLibRSA;

/**
 * Class PS256.
 */
class PS256 extends RSA
{
    /**
     * @return string
     */
    protected function getAlgorithm()
    {
        return 'sha256';
    }

    /**
     * @return int
     */
    protected function getSignatureMethod()
    {
        return PHPSecLibRSA::SIGNATURE_PSS;
    }

    /**
     * @return string
     */
    public function getAlgorithmName()
    {
        return 'PS256';
    }
}
