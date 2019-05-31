<?php

namespace App\Command;

use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserCarCommand extends Command
{
    protected static $defaultName = 'app:user:car';
    private $carRepository;
    private $entityManager;


    public function __construct(CarRepository $carRepository,EntityManagerInterface $entityManager) {
        $this->carRepository = $carRepository;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Supressions des utilisateus sans voiture')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cars =$this->carRepository->findBy(['user'=> null]);
        $Total =count($cars);
        if(!$cars == null)
     {  
        foreach($cars as $car)
        {
            $output->writeln("<info>There is $Total cars</info>");
            $model = $car->getModel();
            $output->writeln("<error>error $model</error>");
            $this->entityManager->remove($car);
        }
        $this->entityManager->flush();
        $output->writeln("<info> champs suprimé</info>");
    }
    else{
        $output->writeln("<info>There is $Total cars</info>");
    }

}
}
