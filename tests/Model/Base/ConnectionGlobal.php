<?php

namespace Model\Base;

/**
 * Base class of Model\ConnectionGlobal document.
 */
abstract class ConnectionGlobal extends \Mandango\Document\Document implements \ArrayAccess
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return \Model\ConnectionGlobal The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
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
        if (isset($data['field'])) {
            $this->data['fields']['field'] = (string) $data['field'];
        } elseif (isset($data['_fields']['field'])) {
            $this->data['fields']['field'] = null;
        }

        return $this;
    }

    /**
     * Set the "field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\ConnectionGlobal The document (fluent interface).
     */
    public function setField($value)
    {
        if (!isset($this->data['fields']['field'])) {
            if (!$this->isNew()) {
                $this->getField();
                if ($value === $this->data['fields']['field']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['field'] = null;
                $this->data['fields']['field'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['field']) {
            return $this;
        }

        if (!isset($this->fieldsModified['field']) && !array_key_exists('field', $this->fieldsModified)) {
            $this->fieldsModified['field'] = $this->data['fields']['field'];
        } elseif ($value === $this->fieldsModified['field']) {
            unset($this->fieldsModified['field']);
        }

        $this->data['fields']['field'] = $value;

        return $this;
    }

    /**
     * Returns the "field" field.
     *
     * @return mixed The $name field.
     */
    public function getField()
    {
        if (!isset($this->data['fields']['field'])) {
            if ($this->isNew()) {
                $this->data['fields']['field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('field', $this->data['fields'])) {
                $this->addFieldCache('field');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('field' => 1));
                if (isset($data['field'])) {
                    $this->data['fields']['field'] = (string) $data['field'];
                } else {
                    $this->data['fields']['field'] = null;
                }
            }
        }

        return $this->data['fields']['field'];
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
        if ('field' == $name) {
            return $this->setField($value);
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
        if ('field' == $name) {
            return $this->getField();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\ConnectionGlobal The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['field'])) {
            $this->setField($array['field']);
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

        $array['field'] = $this->getField();

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
                if (isset($this->data['fields']['field'])) {
                    $query['field'] = (string) $this->data['fields']['field'];
                }
            } else {
                if (isset($this->data['fields']['field']) || array_key_exists('field', $this->data['fields'])) {
                    $value = $this->data['fields']['field'];
                    $originalValue = $this->getOriginalFieldValue('field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['field'] = (string) $this->data['fields']['field'];
                        } else {
                            $query['$unset']['field'] = 1;
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