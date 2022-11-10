<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('test@user.com');
        $user->setPassword('$2y$13$R1y4go8Fb1BYh0mseoGUROzrxhVi6MUlaFFZqoB1AO/MESkkzbzry');

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('test@admin.com');
        $admin->setPassword('$2y$13$v1xPti5CZyYDR7QXh8Iz5OU7VMKH3UUyTFKwfI/tD8VjmbNUaWlNy');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $superAdmin = new User();
        $superAdmin->setEmail('test@manager.com');
        $superAdmin->setRoles(['ROLE_MANAGER']);
        $superAdmin->setPassword('$2y$13$zkDJkHDDiu2kQnRZnbL0ze.4RMprCXFSi7/w0MLAhCrOSKIwBMuDW');

        $manager->persist($superAdmin);
        $manager->flush();
    }
}
