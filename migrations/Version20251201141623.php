<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251201141623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_plats (menu_id INT NOT NULL, plats_id INT NOT NULL, INDEX IDX_14E6416DCCD7E912 (menu_id), INDEX IDX_14E6416DAA14E1C8 (plats_id), PRIMARY KEY(menu_id, plats_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats ADD CONSTRAINT FK_14E6416DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats ADD CONSTRAINT FK_14E6416DAA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93AA14E1C8
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_7D053A93AA14E1C8 ON menu
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu DROP plats_id
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats DROP FOREIGN KEY FK_14E6416DCCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_plats DROP FOREIGN KEY FK_14E6416DAA14E1C8
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_plats
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu ADD plats_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu ADD CONSTRAINT FK_7D053A93AA14E1C8 FOREIGN KEY (plats_id) REFERENCES plats (id) ON UPDATE NO ACTION ON DELETE NO ACTION
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_7D053A93AA14E1C8 ON menu (plats_id)
        SQL);
    }
}
