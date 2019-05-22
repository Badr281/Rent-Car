<?php 

namespace App\Service;

use App\Entity\Image;

class imageHandler
{
    private $path;
    public function __construct($path){
       $this->path= $path.'\public\pic';
    }    

public function handle(Image $image) 
{
    $file = $image->getFile();
    $name = $this->imageName($file);
    $image->setName($name);
    // deplacer le fichier
    $file->move($this->$path,$name);
       
        
}
public function imageName($file) : string
{
    return md5(uniqid()).'.'.$file->guessExtension();
}





}