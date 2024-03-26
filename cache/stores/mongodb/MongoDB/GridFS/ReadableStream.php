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

namespace MongoDB\GridFS;

<<<<<<< HEAD
use MongoDB\BSON\Binary;
use MongoDB\Driver\Cursor;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\GridFS\Exception\CorruptFileException;

use function assert;
use function ceil;
use function floor;
use function is_integer;
use function is_object;
=======
use IteratorIterator;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\GridFS\Exception\CorruptFileException;
use stdClass;
use function ceil;
use function floor;
use function is_integer;
>>>>>>> forked/LAE_400_PACKAGE
use function property_exists;
use function sprintf;
use function strlen;
use function substr;

/**
 * ReadableStream abstracts the process of reading a GridFS file.
 *
 * @internal
 */
class ReadableStream
{
    /** @var string|null */
    private $buffer;

    /** @var integer */
    private $bufferOffset = 0;

    /** @var integer */
    private $chunkSize;

    /** @var integer */
    private $chunkOffset = 0;

<<<<<<< HEAD
    /** @var Cursor|null */
=======
    /** @var IteratorIterator|null */
>>>>>>> forked/LAE_400_PACKAGE
    private $chunksIterator;

    /** @var CollectionWrapper */
    private $collectionWrapper;

<<<<<<< HEAD
    /** @var integer */
    private $expectedLastChunkSize = 0;

    /** @var object */
=======
    /** @var float|integer */
    private $expectedLastChunkSize = 0;

    /** @var stdClass */
>>>>>>> forked/LAE_400_PACKAGE
    private $file;

    /** @var integer */
    private $length;

    /** @var integer */
    private $numChunks = 0;

    /**
     * Constructs a readable GridFS stream.
     *
     * @param CollectionWrapper $collectionWrapper GridFS collection wrapper
<<<<<<< HEAD
     * @param object            $file              GridFS file document
     * @throws CorruptFileException
     */
    public function __construct(CollectionWrapper $collectionWrapper, object $file)
=======
     * @param stdClass          $file              GridFS file document
     * @throws CorruptFileException
     */
    public function __construct(CollectionWrapper $collectionWrapper, stdClass $file)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! isset($file->chunkSize) || ! is_integer($file->chunkSize) || $file->chunkSize < 1) {
            throw new CorruptFileException('file.chunkSize is not an integer >= 1');
        }

        if (! isset($file->length) || ! is_integer($file->length) || $file->length < 0) {
            throw new CorruptFileException('file.length is not an integer > 0');
        }

        if (! isset($file->_id) && ! property_exists($file, '_id')) {
            throw new CorruptFileException('file._id does not exist');
        }

        $this->file = $file;
<<<<<<< HEAD
        $this->chunkSize = $file->chunkSize;
        $this->length = $file->length;
=======
        $this->chunkSize = (integer) $file->chunkSize;
        $this->length = (integer) $file->length;
>>>>>>> forked/LAE_400_PACKAGE

        $this->collectionWrapper = $collectionWrapper;

        if ($this->length > 0) {
            $this->numChunks = (integer) ceil($this->length / $this->chunkSize);
<<<<<<< HEAD
            $this->expectedLastChunkSize = $this->length - (($this->numChunks - 1) * $this->chunkSize);
=======
            $this->expectedLastChunkSize = ($this->length - (($this->numChunks - 1) * $this->chunkSize));
>>>>>>> forked/LAE_400_PACKAGE
        }
    }

    /**
     * Return internal properties for debugging purposes.
     *
<<<<<<< HEAD
     * @see https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     * @return array
     */
    public function __debugInfo(): array
=======
     * @see http://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.debuginfo
     * @return array
     */
    public function __debugInfo()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return [
            'bucketName' => $this->collectionWrapper->getBucketName(),
            'databaseName' => $this->collectionWrapper->getDatabaseName(),
            'file' => $this->file,
        ];
    }

<<<<<<< HEAD
    public function close(): void
=======
    public function close()
>>>>>>> forked/LAE_400_PACKAGE
    {
        // Nothing to do
    }

<<<<<<< HEAD
    public function getFile(): object
=======
    /**
     * Return the stream's file document.
     *
     * @return stdClass
     */
    public function getFile()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->file;
    }

<<<<<<< HEAD
    public function getSize(): int
=======
    /**
     * Return the stream's size in bytes.
     *
     * @return integer
     */
    public function getSize()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->length;
    }

    /**
     * Return whether the current read position is at the end of the stream.
<<<<<<< HEAD
     */
    public function isEOF(): bool
=======
     *
     * @return boolean
     */
    public function isEOF()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->chunkOffset === $this->numChunks - 1) {
            return $this->bufferOffset >= $this->expectedLastChunkSize;
        }

        return $this->chunkOffset >= $this->numChunks;
    }

    /**
     * Read bytes from the stream.
     *
     * Note: this method may return a string smaller than the requested length
     * if data is not available to be read.
     *
     * @param integer $length Number of bytes to read
<<<<<<< HEAD
     * @throws InvalidArgumentException if $length is negative
     */
    public function readBytes(int $length): string
=======
     * @return string
     * @throws InvalidArgumentException if $length is negative
     */
    public function readBytes($length)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($length < 0) {
            throw new InvalidArgumentException(sprintf('$length must be >= 0; given: %d', $length));
        }

        if ($this->chunksIterator === null) {
            $this->initChunksIterator();
        }

        if ($this->buffer === null && ! $this->initBufferFromCurrentChunk()) {
            return '';
        }

<<<<<<< HEAD
        assert($this->buffer !== null);

=======
>>>>>>> forked/LAE_400_PACKAGE
        $data = '';

        while (strlen($data) < $length) {
            if ($this->bufferOffset >= strlen($this->buffer) && ! $this->initBufferFromNextChunk()) {
                break;
            }

            $initialDataLength = strlen($data);
            $data .= substr($this->buffer, $this->bufferOffset, $length - $initialDataLength);
            $this->bufferOffset += strlen($data) - $initialDataLength;
        }

        return $data;
    }

    /**
     * Seeks the chunk and buffer offsets for the next read operation.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException if $offset is out of range
     */
    public function seek(int $offset): void
=======
     * @param integer $offset
     * @throws InvalidArgumentException if $offset is out of range
     */
    public function seek($offset)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($offset < 0 || $offset > $this->file->length) {
            throw new InvalidArgumentException(sprintf('$offset must be >= 0 and <= %d; given: %d', $this->file->length, $offset));
        }

        /* Compute the offsets for the chunk and buffer (i.e. chunk data) from
         * which we will expect to read after seeking. If the chunk offset
         * changed, we'll also need to reset the buffer.
         */
        $lastChunkOffset = $this->chunkOffset;
        $this->chunkOffset = (integer) floor($offset / $this->chunkSize);
        $this->bufferOffset = $offset % $this->chunkSize;

        if ($lastChunkOffset === $this->chunkOffset) {
            return;
        }

        if ($this->chunksIterator === null) {
            return;
        }

        // Clear the buffer since the current chunk will be changed
        $this->buffer = null;

        /* If we are seeking to a previous chunk, we need to reinitialize the
         * chunk iterator.
         */
        if ($lastChunkOffset > $this->chunkOffset) {
            $this->chunksIterator = null;

            return;
        }

        /* If we are seeking to a subsequent chunk, we do not need to
         * reinitalize the chunk iterator. Instead, we can simply move forward
         * to $this->chunkOffset.
         */
        $numChunks = $this->chunkOffset - $lastChunkOffset;
        for ($i = 0; $i < $numChunks; $i++) {
            $this->chunksIterator->next();
        }
    }

    /**
     * Return the current position of the stream.
     *
     * This is the offset within the stream where the next byte would be read.
<<<<<<< HEAD
     */
    public function tell(): int
=======
     *
     * @return integer
     */
    public function tell()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return ($this->chunkOffset * $this->chunkSize) + $this->bufferOffset;
    }

    /**
     * Initialize the buffer to the current chunk's data.
     *
     * @return boolean Whether there was a current chunk to read
     * @throws CorruptFileException if an expected chunk could not be read successfully
     */
<<<<<<< HEAD
    private function initBufferFromCurrentChunk(): bool
=======
    private function initBufferFromCurrentChunk()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->chunkOffset === 0 && $this->numChunks === 0) {
            return false;
        }

<<<<<<< HEAD
        if ($this->chunksIterator === null) {
            return false;
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (! $this->chunksIterator->valid()) {
            throw CorruptFileException::missingChunk($this->chunkOffset);
        }

        $currentChunk = $this->chunksIterator->current();
<<<<<<< HEAD
        assert(is_object($currentChunk));
=======
>>>>>>> forked/LAE_400_PACKAGE

        if ($currentChunk->n !== $this->chunkOffset) {
            throw CorruptFileException::unexpectedIndex($currentChunk->n, $this->chunkOffset);
        }

<<<<<<< HEAD
        if (! $currentChunk->data instanceof Binary) {
            throw CorruptFileException::invalidChunkData($this->chunkOffset);
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        $this->buffer = $currentChunk->data->getData();

        $actualChunkSize = strlen($this->buffer);

        $expectedChunkSize = $this->chunkOffset === $this->numChunks - 1
            ? $this->expectedLastChunkSize
            : $this->chunkSize;

        if ($actualChunkSize !== $expectedChunkSize) {
            throw CorruptFileException::unexpectedSize($actualChunkSize, $expectedChunkSize);
        }

        return true;
    }

    /**
     * Advance to the next chunk and initialize the buffer to its data.
     *
     * @return boolean Whether there was a next chunk to read
     * @throws CorruptFileException if an expected chunk could not be read successfully
     */
<<<<<<< HEAD
    private function initBufferFromNextChunk(): bool
=======
    private function initBufferFromNextChunk()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->chunkOffset === $this->numChunks - 1) {
            return false;
        }

<<<<<<< HEAD
        if ($this->chunksIterator === null) {
            return false;
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        $this->bufferOffset = 0;
        $this->chunkOffset++;
        $this->chunksIterator->next();

        return $this->initBufferFromCurrentChunk();
    }

    /**
     * Initializes the chunk iterator starting from the current offset.
     */
<<<<<<< HEAD
    private function initChunksIterator(): void
    {
        $this->chunksIterator = $this->collectionWrapper->findChunksByFileId($this->file->_id, $this->chunkOffset);
=======
    private function initChunksIterator()
    {
        $cursor = $this->collectionWrapper->findChunksByFileId($this->file->_id, $this->chunkOffset);

        $this->chunksIterator = new IteratorIterator($cursor);
>>>>>>> forked/LAE_400_PACKAGE
        $this->chunksIterator->rewind();
    }
}
