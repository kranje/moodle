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

namespace MongoDB\Exception;

use BadMethodCallException as BaseBadMethodCallException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function sprintf;

class BadMethodCallException extends BaseBadMethodCallException implements Exception
{
    /**
     * Thrown when a mutable method is invoked on an immutable object.
     *
     * @param string $class Class name
     * @return self
     */
<<<<<<< HEAD
    public static function classIsImmutable(string $class)
=======
    public static function classIsImmutable($class)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new static(sprintf('%s is immutable', $class));
    }

    /**
     * Thrown when accessing a result field on an unacknowledged write result.
     *
     * @param string $method Method name
     * @return self
     */
<<<<<<< HEAD
    public static function unacknowledgedWriteResultAccess(string $method)
=======
    public static function unacknowledgedWriteResultAccess($method)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new static(sprintf('%s should not be called for an unacknowledged write result', $method));
    }
}
