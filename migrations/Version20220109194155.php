<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109194155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, category_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_C0B4FE61727ACA70 (parent_id), INDEX IDX_C0B4FE6112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, is_show TINYINT(1) NOT NULL, is_delete TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE base ADD CONSTRAINT FK_C0B4FE61727ACA70 FOREIGN KEY (parent_id) REFERENCES base (id)');
        $this->addSql('ALTER TABLE base ADD CONSTRAINT FK_C0B4FE6112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base DROP FOREIGN KEY FK_C0B4FE61727ACA70');
        $this->addSql('ALTER TABLE base DROP FOREIGN KEY FK_C0B4FE6112469DE2');
        $this->addSql('DROP TABLE base');
        $this->addSql('DROP TABLE category');
    }
}
