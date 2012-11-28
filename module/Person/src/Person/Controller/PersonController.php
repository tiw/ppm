<?php
namespace Person\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Tiddr\Image\SmartResizer;
/**
 * User: wangting
 * Date: 12-11-28
 * Time: 上午9:47
 * copyright 2012 tiddr.de
 */
class PersonController extends AbstractActionController
{
    /**
     * @var \Person\Model\Mapper\Person
     */
    protected $personMapper;

    public function indexAction()
    {
        $persons = $this->getPersonMapper()->fetchAll();
        return array('persons' => $persons);
    }

    public function editAction()
    {
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            $this->redirect()->toRoute('person', array('action' => 'index'));
        }
        $person = $this->getPersonMapper()->findById($id);

        $form = $this->getServiceLocator()->get('PersonForm');
        $form->bind($person);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                // delete the old thumb
                $imagePath = $person->getImagePath();
                if (!$imagePath) {
                    $imageName = BASEDIR . '/public/person_images/' . $imagePath;
                    if (file_exists(BASEDIR . '/public/person_images/' . $imagePath) && is_file($imageName)) {
                        unlink($imageName);
                    }
                }
                $newPerson = $form->getData();
                $newImagePath = $this->_saveThumb($person->getId());
                if ($newImagePath) {
                    $newPerson->setImagePath($newImagePath);
                }
                $this->getPersonMapper()->update($newPerson);
            }
        }
        $imagePath = $person->getImagePath();
        return array('form' => $form, 'imagePath' => $imagePath);
    }


    /**
     * get the person mapper
     * @return \Person\Model\Mapper\Person
     */
    public function getPersonMapper()
    {
        if (!$this->personMapper) {
            $sm = $this->getServiceLocator();
            $this->personMapper = $sm->get('PersonMapper');
        }
        return $this->personMapper;
    }
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('PersonForm');
        $form->get('submit')->setValue('Add');
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                /**
                 * @var \Person\Model\Person
                 */
                $person = $this->getPersonMapper()->insert($form->getData());
                $imageName = $this->_saveThumb($person->getId());
                if ($imageName) {
                    $person->setImagePath($imageName);
                    $this->getPersonMapper()->update($person);
                }
            }
        }
        return array('form' => $form);
    }

    private function _saveThumb($personId)
    {
        $imageName = 'image';
        if ($_FILES[$imageName]['error'] == 0) {
            $suffix = array_pop(explode('.', $_FILES[$imageName]['name']));

            $imageDir = __DIR__ . '/../../../../../public/person_images/';
            $generatedImageName = 'person_' . $personId . '.' . $suffix;
            $uploadName = $imageDir . $generatedImageName;

            if ($_FILES[$imageName]['size'] == 0) {
                return false;
            }
            $result = move_uploaded_file($_FILES['image']['tmp_name'], $uploadName);
            SmartResizer::resize($imageDir, $generatedImageName, $generatedImageName, 200, 300);

            return $generatedImageName;
        } else {
            throw new \Exception('can not save thumb');
        }

    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('person');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');
            if ($del == 'Yes') {
                $this->getPersonMapper()->deleteById($id);
            }
            return $this->redirect()->toRoute('person');
        }
        return array('id' => $id, 'person' => $this->getPersonMapper()->findById($id));
    }}
