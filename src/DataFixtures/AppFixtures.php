<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Role;

class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $role = new Role();
        $role->setLabel ('ROLE_ADMIN');
            $manager->persist($role);
            $manager->flush();

        $userAdmin = new User();
        $userAdmin
        ->setFirstName("Admin")
        ->setLastName("Admin")
        ->setPhone("0999999999")
        ->setEmail("admin@gmail.com")
        ->setUsername("Admin")
        ->setBirthday(\DateTime::createFromFormat('Y-m-d', "2018-09-09"))
        ->addRoleId($role)
        //->setRoles(["ROLE_USER"])
        ->setPassword($this->passwordEncoder->encodePassword($userAdmin, 'admin'));
        $manager->persist($userAdmin);
        $manager->flush();

        $userUser = new User();
        $userUser
        ->setFirstName("User")
        ->setLastName("User")
        ->setPhone("0999999999")
        ->setEmail("user@gmail.com")
        ->setUsername("User")
        ->setBirthday(\DateTime::createFromFormat('Y-m-d', "2018-09-09"))
        ->addRoleId($role)
        //->setRoles(["ROLE_USER"])
        ->setPassword($this->passwordEncoder->encodePassword($userUser, 'user'));
        $manager->persist($userUser);
        $manager->flush();
    }
}
