<?php

namespace App\DataFixtures;

use App\Entity\Base;
use App\Entity\Category;
use App\Entity\History;
use App\Entity\Person;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\ref;

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
        $this->loadCategory($manager);
        $this->loadBase($manager);
        $this->loadHistory($manager);
    }

    private function loadHistory(ObjectManager $manager)
    {
        foreach ($this->historyData() as [$userRef, $baseRef, $noticeNumber, $noticeDate, $startDate, $endDate]) {
            $history = new History();
            $history->setUser($this->getReference($userRef))
                ->setBase($this->getReference($baseRef))
                ->setNoticeDate($noticeDate)
                ->setNoticeNumber($noticeNumber)
                ->setStartDate($startDate)
                ->setEndDate($endDate);

            $manager->persist($history);
        }
        $manager->flush();
    }

    private function loadBase(ObjectManager $manager)
    {
        foreach ($this->baseData() as [$category, $name, $parent, $ref]) {
            $base = new Base();
            $base->setName($name)
                ->setCategory($this->getReference($category));

            $this->setReference($ref, $base);;

            $base->setParent($this->getReference($ref));

            $manager->persist($base);
        }
        $manager->flush();
    }

    private function loadCategory(ObjectManager $manager)
    {
        foreach ($this->categoryData() as [$name, $ref]) {
            $category = new Category();
            $category->setName($name);
            $this->setReference($ref, $category);

            $manager->persist($category);
        }
        $manager->flush();

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
        foreach ($this->userData() as [$username, $password, $role, $isDeleted, $personRef, $userRef]) {
            $user = new User();
            $user->setUsername($username)
                ->setPassword($this->passwordEncoder->encodePassword($user, $password))
                ->setRoles($role)
                ->setPerson($this->getReference($personRef));

            $this->setReference($userRef, $user);

            if ($isDeleted)
                $user->setIsDeleted($isDeleted);

            $manager->persist($user);
        }
        $manager->flush();
    }

    private function userData(): array
    {
        // [$username, $password, $role, $isDeleted, $ref]
        return [
            ['1062949676', '123456', ['ROLE_USER'], false, 'person_0', 'user_0'],
            ['1063938031', '123456', ['ROLE_USER'], true, 'person_1', 'user_1']
        ];
    }

    private function personData(): array
    {
        // [$gender, $firstName, $lastName, $imageName, $email, $birthDate, $address, $ref]
        return [
            ['آقا', 'امیر', 'مشفق', 'avatar-s-1.png', 'amir.2814@gmail.com', new \DateTime('1984/12/09'), 'خیابان نور 24', 'person_0'],
            ['خانم', 'سمیه', 'معتمد', 'avatar-s-2.png', 'somayeh@gmail.com', new \DateTime('1985/11/20'), 'خیابان نور', 'person_1'],
        ];
    }

    private function categoryData(): array
    {
        // [$name, $ref]
        return [
            [" سازمان", "cat_0",],
            ["ساختمان", "cat_1",],
            ["بخش", "cat_2",],
            ["سطح", "cat_3",],
        ];
    }

    private function baseData(): array
    {
        // [$category, $name, $parent, $ref]
        return [
            ['cat_0', 'شهرداری نیشابور', '', 'base_0'],
            ['cat_0', 'سازمان ایمنی و خدمات آتش نشانی', 'base_0', 'base_1'],
            ['cat_0', 'سازمان فرهنگی، اجتماعی و هنری', 'base_0', 'base_2'],
            ['cat_0', 'سازمان سیما و منظر', 'base_0', 'base_3'],
            ['cat_0', 'سازمان عمران', '', 'base_4'],
            ['cat_0', 'سازمان پسماند', '', 'base_5'],
            ['cat_0', 'سازمان مدیریت حمل و نقل', '', 'base_6'],
            ['cat_1', 'ستاد', 'base_0', 'base_7'],
            ['cat_1', 'منطقه یک', 'base_1', 'base_8'],
            ['cat_1', 'منطقه دو', 'base_2', 'base_9'],
            ['cat_1', 'ایستگاه مرکزی', 'base_3', 'base_10'],
            ['cat_1', 'ایستگاه یک', 'base_4', 'base_11'],
            ['cat_1', 'ایستگاه دو', 'base_5', 'base_12'],
            ['cat_1', 'فرهنگسرای سیمرغ', 'base_6', 'base_13'],
            ['cat_1', 'تریاپاک', 'base_7', 'base_14'],
            ['cat_1', 'تولیدات', 'base_8', 'base_15'],
            ['cat_1', 'ساختمان مرکزی', 'base_9', 'base_16'],
            ['cat_1', 'تولید آسفالت', 'base_10', 'base_17'],
            ['cat_1', 'ساختمان مرکزی', 'base_11', 'base_18'],
            ['cat_1', 'انبار', 'base_12', 'base_19'],
            ['cat_1', 'ساختمان مرکزی', 'base_13', 'base_20'],
            ['cat_2', 'امور اداری', 'base_14', 'base_21'],
            ['cat_2', 'امور رفاهی', 'base_15', 'base_22'],
            ['cat_2', 'حسابداری', 'base_16', 'base_23'],
            ['cat_2', 'انبار و اموال', 'base_17', 'base_24'],
            ['cat_3', 'مدیر ارشد', 'base_18', 'base_25'],
            ['cat_3', 'مدیر میانی', 'base_19', 'base_26'],
            ['cat_3', 'کارشناس', 'base_20', 'base_27'],
            ['cat_2', 'تاکسیرانی', 'base_21', 'base_28'],
            ['cat_2', 'اتوبوسرانی', 'base_22', 'base_29'],
            ['cat_2', 'مالی و حسابداری', 'base_23', 'base_30'],
            ['cat_3', 'رئیس', 'base_24', 'base_31'],
            ['cat_3', 'معاون', 'base_25', 'base_32'],
            ['cat_3', 'مدیر', 'base_26', 'base_33'],
        ];

    }

    private function historyData(): array
    {
//        [$userRef, $baseRef, $noticeNumber, $noticeDate, $startDate, $endDate]
        return [
            ['user_1', 'base_0', '1000', new \DateTime('-14 years'), new \DateTime('-14 years'), new \DateTime('-13 years')],
            ['user_1', 'base_1', '1500', new \DateTime('-4 years'), new \DateTime('-4 years'), new \DateTime('-3 years')],
            ['user_1', 'base_2', '2000', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_3', '2500', new \DateTime('-6 years'), new \DateTime('-6 years'), new \DateTime('-5 years')],
            ['user_1', 'base_4', '3000', new \DateTime('-7 years'), new \DateTime('-7 years'), new \DateTime('-6 years')],
            ['user_1', 'base_5', '3500', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_6', '4000', new \DateTime('-14 years'), new \DateTime('-14 years'), null],
            ['user_1', 'base_7', '4500', new \DateTime('-10 years'), new \DateTime('-10 years'), new \DateTime('-9 years')],
            ['user_1', 'base_8', '5000', new \DateTime('-5 years'), new \DateTime('-5 years'), new \DateTime('-4 years')],
            ['user_1', 'base_9', '5500', new \DateTime('-13 years'), new \DateTime('-13 years'), new \DateTime('-12 years')],
            ['user_1', 'base_10', '6000', new \DateTime('-4 years'), new \DateTime('-4 years'), new \DateTime('-3 years')],
            ['user_1', 'base_11', '6500', new \DateTime('-7 years'), new \DateTime('-7 years'), new \DateTime('-6 years')],
            ['user_1', 'base_12', '7000', new \DateTime('-4 years'), new \DateTime('-4 years'), new \DateTime('-3 years')],
            ['user_1', 'base_13', '7500', new \DateTime('-12 years'), new \DateTime('-12 years'), new \DateTime('-11 years')],
            ['user_1', 'base_14', '8000', new \DateTime('-8 years'), new \DateTime('-8 years'), new \DateTime('-7 years')],
            ['user_1', 'base_15', '8500', new \DateTime('-5 years'), new \DateTime('-5 years'), new \DateTime('-4 years')],
            ['user_1', 'base_16', '9000', new \DateTime('-14 years'), new \DateTime('-14 years'), new \DateTime('-13 years')],
            ['user_1', 'base_17', '9500', new \DateTime('-8 years'), new \DateTime('-8 years'), new \DateTime('-7 years')],
            ['user_1', 'base_18', '10000', new \DateTime('-12 years'), new \DateTime('-12 years'), new \DateTime('-11 years')],
            ['user_1', 'base_19', '10500', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_20', '11000', new \DateTime('-4 years'), new \DateTime('-4 years'), null],
            ['user_1', 'base_21', '11500', new \DateTime('-10 years'), new \DateTime('-10 years'), new \DateTime('-9 years')],
            ['user_1', 'base_22', '12000', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_23', '12500', new \DateTime('-11 years'), new \DateTime('-11 years'), new \DateTime('-10 years')],
            ['user_1', 'base_24', '13000', new \DateTime('-9 years'), new \DateTime('-9 years'), new \DateTime('-8 years')],
            ['user_1', 'base_25', '13500', new \DateTime('-12 years'), new \DateTime('-12 years'), new \DateTime('-11 years')],
            ['user_1', 'base_26', '14000', new \DateTime('-8 years'), new \DateTime('-8 years'), new \DateTime('-7 years')],
            ['user_1', 'base_27', '14500', new \DateTime('-9 years'), new \DateTime('-9 years'), new \DateTime('-8 years')],
            ['user_1', 'base_28', '15000', new \DateTime('-8 years'), new \DateTime('-8 years'), new \DateTime('-7 years')],
            ['user_1', 'base_29', '15500', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_30', '16000', new \DateTime('-5 years'), new \DateTime('-5 years'), null],
            ['user_1', 'base_31', '16500', new \DateTime('-2 years'), new \DateTime('-2 years'), new \DateTime('-1 years')],
            ['user_1', 'base_32', '17000', new \DateTime('-12 years'), new \DateTime('-12 years'), new \DateTime('-11 years')],
            ['user_1', 'base_33', '17500', new \DateTime('-7 years'), new \DateTime('-7 years'), null],

        ];
    }
}
