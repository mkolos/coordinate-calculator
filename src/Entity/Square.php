<?php

declare(strict_types = 1);

namespace App\Entity;

class Square
{

    protected const DECIMAL_DEGREES_TO_METERS = 111320;

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


    public function setOtherPointsOfSquare(): void
    {
        $this->latitudeC = $this->latitudeB;
        $this->longitudeC = $this->longitudeA;
        $this->latitudeD = $this->latitudeA;
        $this->longitudeD = $this->longitudeB;
    }

    public function setPerimeterOfSquare(): void
    {
        if (!$this->isSquareSet())
        {
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


    protected function isSquareSet(): bool
    {
        return isset($this->longitudeA)
          && isset($this->latitudeA)
          && isset($this->longitudeB)
          && isset($this->latitudeB);
    }

    protected function calculateSides(): void
    {
        if (!$this->isSquareSet())
        {
            return;
        }

        $this->sideOne = abs($this->latitudeB - $this->latitudeA);
        $this->sideTwo = abs($this->longitudeA - $this->longitudeB);
    }



}