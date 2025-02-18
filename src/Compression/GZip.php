<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Compression;

use Jose\Compression\CompressionInterface;

/**
 * This class implements the compression algorithm GZ (GZip).
 * This compression algorithm is not part of the specification.
 */
class GZip implements CompressionInterface
{
    /**
     * @var int
     */
    protected $compression_level = -1;

    /**
     * @param int $level
     *
     * @return self
     */
    public function setCompressionLevel($level)
    {
        if (!is_numeric($level) || $level < -1 || $level > 9) {
            throw new \InvalidArgumentException('The level of compression can be given as 0 for no compression up to 9 for maximum compression. If -1 given, the default compression level will be the default compression level of the zlib library.');
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCompressionLevel()
    {
        return $this->compression_level;
    }

    /**
     * @return string
     */
    public function getMethodName()
    {
        return 'GZ';
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function compress($data)
    {
        return gzencode($data, $this->getCompressionLevel());
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function uncompress($data)
    {
        return gzdecode($data);
    }
}
