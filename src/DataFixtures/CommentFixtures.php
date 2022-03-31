<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager) :void
    {
        $comment1 = new Comment();
        $comment1->setContent('Sans aucun doute, la meilleure crypto-monnaie.');
        $comment1->setPublishedAt(date_create_immutable('2019-08-15 9:25:45'));
        //$comment1->setAuthor($manager->merge($this->getReference('Satoshi Nakamoto')));
        //$comment1->setCryptocurrency($manager->merge($this->getReference('Bitcoin')));
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setContent("L'ETH pollue plus de 10 fois moins et les transferts sont bien plus rapides. Il est l'heure de faire sa révérence papi.");
        $comment2->setPublishedAt(date_create_immutable('2019-08-17 7:18:14'));
        //$comment1->setAuthor($manager->merge($this->getReference('Vitalik Buterin')));
        //$comment1->setCryptocurrency($manager->merge($this->getReference('Bitcoin')));
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setContent('En attendant, en termes de volume de transactions rien ne vaut le Tether.');
        $comment3->setPublishedAt(date_create_immutable('2019-08-17 8:56:21'));
        //$comment1->setAuthor($manager->merge($this->getReference('Brock Pierce')));
        //$comment1->setCryptocurrency($manager->merge($this->getReference('Bitcoin')));
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4->setContent("L'avenir de la cryptomonnaie.");
        $comment4->setPublishedAt(date_create_immutable('2019-08-17 7:21:19'));
        //$comment1->setAuthor($manager->merge($this->getReference('Vitalik Buterin')));
        //$comment1->setCryptocurrency($manager->merge($this->getReference('Ethereum')));
        $manager->persist($comment4);

        $manager->flush();

        $this->addReference('comment1', $comment1);
        $this->addReference('comment2', $comment2);
        $this->addReference('comment3', $comment3);
        $this->addReference('comment4', $comment4);

    }
}