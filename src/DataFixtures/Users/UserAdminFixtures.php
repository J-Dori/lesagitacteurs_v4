<?php

declare(strict_types=1);

/*
 *  * This file has been edited by Adeliom.
 *  * Adeliom team <contact@adeliom.com>
 */

namespace App\DataFixtures\Users;

use App\Entity\EasyAdmin\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserAdminFixtures extends Fixture implements FixtureGroupInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $items = $this->getData();
        foreach ($items as $key => $item) {
            $user = new User();
            $user->setEmail($item['email']);
            $user->setRoles($item['roles']);
            $user->setFirstname($item['firstname']);
            $user->setLastname($item['lastname']);
            //$hashedPassword = $this->passwordHasher->hashPassword($user, 'Admin1234');
            $user->setPassword($item['password']);
            $manager->persist($user);
        }
        $manager->flush();
    }

    public function getData(): array
    {
        return [
            [
                'email' => 'info@lesagitacteurs.fr', 
                'roles' => ["ROLE_ADMINISTRATOR"], 
                'password' => '$2y$13$9m/XwZxMQTlgTMS/poEgyuOjzocoG7ke5vQScKBA.DgW4g3Kjmge2', 
                'firstname' => 'Joel',
                'lastname' => 'Gomes',
            ],
            [
                'email' => 'joelvg.stb@gmail.com', 
                'roles' => ["ROLE_SUPER_ADMIN"], 
                'password' => '$2y$13$9m/XwZxMQTlgTMS/poEgyuOjzocoG7ke5vQScKBA.DgW4g3Kjmge2', 
                'firstname' => 'Joel',
                'lastname' => 'Gomes',
            ],
            [
                'email' => 'pfscheidecker@gmail.com', 
                'roles' => ["ROLE_ADMINISTRATOR"], 
                'password' => '$2y$10$dnkWTG1Y88.PraXlBEYLUuzipSwrdR.WJb86vNb2IFxC9tZKvwSvK', 
                'firstname' => 'Pierre',
                'lastname' => 'SCHEIDECKER',
            ],
            [
                'email' => 'oportmann@estvideo.fr', 
                'roles' => ["ROLE_ADMINISTRATOR"], 
                'password' => '$2y$10$60KhIIww88PzGHtRap0smO8RWOFTfaVopptvJFaAavQObh1Fb/lYa', 
                'firstname' => 'Odile',
                'lastname' => 'PORTMANN',
            ],
            [
                'email' => 'maya_124@hotmail.fr', 
                'roles' => ["ROLE_ADMINISTRATOR"], 
                'password' => '$2y$10$O/G3qfx.pTPH6Tj2EP0pqesmALvCwY9RMDMR/IPc.BeJkV7wYWi.e', 
                'firstname' => 'Laetitia',
                'lastname' => 'SCHUBNEL',
            ],           
        ];
    }

    public static function getGroups(): array
    {
        return ['users'];
    }
}
