<?php
namespace App\tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Entity\Cars;

class TestCarEntity extends TestCase
{
    public function testCarModel()
    {
        $car = new Cars();
        $result = $car->getModel();

        $this->assertEquals(null, $result);
    }
}