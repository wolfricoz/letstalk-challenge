<?php

namespace Tests\Feature;

use App\CurrencyHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConversionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testConvertCurrency(): void
    {
        self::assertEquals(CurrencyHelper::calculate(100, 1.5), 150);
        self::assertEquals(CurrencyHelper::calculate(200, 2.5), 500);
        self::assertEquals(CurrencyHelper::calculate(300, 3.5), 1050);
        self::assertEquals(CurrencyHelper::calculate(400, 4.5), 1800);
        self::assertEquals(CurrencyHelper::calculate(500, 5.5), 2750);
        self::assertEquals(CurrencyHelper::calculate(600, 6.5), 3900);
        self::assertEquals(CurrencyHelper::calculate(700, 7.54344), 5280.41);
        self::assertEquals(CurrencyHelper::calculate(800, 8.5), 6800);
        self::assertEquals(CurrencyHelper::calculate(900, 9.5), 8550);
        self::assertEquals(CurrencyHelper::calculate(1000, 10.5), 10500);
        self::assertEquals(CurrencyHelper::calculate(1100, 11.5), 12650);
        self::assertNotEquals(CurrencyHelper::calculate(1200, 12.6), 15000);
    }
}
