<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail("nono@gmail.com")
            ->setRoles(["ROLE_USER","ROLE_ADMIN"])
            ->setPseudo("Noelie")
            ->setPassword($this->passwordEncoder->encodePassword(
                $user1, 'noonoo'
            ));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("Satoshi.Nakamoto@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Satoshi Nakamoto")
            ->addCrypto($manager->merge($this->getReference('Bitcoin')))
            ->addComment($manager->merge($this->getReference('comment1')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user2, 'Satoshi Nakamoto'
            ));
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail("Vitalik.Buterin@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Vitalik Buterin")
            ->addCrypto($manager->merge($this->getReference('Ethereum')))
            ->addComment($manager->merge($this->getReference('comment2')))
            ->addComment($manager->merge($this->getReference('comment4')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user3, 'Vitalik Buterin'
            ));
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail("Brock.Pierce@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Brock Pierce")
            ->addCrypto($manager->merge($this->getReference('Tether')))
            ->addComment($manager->merge($this->getReference('comment3')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user4, 'Brock Pierce'
            ));
        $manager->persist($user4);

        $user5 = new User();
        $user5->setEmail("Changpeng.Zhao@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Changpeng Zhao")
            ->addCrypto($manager->merge($this->getReference('Binance Coin')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user5, 'Changpeng Zhao'
            ));
        $manager->persist($user5);

        $user6 = new User();
        $user6->setEmail("Chris.Larsen@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Chris Larsen")
            ->addCrypto($manager->merge($this->getReference('Ripple')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user6, 'Chris Larsen'
            ));
        $manager->persist($user6);

        $user7 = new User();
        $user7->setEmail("Charles.Hoskinson@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Charles Hoskinson")
            ->addCrypto($manager->merge($this->getReference('Cardano')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user7, 'Charles Hoskinson'
            ));
        $manager->persist($user7);

        $user8 = new User();
        $user8->setEmail("Anatoly.Yakovenko@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Anatoly Yakovenko")
            ->addCrypto($manager->merge($this->getReference('Solana')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user8, 'Anatoly Yakovenko'
            ));
        $manager->persist($user8);

        $user9 = new User();
        $user9->setEmail("Terraform.Labs@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Terraform Labs")
            ->addCrypto($manager->merge($this->getReference('Terra')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user9, 'Terraform Labs'
            ));
        $manager->persist($user9);

        $user10 = new User();
        $user10->setEmail("Ava.Labs@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Ava Labs")
            ->addCrypto($manager->merge($this->getReference('Avalanche')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user10, 'Ava Labs'
            ));
        $manager->persist($user10);

        $user11 = new User();
        $user11->setEmail("Gavin.Wood@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Gavin Wood")
            ->addCrypto($manager->merge($this->getReference('Polkadot')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user11, 'Gavin Wood'
            ));
        $manager->persist($user11);

        $user12 = new User();
        $user12->setEmail("Billy.Markus@gmail.com")
            ->setRoles(["ROLE_USER"])
            ->setPseudo("Billy Markus")
            ->addCrypto($manager->merge($this->getReference('Dogecoin')))
            ->setPassword($this->passwordEncoder->encodePassword(
                $user12, 'Billy Markus'
            ));
        $manager->persist($user12);

        $manager->flush();

        $this->addReference('Noelie', $user1);
        $this->addReference('Satoshi Nakamoto', $user2);
        $this->addReference('Vitalik Buterin', $user3);
        $this->addReference('Brock Pierce', $user4);
        $this->addReference('Changpeng Zhao', $user5);
        $this->addReference('Chris Larsen', $user6);
        $this->addReference('Charles Hoskinson', $user7);
        $this->addReference('Anatoly Yakovenko', $user8);
        $this->addReference('Terraform Labs', $user9);
        $this->addReference('Ava Labs', $user10);
        $this->addReference('Gavin Wood', $user11);
        $this->addReference('Billy Markus', $user12);
    }
}