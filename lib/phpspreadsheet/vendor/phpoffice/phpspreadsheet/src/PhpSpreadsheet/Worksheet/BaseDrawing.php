<?php

namespace PhpOffice\PhpSpreadsheet\Worksheet;

use PhpOffice\PhpSpreadsheet\Cell\Hyperlink;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;
use PhpOffice\PhpSpreadsheet\IComparable;

class BaseDrawing implements IComparable
{
<<<<<<< HEAD
    const EDIT_AS_ABSOLUTE = 'absolute';
    const EDIT_AS_ONECELL = 'oneCell';
    const EDIT_AS_TWOCELL = 'twoCell';
    private const VALID_EDIT_AS = [
        self::EDIT_AS_ABSOLUTE,
        self::EDIT_AS_ONECELL,
        self::EDIT_AS_TWOCELL,
    ];

    /**
     * The editAs attribute, used only with two cell anchor.
     *
     * @var string
     */
    protected $editAs = '';

=======
>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Image counter.
     *
     * @var int
     */
    private static $imageCounter = 0;

    /**
     * Image index.
     *
     * @var int
     */
    private $imageIndex = 0;

    /**
     * Name.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $name = '';
=======
    protected $name;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Description.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $description = '';
=======
    protected $description;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Worksheet.
     *
     * @var null|Worksheet
     */
    protected $worksheet;

    /**
     * Coordinates.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $coordinates = 'A1';
=======
    protected $coordinates;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Offset X.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $offsetX = 0;
=======
    protected $offsetX;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Offset Y.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $offsetY = 0;

    /**
     * Coordinates2.
     *
     * @var string
     */
    protected $coordinates2 = '';

    /**
     * Offset X2.
     *
     * @var int
     */
    protected $offsetX2 = 0;

    /**
     * Offset Y2.
     *
     * @var int
     */
    protected $offsetY2 = 0;
=======
    protected $offsetY;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Width.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $width = 0;
=======
    protected $width;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Height.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $height = 0;

    /**
     * Pixel width of image. See $width for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageWidth = 0;

    /**
     * Pixel width of image. See $height for the size the Drawing will be in the sheet.
     *
     * @var int
     */
    protected $imageHeight = 0;
=======
    protected $height;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Proportional resize.
     *
     * @var bool
     */
<<<<<<< HEAD
    protected $resizeProportional = true;
=======
    protected $resizeProportional;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Rotation.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $rotation = 0;
=======
    protected $rotation;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Shadow.
     *
     * @var Drawing\Shadow
     */
    protected $shadow;

    /**
     * Image hyperlink.
     *
     * @var null|Hyperlink
     */
    private $hyperlink;

    /**
     * Image type.
     *
     * @var int
     */
<<<<<<< HEAD
    protected $type = IMAGETYPE_UNKNOWN;
=======
    protected $type;
>>>>>>> forked/LAE_400_PACKAGE

    /**
     * Create a new BaseDrawing.
     */
    public function __construct()
    {
        // Initialise values
<<<<<<< HEAD
        $this->setShadow();
=======
        $this->name = '';
        $this->description = '';
        $this->worksheet = null;
        $this->coordinates = 'A1';
        $this->offsetX = 0;
        $this->offsetY = 0;
        $this->width = 0;
        $this->height = 0;
        $this->resizeProportional = true;
        $this->rotation = 0;
        $this->shadow = new Drawing\Shadow();
        $this->type = IMAGETYPE_UNKNOWN;
>>>>>>> forked/LAE_400_PACKAGE

        // Set image index
        ++self::$imageCounter;
        $this->imageIndex = self::$imageCounter;
    }

<<<<<<< HEAD
    public function getImageIndex(): int
=======
    /**
     * Get image index.
     *
     * @return int
     */
    public function getImageIndex()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->imageIndex;
    }

<<<<<<< HEAD
    public function getName(): string
=======
    /**
     * Get Name.
     *
     * @return string
     */
    public function getName()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->name;
    }

<<<<<<< HEAD
    public function setName(string $name): self
=======
    /**
     * Set Name.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->name = $name;

        return $this;
    }

<<<<<<< HEAD
    public function getDescription(): string
=======
    /**
     * Get Description.
     *
     * @return string
     */
    public function getDescription()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->description;
    }

<<<<<<< HEAD
    public function setDescription(string $description): self
=======
    /**
     * Set Description.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->description = $description;

        return $this;
    }

<<<<<<< HEAD
    public function getWorksheet(): ?Worksheet
=======
    /**
     * Get Worksheet.
     *
     * @return null|Worksheet
     */
    public function getWorksheet()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->worksheet;
    }

    /**
     * Set Worksheet.
     *
     * @param bool $overrideOld If a Worksheet has already been assigned, overwrite it and remove image from old Worksheet?
<<<<<<< HEAD
     */
    public function setWorksheet(?Worksheet $worksheet = null, bool $overrideOld = false): self
    {
        if ($this->worksheet === null) {
            // Add drawing to \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
            if ($worksheet !== null) {
                $this->worksheet = $worksheet;
                $this->worksheet->getCell($this->coordinates);
                $this->worksheet->getDrawingCollection()->append($this);
            }
=======
     *
     * @return $this
     */
    public function setWorksheet(?Worksheet $worksheet = null, $overrideOld = false)
    {
        if ($this->worksheet === null) {
            // Add drawing to \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
            $this->worksheet = $worksheet;
            $this->worksheet->getCell($this->coordinates);
            $this->worksheet->getDrawingCollection()->append($this);
>>>>>>> forked/LAE_400_PACKAGE
        } else {
            if ($overrideOld) {
                // Remove drawing from old \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
                $iterator = $this->worksheet->getDrawingCollection()->getIterator();

                while ($iterator->valid()) {
                    if ($iterator->current()->getHashCode() === $this->getHashCode()) {
                        $this->worksheet->getDrawingCollection()->offsetUnset($iterator->key());
                        $this->worksheet = null;

                        break;
                    }
                }

                // Set new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
                $this->setWorksheet($worksheet);
            } else {
                throw new PhpSpreadsheetException('A Worksheet has already been assigned. Drawings can only exist on one \\PhpOffice\\PhpSpreadsheet\\Worksheet.');
            }
        }

        return $this;
    }

<<<<<<< HEAD
    public function getCoordinates(): string
=======
    /**
     * Get Coordinates.
     *
     * @return string
     */
    public function getCoordinates()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->coordinates;
    }

<<<<<<< HEAD
    public function setCoordinates(string $coordinates): self
=======
    /**
     * Set Coordinates.
     *
     * @param string $coordinates eg: 'A1'
     *
     * @return $this
     */
    public function setCoordinates($coordinates)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->coordinates = $coordinates;

        return $this;
    }

<<<<<<< HEAD
    public function getOffsetX(): int
=======
    /**
     * Get OffsetX.
     *
     * @return int
     */
    public function getOffsetX()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->offsetX;
    }

<<<<<<< HEAD
    public function setOffsetX(int $offsetX): self
=======
    /**
     * Set OffsetX.
     *
     * @param int $offsetX
     *
     * @return $this
     */
    public function setOffsetX($offsetX)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->offsetX = $offsetX;

        return $this;
    }

<<<<<<< HEAD
    public function getOffsetY(): int
=======
    /**
     * Get OffsetY.
     *
     * @return int
     */
    public function getOffsetY()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->offsetY;
    }

<<<<<<< HEAD
    public function setOffsetY(int $offsetY): self
=======
    /**
     * Set OffsetY.
     *
     * @param int $offsetY
     *
     * @return $this
     */
    public function setOffsetY($offsetY)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->offsetY = $offsetY;

        return $this;
    }

<<<<<<< HEAD
    public function getCoordinates2(): string
    {
        return $this->coordinates2;
    }

    public function setCoordinates2(string $coordinates2): self
    {
        $this->coordinates2 = $coordinates2;

        return $this;
    }

    public function getOffsetX2(): int
    {
        return $this->offsetX2;
    }

    public function setOffsetX2(int $offsetX2): self
    {
        $this->offsetX2 = $offsetX2;

        return $this;
    }

    public function getOffsetY2(): int
    {
        return $this->offsetY2;
    }

    public function setOffsetY2(int $offsetY2): self
    {
        $this->offsetY2 = $offsetY2;

        return $this;
    }

    public function getWidth(): int
=======
    /**
     * Get Width.
     *
     * @return int
     */
    public function getWidth()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->width;
    }

<<<<<<< HEAD
    public function setWidth(int $width): self
=======
    /**
     * Set Width.
     *
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
>>>>>>> forked/LAE_400_PACKAGE
    {
        // Resize proportional?
        if ($this->resizeProportional && $width != 0) {
            $ratio = $this->height / ($this->width != 0 ? $this->width : 1);
            $this->height = (int) round($ratio * $width);
        }

        // Set width
        $this->width = $width;

        return $this;
    }

<<<<<<< HEAD
    public function getHeight(): int
=======
    /**
     * Get Height.
     *
     * @return int
     */
    public function getHeight()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->height;
    }

<<<<<<< HEAD
    public function setHeight(int $height): self
=======
    /**
     * Set Height.
     *
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
>>>>>>> forked/LAE_400_PACKAGE
    {
        // Resize proportional?
        if ($this->resizeProportional && $height != 0) {
            $ratio = $this->width / ($this->height != 0 ? $this->height : 1);
            $this->width = (int) round($ratio * $height);
        }

        // Set height
        $this->height = $height;

        return $this;
    }

    /**
     * Set width and height with proportional resize.
     *
     * Example:
     * <code>
     * $objDrawing->setResizeProportional(true);
     * $objDrawing->setWidthAndHeight(160,120);
     * </code>
     *
<<<<<<< HEAD
     * @author Vincent@luo MSN:kele_100@hotmail.com
     */
    public function setWidthAndHeight(int $width, int $height): self
=======
     * @param int $width
     * @param int $height
     *
     * @return $this
     *
     * @author Vincent@luo MSN:kele_100@hotmail.com
     */
    public function setWidthAndHeight($width, $height)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $xratio = $width / ($this->width != 0 ? $this->width : 1);
        $yratio = $height / ($this->height != 0 ? $this->height : 1);
        if ($this->resizeProportional && !($width == 0 || $height == 0)) {
            if (($xratio * $this->height) < $height) {
                $this->height = (int) ceil($xratio * $this->height);
                $this->width = $width;
            } else {
                $this->width = (int) ceil($yratio * $this->width);
                $this->height = $height;
            }
        } else {
            $this->width = $width;
            $this->height = $height;
        }

        return $this;
    }

<<<<<<< HEAD
    public function getResizeProportional(): bool
=======
    /**
     * Get ResizeProportional.
     *
     * @return bool
     */
    public function getResizeProportional()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->resizeProportional;
    }

<<<<<<< HEAD
    public function setResizeProportional(bool $resizeProportional): self
=======
    /**
     * Set ResizeProportional.
     *
     * @param bool $resizeProportional
     *
     * @return $this
     */
    public function setResizeProportional($resizeProportional)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->resizeProportional = $resizeProportional;

        return $this;
    }

<<<<<<< HEAD
    public function getRotation(): int
=======
    /**
     * Get Rotation.
     *
     * @return int
     */
    public function getRotation()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->rotation;
    }

<<<<<<< HEAD
    public function setRotation(int $rotation): self
=======
    /**
     * Set Rotation.
     *
     * @param int $rotation
     *
     * @return $this
     */
    public function setRotation($rotation)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->rotation = $rotation;

        return $this;
    }

<<<<<<< HEAD
    public function getShadow(): Drawing\Shadow
=======
    /**
     * Get Shadow.
     *
     * @return Drawing\Shadow
     */
    public function getShadow()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->shadow;
    }

<<<<<<< HEAD
    public function setShadow(?Drawing\Shadow $shadow = null): self
    {
        $this->shadow = $shadow ?? new Drawing\Shadow();
=======
    /**
     * Set Shadow.
     *
     * @return $this
     */
    public function setShadow(?Drawing\Shadow $shadow = null)
    {
        $this->shadow = $shadow;
>>>>>>> forked/LAE_400_PACKAGE

        return $this;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        return md5(
            $this->name .
            $this->description .
<<<<<<< HEAD
            (($this->worksheet === null) ? '' : $this->worksheet->getHashCode()) .
            $this->coordinates .
            $this->offsetX .
            $this->offsetY .
            $this->coordinates2 .
            $this->offsetX2 .
            $this->offsetY2 .
=======
            $this->worksheet->getHashCode() .
            $this->coordinates .
            $this->offsetX .
            $this->offsetY .
>>>>>>> forked/LAE_400_PACKAGE
            $this->width .
            $this->height .
            $this->rotation .
            $this->shadow->getHashCode() .
            __CLASS__
        );
    }

    /**
     * Implement PHP __clone to create a deep clone, not just a shallow copy.
     */
    public function __clone()
    {
        $vars = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if ($key == 'worksheet') {
                $this->worksheet = null;
            } elseif (is_object($value)) {
                $this->$key = clone $value;
            } else {
                $this->$key = $value;
            }
        }
    }

    public function setHyperlink(?Hyperlink $hyperlink = null): void
    {
        $this->hyperlink = $hyperlink;
    }

<<<<<<< HEAD
    public function getHyperlink(): ?Hyperlink
=======
    /**
     * @return null|Hyperlink
     */
    public function getHyperlink()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->hyperlink;
    }

    /**
     * Set Fact Sizes and Type of Image.
     */
    protected function setSizesAndType(string $path): void
    {
<<<<<<< HEAD
        if ($this->imageWidth === 0 && $this->imageHeight === 0 && $this->type === IMAGETYPE_UNKNOWN) {
            $imageData = getimagesize($path);

            if (is_array($imageData)) {
                $this->imageWidth = $imageData[0];
                $this->imageHeight = $imageData[1];
                $this->type = $imageData[2];
            }
        }
        if ($this->width === 0 && $this->height === 0) {
            $this->width = $this->imageWidth;
            $this->height = $this->imageHeight;
        }
=======
        if ($this->width == 0 && $this->height == 0 && $this->type == IMAGETYPE_UNKNOWN) {
            $imageData = getimagesize($path);

            if (is_array($imageData)) {
                $this->width = $imageData[0];
                $this->height = $imageData[1];
                $this->type = $imageData[2];
            }
        }
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Get Image Type.
     */
    public function getType(): int
    {
        return $this->type;
    }
<<<<<<< HEAD

    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    public function getEditAs(): string
    {
        return $this->editAs;
    }

    public function setEditAs(string $editAs): self
    {
        $this->editAs = $editAs;

        return $this;
    }

    public function validEditAs(): bool
    {
        return in_array($this->editAs, self::VALID_EDIT_AS, true);
    }
=======
>>>>>>> forked/LAE_400_PACKAGE
}
