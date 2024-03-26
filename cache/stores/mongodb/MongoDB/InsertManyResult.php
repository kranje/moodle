<?php
/*
<<<<<<< HEAD
 * Copyright 2015-present MongoDB, Inc.
=======
 * Copyright 2015-2017 MongoDB, Inc.
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

namespace MongoDB;

use MongoDB\Driver\WriteResult;
use MongoDB\Exception\BadMethodCallException;

/**
 * Result class for a multi-document insert operation.
 */
class InsertManyResult
{
    /** @var WriteResult */
    private $writeResult;

<<<<<<< HEAD
    /** @var array */
=======
    /** @var mixed[] */
>>>>>>> forked/LAE_400_PACKAGE
    private $insertedIds;

    /** @var boolean */
    private $isAcknowledged;

<<<<<<< HEAD
=======
    /**
     * @param WriteResult $writeResult
     * @param mixed[]     $insertedIds
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function __construct(WriteResult $writeResult, array $insertedIds)
    {
        $this->writeResult = $writeResult;
        $this->insertedIds = $insertedIds;
        $this->isAcknowledged = $writeResult->isAcknowledged();
    }

    /**
     * Return the number of documents that were inserted.
     *
     * This method should only be called if the write was acknowledged.
     *
     * @see InsertManyResult::isAcknowledged()
<<<<<<< HEAD
     * @return integer|null
=======
     * @return integer
>>>>>>> forked/LAE_400_PACKAGE
     * @throws BadMethodCallException is the write result is unacknowledged
     */
    public function getInsertedCount()
    {
        if ($this->isAcknowledged) {
            return $this->writeResult->getInsertedCount();
        }

        throw BadMethodCallException::unacknowledgedWriteResultAccess(__METHOD__);
    }

    /**
     * Return a map of the inserted documents' IDs.
     *
     * The index of each ID in the map corresponds to each document's position
     * in the bulk operation. If a document had an ID prior to inserting (i.e.
     * the driver did not generate an ID), the index will contain its "_id"
     * field value. Any driver-generated ID will be a MongoDB\BSON\ObjectId
     * instance.
     *
<<<<<<< HEAD
     * @return array
=======
     * @return mixed[]
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getInsertedIds()
    {
        return $this->insertedIds;
    }

    /**
     * Return whether this insert result was acknowledged by the server.
     *
     * If the insert was not acknowledged, other fields from the WriteResult
     * (e.g. insertedCount) will be undefined.
     *
     * @return boolean
     */
    public function isAcknowledged()
    {
        return $this->writeResult->isAcknowledged();
    }
}
