<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119091106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE article ALTER ean TYPE NUMERIC(15, 0)');
        $this->addSql('ALTER TABLE article ALTER ean DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE article_id_seq');
        $this->addSql('SELECT setval(\'article_id_seq\', (SELECT MAX(id) FROM article))');
        $this->addSql('ALTER TABLE article ALTER id SET DEFAULT nextval(\'article_id_seq\')');
        $this->addSql('ALTER TABLE article ALTER ean TYPE NUMERIC(20, 0)');
        $this->addSql('ALTER TABLE article ALTER ean SET NOT NULL');
    }
}
