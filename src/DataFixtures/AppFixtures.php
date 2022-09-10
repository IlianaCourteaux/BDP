<?php

namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Contact;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;


    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }


    public function load(ObjectManager $manager): void
    {
        // Users

        for ($i=0; $i<10; $i++){
            $user = new Users();
            $user
                ->setUsername($this->faker->name())
                ->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setIsVerified('1')
                ->setPassword('password');

            $manager->persist($user);
        }

        // Contact

        for ($i=0; $i<5; $i++){
            $contact = new Contact();
            $contact
                ->setUsername($this->faker->name())
                ->setEmail($this->faker->email())
                ->setDiscord($this->faker->word() . '#' . $this->faker->numberBetween(1000, 9999))
                ->setSubject(['0'])
                ->setMessage($this->faker->text());

                $manager->persist($contact);
        }

        $manager->flush();
    }

}
