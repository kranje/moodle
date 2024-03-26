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
use MongoDB\InsertOneResult;
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

/**
 * Operation for inserting a single document with the insert command.
 *
 * @api
 * @see \MongoDB\Collection::insertOne()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/insert/
 */
class InsertOne implements Executable
{
=======
 * @see http://docs.mongodb.org/manual/reference/command/insert/
 */
class InsertOne implements Executable
{
    /** @var integer */
    private static $wireVersionForDocumentLevelValidation = 4;

>>>>>>> forked/LAE_400_PACKAGE
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array|object */
    private $document;

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
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
=======
     *    For servers < 3.2, this option is ignored as document level validation
     *    is not available.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $document       Document to insert
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, $document, array $options = [])
=======
    public function __construct($databaseName, $collectionName, $document, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($document) && ! is_object($document)) {
            throw InvalidArgumentException::invalidType('$document', $document, 'array or object');
        }

        if (isset($options['bypassDocumentValidation']) && ! is_bool($options['bypassDocumentValidation'])) {
            throw InvalidArgumentException::invalidType('"bypassDocumentValidation" option', $options['bypassDocumentValidation'], 'boolean');
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
        $this->document = $document;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return InsertOneResult
     * @throws UnsupportedException if write concern is used and unsupported
=======
     * @param Server $server
     * @return InsertOneResult
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
=======
        $options = [];

>>>>>>> forked/LAE_400_PACKAGE
        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if (isset($this->options['writeConcern']) && $inTransaction) {
            throw UnsupportedException::writeConcernNotSupportedInTransaction();
        }

<<<<<<< HEAD
        $bulk = new Bulk($this->createBulkWriteOptions());
        $insertedId = $bulk->insert($this->document);

        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createExecuteOptions());
=======
        if (! empty($this->options['bypassDocumentValidation']) &&
            server_supports_feature($server, self::$wireVersionForDocumentLevelValidation)
        ) {
            $options['bypassDocumentValidation'] = $this->options['bypassDocumentValidation'];
        }

        $bulk = new Bulk($options);
        $insertedId = $bulk->insert($this->document);

        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        return new InsertOneResult($writeResult, $insertedId);
    }

    /**
<<<<<<< HEAD
     * Create options for constructing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
     */
    private function createBulkWriteOptions(): array
    {
        $options = [];

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
