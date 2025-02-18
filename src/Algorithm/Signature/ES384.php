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

use Mdanter\Ecc\EccFactory;

/**
 */
class ES384 extends ECDSA
{
    /**
     * @return \Mdanter\Ecc\Primitives\GeneratorPoint
     */
    protected function getGenerator()
    {
        return EccFactory::getNistCurves()->generator384();
    }

    /**
     * @return string
     */
    protected function getHashAlgorithm()
    {
        return 'sha384';
    }

    /**
     * @return int
     */
    protected function getSignaturePartLength()
    {
        return 96;
    }

    /**
     * @return string
     */
    public function getAlgorithmName()
    {
        return 'ES384';
    }
}
