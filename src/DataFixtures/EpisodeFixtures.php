<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Faker;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');

        for ($a = 0; $a <= 9; $a++) {
            for ($i = 1; $i <= 3; $i++) {
                for ($j = 1; $j <= 10; $j++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->realText(10));
                    $episode->setNumber($j);
                    $episode->setSynopsis($faker->realText(100));
                    $episode->setSeason($this->getReference('program_' . $a . 'season_' . $i));
                    $manager->persist($episode);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SeasonFixtures::class];
    }
}
