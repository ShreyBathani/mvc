<?php
namespace Block\Home\Index;
\Mage::loadFileByClassName('Block\Core\Template');

class Products extends \Block\Core\Template
{
	protected $mostPopularProducts = [];
    function __construct()
    {
        $this->setTemplate('./View/home/index/products.php');
    }
    public function setMostPopularProducts()
	{
		$product = \Mage::getModel('Model\Product');
        $productMedia = \Mage::getModel('Model\Product\Media');
		$query = "SELECT `p`.`productId`,`p`.`name`,`p`.`price`,`pm`.`imageName` FROM `{$product->getTableName()}` as `p` 
		LEFT JOIN `{$productMedia->getTableName()}` as `pm` ON `p`.`productId` = `pm`.`productId` AND `pm`.`thumb` = 1 WHERE `p`.`popular` != '53' LIMIT 8";
		$this->mostPopularProducts = $product->fetchAll($query);
		return $this;
	}
	public function getMostPopularProducts()
	{
		if (!$this->mostPopularProducts) {
			$this->setMostPopularProducts();
		}
		return $this->mostPopularProducts;
	}
}