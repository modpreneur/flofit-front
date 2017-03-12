<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161026125002 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clickbank_product (id INT AUTO_INCREMENT NOT NULL, sku VARCHAR(100) NOT NULL, site VARCHAR(50) NOT NULL, digital TINYINT(1) DEFAULT \'0\' NOT NULL, physical TINYINT(1) DEFAULT \'0\' NOT NULL, digital_recuring TINYINT(1) DEFAULT \'0\' NOT NULL, physical_recuring TINYINT(1) DEFAULT \'0\' NOT NULL, title LONGTEXT NOT NULL, first_price DOUBLE PRECISION NOT NULL, second_price DOUBLE PRECISION NOT NULL, recuring_frequency VARCHAR(30) NOT NULL, duration INT NOT NULL, trial_days INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, firstPrice DOUBLE PRECISION NOT NULL, currency VARCHAR(3) DEFAULT \'usd\' NOT NULL, discr VARCHAR(255) NOT NULL, sku_id VARCHAR(200) DEFAULT NULL, plan_id VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_item (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_92F307BF4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_item ADD CONSTRAINT FK_92F307BF4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_item DROP FOREIGN KEY FK_92F307BF4584665A');
        $this->addSql('DROP TABLE clickbank_product');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_item');
    }
}
