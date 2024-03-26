<?php

namespace PhpOffice\PhpSpreadsheet\Style\ConditionalFormatting;

class ConditionalDataBar
{
    /** <dataBar> attribute  */

    /** @var null|bool */
    private $showValue;

    /** <dataBar> children */

<<<<<<< HEAD
    /** @var ?ConditionalFormatValueObject */
    private $minimumConditionalFormatValueObject;

    /** @var ?ConditionalFormatValueObject */
=======
    /** @var ConditionalFormatValueObject */
    private $minimumConditionalFormatValueObject;

    /** @var ConditionalFormatValueObject */
>>>>>>> forked/LAE_400_PACKAGE
    private $maximumConditionalFormatValueObject;

    /** @var string */
    private $color;

    /** <extLst> */

<<<<<<< HEAD
    /** @var ?ConditionalFormattingRuleExtension */
=======
    /** @var ConditionalFormattingRuleExtension */
>>>>>>> forked/LAE_400_PACKAGE
    private $conditionalFormattingRuleExt;

    /**
     * @return null|bool
     */
    public function getShowValue()
    {
        return $this->showValue;
    }

    /**
     * @param bool $showValue
     */
    public function setShowValue($showValue)
    {
        $this->showValue = $showValue;

        return $this;
    }

<<<<<<< HEAD
    public function getMinimumConditionalFormatValueObject(): ?ConditionalFormatValueObject
=======
    /**
     * @return ConditionalFormatValueObject
     */
    public function getMinimumConditionalFormatValueObject()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->minimumConditionalFormatValueObject;
    }

    public function setMinimumConditionalFormatValueObject(ConditionalFormatValueObject $minimumConditionalFormatValueObject)
    {
        $this->minimumConditionalFormatValueObject = $minimumConditionalFormatValueObject;

        return $this;
    }

<<<<<<< HEAD
    public function getMaximumConditionalFormatValueObject(): ?ConditionalFormatValueObject
=======
    /**
     * @return ConditionalFormatValueObject
     */
    public function getMaximumConditionalFormatValueObject()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->maximumConditionalFormatValueObject;
    }

    public function setMaximumConditionalFormatValueObject(ConditionalFormatValueObject $maximumConditionalFormatValueObject)
    {
        $this->maximumConditionalFormatValueObject = $maximumConditionalFormatValueObject;

        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

<<<<<<< HEAD
    public function getConditionalFormattingRuleExt(): ?ConditionalFormattingRuleExtension
=======
    /**
     * @return ConditionalFormattingRuleExtension
     */
    public function getConditionalFormattingRuleExt()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->conditionalFormattingRuleExt;
    }

    public function setConditionalFormattingRuleExt(ConditionalFormattingRuleExtension $conditionalFormattingRuleExt)
    {
        $this->conditionalFormattingRuleExt = $conditionalFormattingRuleExt;

        return $this;
    }
}
