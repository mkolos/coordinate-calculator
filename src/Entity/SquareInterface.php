<?php

namespace App\Entity;

interface SquareInterface
{

    /**
     * @return mixed
     */
    public function getLatitudeA();

    /**
     * @param mixed $latitudeA
     *
     * @return Square
     */
    public function setLatitudeA($latitudeA);

    /**
     * @return mixed
     */
    public function getLongitudeA();

    /**
     * @param mixed $longitudeA
     *
     * @return Square
     */
    public function setLongitudeA($longitudeA);

    /**
     * @return mixed
     */
    public function getLatitudeB();

    /**
     * @param mixed $latitudeB
     *
     * @return Square
     */
    public function setLatitudeB($latitudeB);

    /**
     * @return mixed
     */
    public function getLongitudeB();

    /**
     * @param mixed $longitudeB
     *
     * @return Square
     */
    public function setLongitudeB($longitudeB);

    /**
     * @return mixed
     */
    public function getLatitudeC();

    /**
     * @param mixed $latitudeC
     *
     * @return Square
     */
    public function setLatitudeC($latitudeC);

    /**
     * @return mixed
     */
    public function getLongitudeC();

    /**
     * @param mixed $longitudeC
     *
     * @return Square
     */
    public function setLongitudeC($longitudeC);

    /**
     * @return mixed
     */
    public function getLatitudeD();

    /**
     * @param mixed $latitudeD
     *
     * @return Square
     */
    public function setLatitudeD($latitudeD);

    /**
     * @return mixed
     */
    public function getLongitudeD();

    /**
     * @param mixed $longitudeD
     *
     * @return Square
     */
    public function setLongitudeD($longitudeD);

    /**
     * @return mixed
     */
    public function getPerimeter();

    /**
     * @return mixed
     */
    public function getArea();

    /**
     * @return mixed
     */
    public function getCostOfFence();

    public function calculateOtherPointsOfSquare(): void;

    public function calculatePerimeterOfSquare(): void;

    public function calculateAreaOfSquare(): void;

    public function calculateCostOfFence(): void;

}