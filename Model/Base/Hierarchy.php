<?php

namespace Model\Base;

/**
 * Base class of Model\Hierarchy document.
 */
abstract class Hierarchy extends \Mandango\Document\Document
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
     * @return \Model\Hierarchy The document (fluent interface).
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
        if (isset($data['name'])) {
            $this->data['fields']['name'] = (string) $data['name'];
        } elseif (isset($data['_fields']['name'])) {
            $this->data['fields']['name'] = null;
        }
        if (isset($data['parent'])) {
            $this->data['fields']['parent'] = (string) $data['parent'];
        } elseif (isset($data['_fields']['parent'])) {
            $this->data['fields']['parent'] = null;
        }
        if (isset($data['level'])) {
            $this->data['fields']['level'] = (int) $data['level'];
        } elseif (isset($data['_fields']['level'])) {
            $this->data['fields']['level'] = null;
        }
        if (isset($data['path'])) {
            $this->data['fields']['path'] = (string) $data['path'];
        } elseif (isset($data['_fields']['path'])) {
            $this->data['fields']['path'] = null;
        }
        if (isset($data['root'])) {
            $this->data['fields']['root'] = (bool) $data['root'];
        } elseif (isset($data['_fields']['root'])) {
            $this->data['fields']['root'] = null;
        }

        return $this;
    }

    /**
     * Set the "name" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function setName($value)
    {
        if (!isset($this->data['fields']['name'])) {
            if (!$this->isNew()) {
                $this->getName();
                if ($value === $this->data['fields']['name']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['name'] = null;
                $this->data['fields']['name'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['name']) {
            return $this;
        }

        if (!isset($this->fieldsModified['name']) && !array_key_exists('name', $this->fieldsModified)) {
            $this->fieldsModified['name'] = $this->data['fields']['name'];
        } elseif ($value === $this->fieldsModified['name']) {
            unset($this->fieldsModified['name']);
        }

        $this->data['fields']['name'] = $value;

        return $this;
    }

    /**
     * Returns the "name" field.
     *
     * @return mixed The $name field.
     */
    public function getName()
    {
        if (!isset($this->data['fields']['name'])) {
            if ($this->isNew()) {
                $this->data['fields']['name'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('name', $this->data['fields'])) {
                $this->addFieldCache('name');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('name' => 1));
                if (isset($data['name'])) {
                    $this->data['fields']['name'] = (string) $data['name'];
                } else {
                    $this->data['fields']['name'] = null;
                }
            }
        }

        return $this->data['fields']['name'];
    }

    /**
     * Set the "parent" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function setParent($value)
    {
        if (!isset($this->data['fields']['parent'])) {
            if (!$this->isNew()) {
                $this->getParent();
                if ($value === $this->data['fields']['parent']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['parent'] = null;
                $this->data['fields']['parent'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['parent']) {
            return $this;
        }

        if (!isset($this->fieldsModified['parent']) && !array_key_exists('parent', $this->fieldsModified)) {
            $this->fieldsModified['parent'] = $this->data['fields']['parent'];
        } elseif ($value === $this->fieldsModified['parent']) {
            unset($this->fieldsModified['parent']);
        }

        $this->data['fields']['parent'] = $value;

        return $this;
    }

    /**
     * Returns the "parent" field.
     *
     * @return mixed The $name field.
     */
    public function getParent()
    {
        if (!isset($this->data['fields']['parent'])) {
            if ($this->isNew()) {
                $this->data['fields']['parent'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('parent', $this->data['fields'])) {
                $this->addFieldCache('parent');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('parent' => 1));
                if (isset($data['parent'])) {
                    $this->data['fields']['parent'] = (string) $data['parent'];
                } else {
                    $this->data['fields']['parent'] = null;
                }
            }
        }

        return $this->data['fields']['parent'];
    }

    /**
     * Set the "level" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function setLevel($value)
    {
        if (!isset($this->data['fields']['level'])) {
            if (!$this->isNew()) {
                $this->getLevel();
                if ($value === $this->data['fields']['level']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['level'] = null;
                $this->data['fields']['level'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['level']) {
            return $this;
        }

        if (!isset($this->fieldsModified['level']) && !array_key_exists('level', $this->fieldsModified)) {
            $this->fieldsModified['level'] = $this->data['fields']['level'];
        } elseif ($value === $this->fieldsModified['level']) {
            unset($this->fieldsModified['level']);
        }

        $this->data['fields']['level'] = $value;

        return $this;
    }

    /**
     * Returns the "level" field.
     *
     * @return mixed The $name field.
     */
    public function getLevel()
    {
        if (!isset($this->data['fields']['level'])) {
            if ($this->isNew()) {
                $this->data['fields']['level'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('level', $this->data['fields'])) {
                $this->addFieldCache('level');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('level' => 1));
                if (isset($data['level'])) {
                    $this->data['fields']['level'] = (int) $data['level'];
                } else {
                    $this->data['fields']['level'] = null;
                }
            }
        }

        return $this->data['fields']['level'];
    }

    /**
     * Set the "path" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function setPath($value)
    {
        if (!isset($this->data['fields']['path'])) {
            if (!$this->isNew()) {
                $this->getPath();
                if ($value === $this->data['fields']['path']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['path'] = null;
                $this->data['fields']['path'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['path']) {
            return $this;
        }

        if (!isset($this->fieldsModified['path']) && !array_key_exists('path', $this->fieldsModified)) {
            $this->fieldsModified['path'] = $this->data['fields']['path'];
        } elseif ($value === $this->fieldsModified['path']) {
            unset($this->fieldsModified['path']);
        }

        $this->data['fields']['path'] = $value;

        return $this;
    }

    /**
     * Returns the "path" field.
     *
     * @return mixed The $name field.
     */
    public function getPath()
    {
        if (!isset($this->data['fields']['path'])) {
            if ($this->isNew()) {
                $this->data['fields']['path'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('path', $this->data['fields'])) {
                $this->addFieldCache('path');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('path' => 1));
                if (isset($data['path'])) {
                    $this->data['fields']['path'] = (string) $data['path'];
                } else {
                    $this->data['fields']['path'] = null;
                }
            }
        }

        return $this->data['fields']['path'];
    }

    /**
     * Set the "root" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function setRoot($value)
    {
        if (!isset($this->data['fields']['root'])) {
            if (!$this->isNew()) {
                $this->getRoot();
                if ($value === $this->data['fields']['root']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['root'] = null;
                $this->data['fields']['root'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['root']) {
            return $this;
        }

        if (!isset($this->fieldsModified['root']) && !array_key_exists('root', $this->fieldsModified)) {
            $this->fieldsModified['root'] = $this->data['fields']['root'];
        } elseif ($value === $this->fieldsModified['root']) {
            unset($this->fieldsModified['root']);
        }

        $this->data['fields']['root'] = $value;

        return $this;
    }

    /**
     * Returns the "root" field.
     *
     * @return mixed The $name field.
     */
    public function getRoot()
    {
        if (!isset($this->data['fields']['root'])) {
            if ($this->isNew()) {
                $this->data['fields']['root'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('root', $this->data['fields'])) {
                $this->addFieldCache('root');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('root' => 1));
                if (isset($data['root'])) {
                    $this->data['fields']['root'] = (bool) $data['root'];
                } else {
                    $this->data['fields']['root'] = null;
                }
            }
        }

        return $this->data['fields']['root'];
    }

    /**
     * Process onDelete.
     */
    public function processOnDelete()
    {
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
        if ('name' == $name) {
            return $this->setName($value);
        }
        if ('parent' == $name) {
            return $this->setParent($value);
        }
        if ('level' == $name) {
            return $this->setLevel($value);
        }
        if ('path' == $name) {
            return $this->setPath($value);
        }
        if ('root' == $name) {
            return $this->setRoot($value);
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
        if ('name' == $name) {
            return $this->getName();
        }
        if ('parent' == $name) {
            return $this->getParent();
        }
        if ('level' == $name) {
            return $this->getLevel();
        }
        if ('path' == $name) {
            return $this->getPath();
        }
        if ('root' == $name) {
            return $this->getRoot();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\Hierarchy The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['parent'])) {
            $this->setParent($array['parent']);
        }
        if (isset($array['level'])) {
            $this->setLevel($array['level']);
        }
        if (isset($array['path'])) {
            $this->setPath($array['path']);
        }
        if (isset($array['root'])) {
            $this->setRoot($array['root']);
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

        $array['name'] = $this->getName();
        $array['parent'] = $this->getParent();
        $array['level'] = $this->getLevel();
        $array['path'] = $this->getPath();
        $array['root'] = $this->getRoot();

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
                if (isset($this->data['fields']['name'])) {
                    $query['name'] = (string) $this->data['fields']['name'];
                }
                if (isset($this->data['fields']['parent'])) {
                    $query['parent'] = (string) $this->data['fields']['parent'];
                }
                if (isset($this->data['fields']['level'])) {
                    $query['level'] = (int) $this->data['fields']['level'];
                }
                if (isset($this->data['fields']['path'])) {
                    $query['path'] = (string) $this->data['fields']['path'];
                }
                if (isset($this->data['fields']['root'])) {
                    $query['root'] = (bool) $this->data['fields']['root'];
                }
            } else {
                if (isset($this->data['fields']['name']) || array_key_exists('name', $this->data['fields'])) {
                    $value = $this->data['fields']['name'];
                    $originalValue = $this->getOriginalFieldValue('name');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['name'] = (string) $this->data['fields']['name'];
                        } else {
                            $query['$unset']['name'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['parent']) || array_key_exists('parent', $this->data['fields'])) {
                    $value = $this->data['fields']['parent'];
                    $originalValue = $this->getOriginalFieldValue('parent');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['parent'] = (string) $this->data['fields']['parent'];
                        } else {
                            $query['$unset']['parent'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['level']) || array_key_exists('level', $this->data['fields'])) {
                    $value = $this->data['fields']['level'];
                    $originalValue = $this->getOriginalFieldValue('level');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['level'] = (int) $this->data['fields']['level'];
                        } else {
                            $query['$unset']['level'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['path']) || array_key_exists('path', $this->data['fields'])) {
                    $value = $this->data['fields']['path'];
                    $originalValue = $this->getOriginalFieldValue('path');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['path'] = (string) $this->data['fields']['path'];
                        } else {
                            $query['$unset']['path'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['root']) || array_key_exists('root', $this->data['fields'])) {
                    $value = $this->data['fields']['root'];
                    $originalValue = $this->getOriginalFieldValue('root');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['root'] = (bool) $this->data['fields']['root'];
                        } else {
                            $query['$unset']['root'] = 1;
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