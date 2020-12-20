<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201226200228 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ad_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE deal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE deal_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ad (id INT NOT NULL, seller_id INT NOT NULL, created_value DATE NOT NULL, category_value VARCHAR(255) NOT NULL, address_value VARCHAR(255) NOT NULL, description_value TEXT NOT NULL, price_value INT NOT NULL, rooms_value INT NOT NULL, area_value DOUBLE PRECISION NOT NULL, floor_value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_77E0ED588DE820D9 ON ad (seller_id)');
        $this->addSql('COMMENT ON COLUMN ad.created_value IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE deal (id INT NOT NULL, ad_id INT NOT NULL, buyer_id INT NOT NULL, state_value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E3FEC1164F34D596 ON deal (ad_id)');
        $this->addSql('CREATE INDEX IDX_E3FEC1166C755722 ON deal (buyer_id)');
        $this->addSql('CREATE TABLE deal_event (id INT NOT NULL, deal_id INT DEFAULT NULL, created_value DATE NOT NULL, state_value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7D71C9BBF60E2305 ON deal_event (deal_id)');
        $this->addSql('COMMENT ON COLUMN deal_event.created_value IS \'(DC2Type:date_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, roles JSON NOT NULL, email_value VARCHAR(255) NOT NULL, name_value VARCHAR(255) NOT NULL, password_value VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649803A19BB ON "user" (email_value)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED588DE820D9 FOREIGN KEY (seller_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1164F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deal ADD CONSTRAINT FK_E3FEC1166C755722 FOREIGN KEY (buyer_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE deal_event ADD CONSTRAINT FK_7D71C9BBF60E2305 FOREIGN KEY (deal_id) REFERENCES deal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deal DROP CONSTRAINT FK_E3FEC1164F34D596');
        $this->addSql('ALTER TABLE deal_event DROP CONSTRAINT FK_7D71C9BBF60E2305');
        $this->addSql('ALTER TABLE ad DROP CONSTRAINT FK_77E0ED588DE820D9');
        $this->addSql('ALTER TABLE deal DROP CONSTRAINT FK_E3FEC1166C755722');
        $this->addSql('DROP SEQUENCE ad_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE deal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE deal_event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE deal');
        $this->addSql('DROP TABLE deal_event');
        $this->addSql('DROP TABLE "user"');
    }
}
