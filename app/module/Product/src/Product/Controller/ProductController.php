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

    public function indexAction() {
        return new ViewModel(array(
            'products' => $this->getProductTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $form = new ProductForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());

            $postArr = $request->getPost()->toArray();
            $fileArr = $this->params()->fromFiles('img');
            $data = array_merge(
                    $postArr, array('file' => $fileArr['name'])
            );

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

        $form = new ProductForm();
        $form->bind($product);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getProductTable()->saveProduct($form->getData());

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

}
