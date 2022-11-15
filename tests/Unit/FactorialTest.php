<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Factorial;

class FactorialTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFactorial()
    {
        $f = new Factorial();
        // $result = $f -> Factorial(0);

        $this->assertEquals(1, $f -> Factorial(0));
        $this->assertEquals(1, $f -> Factorial(1));
        $this->assertEquals(7*$f -> Factorial(6), $f -> Factorial(7));
        $this->assertEquals(null, $f -> Factorial(-3));
        $this->assertEquals(null, $f -> Factorial(1.5));
        $this->assertEquals(null, $f -> Factorial(false));
        $this->assertEquals(null, $f -> Factorial('abc'));
    }
}
