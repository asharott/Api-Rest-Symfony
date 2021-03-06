<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($p = 0; $p < 50; $p++) {
            $post = new Post;
            $post->setNote($faker->numberBetween(1,5))
                ->setExperience($faker->numberBetween(1,4))
                ->setMentoringType($faker->numberBetween(1,3))
                ->setMeetingType($faker->numberBetween(1,3))
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setJobTitle($faker->jobTitle)
                ->setCity($faker->city)
                ->setCompetences($faker->randomElements($array = array ('Javascript','Symfony','Laravel', 'Sketch', 'Figma', 'Atomic Design', 'UX Design'), $count = 4))
                ->setCourse($faker->paragraphs(mt_rand(1, 3), true))
                ->setEmail($faker->email)
                ->setCreatedAt($faker->dateTimeBetween('-6 months'));

            $manager->persist($post);

            for ($c = 0; $c < mt_rand(3, 5); $c++) {
                $comment = new Comment;
                $comment->setContent($faker->paragraphs(mt_rand(1, 3), true))
                    ->setFirstName($faker->firstName)
                    ->setLastName($faker->lastName)
                    ->setPost($post);

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
