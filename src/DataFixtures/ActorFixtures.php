<?php


namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const ACTORS = ['Andrew Lincoln', 'Norman Reedus', 'Lauren Cohan', 'Danai Gurira'];
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('en_US');

        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $actor->addProgram($this->getReference('program_0'));

            if ($actorName == 'Andrew Lincoln') {
                $actor->addProgram($this->getReference('program_5'));
            }
            $manager->persist($actor);
        }

        for ($i = 0; $i < 50; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);
            $actor->addProgram($this->getReference('program_' . $faker->regexify('[0-5]')));
            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}