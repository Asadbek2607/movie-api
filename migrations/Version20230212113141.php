<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212113141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add CardImage to Movie';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie ADD card_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26F8494EBEE FOREIGN KEY (card_image_id) REFERENCES media_object (id)');
        $this->addSql('CREATE INDEX IDX_1D5EF26F8494EBEE ON movie (card_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26F8494EBEE');
        $this->addSql('DROP INDEX IDX_1D5EF26F8494EBEE ON movie');
        $this->addSql('ALTER TABLE movie DROP card_image_id');
    }
}
