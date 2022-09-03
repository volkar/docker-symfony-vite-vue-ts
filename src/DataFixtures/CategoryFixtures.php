<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category1 = new Category();
        $category1->setTitle('Brand identity');
        $category1->setSlug('brand');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setTitle('Digital design');
        $category2->setSlug('digital');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setTitle('Industrial design');
        $category3->setSlug('industrial');
        $manager->persist($category3);

        $manager->flush();

        $this->addReference('project_type_identity', $category1);
        $this->addReference('project_type_digital', $category2);
        $this->addReference('project_type_industrial', $category3);
    }
}
