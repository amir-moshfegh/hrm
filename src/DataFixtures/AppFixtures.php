<?php

namespace App\DataFixtures;

use App\Entity\Person;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadPerson($manager);
        $this->loadUser($manager);
    }

    private function loadPerson(ObjectManager $manager)
    {
        foreach ($this->personData() as [$gender, $firstName, $lastName, $imageName, $email, $birthDate, $address, $ref]) {
            $person = new Person();
            $person->setFirstName($firstName)
                ->setLastName($lastName)
                ->setImagePath($imageName)
                ->setEmail($email)
                ->setBirthDate($birthDate)
                ->setAddress($address)
                ->setGender($gender);

            $this->addReference($ref, $person);

            $manager->persist($person);
        }
        $manager->flush();
    }

    private function loadUser(ObjectManager $manager)
    {
        foreach ($this->userData() as [$username, $password, $role, $isDeleted]) {
            $user = new User();
            $user->setUsername($username)
                ->setPassword($this->passwordEncoder->encodePassword($user, $password))
                ->setRoles($role)
                ->setPerson($this->getReference($username));

            if ($isDeleted)
                $user->setIsDeleted($isDeleted);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function userData(): array
    {
        // [$username, $password, $role, $isDeleted]
        return [
            ['1062949676', '123456', ['ROLE_USER'], false],
            ['1063938031', '123456', ['ROLE_USER'], true]
        ];
    }

    private function personData(): array
    {
//        [$gender, $firstName, $lastName, $imageName, $email, $birthDate, $address, $ref]
        return [
            ['آقا', 'امیر', 'مشفق', 'avatar-s-1.png', 'amir.2814@gmail.com', new \DateTime('1984/12/09'), 'خیابان نور 24', '1062949676'],
            ['خانم', 'سمیه', 'معتمد', 'avatar-s-2.png', 'somayeh@gmail.com', new \DateTime('1985/11/20'), 'خیابان نور', '1063938031'],
        ];
    }
}
