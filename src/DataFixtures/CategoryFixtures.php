<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $travelAdventure = new Category();
        $travelAdventure->setName('Travel & Adventure');
        $manager->persist($travelAdventure);
        $this->addReference('cat-travel-adventure', $travelAdventure);

        $sport = new Category();
        $sport->setName('Sport');
        $manager->persist($sport);
        $this->addReference('cat-sport', $sport);

        $entertainment = new Category();
        $entertainment->setName('Entertainment');
        $manager->persist($entertainment);
        $this->addReference('cat-entertainment', $entertainment);

        $humanRelation = new Category();
        $humanRelation->setName('Human Relations');
        $manager->persist($humanRelation);
        $this->addReference('cat-human-relation', $humanRelation);

        $others = new Category();
        $others->setName('Others');
        $manager->persist($others);
        $this->addReference('cat-others', $others);

        $manager->flush();
    }
}
