<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Product {

    public $productid;
    public $title;
    public $urlrewrite;
    public $quantity;
    public $price;
    public $img;
    public $description;
    public $status;
    public $categoryid;
    protected $inputFilter;

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

    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'productid',
                        'required' => true,
                        'fall_back_value' => 0,
                        'filters' => array(
                            array('name' => 'Int'),
                        )
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'title',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'max' => 100
                                )
                            )
                        ),
                        'filters' => array(
                            array('name' => 'StringTrim')
                        )
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'urlrewrite',
                        'required' => true,
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'max' => 100
                                )
                            )
                        ),
                        'filters' => array(
                            array('name' => 'StringTrim')
                        )
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'quantity',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'Int'),
                        )
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'price',
                        'required' => false,
                        'validators' => array(
                            array('name' => '\Zend\I18n\Validator\Float'),
                        )
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'img',
                        'required' => false,
                        'validators' => array(
                            array(
                                'name' => '\Zend\Validator\File\Size',
                                'options' => array(
                                    'min' => '10kB',
                                    'max' => '2MB'
                                )
                            )
                        ),
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'description',
                        'required' => false,
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'max' => 1000
                                )
                            )
                        ),
                        'filters' => array(
                            array('name' => 'StringTrim')
                        )
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'status',
                        'required' => true,
                        'fallback_value' => 0,
                        'validators' => array(
                            array('name' => 'Digits')
                        ),
                        'filters' => array(
                            array('name' => 'Int')
                        )
            )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'categoryid',
                        'required' => true,
                        'fallback_value' => 0,
                        'validators' => array(
                            array('name' => 'Digits')
                        ),
                        'filters' => array(
                            array('name' => 'Int')
                        )
            )));
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function setImg($img) {
        $this->img = $img;
    }

}
