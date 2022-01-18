<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109205214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704B217BBB47');
        $this->addSql('DROP INDEX IDX_27BA704B217BBB47 ON history');
        $this->addSql('ALTER TABLE history CHANGE person_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_27BA704BA76ED395 ON history (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BA76ED395');
        $this->addSql('DROP INDEX IDX_27BA704BA76ED395 ON history');
        $this->addSql('ALTER TABLE history CHANGE user_id person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704B217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_27BA704B217BBB47 ON history (person_id)');
    }
}
