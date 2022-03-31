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
        $crypto1->setPrix(47036.02);
        $crypto1->setCategorie('Coin');
        $crypto1->setQuantite(18998168);
        //$crypto1->setQuantitéTotale(18998168)
        $crypto1->setQuantiteMax(21000000);
        $crypto1->setDate(date_create('2009-01-03'));
        $crypto1->setNbLikes(48);
        //$crypto1->setCreateur($manager->merge($this->getReference('Satoshi Nakamoto')));
        $crypto1->addComment($manager->merge($this->getReference('comment1')));
        $crypto1->addComment($manager->merge($this->getReference('comment2')));
        $crypto1->addComment($manager->merge($this->getReference('comment3')));
        $manager->persist($crypto1);

        $crypto2 = new Crypto();
        $crypto2->setNom('Ethereum');
        $crypto2->setSymbole('ETH');
        $crypto2->setPrix(3369.19);
        $crypto2->setCategorie('Altcoin');
        $crypto2->setQuantite(120173610);
        //$crypto2->setQuantitéTotale(120173610)
        $crypto2->setQuantiteMax(0);
        $crypto2->setDate(date_create('2015-07-30'));
        $crypto2->setNbLikes(23);
        //$crypto2->setCreateur($manager->merge($this->getReference('Vitalik Buterin')));
        $crypto2->addComment($manager->merge($this->getReference('comment4')));
        $manager->persist($crypto2);

        $crypto3 = new Crypto();
        $crypto3->setNom('Tether');
        $crypto3->setSymbole('USDT');
        $crypto3->setPrix(1.0003);
        $crypto3->setCategorie('Stablecoin');
        $crypto3->setQuantite(81671735986);
        //$crypto3->setQuantitéTotale(81671735986)
        $crypto3->setQuantiteMax(0);
        $crypto3->setDate(date_create('2014-10-06'));
        $crypto3->setNbLikes(0);
        //$crypto3->setCreateur($manager->merge($this->getReference('Brock Pierce')));
        $manager->persist($crypto3);

        $crypto4 = new Crypto();
        $crypto4->setNom('Binance Coin');
        $crypto4->setSymbole('BNB');
        $crypto4->setPrix(436.07);
        $crypto4->setCategorie('Altcoin');
        $crypto4->setQuantite(165116761);
        //$crypto4->setQuantitéTotale(165116761)
        $crypto4->setQuantiteMax(165116761);
        $crypto4->setDate(date_create('2017-07-14'));
        $crypto4->setNbLikes(0);
        //$crypto4->setCreateur($manager->merge($this->getReference('Changpeng Zhao')));
        $manager->persist($crypto4);

        $crypto5 = new Crypto();
        $crypto5->setNom('Ripple');
        $crypto5->setSymbole('XRP');
        $crypto5->setPrix(0.8578);
        $crypto5->setCategorie('Altcoin');
        $crypto5->setQuantite(48121609012);
        //$crypto5->setQuantitéTotale(99990000000)
        $crypto5->setQuantiteMax(100000000000);
        $crypto5->setDate(date_create('2012-09-30'));
        $crypto5->setNbLikes(0);
        //$crypto5->setCreateur($manager->merge($this->getReference('Chris Larsen')));
        $manager->persist($crypto5);

        $crypto6 = new Crypto();
        $crypto6->setNom('Cardano');
        $crypto6->setSymbole('ADA');
        $crypto6->setPrix(1.175);
        $crypto6->setCategorie('Altcoin');
        $crypto6->setQuantite(33733620105);
        //$crypto6->setQuantitéTotale(34259000000)
        $crypto6->setQuantiteMax(45000000000);
        $crypto6->setDate(date_create('2017-09-23'));
        $crypto6->setNbLikes(0);
        //$crypto6->setCreateur($manager->merge($this->getReference('Charles Hoskinson')));
        $manager->persist($crypto6);

        $crypto7 = new Crypto();
        $crypto7->setNom('Solana');
        $crypto7->setSymbole('SOL');
        $crypto7->setPrix(121.14);
        $crypto7->setCategorie('Altcoin');
        $crypto7->setQuantite(325110945);
        //$crypto7->setQuantitéTotale(511,617,000)
        $crypto7->setQuantiteMax(0);
        $crypto7->setDate(date_create('2017-04-30'));
        $crypto7->setNbLikes(0);
        //$crypto7->setCreateur($manager->merge($this->getReference('Anatoly Yakovenko')));
        $manager->persist($crypto7);

        $crypto8 = new Crypto();
        $crypto8->setNom('Terra');
        $crypto8->setSymbole('LUNA');
        $crypto8->setPrix(106.08);
        $crypto8->setCategorie('Stablecoin');
        $crypto8->setQuantite(287765804);
        //$crypto8->setQuantitéTotale(995859000)
        $crypto8->setQuantiteMax(0);
        $crypto8->setDate(date_create('2018-01-31'));
        $crypto8->setNbLikes(0);
        //$crypto8->setCreateur($manager->merge($this->getReference('Terraform Labs')));
        $manager->persist($crypto8);

        $crypto9 = new Crypto();
        $crypto9->setNom('Avalanche');
        $crypto9->setSymbole('AVAX');
        $crypto9->setPrix(92.83);
        $crypto9->setCategorie('Altcoin');
        $crypto9->setQuantite(267274005);
        //$crypto9->setQuantitéTotale(395891000)
        $crypto9->setQuantiteMax(0);
        $crypto9->setDate(date_create('2020-09-30'));
        $crypto9->setNbLikes(0);
        //$crypto9->setCreateur($manager->merge($this->getReference('Ava Labs')));
        $manager->persist($crypto9);

        $crypto10 = new Crypto();
        $crypto10->setNom('Polkadot');
        $crypto10->setSymbole('DOT');
        $crypto10->setPrix(21.97);
        $crypto10->setCategorie('Altcoin');
        $crypto10->setQuantite(987579315);
        //$crypto10->setQuantitéTotale(1103000000)
        $crypto10->setQuantiteMax(0);
        $crypto10->setDate(date_create('2017-10-27'));
        $crypto10->setNbLikes(0);
        //$crypto10->setCreateur($manager->merge($this->getReference('Gavin Wood')));
        $manager->persist($crypto10);

        $crypto11 = new Crypto();
        $crypto11->setNom('Dogecoin');
        $crypto11->setSymbole('DOGE');
        $crypto11->setPrix(0.1417);
        $crypto11->setCategorie('Altcoin');
        $crypto11->setQuantite(132670764300);
        //$crypto11->setQuantitéTotale(132670764300)
        $crypto11->setQuantiteMax(0);
        $crypto11->setDate(date_create('2013-12-06'));
        $crypto11->setNbLikes(0);
        //$crypto11->setCreateur($manager->merge($this->getReference('Billy Markus')));
        $manager->persist($crypto11);

        $manager->flush();

        $this->addReference('Bitcoin', $crypto1);
        $this->addReference('Ethereum', $crypto2);
        $this->addReference('Tether', $crypto3);
        $this->addReference('Binance Coin', $crypto4);
        $this->addReference('Ripple', $crypto5);
        $this->addReference('Cardano', $crypto6);
        $this->addReference('Solana', $crypto7);
        $this->addReference('Terra', $crypto8);
        $this->addReference('Avalanche', $crypto9);
        $this->addReference('Polkadot', $crypto10);
        $this->addReference('Dogecoin', $crypto11);

    }
}