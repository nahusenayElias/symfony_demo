<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = $manager->getRepository(Category::class)->findOneBy(['name' => 'Electronics']);

        $product1 = new Product();
        $product1->setName('Laptop');
        $product1->setPrice(999.99);
        $product1->setCategory($category);
        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Smartphone');
        $product2->setPrice(499.99);
        $product2->setCategory($category);
        $manager->persist($product2);

        $manager->flush();
    }
}