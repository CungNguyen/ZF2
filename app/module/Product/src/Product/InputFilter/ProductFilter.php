<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\InputFilter;

use Zend\InputFilter\InputFilter;

class ProductFilter extends InputFilter {

    public function __construct() {

        $this->add(array(
            'name' => 'productid',
            'required' => true,
            'fall_back_value' => 0,
            'filters' => array(
                array('name' => 'Int'),
            )
        ));

        $this->add(array(
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
        ));
        $this->add(array(
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
        ));
        $this->add(array(
            'name' => 'quantity',
            'required' => false,
            'filters' => array(
                array('name' => 'Int'),
            )
        ));

        $this->add(array(
            'name' => 'price',
            'required' => false,
            'validators' => array(
                array('name' => '\Zend\I18n\Validator\Float'),
            )
        ));

        $this->add(array(
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
        ));
        $this->add(array(
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
        ));

        $this->add(array(
            'name' => 'status',
            'required' => true,
            'fallback_value' => 0,
            'validators' => array(
                array('name' => 'Digits')
            ),
            'filters' => array(
                array('name' => 'Int')
            )
        ));
        $this->add(array(
            'name' => 'categoryid',
            'required' => true,
            'fallback_value' => 0,
            'validators' => array(
                array('name' => 'Digits')
            ),
            'filters' => array(
                array('name' => 'Int')
            )
        ));
    }

}
