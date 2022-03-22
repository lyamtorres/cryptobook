<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Crypto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CryptoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $crypto = new Crypto();
            $crypto->setNom('Bitcoin');
            $crypto->setSymbole('BTC');
            $crypto->setPrix(37758.43);
            $crypto->setCategorie('Coin');
            $crypto->setQuantite(20000000);
            $crypto->setDate(date_create('2008-10-31'));
            $crypto->setNbLikes(48);
            $manager->persist($crypto);
        }

        for ($i = 0; $i < 5; $i++) {
            $crypto = new Crypto();
            $crypto->setNom('Ethereum');
            $crypto->setSymbole('ETH');
            $crypto->setPrix(2726.66);
            $crypto->setCategorie('Token');
            $crypto->setQuantite(113500000);
            $crypto->setDate(date_create('2015-07-30'));
            $crypto->setNbLikes(23);
            $manager->persist($crypto);
        }

        $manager->flush();
    }
}