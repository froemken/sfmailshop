#
# Table structure for table 'tx_sfmailshop_domain_model_variant'
#
CREATE TABLE tx_sfmailshop_domain_model_product (
  title varchar(255) DEFAULT '' NOT NULL,
  is_top_product tinyint(1) DEFAULT '0' NOT NULL,
  article_number varchar(255) DEFAULT '' NOT NULL,
  description text,
  images int(11) unsigned DEFAULT '0',
  price varchar(255) DEFAULT '' NOT NULL,
  stock int(11) unsigned DEFAULT '0',
  variants int(11) unsigned DEFAULT '0'
);

#
# Table structure for table 'tx_sfmailshop_domain_model_variant'
#
CREATE TABLE tx_sfmailshop_domain_model_variant (
  title varchar(255) DEFAULT '' NOT NULL,
  price varchar(255) DEFAULT '' NOT NULL,
  stock int(11) unsigned DEFAULT '0',
  color varchar(255) DEFAULT '' NOT NULL,
  size varchar(255) DEFAULT '' NOT NULL,
  has_lettering tinyint(1) unsigned DEFAULT '0',
  product int(11) unsigned DEFAULT '0'
);

#
# Table structure for table 'tx_sfmailshop_domain_model_color'
#
CREATE TABLE tx_sfmailshop_domain_model_color (
  title varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_sfmailshop_domain_model_size'
#
CREATE TABLE tx_sfmailshop_domain_model_size (
  title varchar(255) DEFAULT '' NOT NULL
);
