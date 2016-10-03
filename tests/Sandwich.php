<?php
namespace Skybluesofa\Chainable\Tests;

use Skybluesofa\Chainable\Traits\Chainable;

class Sandwich {
    use Chainable;

    private $breadType = null;
    private $condiments = [];
    private $vegetables = [];
    private $cheese = null;
    private $meat = null;
    private $isGrilled = false;

    private function withBread($breadType=null) {
      $this->breadType = $breadType;
      return $this;
    }

    private function addCondiment($condiment=null) {
      if ($condiment) {
        $this->condiments[] = $condiment;
      }
      return $this;
    }

    private function removeCondiment($condiment=null) {
      if ($condiment && in_array($condiment, $this->condiments)) {
        unset($this->condiments[$condiment]);
      }
      return $this;
    }

    private function withCheese($cheeseType=null) {
      $this->cheese = $cheeseType;
      return $this;
    }

    private function withMeat($meatType=null) {
      $this->meat = $meatType;
      return $this;
    }

    private function grill($grilled=true) {
      $this->isGrilled = $grilled;
      return $this;
    }

    public function addVegetable($vegetable=null) {
      if ($vegetable) {
        $this->vegetables[] = $vegetable;
      }
      return $this;
    }

    public function removeVegetable($vegetable=null) {
      if ($vegetable && in_array($vegetable, $this->vegetables)) {
        unset($this->vegetables[$vegetable]);
      }
      return $this;
    }

    private function make() {
      if (!$this->breadType) {
        throw new \Exception("That's not a sandwich, it's just a pile of food.");
      }
      return [
        'bread' => $this->breadType,
        'condiments' => $this->condiments,
        'vegetables' => $this->vegetables,
        'cheese' => $this->cheese,
        'meat' => $this->meat,
        'isGrilled' => $this->isGrilled,
      ];
    }
}
