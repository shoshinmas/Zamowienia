<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setVisible(TRUE);
            $manager->persist($product);
        }
        /*for ($i = 0; $i < 20; $i++) {
            $order = new Order();
            $order->setClientEmail('lala '.$i);
            $order->setTotalSum(mt_rand(10, 100));
            $order->setQuantity(mt_rand(10, 100));
            $order->setStatus('lala '.$i);
            $manager->persist($order);
        }*/

        $manager->flush();
    }
}