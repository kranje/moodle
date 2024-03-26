<?php

namespace PhpOffice\PhpSpreadsheet\Calculation\Token;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
<<<<<<< HEAD
use PhpOffice\PhpSpreadsheet\Calculation\Engine\BranchPruner;
=======
>>>>>>> forked/LAE_400_PACKAGE

class Stack
{
    /**
<<<<<<< HEAD
     * @var BranchPruner
     */
    private $branchPruner;

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * The parser stack for formulae.
     *
     * @var mixed[]
     */
    private $stack = [];

    /**
     * Count of entries in the parser stack.
     *
     * @var int
     */
    private $count = 0;

<<<<<<< HEAD
    public function __construct(BranchPruner $branchPruner)
    {
        $this->branchPruner = $branchPruner;
    }

    /**
     * Return the number of entries on the stack.
     */
    public function count(): int
=======
    /**
     * Return the number of entries on the stack.
     *
     * @return int
     */
    public function count()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->count;
    }

    /**
     * Push a new entry onto the stack.
     *
<<<<<<< HEAD
     * @param mixed $value
     */
    public function push(string $type, $value, ?string $reference = null): void
    {
        $stackItem = $this->getStackItem($type, $value, $reference);
=======
     * @param mixed $type
     * @param mixed $value
     * @param mixed $reference
     * @param null|string $storeKey will store the result under this alias
     * @param null|string $onlyIf will only run computation if the matching
     *      store key is true
     * @param null|string $onlyIfNot will only run computation if the matching
     *      store key is false
     */
    public function push(
        $type,
        $value,
        $reference = null,
        $storeKey = null,
        $onlyIf = null,
        $onlyIfNot = null
    ): void {
        $stackItem = $this->getStackItem($type, $value, $reference, $storeKey, $onlyIf, $onlyIfNot);

>>>>>>> forked/LAE_400_PACKAGE
        $this->stack[$this->count++] = $stackItem;

        if ($type == 'Function') {
            $localeFunction = Calculation::localeFunc($value);
            if ($localeFunction != $value) {
                $this->stack[($this->count - 1)]['localeValue'] = $localeFunction;
            }
        }
    }

<<<<<<< HEAD
    public function pushStackItem(array $stackItem): void
    {
        $this->stack[$this->count++] = $stackItem;
    }

    /**
     * @param mixed $value
     */
    public function getStackItem(string $type, $value, ?string $reference = null): array
    {
=======
    public function getStackItem(
        $type,
        $value,
        $reference = null,
        $storeKey = null,
        $onlyIf = null,
        $onlyIfNot = null
    ) {
>>>>>>> forked/LAE_400_PACKAGE
        $stackItem = [
            'type' => $type,
            'value' => $value,
            'reference' => $reference,
        ];

<<<<<<< HEAD
        // will store the result under this alias
        $storeKey = $this->branchPruner->currentCondition();
        if (isset($storeKey) || $reference === 'NULL') {
            $stackItem['storeKey'] = $storeKey;
        }

        // will only run computation if the matching store key is true
        $onlyIf = $this->branchPruner->currentOnlyIf();
        if (isset($onlyIf) || $reference === 'NULL') {
            $stackItem['onlyIf'] = $onlyIf;
        }

        // will only run computation if the matching store key is false
        $onlyIfNot = $this->branchPruner->currentOnlyIfNot();
        if (isset($onlyIfNot) || $reference === 'NULL') {
=======
        if (isset($storeKey)) {
            $stackItem['storeKey'] = $storeKey;
        }

        if (isset($onlyIf)) {
            $stackItem['onlyIf'] = $onlyIf;
        }

        if (isset($onlyIfNot)) {
>>>>>>> forked/LAE_400_PACKAGE
            $stackItem['onlyIfNot'] = $onlyIfNot;
        }

        return $stackItem;
    }

    /**
     * Pop the last entry from the stack.
<<<<<<< HEAD
     */
    public function pop(): ?array
=======
     *
     * @return mixed
     */
    public function pop()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->count > 0) {
            return $this->stack[--$this->count];
        }

        return null;
    }

    /**
     * Return an entry from the stack without removing it.
<<<<<<< HEAD
     */
    public function last(int $n = 1): ?array
=======
     *
     * @param int $n number indicating how far back in the stack we want to look
     *
     * @return mixed
     */
    public function last($n = 1)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($this->count - $n < 0) {
            return null;
        }

        return $this->stack[$this->count - $n];
    }

    /**
     * Clear the stack.
     */
    public function clear(): void
    {
        $this->stack = [];
        $this->count = 0;
    }
<<<<<<< HEAD
=======

    public function __toString()
    {
        $str = 'Stack: ';
        foreach ($this->stack as $index => $item) {
            if ($index > $this->count - 1) {
                break;
            }
            $value = $item['value'] ?? 'no value';
            while (is_array($value)) {
                $value = array_pop($value);
            }
            $str .= $value . ' |> ';
        }

        return $str;
    }
>>>>>>> forked/LAE_400_PACKAGE
}
