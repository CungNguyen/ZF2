<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Model;

class Category {
    public $categoryid;
    public $title;
    public $status;
    
    public function exchangeArray($data) {
        $this->categoryid = (isset($data['categoryid'])) ? $data['categoryid'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->status = (isset($data['status'])) ? $data['status'] : null;
    }
}