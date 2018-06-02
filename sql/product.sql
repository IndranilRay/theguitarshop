CREATE DATABASE guitar_shop;
CREATE TABLE IF NOT EXISTS `product_products` (
  `prod_id` int(6) unsigned NOT NULL,
  `sku` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `product_added_on` timestamp NOT NULL,
  `type` bit NOT NULL,
  `qunatity` int NOT NULL,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`prod_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `product_brand` (
  `brand_id` int(6) unsigned NOT NULL,
  `brand_name` varchar(250) NOT NULL,
  PRIMARY KEY (`brand_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `product_model` (
  `model_id` int(6) unsigned NOT NULL,
  `model_name` varchar(250) NOT NULL,
  PRIMARY KEY (`model_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `product_guitar` (
  `guitar_id` int(6) unsigned NOT NULL,
  `prod_id` int(6) NOT NULL,
  `brand_id` int(6) NOT NULL,
  `model_id` int(6) NOT NULL,
  `name` varchar(250) NOT NULL,
  `no_of_strings` int(10) NOT NULL,
  `type` varchar(250) NOT NULL,
  PRIMARY KEY (`guitar_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `product_guitar_accessories` (
  `access_id` int(6) unsigned NOT NULL,
  `access_name` varchar(250) NOT NULL,
  `attributes` varchar(250) NOT NULL,
  `prod_id` int(6) NOT NULL,
  PRIMARY KEY (`access_id`)
) DEFAULT CHARSET=utf8;