<?php
namespace App\Test\Faker;

use App\faker\CarProvider;
use PHPUnit\Framework\TestCase;

class CarProviderTest extends TestCase
{
 public function testCarburentNoContains()
 {
     $this->assetContains('electrique',CarProvider::carburant);
 }   
}