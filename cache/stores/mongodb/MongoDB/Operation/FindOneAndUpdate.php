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

use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

use function array_key_exists;
=======
>>>>>>> forked/LAE_400_PACKAGE
use function is_array;
use function is_integer;
use function is_object;
use function MongoDB\is_first_key_operator;
use function MongoDB\is_pipeline;

/**
 * Operation for updating a document with the findAndModify command.
 *
 * @api
 * @see \MongoDB\Collection::findOneAndUpdate()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/findAndModify/
 */
class FindOneAndUpdate implements Executable, Explainable
{
    public const RETURN_DOCUMENT_BEFORE = 1;
    public const RETURN_DOCUMENT_AFTER = 2;
=======
 * @see http://docs.mongodb.org/manual/reference/command/findAndModify/
 */
class FindOneAndUpdate implements Executable, Explainable
{
    const RETURN_DOCUMENT_BEFORE = 1;
    const RETURN_DOCUMENT_AFTER = 2;
>>>>>>> forked/LAE_400_PACKAGE

    /** @var FindAndModify */
    private $findAndModify;

    /**
     * Constructs a findAndModify command for updating a document.
     *
     * Supported options:
     *
     *  * arrayFilters (document array): A set of filters specifying to which
     *    array elements an update should apply.
     *
     *  * bypassDocumentValidation (boolean): If true, allows the write to
     *    circumvent document level validation.
     *
<<<<<<< HEAD
     *  * collation (document): Collation specification.
     *
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    For servers < 3.2, this option is ignored as document level validation
     *    is not available.
     *
     *  * collation (document): Collation specification.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * hint (string|document): The index to use. Specify either the index
     *    name as a string or the index key pattern as a document. If specified,
     *    then the query system will only consider plans using the hinted index.
     *
     *    This is not supported for server versions < 4.4 and will result in an
     *    exception at execution time if used.
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * projection (document): Limits the fields to return for the matching
     *    document.
     *
     *  * returnDocument (enum): Whether to return the document before or after
     *    the update is applied. Must be either
     *    FindOneAndUpdate::RETURN_DOCUMENT_BEFORE or
     *    FindOneAndUpdate::RETURN_DOCUMENT_AFTER. The default is
     *    FindOneAndUpdate::RETURN_DOCUMENT_BEFORE.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * sort (document): Determines which document the operation modifies if
     *    the query selects multiple documents.
     *
     *  * typeMap (array): Type map for BSON deserialization.
     *
     *  * upsert (boolean): When true, a new document is created if no document
     *    matches the query. The default is false.
     *
<<<<<<< HEAD
     *  * let (document): Map of parameter names and values. Values must be
     *    constant or closed expressions that do not reference document fields.
     *    Parameters can then be accessed as variables in an aggregate
     *    expression context (e.g. "$$var").
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
=======
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $filter         Query by which to filter documents
     * @param array|object $update         Update to apply to the matched document
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, $filter, $update, array $options = [])
=======
    public function __construct($databaseName, $collectionName, $filter, $update, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($filter) && ! is_object($filter)) {
            throw InvalidArgumentException::invalidType('$filter', $filter, 'array or object');
        }

        if (! is_array($update) && ! is_object($update)) {
            throw InvalidArgumentException::invalidType('$update', $update, 'array or object');
        }

        if (! is_first_key_operator($update) && ! is_pipeline($update)) {
            throw new InvalidArgumentException('Expected an update document with operator as first key or a pipeline');
        }

<<<<<<< HEAD
=======
        $options += [
            'returnDocument' => self::RETURN_DOCUMENT_BEFORE,
            'upsert' => false,
        ];

>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['projection']) && ! is_array($options['projection']) && ! is_object($options['projection'])) {
            throw InvalidArgumentException::invalidType('"projection" option', $options['projection'], 'array or object');
        }

<<<<<<< HEAD
        if (array_key_exists('returnDocument', $options) && ! is_integer($options['returnDocument'])) {
            throw InvalidArgumentException::invalidType('"returnDocument" option', $options['returnDocument'], 'integer');
        }

        if (
            isset($options['returnDocument']) &&
            $options['returnDocument'] !== self::RETURN_DOCUMENT_AFTER &&
            $options['returnDocument'] !== self::RETURN_DOCUMENT_BEFORE
        ) {
=======
        if (! is_integer($options['returnDocument'])) {
            throw InvalidArgumentException::invalidType('"returnDocument" option', $options['returnDocument'], 'integer');
        }

        if ($options['returnDocument'] !== self::RETURN_DOCUMENT_AFTER &&
            $options['returnDocument'] !== self::RETURN_DOCUMENT_BEFORE) {
>>>>>>> forked/LAE_400_PACKAGE
            throw new InvalidArgumentException('Invalid value for "returnDocument" option: ' . $options['returnDocument']);
        }

        if (isset($options['projection'])) {
            $options['fields'] = $options['projection'];
        }

<<<<<<< HEAD
        if (isset($options['returnDocument'])) {
            $options['new'] = $options['returnDocument'] === self::RETURN_DOCUMENT_AFTER;
        }
=======
        $options['new'] = $options['returnDocument'] === self::RETURN_DOCUMENT_AFTER;
>>>>>>> forked/LAE_400_PACKAGE

        unset($options['projection'], $options['returnDocument']);

        $this->findAndModify = new FindAndModify(
            $databaseName,
            $collectionName,
            ['query' => $filter, 'update' => $update] + $options
        );
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
=======
     * @param Server $server
>>>>>>> forked/LAE_400_PACKAGE
     * @return array|object|null
     * @throws UnsupportedException if collation or write concern is used and unsupported
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
        return $this->findAndModify->execute($server);
    }

<<<<<<< HEAD
    /**
     * Returns the command document for this operation.
     *
     * @see Explainable::getCommandDocument()
     * @return array
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function getCommandDocument(Server $server)
    {
        return $this->findAndModify->getCommandDocument($server);
    }
}
