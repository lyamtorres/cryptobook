<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Crypto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class CryptoFixtures extends Fixture
{
    public function load(ObjectManager $manager) :void
    {
        $crypto1 = new Crypto();
        $crypto1->setNom('Bitcoin');
        $crypto1->setSymbole('BTC');
        $crypto1->setPrix(37758.43);
        $crypto1->setCategorie('Coin');
        $crypto1->setQuantite(20000000);
        $crypto1->setDate(date_create('2008-10-31'));
        $crypto1->setNbLikes(48);
        //$crypto1->setCreateur($manager->merge($this->getReference('Noelie')));
        $manager->persist($crypto1);

        $crypto2 = new Crypto();
        $crypto2->setNom('Ethereum');
        $crypto2->setSymbole('ETH');
        $crypto2->setPrix(2726.66);
        $crypto2->setCategorie('Token');
        $crypto2->setQuantite(113500000);
        $crypto2->setDate(date_create('2015-07-30'));
        $crypto2->setNbLikes(23);
        //$crypto2->setCreateur($manager->merge($this->getReference('Noelie')));
        $manager->persist($crypto2);

        $manager->flush();

        $this->addReference('Bitcoin', $crypto1);
        $this->addReference('Ethereum', $crypto2);
    }
}