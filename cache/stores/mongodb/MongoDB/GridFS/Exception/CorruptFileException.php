<?php
/*
<<<<<<< HEAD
 * Copyright 2016-present MongoDB, Inc.
=======
 * Copyright 2016-2017 MongoDB, Inc.
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
<<<<<<< HEAD
 *   https://www.apache.org/licenses/LICENSE-2.0
=======
 *   http://www.apache.org/licenses/LICENSE-2.0
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace MongoDB\GridFS\Exception;

use MongoDB\Exception\RuntimeException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function sprintf;

class CorruptFileException extends RuntimeException
{
    /**
<<<<<<< HEAD
     * Thrown when a chunk doesn't contain valid data.
     */
    public static function invalidChunkData(int $chunkIndex): self
    {
        return new static(sprintf('Invalid data found for index "%d"', $chunkIndex));
    }

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Thrown when a chunk is not found for an expected index.
     *
     * @param integer $expectedIndex Expected index number
     * @return self
     */
<<<<<<< HEAD
    public static function missingChunk(int $expectedIndex)
=======
    public static function missingChunk($expectedIndex)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new static(sprintf('Chunk not found for index "%d"', $expectedIndex));
    }

    /**
     * Thrown when a chunk has an unexpected index number.
     *
     * @param integer $index         Actual index number (i.e. "n" field)
     * @param integer $expectedIndex Expected index number
     * @return self
     */
<<<<<<< HEAD
    public static function unexpectedIndex(int $index, int $expectedIndex)
=======
    public static function unexpectedIndex($index, $expectedIndex)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new static(sprintf('Expected chunk to have index "%d" but found "%d"', $expectedIndex, $index));
    }

    /**
     * Thrown when a chunk has an unexpected data size.
     *
     * @param integer $size         Actual size (i.e. "data" field length)
     * @param integer $expectedSize Expected size
     * @return self
     */
<<<<<<< HEAD
    public static function unexpectedSize(int $size, int $expectedSize)
=======
    public static function unexpectedSize($size, $expectedSize)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new static(sprintf('Expected chunk to have size "%d" but found "%d"', $expectedSize, $size));
    }
}
