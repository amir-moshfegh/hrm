<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109191536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(15) NOT NULL, last_name VARCHAR(25) NOT NULL, image_name VARCHAR(255) NOT NULL, gender VARCHAR(10) NOT NULL, father_name VARCHAR(15) DEFAULT NULL, birth_place VARCHAR(50) DEFAULT NULL, birth_date DATE DEFAULT NULL, shsh VARCHAR(10) DEFAULT NULL, insurance_id VARCHAR(15) DEFAULT NULL, account_id INT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, marital_status VARCHAR(10) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, mobile VARCHAR(11) DEFAULT NULL, tel1 VARCHAR(11) DEFAULT NULL, sms VARCHAR(11) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_deleted TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649217BBB47');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE user');
    }
}
