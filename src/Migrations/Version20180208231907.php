<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180208231907 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart_discount (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(50) NOT NULL, discount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_order (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', payment_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', shipment_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', discount_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, items_total INT NOT NULL, items_price_total DOUBLE PRECISION DEFAULT \'0\' NOT NULL, price_total DOUBLE PRECISION DEFAULT \'0\' NOT NULL, INDEX IDX_AAC3FE904C3A3BB (payment_id), INDEX IDX_AAC3FE907BE036FC (shipment_id), INDEX IDX_AAC3FE904C7C611F (discount_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_order_item (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', order_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', product_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, quantity INT NOT NULL, price_total DOUBLE PRECISION DEFAULT \'0\' NOT NULL, INDEX IDX_32806FFB8D9F6D38 (order_id), INDEX IDX_32806FFB4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_payment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_product (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_shipment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_order ADD CONSTRAINT FK_AAC3FE904C3A3BB FOREIGN KEY (payment_id) REFERENCES cart_payment (id)');
        $this->addSql('ALTER TABLE cart_order ADD CONSTRAINT FK_AAC3FE907BE036FC FOREIGN KEY (shipment_id) REFERENCES cart_shipment (id)');
        $this->addSql('ALTER TABLE cart_order ADD CONSTRAINT FK_AAC3FE904C7C611F FOREIGN KEY (discount_id) REFERENCES cart_discount (id)');
        $this->addSql('ALTER TABLE cart_order_item ADD CONSTRAINT FK_32806FFB8D9F6D38 FOREIGN KEY (order_id) REFERENCES cart_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_order_item ADD CONSTRAINT FK_32806FFB4584665A FOREIGN KEY (product_id) REFERENCES cart_product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_order DROP FOREIGN KEY FK_AAC3FE904C7C611F');
        $this->addSql('ALTER TABLE cart_order_item DROP FOREIGN KEY FK_32806FFB8D9F6D38');
        $this->addSql('ALTER TABLE cart_order DROP FOREIGN KEY FK_AAC3FE904C3A3BB');
        $this->addSql('ALTER TABLE cart_order_item DROP FOREIGN KEY FK_32806FFB4584665A');
        $this->addSql('ALTER TABLE cart_order DROP FOREIGN KEY FK_AAC3FE907BE036FC');
        $this->addSql('DROP TABLE cart_discount');
        $this->addSql('DROP TABLE cart_order');
        $this->addSql('DROP TABLE cart_order_item');
        $this->addSql('DROP TABLE cart_payment');
        $this->addSql('DROP TABLE cart_product');
        $this->addSql('DROP TABLE cart_shipment');
    }
}
