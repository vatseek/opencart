<?php
class ModelCatalogBuypack extends Model {
	
	public function install(){
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` ADD `qty_perpack` INT(1) NOT NULL DEFAULT '1' AFTER `quantity`");
	}
	
	public function uninstall(){
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "product` DROP `qty_perpack`");
	}
}