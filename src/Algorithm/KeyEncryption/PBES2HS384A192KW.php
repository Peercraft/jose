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

use AESKW\A192KW as Wrapper;

/**
 * Class PBES2HS384A192KW.
 */
class PBES2HS384A192KW extends PBES2AESKW
{
    /**
     * {@inheritdoc}
     */
    protected function getWrapper()
    {
        return new Wrapper();
    }

    /**
     * {@inheritdoc}
     */
    protected function getHashAlgorithm()
    {
        return 'sha384';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKeySize()
    {
        return 24;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlgorithmName()
    {
        return 'PBES2-HS384+A192KW';
    }
}
