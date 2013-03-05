<?php

namespace Model\Base;

/**
 * Base class of Model\Message document.
 */
abstract class Message extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Model\Message The document (fluent interface).
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
        if (isset($data['author'])) {
            $this->data['fields']['author'] = (string) $data['author'];
        } elseif (isset($data['_fields']['author'])) {
            $this->data['fields']['author'] = null;
        }
        if (isset($data['replyTo'])) {
            $this->data['fields']['replyToId'] = $data['replyTo'];
        } elseif (isset($data['_fields']['replyTo'])) {
            $this->data['fields']['replyToId'] = null;
        }

        return $this;
    }

    /**
     * Set the "author" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Message The document (fluent interface).
     */
    public function setAuthor($value)
    {
        if (!isset($this->data['fields']['author'])) {
            if (!$this->isNew()) {
                $this->getAuthor();
                if ($value === $this->data['fields']['author']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['author'] = null;
                $this->data['fields']['author'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['author']) {
            return $this;
        }

        if (!isset($this->fieldsModified['author']) && !array_key_exists('author', $this->fieldsModified)) {
            $this->fieldsModified['author'] = $this->data['fields']['author'];
        } elseif ($value === $this->fieldsModified['author']) {
            unset($this->fieldsModified['author']);
        }

        $this->data['fields']['author'] = $value;

        return $this;
    }

    /**
     * Returns the "author" field.
     *
     * @return mixed The $name field.
     */
    public function getAuthor()
    {
        if (!isset($this->data['fields']['author'])) {
            if ($this->isNew()) {
                $this->data['fields']['author'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('author', $this->data['fields'])) {
                $this->addFieldCache('author');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('author' => 1));
                if (isset($data['author'])) {
                    $this->data['fields']['author'] = (string) $data['author'];
                } else {
                    $this->data['fields']['author'] = null;
                }
            }
        }

        return $this->data['fields']['author'];
    }

    /**
     * Set the "replyToId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Message The document (fluent interface).
     */
    public function setReplyToId($value)
    {
        if (!isset($this->data['fields']['replyToId'])) {
            if (!$this->isNew()) {
                $this->getReplyToId();
                if ($value === $this->data['fields']['replyToId']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['replyToId'] = null;
                $this->data['fields']['replyToId'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['replyToId']) {
            return $this;
        }

        if (!isset($this->fieldsModified['replyToId']) && !array_key_exists('replyToId', $this->fieldsModified)) {
            $this->fieldsModified['replyToId'] = $this->data['fields']['replyToId'];
        } elseif ($value === $this->fieldsModified['replyToId']) {
            unset($this->fieldsModified['replyToId']);
        }

        $this->data['fields']['replyToId'] = $value;

        return $this;
    }

    /**
     * Returns the "replyToId" field.
     *
     * @return mixed The $name field.
     */
    public function getReplyToId()
    {
        if (!isset($this->data['fields']['replyToId'])) {
            if ($this->isNew()) {
                $this->data['fields']['replyToId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('replyToId', $this->data['fields'])) {
                $this->addFieldCache('replyTo');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('replyTo' => 1));
                if (isset($data['replyTo'])) {
                    $this->data['fields']['replyToId'] = $data['replyTo'];
                } else {
                    $this->data['fields']['replyToId'] = null;
                }
            }
        }

        return $this->data['fields']['replyToId'];
    }

    /**
     * Set the "replyTo" reference.
     *
     * @param \Model\Message|null $value The reference, or null.
     *
     * @return \Model\Message The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\Message.
     */
    public function setReplyTo($value)
    {
        if (null !== $value && !$value instanceof \Model\Message) {
            throw new \InvalidArgumentException('The "replyTo" reference is not an instance of Model\Message.');
        }

        $this->setReplyToId((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['replyTo'] = $value;

        return $this;
    }

    /**
     * Returns the "replyTo" reference.
     *
     * @return \Model\Message|null The reference or null if it does not exist.
     */
    public function getReplyTo()
    {
        if (!isset($this->data['referencesOne']['replyTo'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('replyTo');
            }
            if (!$id = $this->getReplyToId()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Model\Message')->findOneById($id)) {
                throw new \RuntimeException('The reference "replyTo" does not exist.');
            }
            $this->data['referencesOne']['replyTo'] = $document;
        }

        return $this->data['referencesOne']['replyTo'];
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
     * Update the value of the reference fields.
     */
    public function updateReferenceFields()
    {
        if (isset($this->data['referencesOne']['replyTo']) && !isset($this->data['fields']['replyToId'])) {
            $this->setReplyToId($this->data['referencesOne']['replyTo']->getId());
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['replyTo'])) {
            $this->data['referencesOne']['replyTo']->save();
        }
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
        if ('author' == $name) {
            return $this->setAuthor($value);
        }
        if ('replyToId' == $name) {
            return $this->setReplyToId($value);
        }
        if ('replyTo' == $name) {
            return $this->setReplyTo($value);
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
        if ('author' == $name) {
            return $this->getAuthor();
        }
        if ('replyToId' == $name) {
            return $this->getReplyToId();
        }
        if ('replyTo' == $name) {
            return $this->getReplyTo();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\Message The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['author'])) {
            $this->setAuthor($array['author']);
        }
        if (isset($array['replyToId'])) {
            $this->setReplyToId($array['replyToId']);
        }
        if (isset($array['replyTo'])) {
            $this->setReplyTo($array['replyTo']);
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

        $array['author'] = $this->getAuthor();
        if ($withReferenceFields) {
            $array['replyToId'] = $this->getReplyToId();
        }

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
                if (isset($this->data['fields']['author'])) {
                    $query['author'] = (string) $this->data['fields']['author'];
                }
                if (isset($this->data['fields']['replyToId'])) {
                    $query['replyTo'] = $this->data['fields']['replyToId'];
                }
            } else {
                if (isset($this->data['fields']['author']) || array_key_exists('author', $this->data['fields'])) {
                    $value = $this->data['fields']['author'];
                    $originalValue = $this->getOriginalFieldValue('author');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['author'] = (string) $this->data['fields']['author'];
                        } else {
                            $query['$unset']['author'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['replyToId']) || array_key_exists('replyToId', $this->data['fields'])) {
                    $value = $this->data['fields']['replyToId'];
                    $originalValue = $this->getOriginalFieldValue('replyToId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['replyTo'] = $this->data['fields']['replyToId'];
                        } else {
                            $query['$unset']['replyTo'] = 1;
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