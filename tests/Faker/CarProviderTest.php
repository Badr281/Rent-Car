<?php
namespace App\Test\Faker;

use App\faker\CarProvider;
use PHPUnit\Framework\TestCase;

class CarProviderTest extends TestCase
{
/**
 * @dataProvider carburentProvider
 */
 public function testCarburentContains($carburent)
 {
    $this->assertContains($carburent, CarProvider::carburant);
 }   


 public function testCarburentNotContains()
 {
    $this->assertNotContains("Ethanol", CarProvider::carburant);
 }   

 /**
 * @dataProvider colorProvider
 */
public function testColorContains($color)
{
   $this->assertContains($color, CarProvider::color);
}  

 public function carburentProvider()
 {
    return array(
        ['electrique'],
        ['essence'],
        ['diesel']
    );


 }   

 public function colorProvider()
 {
    return array(
        ['Navy'],
        ['blue'],
        ['violet']
    );
 }   
}