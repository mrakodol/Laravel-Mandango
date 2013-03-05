<?php

namespace Model\Base;

/**
 * Base class of Model\Book document.
 */
abstract class Book extends \Mandango\Document\Document implements \ArrayAccess
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
        $this->setComment('good');
        $this->setIsHere(true);
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return \Model\Book The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if (true || $clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }
        if (isset($data['_id'])) {
            $this->setId($data['_id']);
            $this->setIsNew(false);
        }
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }
        if (isset($data['comment'])) {
            $this->data['fields']['comment'] = (string) $data['comment'];
        } elseif (isset($data['_fields']['comment'])) {
            $this->data['fields']['comment'] = null;
        }
        if (isset($data['isHere'])) {
            $this->data['fields']['isHere'] = (bool) $data['isHere'];
        } elseif (isset($data['_fields']['isHere'])) {
            $this->data['fields']['isHere'] = null;
        }

        return $this;
    }

    /**
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Book The document (fluent interface).
     */
    public function setTitle($value)
    {
        if (!isset($this->data['fields']['title'])) {
            if (!$this->isNew()) {
                $this->getTitle();
                if ($value === $this->data['fields']['title']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['title'] = null;
                $this->data['fields']['title'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['title']) {
            return $this;
        }

        if (!isset($this->fieldsModified['title']) && !array_key_exists('title', $this->fieldsModified)) {
            $this->fieldsModified['title'] = $this->data['fields']['title'];
        } elseif ($value === $this->fieldsModified['title']) {
            unset($this->fieldsModified['title']);
        }

        $this->data['fields']['title'] = $value;

        return $this;
    }

    /**
     * Returns the "title" field.
     *
     * @return mixed The $name field.
     */
    public function getTitle()
    {
        if (!isset($this->data['fields']['title'])) {
            if ($this->isNew()) {
                $this->data['fields']['title'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields'])) {
                $this->addFieldCache('title');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('title' => 1));
                if (isset($data['title'])) {
                    $this->data['fields']['title'] = (string) $data['title'];
                } else {
                    $this->data['fields']['title'] = null;
                }
            }
        }

        return $this->data['fields']['title'];
    }

    /**
     * Set the "comment" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Book The document (fluent interface).
     */
    public function setComment($value)
    {
        if (!isset($this->data['fields']['comment'])) {
            if (!$this->isNew()) {
                $this->getComment();
                if ($value === $this->data['fields']['comment']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['comment'] = null;
                $this->data['fields']['comment'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['comment']) {
            return $this;
        }

        if (!isset($this->fieldsModified['comment']) && !array_key_exists('comment', $this->fieldsModified)) {
            $this->fieldsModified['comment'] = $this->data['fields']['comment'];
        } elseif ($value === $this->fieldsModified['comment']) {
            unset($this->fieldsModified['comment']);
        }

        $this->data['fields']['comment'] = $value;

        return $this;
    }

    /**
     * Returns the "comment" field.
     *
     * @return mixed The $name field.
     */
    public function getComment()
    {
        if (!isset($this->data['fields']['comment'])) {
            if ($this->isNew()) {
                $this->data['fields']['comment'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('comment', $this->data['fields'])) {
                $this->addFieldCache('comment');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('comment' => 1));
                if (isset($data['comment'])) {
                    $this->data['fields']['comment'] = (string) $data['comment'];
                } else {
                    $this->data['fields']['comment'] = null;
                }
            }
        }

        return $this->data['fields']['comment'];
    }

    /**
     * Set the "isHere" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Book The document (fluent interface).
     */
    public function setIsHere($value)
    {
        if (!isset($this->data['fields']['isHere'])) {
            if (!$this->isNew()) {
                $this->getIsHere();
                if ($value === $this->data['fields']['isHere']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isHere'] = null;
                $this->data['fields']['isHere'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['isHere']) {
            return $this;
        }

        if (!isset($this->fieldsModified['isHere']) && !array_key_exists('isHere', $this->fieldsModified)) {
            $this->fieldsModified['isHere'] = $this->data['fields']['isHere'];
        } elseif ($value === $this->fieldsModified['isHere']) {
            unset($this->fieldsModified['isHere']);
        }

        $this->data['fields']['isHere'] = $value;

        return $this;
    }

    /**
     * Returns the "isHere" field.
     *
     * @return mixed The $name field.
     */
    public function getIsHere()
    {
        if (!isset($this->data['fields']['isHere'])) {
            if ($this->isNew()) {
                $this->data['fields']['isHere'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isHere', $this->data['fields'])) {
                $this->addFieldCache('isHere');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isHere' => 1));
                if (isset($data['isHere'])) {
                    $this->data['fields']['isHere'] = (bool) $data['isHere'];
                } else {
                    $this->data['fields']['isHere'] = null;
                }
            }
        }

        return $this->data['fields']['isHere'];
    }

    /**
     * Process onDelete.
     */
    public function processOnDelete()
    {
        // Model\Article: like
        $discriminatorValue = get_class($this);
        $this->processOnDeleteCascade('Model\Article', array('like' => array('_mandangoDocumentClass' => $discriminatorValue, 'id' => $this->getId())));

        // Model\Article: likeUnset
        $discriminatorValue = get_class($this);
        $criteria = array('likeUnset' => array('_mandangoDocumentClass' => $discriminatorValue, 'id' => $this->getId()));
        $update = array('$unset' => array('likeUnset' => 1));
        $this->processOnDeleteUnset('Model\Article', $criteria, $update);

        // Model\Article: related
        $discriminatorValue = get_class($this);
        $criteria = array();
        $update = array('$pull' => array('related' => array('_mandangoDocumentClass' => $discriminatorValue, 'id' => $this->getId())));
        $this->processOnDeleteUnset('Model\Article', $criteria, $update);
    }

    private function processOnDeleteCascade($class, array $criteria)
    {
        $repository = $this->getMandango()->getRepository($class);
        $documents = $repository->createQuery($criteria)->all();
        if (count($documents)) {
            $repository->delete($documents);
        }
    }

    private function processOnDeleteUnset($class, array $criteria, array $update)
    {
        $this->getMandango()->getRepository($class)->update($criteria, $update, array('multiple' => true));
    }

    /**
     * Set a document data value by data name as string.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return mixed the data name setter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function set($name, $value)
    {
        if ('title' == $name) {
            return $this->setTitle($value);
        }
        if ('comment' == $name) {
            return $this->setComment($value);
        }
        if ('isHere' == $name) {
            return $this->setIsHere($value);
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Returns a document data by data name as string.
     *
     * @param string $name The data name.
     *
     * @return mixed The data name getter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function get($name)
    {
        if ('title' == $name) {
            return $this->getTitle();
        }
        if ('comment' == $name) {
            return $this->getComment();
        }
        if ('isHere' == $name) {
            return $this->getIsHere();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\Book The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['comment'])) {
            $this->setComment($array['comment']);
        }
        if (isset($array['isHere'])) {
            $this->setIsHere($array['isHere']);
        }

        return $this;
    }

    /**
     * Export the document data to an array.
     *
     * @param Boolean $withReferenceFields Whether include the fields of references or not (false by default).
     *
     * @return array An array with the document data.
     */
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['title'] = $this->getTitle();
        $array['comment'] = $this->getComment();
        $array['isHere'] = $this->getIsHere();

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = array();
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['comment'])) {
                    $query['comment'] = (string) $this->data['fields']['comment'];
                }
                if (isset($this->data['fields']['isHere'])) {
                    $query['isHere'] = (bool) $this->data['fields']['isHere'];
                }
            } else {
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset']['title'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['comment']) || array_key_exists('comment', $this->data['fields'])) {
                    $value = $this->data['fields']['comment'];
                    $originalValue = $this->getOriginalFieldValue('comment');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['comment'] = (string) $this->data['fields']['comment'];
                        } else {
                            $query['$unset']['comment'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isHere']) || array_key_exists('isHere', $this->data['fields'])) {
                    $value = $this->data['fields']['isHere'];
                    $originalValue = $this->getOriginalFieldValue('isHere');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isHere'] = (bool) $this->data['fields']['isHere'];
                        } else {
                            $query['$unset']['isHere'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }

        return $query;
    }

    /**
     * Throws an \LogicException because you cannot check if data exists.
     *
     * @throws \LogicException
     */
    public function offsetExists($name)
    {
        throw new \LogicException('You cannot check if data exists.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetSet($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function offsetGet($name)
    {
        return $this->get($name);
    }

    /**
     * Throws a \LogicException because you cannot unset data through ArrayAccess.
     *
     * @throws \LogicException
     */
    public function offsetUnset($name)
    {
        throw new \LogicException('You cannot unset data.');
    }

    /**
     * Set data in the document.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * Returns data of the document.
     *
     * @param string $name The data name.
     *
     * @return mixed Some data.
     *
     * @throws \InvalidArgumentException If the data name does not exists.
     */
    public function __get($name)
    {
        return $this->get($name);
    }
}