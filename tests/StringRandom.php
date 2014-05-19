<?php

require_once 'PHPUnit/Autoload.php';
require_once __DIR__.'/../src/String/StringRandom.php';

class Test_StringRandom extends PHPUnit_Framework_TestCase {

    public function test_default() {
        $result = String\StringRandom::create();
        $this->assertEquals(8, strlen($result));

        $result = String\StringRandom::create('', 12);
        $this->assertEquals(0, strlen($result));
    }

    public function test_customstrings() {
        $result = String\StringRandom::create('0-9 a-z A-Z', 123);
        $this->assertEquals(123, strlen($result));

        $result = String\StringRandom::create('digit number 0-9', 12);
        $this->assertEquals(12, strlen($result));
        $this->assertRegExp('/\d+/', $result);

        $result = String\StringRandom::create('snakk big lc uc a-z A-Z', 24);
        $this->assertEquals(24, strlen($result));
        $this->assertRegExp('/\w+/', $result);

        $result = String\StringRandom::create('0-9 a-z A-Z', 0);
        $this->assertEquals(0, strlen($result));

    }

}
