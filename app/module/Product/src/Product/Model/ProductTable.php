<?php

namespace Product\Model;

use Zend\Db\TableGateway\TableGateway;

class ProductTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getProduct($productid) {
        $productid = (int) $productid;
        $rowset = $this->tableGateway->select(array('productid' => $productid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $productid");
        }
        return $row;
    }

    public function saveProduct(Product $product) {
        $data = array(
            'title' => $product->title,
            'urlrewrite' => $product->urlrewrite,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'img' => $product->img,
            'description' => $product->description,
            'status' => $product->status,
            'categoryid' => $product->categoryid,
        );

        $productid = (int) $product->productid;
        if ($productid == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getProduct($productid)) {
                $this->tableGateway->update($data, array('productid' => $productid));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteProduct($productid) {
        $this->tableGateway->delete(array('productid' => $productid));
    }

}
