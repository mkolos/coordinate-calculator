<?php

declare(strict_types=1);

namespace App\Entity;

use Exception;
use Monolog\Handler\IFTTTHandler;
use phpDocumentor\Reflection\DocBlock\Tags\TagWithType;
use phpDocumentor\Reflection\Types\Static_;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Square implements SquareInterface
{

    protected const DECIMAL_DEGREES_TO_METERS = 111320;

    protected $sizeOfCorner = 1;

    protected $costOfCorner = 400;

    protected $sizeOfColumn = 0.2;

    protected $costOfColumn = 100;

    protected $sizeOfWire = 2;

    protected $costOfWire = 50;

    protected $sizeOfGate = 5;

    protected $costOfGate = 1000;

    protected $latitudeA;

    protected $longitudeA;

    protected $latitudeB;

    protected $longitudeB;

    protected $latitudeC;

    protected $longitudeC;

    protected $latitudeD;

    protected $longitudeD;

    protected $perimeter;

    protected $area;

    protected $sideOne;

    protected $sideTwo;

    protected $costOfFence;


    /**
     * @return mixed
     */
    public function getLatitudeA()
    {
        return $this->latitudeA;
    }

    /**
     * @param mixed $latitudeA
     *
     * @return Square
     */
    public function setLatitudeA($latitudeA)
    {
        $this->latitudeA = $latitudeA;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitudeA()
    {
        return $this->longitudeA;
    }

    /**
     * @param mixed $longitudeA
     *
     * @return Square
     */
    public function setLongitudeA($longitudeA)
    {
        $this->longitudeA = $longitudeA;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitudeB()
    {
        return $this->latitudeB;
    }

    /**
     * @param mixed $latitudeB
     *
     * @return Square
     */
    public function setLatitudeB($latitudeB)
    {
        $this->latitudeB = $latitudeB;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitudeB()
    {
        return $this->longitudeB;
    }

    /**
     * @param mixed $longitudeB
     *
     * @return Square
     */
    public function setLongitudeB($longitudeB)
    {
        $this->longitudeB = $longitudeB;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitudeC()
    {
        return $this->latitudeC;
    }

    /**
     * @param mixed $latitudeC
     *
     * @return Square
     */
    public function setLatitudeC($latitudeC)
    {
        $this->latitudeC = $latitudeC;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitudeC()
    {
        return $this->longitudeC;
    }

    /**
     * @param mixed $longitudeC
     *
     * @return Square
     */
    public function setLongitudeC($longitudeC)
    {
        $this->longitudeC = $longitudeC;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatitudeD()
    {
        return $this->latitudeD;
    }

    /**
     * @param mixed $latitudeD
     *
     * @return Square
     */
    public function setLatitudeD($latitudeD)
    {
        $this->latitudeD = $latitudeD;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLongitudeD()
    {
        return $this->longitudeD;
    }

    /**
     * @param mixed $longitudeD
     *
     * @return Square
     */
    public function setLongitudeD($longitudeD)
    {
        $this->longitudeD = $longitudeD;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerimeter()
    {
        return $this->perimeter;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return mixed
     */
    public function getCostOfFence()
    {
        return $this->costOfFence;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('latitudeA', new NotBlank());
        $metadata->addPropertyConstraint(
          'latitudeA',
          new Assert\Range(
            [
              'min' => -90,
              'max' => 90,
              'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
            ]
          )
        );
        $metadata->addPropertyConstraint('longitudeA', new NotBlank());
        $metadata->addPropertyConstraint(
          'longitudeA',
          new Assert\Range(
            [
              'min' => -90,
              'max' => 90,
              'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
            ]
          )
        );
        $metadata->addPropertyConstraint('latitudeB', new NotBlank());
        $metadata->addPropertyConstraint(
          'latitudeB',
          new Assert\Range(
            [
              'min' => -90,
              'max' => 90,
              'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
            ]
          )
        );
        $metadata->addPropertyConstraint('longitudeB', new NotBlank());
        $metadata->addPropertyConstraint(
          'longitudeB',
          new Assert\Range(
            [
              'min' => -90,
              'max' => 90,
              'notInRangeMessage' => 'You must be between {{ min }}cm and {{ max }}cm tall to enter',
            ]
          )
        );
    }

    public function calculateOtherPointsOfSquare(): void
    {
        $this->latitudeC = $this->latitudeB;
        $this->longitudeC = $this->longitudeA;
        $this->latitudeD = $this->latitudeA;
        $this->longitudeD = $this->longitudeB;
    }

    public function calculatePerimeterOfSquare(): void
    {
        if (!$this->isSquareSet()) {
            return;
        }

        $sideOne = abs($this->latitudeB - $this->latitudeA);
        $sideTwo = abs($this->longitudeA - $this->longitudeB);

        $this->perimeter = ((2 * $sideOne) + (2 * $sideTwo)) * static::DECIMAL_DEGREES_TO_METERS;
    }

    public function calculateAreaOfSquare(): void
    {
        if (!$this->isSquareSet()) {
            return;
        }

        $this->calculateSides();

        $sideOneInMeters = $this->sideOne * static::DECIMAL_DEGREES_TO_METERS;
        $sideTwoInMeters = $this->sideTwo * static::DECIMAL_DEGREES_TO_METERS;

        $this->area = $sideOneInMeters * $sideTwoInMeters;
    }

    public function calculateCostOfFence(): void
    {
        if (!$this->isSquareSet()) {
            return;
        }

        $this->calculateSides();
        $this->calculatePerimeterOfSquare();

        $sideOneInMeters = $this->sideOne * static::DECIMAL_DEGREES_TO_METERS;
        $sideTwoInMeters = $this->sideTwo * static::DECIMAL_DEGREES_TO_METERS;

        $minLengthOfSide = $this->sizeOfCorner + $this->sizeOfGate;

        if ($sideOneInMeters < $minLengthOfSide || $sideTwoInMeters < $minLengthOfSide) {
            $this->costOfFence = 'These parameters cannot be used to calculate the cost of the fence';
        }

        $this->getCsvToVariable();

        $baseCost = $this->costOfCorner + $this->costOfGate;
        $costOfOneWireOneColumn = $this->costOfColumn + $this->costOfWire;

        $numberOfWiresAndColumnsInSideOne = ceil(
          ($sideOneInMeters - $minLengthOfSide) / ($this->sizeOfColumn + $this->sizeOfWire)
        );
        $numberOfWiresAndColumnsInSideTwo = ceil(
          ($sideTwoInMeters - $minLengthOfSide) / ($this->sizeOfColumn + $this->sizeOfWire)
        );

        $costOfSideOne = $baseCost + $numberOfWiresAndColumnsInSideOne * $costOfOneWireOneColumn;
        $costOfSideTwo = $baseCost + $numberOfWiresAndColumnsInSideTwo * $costOfOneWireOneColumn;

        $this->costOfFence = 2 * $costOfSideOne + 2 * $costOfSideTwo;
    }

    protected function isSquareSet(): bool
    {
        return isset($this->longitudeA)
          && isset($this->latitudeA)
          && isset($this->longitudeB)
          && isset($this->latitudeB);
    }

    protected function calculateSides(): void
    {
        if (!$this->isSquareSet()) {
            return;
        }

        $this->sideOne = abs($this->latitudeB - $this->latitudeA);
        $this->sideTwo = abs($this->longitudeA - $this->longitudeB);
    }

    protected function getCsvToVariable()
    {
        $data = array_map('str_getcsv', file(__DIR__ . '/cost.csv'));
        array_walk(
          $data,
          function (&$a) use ($data) {
              $a = array_combine($data[0], $a);
          }
        );
        array_shift($data); # remove column header

        foreach (reset($data) as $key => $value) {
            $this->{$key} = (float)$value;
        }
    }

}