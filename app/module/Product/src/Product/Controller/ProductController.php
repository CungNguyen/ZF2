<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;
use Product\Model\Product;
use Product\Form\ProductForm;

class ProductController extends AbstractActionController {

    protected $productTable;
    protected $categoryTable;

    public function indexAction() {
        return new ViewModel(array(
            'products' => $this->getProductTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new ProductForm();
        $form->get('submit')->setValue('Add');
        $categoryList = $this->getCategoryList();
        $form->get('categoryid')->setValueOptions($categoryList);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());

            $postArr = $request->getPost()->toArray();
            $form->setData($postArr);
            $file = $this->params()->fromFiles('img');

            if ($form->isValid()) {
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setDestination(getcwd() . '\public\assets');
                if ($adapter->receive($file['name'])) {
                    $formData = $form->getData();
                    $formData['img'] = $adapter->getFileName(null, false);
                    $product->exchangeArray($formData);
                    $this->getProductTable()->saveProduct($product);
                    // Redirect to list of albums
                    return $this->redirect()->toRoute('product');
                }
            } else {
                var_dump($form->getMessages());
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product', array(
                        'action' => 'add'
            ));
        }
        $product = $this->getProductTable()->getProduct($id);
        $img = $product->img;

        $form = new ProductForm();
        $form->bind($product); // bind form to object, getData will return this object
        $form->get('submit')->setAttribute('value', 'Edit');
        $categoryList = $this->getCategoryList();
        $form->get('categoryid')->setValueOptions($categoryList)->setValue($product->categoryid);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($product->getInputFilter());

            $postArr = $request->getPost()->toArray();
            $form->setData($postArr);
            $file = $this->params()->fromFiles('img');


            if ($form->isValid()) {
                $adapter = new \Zend\File\Transfer\Adapter\Http();
                $adapter->setDestination(getcwd() . '\public\assets');
                $formData = $form->getData();

                if ($adapter->receive($file['name'])) {
                    $formData->setImg($adapter->getFileName(null, false));
                } else {
                    $formData->setImg($img);
                }
                $this->getProductTable()->saveProduct($formData);
                return $this->redirect()->toRoute('product');
            } else {
                var_dump($form->getMessages());
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('product');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getProductTable()->deleteProduct($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('product');
        }

        return array(
            'productid' => $id,
            'product' => $this->getProductTable()->getProduct($id)
        );
    }

    public function getProductTable() {
        if (!$this->productTable) {
            $sm = $this->getServiceLocator();
            $this->productTable = $sm->get('Product\Model\ProductTable');
        }
        return $this->productTable;
    }

    public function getCategoryTable() {
        if (!$this->categoryTable) {
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Product\Model\CategoryTable');
        }
        return $this->categoryTable;
    }
    
    public function getCategoryList() {
        $categoryTable = $this->getCategoryTable()->fetchAll();
        $categoryList = array();
        foreach($categoryTable as $category) {
            $categoryList[$category->categoryid] = $category->title;
        }
        return $categoryList;
    }
}
