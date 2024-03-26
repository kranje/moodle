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

namespace MongoDB\Operation;

use MongoDB\Driver\BulkWrite as Bulk;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
use MongoDB\InsertManyResult;
<<<<<<< HEAD

use function is_array;
use function is_bool;
use function is_object;
=======
use function is_array;
use function is_bool;
use function is_object;
use function MongoDB\server_supports_feature;
>>>>>>> forked/LAE_400_PACKAGE
use function sprintf;

/**
 * Operation for inserting multiple documents with the insert command.
 *
 * @api
 * @see \MongoDB\Collection::insertMany()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/insert/
 */
class InsertMany implements Executable
{
=======
 * @see http://docs.mongodb.org/manual/reference/command/insert/
 */
class InsertMany implements Executable
{
    /** @var integer */
    private static $wireVersionForDocumentLevelValidation = 4;

>>>>>>> forked/LAE_400_PACKAGE
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var object[]|array[] */
    private $documents;

    /** @var array */
    private $options;

    /**
     * Constructs an insert command.
     *
     * Supported options:
     *
     *  * bypassDocumentValidation (boolean): If true, allows the write to
     *    circumvent document level validation.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to the command(s)
     *    associated with this insert.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    For servers < 3.2, this option is ignored as document level validation
     *    is not available.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * ordered (boolean): If true, when an insert fails, return without
     *    performing the remaining writes. If false, when a write fails,
     *    continue with the remaining writes, if any. The default is true.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @param string           $databaseName   Database name
     * @param string           $collectionName Collection name
     * @param array[]|object[] $documents      List of documents to insert
     * @param array            $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $documents, array $options = [])
=======
    public function __construct($databaseName, $collectionName, array $documents, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (empty($documents)) {
            throw new InvalidArgumentException('$documents is empty');
        }

        $expectedIndex = 0;

        foreach ($documents as $i => $document) {
            if ($i !== $expectedIndex) {
                throw new InvalidArgumentException(sprintf('$documents is not a list (unexpected index: "%s")', $i));
            }

            if (! is_array($document) && ! is_object($document)) {
                throw InvalidArgumentException::invalidType(sprintf('$documents[%d]', $i), $document, 'array or object');
            }

            $expectedIndex += 1;
        }

        $options += ['ordered' => true];

        if (isset($options['bypassDocumentValidation']) && ! is_bool($options['bypassDocumentValidation'])) {
            throw InvalidArgumentException::invalidType('"bypassDocumentValidation" option', $options['bypassDocumentValidation'], 'boolean');
        }

        if (! is_bool($options['ordered'])) {
            throw InvalidArgumentException::invalidType('"ordered" option', $options['ordered'], 'boolean');
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['writeConcern']) && ! $options['writeConcern'] instanceof WriteConcern) {
            throw InvalidArgumentException::invalidType('"writeConcern" option', $options['writeConcern'], WriteConcern::class);
        }

<<<<<<< HEAD
        if (isset($options['bypassDocumentValidation']) && ! $options['bypassDocumentValidation']) {
            unset($options['bypassDocumentValidation']);
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['writeConcern']) && $options['writeConcern']->isDefault()) {
            unset($options['writeConcern']);
        }

<<<<<<< HEAD
        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;
=======
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->documents = $documents;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return InsertManyResult
     * @throws UnsupportedException if write concern is used and unsupported
=======
     * @param Server $server
     * @return InsertManyResult
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if ($inTransaction && isset($this->options['writeConcern'])) {
            throw UnsupportedException::writeConcernNotSupportedInTransaction();
        }

<<<<<<< HEAD
        $bulk = new Bulk($this->createBulkWriteOptions());
=======
        $options = ['ordered' => $this->options['ordered']];

        if (! empty($this->options['bypassDocumentValidation']) &&
            server_supports_feature($server, self::$wireVersionForDocumentLevelValidation)
        ) {
            $options['bypassDocumentValidation'] = $this->options['bypassDocumentValidation'];
        }

        $bulk = new Bulk($options);
>>>>>>> forked/LAE_400_PACKAGE
        $insertedIds = [];

        foreach ($this->documents as $i => $document) {
            $insertedIds[$i] = $bulk->insert($document);
        }

<<<<<<< HEAD
        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createExecuteOptions());
=======
        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        return new InsertManyResult($writeResult, $insertedIds);
    }

    /**
<<<<<<< HEAD
     * Create options for constructing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
     */
    private function createBulkWriteOptions(): array
    {
        $options = ['ordered' => $this->options['ordered']];

        foreach (['bypassDocumentValidation', 'comment'] as $option) {
            if (isset($this->options[$option])) {
                $options[$option] = $this->options[$option];
            }
        }

        return $options;
    }

    /**
     * Create options for executing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
     */
    private function createExecuteOptions(): array
=======
     * Create options for executing the bulk write.
     *
     * @see http://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
     * @return array
     */
    private function createOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $options = [];

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        if (isset($this->options['writeConcern'])) {
            $options['writeConcern'] = $this->options['writeConcern'];
        }

        return $options;
    }
}
