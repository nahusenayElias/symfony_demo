<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250302185610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Step 1: Create the `user` table
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');

        // Step 2: Add a default category if none exists
        $this->addSql('INSERT INTO category (name) VALUES ("Default Category")');

        // Step 3: Create a temporary table to hold existing product data
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, price FROM product');

        // Step 4: Drop the existing `product` table
        $this->addSql('DROP TABLE product');

        // Step 5: Recreate the `product` table with the `category_id` column
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, category_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');

        // Step 6: Insert existing product data and assign the default category
        $this->addSql('INSERT INTO product (id, name, price, category_id) SELECT id, name, price, (SELECT id FROM category WHERE name = "Default Category") FROM __temp__product');

        // Step 7: Drop the temporary table
        $this->addSql('DROP TABLE __temp__product');

        // Step 8: Create an index on the `category_id` column
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
    }

    public function down(Schema $schema): void
    {
        // Step 1: Drop the `user` table
        $this->addSql('DROP TABLE user');

        // Step 2: Create a temporary table to hold existing product data
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, name, price FROM product');

        // Step 3: Drop the existing `product` table
        $this->addSql('DROP TABLE product');

        // Step 4: Recreate the `product` table without the `category_id` column
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL)');

        // Step 5: Insert existing product data back into the table
        $this->addSql('INSERT INTO product (id, name, price) SELECT id, name, price FROM __temp__product');

        // Step 6: Drop the temporary table
        $this->addSql('DROP TABLE __temp__product');
    }
}