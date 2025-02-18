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
 * Class A192KW.
 */
class A192KW extends AESKW
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
    public function getAlgorithmName()
    {
        return 'A192KW';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKeySize()
    {
        return 24;
    }
}
