<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Faker;
use App\Service\Slugify;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');

        for ($a = 0; $a <= 5; $a++) {
            for ($i = 1; $i <= 3; $i++) {
                for ($j = 1; $j <= 10; $j++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->realText(20, 2));
                    $episode->setNumber($j);
                    $episode->setSynopsis($faker->text(100));
                    $episode->setSeason($this->getReference('program_' . $a . 'season_' . $i));
                    $slug = $this->slugify->generate($episode->getTitle());
                    $episode->setSlug($slug);
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
