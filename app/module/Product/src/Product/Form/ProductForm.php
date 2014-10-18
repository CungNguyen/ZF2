<?php

namespace Product\Form;

use Zend\Form\Form;

class ProductForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('product');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
        $this->add(array(
            'name' => 'productid',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Title',
            ),
        ));
        $this->add(array(
            'name' => 'urlrewrite',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Url Rewrite',
            ),
        ));
        $this->add(array(
            'name' => 'quantity',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Quantity',
            ),
        ));
        $this->add(array(
            'name' => 'price',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Price',
            ),
        ));
        $this->add(array(
            'name' => 'img',
            'attributes' => array(
                'type'  => 'file',
            ),
            'options' => array(
                'label' => 'Picture',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'status',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Status',
            ),
        ));
        $this->add(array(
            'name' => 'categoryid',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Category',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}

