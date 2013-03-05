<?php

namespace Model\Base;

/**
 * Base class of Model\FormElement document.
 */
abstract class FormElement extends \Model\Element implements \ArrayAccess
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
     * @return \Model\FormElement The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        parent::setDocumentData($data);

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }
        if (isset($data['_id'])) {
            $this->setId($data['_id']);
            $this->setIsNew(false);
        }
        if (isset($data['label'])) {
            $this->data['fields']['label'] = (string) $data['label'];
        } elseif (isset($data['_fields']['label'])) {
            $this->data['fields']['label'] = null;
        }
        if (isset($data['default'])) {
            $this->data['fields']['default'] = $data['default'];
        } elseif (isset($data['_fields']['default'])) {
            $this->data['fields']['default'] = null;
        }
        if (isset($data['author'])) {
            $this->data['fields']['author_reference_field'] = $data['author'];
        } elseif (isset($data['_fields']['author'])) {
            $this->data['fields']['author_reference_field'] = null;
        }
        if (isset($data['categories'])) {
            $this->data['fields']['categories_reference_field'] = $data['categories'];
        } elseif (isset($data['_fields']['categories'])) {
            $this->data['fields']['categories_reference_field'] = null;
        }
        if (isset($data['comments'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Model\Comment');
            $embedded->setRootAndPath($this, 'comments');
            $embedded->setSavedData($data['comments']);
            $this->data['embeddedsMany']['comments'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "label" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function setLabel($value)
    {
        if (!isset($this->data['fields']['label'])) {
            if (!$this->isNew()) {
                $this->getLabel();
                if ($value === $this->data['fields']['label']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['label'] = null;
                $this->data['fields']['label'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['label']) {
            return $this;
        }

        if (!isset($this->fieldsModified['label']) && !array_key_exists('label', $this->fieldsModified)) {
            $this->fieldsModified['label'] = $this->data['fields']['label'];
        } elseif ($value === $this->fieldsModified['label']) {
            unset($this->fieldsModified['label']);
        }

        $this->data['fields']['label'] = $value;

        return $this;
    }

    /**
     * Returns the "label" field.
     *
     * @return mixed The $name field.
     */
    public function getLabel()
    {
        if (!isset($this->data['fields']['label'])) {
            if ($this->isNew()) {
                $this->data['fields']['label'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('label', $this->data['fields'])) {
                $this->addFieldCache('label');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('label' => 1));
                if (isset($data['label'])) {
                    $this->data['fields']['label'] = (string) $data['label'];
                } else {
                    $this->data['fields']['label'] = null;
                }
            }
        }

        return $this->data['fields']['label'];
    }

    /**
     * Set the "default" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function setDefault($value)
    {
        if (!isset($this->data['fields']['default'])) {
            if (!$this->isNew()) {
                $this->getDefault();
                if ($value === $this->data['fields']['default']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['default'] = null;
                $this->data['fields']['default'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['default']) {
            return $this;
        }

        if (!isset($this->fieldsModified['default']) && !array_key_exists('default', $this->fieldsModified)) {
            $this->fieldsModified['default'] = $this->data['fields']['default'];
        } elseif ($value === $this->fieldsModified['default']) {
            unset($this->fieldsModified['default']);
        }

        $this->data['fields']['default'] = $value;

        return $this;
    }

    /**
     * Returns the "default" field.
     *
     * @return mixed The $name field.
     */
    public function getDefault()
    {
        if (!isset($this->data['fields']['default'])) {
            if ($this->isNew()) {
                $this->data['fields']['default'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('default', $this->data['fields'])) {
                $this->addFieldCache('default');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('default' => 1));
                if (isset($data['default'])) {
                    $this->data['fields']['default'] = $data['default'];
                } else {
                    $this->data['fields']['default'] = null;
                }
            }
        }

        return $this->data['fields']['default'];
    }

    /**
     * Set the "author_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function setAuthor_reference_field($value)
    {
        if (!isset($this->data['fields']['author_reference_field'])) {
            if (!$this->isNew()) {
                $this->getAuthor_reference_field();
                if ($value === $this->data['fields']['author_reference_field']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['author_reference_field'] = null;
                $this->data['fields']['author_reference_field'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['author_reference_field']) {
            return $this;
        }

        if (!isset($this->fieldsModified['author_reference_field']) && !array_key_exists('author_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['author_reference_field'] = $this->data['fields']['author_reference_field'];
        } elseif ($value === $this->fieldsModified['author_reference_field']) {
            unset($this->fieldsModified['author_reference_field']);
        }

        $this->data['fields']['author_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "author_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getAuthor_reference_field()
    {
        if (!isset($this->data['fields']['author_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['author_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('author_reference_field', $this->data['fields'])) {
                $this->addFieldCache('author');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('author' => 1));
                if (isset($data['author'])) {
                    $this->data['fields']['author_reference_field'] = $data['author'];
                } else {
                    $this->data['fields']['author_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['author_reference_field'];
    }

    /**
     * Set the "categories_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function setCategories_reference_field($value)
    {
        if (!isset($this->data['fields']['categories_reference_field'])) {
            if (!$this->isNew()) {
                $this->getCategories_reference_field();
                if ($value === $this->data['fields']['categories_reference_field']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['categories_reference_field'] = null;
                $this->data['fields']['categories_reference_field'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['categories_reference_field']) {
            return $this;
        }

        if (!isset($this->fieldsModified['categories_reference_field']) && !array_key_exists('categories_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['categories_reference_field'] = $this->data['fields']['categories_reference_field'];
        } elseif ($value === $this->fieldsModified['categories_reference_field']) {
            unset($this->fieldsModified['categories_reference_field']);
        }

        $this->data['fields']['categories_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "categories_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getCategories_reference_field()
    {
        if (!isset($this->data['fields']['categories_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['categories_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('categories_reference_field', $this->data['fields'])) {
                $this->addFieldCache('categories');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('categories' => 1));
                if (isset($data['categories'])) {
                    $this->data['fields']['categories_reference_field'] = $data['categories'];
                } else {
                    $this->data['fields']['categories_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['categories_reference_field'];
    }

    /**
     * Set the "author" reference.
     *
     * @param \Model\Author|null $value The reference, or null.
     *
     * @return \Model\FormElement The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\Author.
     */
    public function setAuthor($value)
    {
        if (null !== $value && !$value instanceof \Model\Author) {
            throw new \InvalidArgumentException('The "author" reference is not an instance of Model\Author.');
        }

        $this->setAuthor_reference_field((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['author'] = $value;

        return $this;
    }

    /**
     * Returns the "author" reference.
     *
     * @return \Model\Author|null The reference or null if it does not exist.
     */
    public function getAuthor()
    {
        if (!isset($this->data['referencesOne']['author'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('author');
            }
            if (!$id = $this->getAuthor_reference_field()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Model\Author')->findOneById($id)) {
                throw new \RuntimeException('The reference "author" does not exist.');
            }
            $this->data['referencesOne']['author'] = $document;
        }

        return $this->data['referencesOne']['author'];
    }

    /**
     * Returns the "categories" reference.
     *
     * @return \Mandango\Group\ReferenceGroup The reference.
     */
    public function getCategories()
    {
        if (!isset($this->data['referencesMany']['categories'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('categories');
            }
            $this->data['referencesMany']['categories'] = new \Mandango\Group\ReferenceGroup('Model\Category', $this, 'categories_reference_field');
        }

        return $this->data['referencesMany']['categories'];
    }

    /**
     * Adds documents to the "categories" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function addCategories($documents)
    {
        $this->getCategories()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "categories" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function removeCategories($documents)
    {
        $this->getCategories()->remove($documents);

        return $this;
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
        parent::updateReferenceFields();

        if (isset($this->data['referencesOne']['author']) && !isset($this->data['fields']['author_reference_field'])) {
            $this->setAuthor_reference_field($this->data['referencesOne']['author']->getId());
        }
        if (isset($this->data['embeddedsMany']['comments'])) {
            $group = $this->data['embeddedsMany']['comments'];
            foreach ($group->getSaved() as $document) {
                $document->updateReferenceFields();
            }
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['author'])) {
            $this->data['referencesOne']['author']->save();
        }
    }

    /**
     * Returns the "comments" embedded many.
     *
     * @return \Mandango\Group\EmbeddedGroup The "comments" embedded many.
     */
    public function getComments()
    {
        if (!isset($this->data['embeddedsMany']['comments'])) {
            $this->data['embeddedsMany']['comments'] = $embedded = new \Mandango\Group\EmbeddedGroup('Model\Comment');
            $embedded->setRootAndPath($this, 'comments');
        }

        return $this->data['embeddedsMany']['comments'];
    }

    /**
     * Adds documents to the "comments" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function addComments($documents)
    {
        $this->getComments()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "comments" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function removeComments($documents)
    {
        $this->getComments()->remove($documents);

        return $this;
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['referencesMany']['categories'])) {
            $this->data['referencesMany']['categories']->reset();
        }
        if (isset($this->data['embeddedsOne']['source'])) {
            $this->data['embeddedsOne']['source']->resetGroups();
        }
        if (isset($this->data['embeddedsMany']['comments'])) {
            $group = $this->data['embeddedsMany']['comments'];
            foreach (array_merge($group->getAdd(), $group->getRemove()) as $document) {
                $document->resetGroups();
            }
            if ($group->isSavedInitialized()) {
                foreach ($group->getSaved() as $document) {
                    $document->resetGroups();
                }
            }
            $group->reset();
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
        if ('label' == $name) {
            return $this->setLabel($value);
        }
        if ('default' == $name) {
            return $this->setDefault($value);
        }
        if ('author_reference_field' == $name) {
            return $this->setAuthor_reference_field($value);
        }
        if ('categories_reference_field' == $name) {
            return $this->setCategories_reference_field($value);
        }
        if ('author' == $name) {
            return $this->setAuthor($value);
        }
        if ('source' == $name) {
            return $this->setSource($value);
        }
        try {
            return parent::set($name, $value);
        } catch (\InvalidArgumentException $e) {
        }
        try {
            return parent::get($name);
        } catch (\InvalidArgumentException $e) {
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
        if ('label' == $name) {
            return $this->getLabel();
        }
        if ('default' == $name) {
            return $this->getDefault();
        }
        if ('author_reference_field' == $name) {
            return $this->getAuthor_reference_field();
        }
        if ('categories_reference_field' == $name) {
            return $this->getCategories_reference_field();
        }
        if ('author' == $name) {
            return $this->getAuthor();
        }
        if ('categories' == $name) {
            return $this->getCategories();
        }
        if ('source' == $name) {
            return $this->getSource();
        }
        if ('comments' == $name) {
            return $this->getComments();
        }
        try {
            return parent::get($name);
        } catch (\InvalidArgumentException $e) {
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\FormElement The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        parent::fromArray($array);
        if (isset($array['default'])) {
            $this->setDefault($array['default']);
        }
        if (isset($array['author_reference_field'])) {
            $this->setAuthor_reference_field($array['author_reference_field']);
        }
        if (isset($array['author'])) {
            $this->setAuthor($array['author']);
        }
        if (isset($array['comments'])) {
            $embeddeds = array();
            foreach ($array['comments'] as $documentData) {
                $embeddeds[] = $embedded = new \Model\Comment($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getComments()->replace($embeddeds);
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
        $array = parent::toArray($withReferenceFields);

        $array['default'] = $this->getDefault();
        if ($withReferenceFields) {
            $array['author_reference_field'] = $this->getAuthor_reference_field();
        }

        return $array;
    }

    /**
     * INTERNAL. Invoke the "preInsert" event.
     */
    public function preInsertEvent()
    {
        parent::elementPreInsert();
        $this->formElementPreInsert();
    }

    /**
     * INTERNAL. Invoke the "postInsert" event.
     */
    public function postInsertEvent()
    {
        parent::elementPostInsert();
        $this->formElementPostInsert();
    }

    /**
     * INTERNAL. Invoke the "preUpdate" event.
     */
    public function preUpdateEvent()
    {
        parent::elementPreUpdate();
        $this->formElementPreUpdate();
    }

    /**
     * INTERNAL. Invoke the "postUpdate" event.
     */
    public function postUpdateEvent()
    {
        parent::elementPostUpdate();
        $this->formElementPostUpdate();
    }

    /**
     * INTERNAL. Invoke the "preDelete" event.
     */
    public function preDeleteEvent()
    {
        parent::elementPreDelete();
        $this->formElementPreDelete();
    }

    /**
     * INTERNAL. Invoke the "postDelete" event.
     */
    public function postDeleteEvent()
    {
        parent::elementPostDelete();
        $this->formElementPostDelete();
    }

    /**
     * Query for save.
     */
    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = parent::queryForSave();
        if ($isNew) {
            $query['type'] = 'formelement';
        }
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['default'])) {
                    $query['default'] = $this->data['fields']['default'];
                }
                if (isset($this->data['fields']['author_reference_field'])) {
                    $query['author'] = $this->data['fields']['author_reference_field'];
                }
            } else {
                if (isset($this->data['fields']['default']) || array_key_exists('default', $this->data['fields'])) {
                    $value = $this->data['fields']['default'];
                    $originalValue = $this->getOriginalFieldValue('default');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['default'] = $this->data['fields']['default'];
                        } else {
                            $query['$unset']['default'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['author_reference_field']) || array_key_exists('author_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['author_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('author_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['author'] = $this->data['fields']['author_reference_field'];
                        } else {
                            $query['$unset']['author'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsOne'])) {
        }
        if (isset($this->data['embeddedsMany'])) {
            if ($isNew) {
                if (isset($this->data['embeddedsMany']['comments'])) {
                    foreach ($this->data['embeddedsMany']['comments']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['comments'])) {
                    $group = $this->data['embeddedsMany']['comments'];
                    foreach ($group->getSaved() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                    $groupRap = $group->getRootAndPath();
                    foreach ($group->getAdd() as $document) {
                        $q = $document->queryForSave(array(), true);
                        $rap = $document->getRootAndPath();
                        foreach (explode('.', $rap['path']) as $name) {
                            if (0 === strpos($name, '_add')) {
                                $name = substr($name, 4);
                            }
                            $q = $q[$name];
                        }
                        $query['$pushAll'][$groupRap['path']][] = $q;
                    }
                    foreach ($group->getRemove() as $document) {
                        $rap = $document->getRootAndPath();
                        $query['$unset'][$rap['path']] = 1;
                    }
                }
            }
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