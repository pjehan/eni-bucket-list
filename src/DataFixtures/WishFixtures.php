<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;

class WishFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $wish1 = new Wish();
        $wish1->setTitle('Saut en parachute');
        $wish1->setDescription('La description...');
        $wish1->setAuthor('Pierre');
        $wish1->setIsPublished(true);
        $wish1->setDateCreated(new \DateTime('2020-01-10 09:15:35'));
        $wish1->setCategory($this->getReference('cat-travel-adventure'));
        $manager->persist($wish1);

        $wish2 = new Wish();
        $wish2->setTitle('Apprendre le PHP');
        $wish2->setAuthor('John');
        $wish2->setIsPublished(false);
        $wish2->setCategory($this->getReference('cat-entertainment'));
        $manager->persist($wish2);

        $wish3 = new Wish();
        $wish3->setTitle('Apprendre le langage GO');
        $wish3->setDescription('Parce que Eliot a dit que c\'est bien !');
        $wish3->setAuthor('Pierre');
        $wish3->setIsPublished(true);
        $wish3->setDateCreated(new \DateTime('2020-08-09 17:55:05'));
        $wish3->setCategory($this->getReference('cat-entertainment'));
        $manager->persist($wish3);

        // Utilisation de Faker
        $generator = Factory::create('fr_FR');
        $populator = new Populator($generator, $manager);
        $populator->addEntity(Category::class, 1); // Pour avoir 1 catégorie à associer aux 100 Wish créés ensuite
        $populator->addEntity(Wish::class, 100, [
            'author' => function() use ($generator) {
                return $generator->userName;
            }
        ]);
        $populator->execute();

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
