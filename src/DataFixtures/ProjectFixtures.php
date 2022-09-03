<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $project1 = new Project();
        $project1->setTitle('Identity project');
        $project1->setCategory($this->getReference('project_type_identity'));
        $project1->setContent('Description');
        $project1->setCover('p1.jpg');
        $manager->persist($project1);

        $project2 = new Project();
        $project2->setTitle('Second identity project');
        $project2->setCategory($this->getReference('project_type_identity'));
        $project2->setContent('Description');
        $project2->setCover('p2.jpg');
        $manager->persist($project2);

        $project3 = new Project();
        $project3->setTitle('Digital project');
        $project3->setCategory($this->getReference('project_type_digital'));
        $project3->setContent('Description');
        $project3->setCover('p3.jpg');
        $manager->persist($project3);


        $project4 = new Project();
        $project4->setTitle('Industrial project');
        $project4->setCategory($this->getReference('project_type_industrial'));
        $project4->setContent('Description');
        $project4->setCover('p4.jpg');
        $manager->persist($project4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
