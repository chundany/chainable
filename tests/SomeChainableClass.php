<?php
namespace Skybluesofa\Chainable\Tests;

use Skybluesofa\Chainable\Traits\Chainable;

class SomeChainableClass {
    use Chainable;

    private $abc;
    private $mno;
    private $xyz;

    private function setAbc($abc=null) {
        $this->abc = $abc;
        return $this;
    }

    private function setMno($mno=null) {
        $this->mno = $mno;
        return $this;
    }

    private function run() {
        return [
            'abc' => $this->abc,
            'mno' => $this->mno,
            'xyz' => $this->xyz,
        ];
    }
}
