<?php
namespace App\faker;

use Faker\Provider\Base;

class CarProvider extends Base
{
    const carburant = [
        'diesel',
        'essence',
        'electrique'
        ];
    const color =['Navy' ,'blue','violet'];

    const model =['2017' ,'2018','2019'];


public function carb()
{
    return self::randomElement(self::carburant);
}
public function color(){
    return self::randomElement(self::color);
}
public function pricef(){
    return rand(1,1000);
}
public function modelr(){
    return self::randomElement(self::model);
}
}

