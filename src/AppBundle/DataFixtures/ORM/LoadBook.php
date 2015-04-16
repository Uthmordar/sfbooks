<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Book;
use Cocur\Slugify\Slugify;
use Faker;


class LoadUserData implements FixtureInterface
{
    private $slugify;
    private $faker;
    
    public function __construct(){
        $this->slugify=new Slugify();
        $this->faker= Faker\Factory::create("fr_FR");
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for($i=0; $i<20; $i++){
            $book=new Book();
            $book->setAuthor($this->faker->name);
            $book->setTitle($this->faker->realText(50));
            $book->setIsbm($this->faker->ean13);
            $book->setDatePublished($this->faker->dateTime);
            $book->setSummary($this->faker->realText(200));
            $book->setSlug($this->slugify->slugify($book->getTitle()));
            $manager->persist($book);
        }
        $manager->flush();
    }
}