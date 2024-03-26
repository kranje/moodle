<?php

if (!class_exists('Google_Client')) {
  require_once dirname(__FILE__) . '/autoload.php';
}

/**
 * Extension to the regular Google_Model that automatically
 * exposes the items array for iteration, so you can just
 * iterate over the object rather than a reference inside.
 */
class Google_Collection extends Google_Model implements Iterator, Countable
{
  protected $collection_key = 'items';

<<<<<<< HEAD
  public function rewind(): void
=======
  public function rewind()
>>>>>>> forked/LAE_400_PACKAGE
  {
    if (isset($this->modelData[$this->collection_key])
        && is_array($this->modelData[$this->collection_key])) {
      reset($this->modelData[$this->collection_key]);
    }
  }

<<<<<<< HEAD
  #[\ReturnTypeWillChange]
=======
>>>>>>> forked/LAE_400_PACKAGE
  public function current()
  {
    $this->coerceType($this->key());
    if (is_array($this->modelData[$this->collection_key])) {
      return current($this->modelData[$this->collection_key]);
    }
<<<<<<< HEAD
    return null;
  }

  #[\ReturnTypeWillChange]
=======
  }

>>>>>>> forked/LAE_400_PACKAGE
  public function key()
  {
    if (isset($this->modelData[$this->collection_key])
        && is_array($this->modelData[$this->collection_key])) {
      return key($this->modelData[$this->collection_key]);
    }
<<<<<<< HEAD
    return null;
  }

  public function next(): void
  {
    next($this->modelData[$this->collection_key]);
  }

  public function valid(): bool
=======
  }

  public function next()
  {
    return next($this->modelData[$this->collection_key]);
  }

  public function valid()
>>>>>>> forked/LAE_400_PACKAGE
  {
    $key = $this->key();
    return $key !== null && $key !== false;
  }

<<<<<<< HEAD
  public function count(): int
=======
  public function count()
>>>>>>> forked/LAE_400_PACKAGE
  {
    if (!isset($this->modelData[$this->collection_key])) {
      return 0;
    }
    return count($this->modelData[$this->collection_key]);
  }

<<<<<<< HEAD
  public function offsetExists($offset): bool
=======
  public function offsetExists($offset)
>>>>>>> forked/LAE_400_PACKAGE
  {
    if (!is_numeric($offset)) {
      return parent::offsetExists($offset);
    }
    return isset($this->modelData[$this->collection_key][$offset]);
  }

<<<<<<< HEAD
  #[\ReturnTypeWillChange]
=======
>>>>>>> forked/LAE_400_PACKAGE
  public function offsetGet($offset)
  {
    if (!is_numeric($offset)) {
      return parent::offsetGet($offset);
    }
    $this->coerceType($offset);
    return $this->modelData[$this->collection_key][$offset];
  }

<<<<<<< HEAD
  public function offsetSet($offset, $value): void
  {
    if (!is_numeric($offset)) {
      parent::offsetSet($offset, $value);
      return;
=======
  public function offsetSet($offset, $value)
  {
    if (!is_numeric($offset)) {
      return parent::offsetSet($offset, $value);
>>>>>>> forked/LAE_400_PACKAGE
    }
    $this->modelData[$this->collection_key][$offset] = $value;
  }

<<<<<<< HEAD
  public function offsetUnset($offset): void
  {
    if (!is_numeric($offset)) {
        parent::offsetUnset($offset);
        return;
=======
  public function offsetUnset($offset)
  {
    if (!is_numeric($offset)) {
      return parent::offsetUnset($offset);
>>>>>>> forked/LAE_400_PACKAGE
    }
    unset($this->modelData[$this->collection_key][$offset]);
  }

  private function coerceType($offset)
  {
    $typeKey = $this->keyType($this->collection_key);
    if (isset($this->$typeKey) && !is_object($this->modelData[$this->collection_key][$offset])) {
      $type = $this->$typeKey;
      $this->modelData[$this->collection_key][$offset] =
          new $type($this->modelData[$this->collection_key][$offset]);
    }
  }
}
