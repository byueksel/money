<?php

namespace Byueksel;

use JsonSerializable;

/**
 * A simple Money Class for PHP
 *
 * Date: 17.12.2017
 * Time: 01:04
 *
 * @package Byueksel
 * @subpackage Money
 * @author Burak Yueksel <brkyksl58@gmail.com>
 * @copyright 2017 Burak Yueksel
 * @license MIT
 * @version 1.0.0
 */
class Money implements JsonSerializable
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var int
     */
    private $baseUnit;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $locale;

    /**
     * Retruns the calculated amount
     * @return float Calculated amount
     */
    private function calculateAmount() : float
    {
        return $this->amount / $this->baseUnit;
    }

    /**
     * Currency constructor.
     * @param int|float $amount Amount
     * @param string $currency Currency-Name
     * @param int $baseUnit Base-Unit
     */
    public function __construct($amount = 0, string $currency = 'EUR',
                                int $baseUnit = 100)
    {
        $this->amount = $amount * $baseUnit;
        $this->baseUnit = $baseUnit;
        $this->currency = $currency;
    }

    /**
     * Returns the Raw Amount
     * @return int
     */
    public function getRawAmount(): int
    {
        return $this->amount;
    }

    /**
     * Returns the Amount divided by the Base-Unit
     * @var int $decimals Decimals
     * @return int|float
     */
    public function getAmount(int $decimals = 2): float
    {
        return (float) round($this->calculateAmount(), $decimals, PHP_ROUND_HALF_UP);
    }

    public function getFormatedAmount($decimals = 2, $decPoint = ',',
                                      $thousandsSep = '.') :string
    {
        $amount = $this->calculateAmount();
        return number_format($amount, $decimals, $decPoint, $thousandsSep);
    }

    /**
     * Returns the Base-Unit
     * @return int
     */
    public function getBaseUnit(): int
    {
        return $this->baseUnit;
    }

    /**
     * Returns the Currency
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Returns the locale used for LC_MONETARY
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Addition
     * @param Money $money Money-Object
     * @return $this
     */
    public function add(Money $money)
    {
        $this->amount = $this->amount + $money->getRawAmount();

        return $this;
    }

    /**
     * Subtraction
     * @param Money $money
     * @return $this
     */
    public function subtract(Money $money)
    {
        $this->amount = $this->amount - $money->getRawAmount();

        return $this;
    }

    /**
     * @param int|float $multiplier
     * @return $this
     */
    public function multiply($multiplier)
    {
        $this->amount = $this->amount * $multiplier;

        return $this;
    }

    /**
     * @param  int|float $divisor
     * @return $this
     */
    public function divide($divisor)
    {
        $this->amount = $this->amount / $divisor;

        return $this;
    }

    /**
     * __toString
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getFormatedAmount();
    }

    /**
     * __clone
     * @return Money
     */
    public function __clone()
    {
        return new Money($this->getRawAmount(), $this->currency, $this->baseUnit);
    }

    /**
     * Return Array
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array|mixed data which can be serialized by <b>json_encode</b>
     */
    public function jsonSerialize()
    {
        return [
            'amount' => $this->amount,
            'baseUnit' => $this->baseUnit,
            'currency' => $this->currency,
        ];
    }
}