<?php

namespace App\Tests\Entity;

use App\Entity\Square;
use PHPUnit\Framework\TestCase;

class SquareTest extends TestCase
{

    public function testCalculateAreaOfSquare()
    {
        $square = $this->setBaseSquare();
        $square->calculateAreaOfSquare();

        $this->assertEquals(49568569600, $square->getArea());
    }

    public function testCalculateCostOfFence()
    {
        $square = $this->setBaseSquare();
        $square->calculateCostOfFence();

        $this->assertEquals(424632408, $square->getCostOfFence());
    }

    public function testCalculateOtherPointsOfSquare()
    {
        $square = $this->setBaseSquare();

        $square->calculateOtherPointsOfSquare();
        $this->assertEquals(44, $square->getLatitudeC());
        $this->assertEquals(43, $square->getLongitudeC());
        $this->assertEquals(42, $square->getLatitudeD());
        $this->assertEquals(45, $square->getLongitudeD());
    }

    public function testCalculatePerimeterOfSquare()
    {
        $square = $this->setBaseSquare();
        $square->calculatePerimeterOfSquare();

        $this->assertEquals(890560, $square->getPerimeter());

    }

    protected function setBaseSquare(): Square
    {
        $square = new Square();

        return $square
          ->setLatitudeA(42)
          ->setLongitudeA(43)
          ->setLatitudeB(44)
          ->setLongitudeB(45);
    }

}
