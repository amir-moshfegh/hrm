<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109200757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, base_id INT DEFAULT NULL, notice_number VARCHAR(10) DEFAULT NULL, notice_date DATETIME DEFAULT NULL, is_delete TINYINT(1) NOT NULL, INDEX IDX_27BA704B217BBB47 (person_id), INDEX IDX_27BA704B6967DF41 (base_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B6967DF41 FOREIGN KEY (base_id) REFERENCES base (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE history');
    }
}
