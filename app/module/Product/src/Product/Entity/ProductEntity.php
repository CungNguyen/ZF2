<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="product")
 * */
class ProductEntity {

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue * */
    protected $productid;

    /** @ORM\Column(type="string") * */
    protected $title;

    /** @ORM\Column(type="string") * */
    protected $urlrewrite;

    /** @ORM\Column(type="integer") * */
    protected $quantity;

    /** @ORM\Column(type="float") * */
    protected $price;

    /** @ORM\Column(type="string") * */
    protected $img;

    /** @ORM\Column(type="string") * */
    protected $description;

    /** @ORM\Column(type="integer") * */
    protected $status;

    /** @ORM\Column(type="integer") * */
    protected $categoryid;

    public function exchangeArray($data) {
        $this->productid = (isset($data['productid'])) ? $data['productid'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->urlrewrite = (isset($data['urlrewrite'])) ? $data['urlrewrite'] : null;
        $this->quantity = (isset($data['quantity'])) ? $data['quantity'] : null;
        $this->price = (isset($data['price'])) ? $data['price'] : null;
        $this->img = (isset($data['img'])) ? $data['img'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
        $this->categoryid = (isset($data['categoryid'])) ? $data['categoryid'] : null;
    }

    public function getProductId() {
        return $this->productid;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getUrlRewrite() {
        return $this->urlrewrite;
    }

    public function setUrlRewrite($urlRewrite) {
        $this->urlrewrite = $urlRewrite;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getImg() {
        return $this->img;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setImg($img) {
        $this->img = $img;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setCategoryid($categoryid) {
        $this->categoryid = $categoryid;
    }

    public function getCategoryid() {
        return $this->categoryid;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
