<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Model;

use Product\Entity\ProductEntity;

class ProductModel {

    protected $serviceManager;
    protected $entityManager;
    protected $repository;

    public function __construct($serviceManager) {
        $this->serviceManager = $serviceManager;
        $this->entityManager = $this->serviceManager->get('doctrine.entitymanager.orm_default');
        $this->repository = $this->entityManager->getRepository('Product\Entity\ProductEntity'); // Fully namespace
    }

    public function getListProduct() {
        $productTest = $this->repository->findAll();
        return $productTest;
    }

    public function getProduct($id) {
        $product = $this->repository->find($id);
        return $product;
    }

    public function saveProduct(ProductEntity $product) {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function delete($productid) {
        $product = $this->getProduct($productid);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

}
