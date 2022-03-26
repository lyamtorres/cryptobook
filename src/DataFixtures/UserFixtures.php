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
        $user = new User();
        $user->setEmail("nono@gmail.com")
            ->setRoles(["ROLE_USER","ROLE_ADMIN"])
            ->setPseudo("Noelie")
            ->addCrypto($manager->merge($this->getReference('Bitcoin')))
            ->addCrypto($manager->merge($this->getReference('Ethereum')))
            ->setPassword($this->passwordEncoder->encodePassword(
            $user, 'noonoo'
        ));
        $manager->persist($user);
        $manager->flush();

        $this->addReference('Noelie', $user);
    }
}
