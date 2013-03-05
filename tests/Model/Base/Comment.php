<?php

namespace Model\Base;

/**
 * Base class of Model\Comment document.
 */
abstract class Comment extends \Mandango\Document\EmbeddedDocument implements \ArrayAccess
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
     * @return \Model\Comment The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['name'])) {
            $this->data['fields']['name'] = (string) $data['name'];
        } elseif (isset($data['_fields']['name'])) {
            $this->data['fields']['name'] = null;
        }
        if (isset($data['text'])) {
            $this->data['fields']['text'] = (string) $data['text'];
        } elseif (isset($data['_fields']['text'])) {
            $this->data['fields']['text'] = null;
        }
        if (isset($data['note'])) {
            $this->data['fields']['note'] = (string) $data['note'];
        } elseif (isset($data['_fields']['note'])) {
            $this->data['fields']['note'] = null;
        }
        if (isset($data['line'])) {
            $this->data['fields']['line'] = (string) $data['line'];
        } elseif (isset($data['_fields']['line'])) {
            $this->data['fields']['line'] = null;
        }
        if (isset($data['author'])) {
            $this->data['fields']['authorId'] = $data['author'];
        } elseif (isset($data['_fields']['author'])) {
            $this->data['fields']['authorId'] = null;
        }
        if (isset($data['categories'])) {
            $this->data['fields']['categoryIds'] = $data['categories'];
        } elseif (isset($data['_fields']['categories'])) {
            $this->data['fields']['categoryIds'] = null;
        }
        if (isset($data['infos'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Model\Info');
            if ($rap = $this->getRootAndPath()) {
                $embedded->setRootAndPath($rap['root'], $rap['path'].'.infos');
            }
            $embedded->setSavedData($data['infos']);
            $this->data['embeddedsMany']['infos'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "name" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setName($value)
    {
        if (!isset($this->data['fields']['name'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
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
            if (
                (!isset($this->data['fields']) || !array_key_exists('name', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.name';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['name'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['name'])) {
                $this->data['fields']['name'] = null;
            }
        }

        return $this->data['fields']['name'];
    }

    /**
     * Set the "text" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setText($value)
    {
        if (!isset($this->data['fields']['text'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getText();
                if ($value === $this->data['fields']['text']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['text'] = null;
                $this->data['fields']['text'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['text']) {
            return $this;
        }

        if (!isset($this->fieldsModified['text']) && !array_key_exists('text', $this->fieldsModified)) {
            $this->fieldsModified['text'] = $this->data['fields']['text'];
        } elseif ($value === $this->fieldsModified['text']) {
            unset($this->fieldsModified['text']);
        }

        $this->data['fields']['text'] = $value;

        return $this;
    }

    /**
     * Returns the "text" field.
     *
     * @return mixed The $name field.
     */
    public function getText()
    {
        if (!isset($this->data['fields']['text'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('text', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.text';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['text'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['text'])) {
                $this->data['fields']['text'] = null;
            }
        }

        return $this->data['fields']['text'];
    }

    /**
     * Set the "note" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setNote($value)
    {
        if (!isset($this->data['fields']['note'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getNote();
                if ($value === $this->data['fields']['note']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['note'] = null;
                $this->data['fields']['note'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['note']) {
            return $this;
        }

        if (!isset($this->fieldsModified['note']) && !array_key_exists('note', $this->fieldsModified)) {
            $this->fieldsModified['note'] = $this->data['fields']['note'];
        } elseif ($value === $this->fieldsModified['note']) {
            unset($this->fieldsModified['note']);
        }

        $this->data['fields']['note'] = $value;

        return $this;
    }

    /**
     * Returns the "note" field.
     *
     * @return mixed The $name field.
     */
    public function getNote()
    {
        if (!isset($this->data['fields']['note'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('note', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.note';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['note'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['note'])) {
                $this->data['fields']['note'] = null;
            }
        }

        return $this->data['fields']['note'];
    }

    /**
     * Set the "line" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setLine($value)
    {
        if (!isset($this->data['fields']['line'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getLine();
                if ($value === $this->data['fields']['line']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['line'] = null;
                $this->data['fields']['line'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['line']) {
            return $this;
        }

        if (!isset($this->fieldsModified['line']) && !array_key_exists('line', $this->fieldsModified)) {
            $this->fieldsModified['line'] = $this->data['fields']['line'];
        } elseif ($value === $this->fieldsModified['line']) {
            unset($this->fieldsModified['line']);
        }

        $this->data['fields']['line'] = $value;

        return $this;
    }

    /**
     * Returns the "line" field.
     *
     * @return mixed The $name field.
     */
    public function getLine()
    {
        if (!isset($this->data['fields']['line'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('line', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.line';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['line'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['line'])) {
                $this->data['fields']['line'] = null;
            }
        }

        return $this->data['fields']['line'];
    }

    /**
     * Set the "authorId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setAuthorId($value)
    {
        if (!isset($this->data['fields']['authorId'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getAuthorId();
                if ($value === $this->data['fields']['authorId']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['authorId'] = null;
                $this->data['fields']['authorId'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['authorId']) {
            return $this;
        }

        if (!isset($this->fieldsModified['authorId']) && !array_key_exists('authorId', $this->fieldsModified)) {
            $this->fieldsModified['authorId'] = $this->data['fields']['authorId'];
        } elseif ($value === $this->fieldsModified['authorId']) {
            unset($this->fieldsModified['authorId']);
        }

        $this->data['fields']['authorId'] = $value;

        return $this;
    }

    /**
     * Returns the "authorId" field.
     *
     * @return mixed The $name field.
     */
    public function getAuthorId()
    {
        if (!isset($this->data['fields']['authorId'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('authorId', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.author';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['authorId'] = $data;
                }
            }
            if (!isset($this->data['fields']['authorId'])) {
                $this->data['fields']['authorId'] = null;
            }
        }

        return $this->data['fields']['authorId'];
    }

    /**
     * Set the "categoryIds" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function setCategoryIds($value)
    {
        if (!isset($this->data['fields']['categoryIds'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getCategoryIds();
                if ($value === $this->data['fields']['categoryIds']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['categoryIds'] = null;
                $this->data['fields']['categoryIds'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['categoryIds']) {
            return $this;
        }

        if (!isset($this->fieldsModified['categoryIds']) && !array_key_exists('categoryIds', $this->fieldsModified)) {
            $this->fieldsModified['categoryIds'] = $this->data['fields']['categoryIds'];
        } elseif ($value === $this->fieldsModified['categoryIds']) {
            unset($this->fieldsModified['categoryIds']);
        }

        $this->data['fields']['categoryIds'] = $value;

        return $this;
    }

    /**
     * Returns the "categoryIds" field.
     *
     * @return mixed The $name field.
     */
    public function getCategoryIds()
    {
        if (!isset($this->data['fields']['categoryIds'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('categoryIds', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.categories';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['categoryIds'] = $data;
                }
            }
            if (!isset($this->data['fields']['categoryIds'])) {
                $this->data['fields']['categoryIds'] = null;
            }
        }

        return $this->data['fields']['categoryIds'];
    }

    /**
     * Set the "author" reference.
     *
     * @param \Model\Author|null $value The reference, or null.
     *
     * @return \Model\Comment The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\Author.
     */
    public function setAuthor($value)
    {
        if (null !== $value && !$value instanceof \Model\Author) {
            throw new \InvalidArgumentException('The "author" reference is not an instance of Model\Author.');
        }

        $this->setAuthorId((null === $value || $value->isNew()) ? null : $value->getId());

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
            if (!$id = $this->getAuthorId()) {
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
            $this->data['referencesMany']['categories'] = new \Mandango\Group\ReferenceGroup('Model\Category', $this, 'categoryIds');
        }

        return $this->data['referencesMany']['categories'];
    }

    /**
     * Adds documents to the "categories" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Comment The document (fluent interface).
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
     * @return \Model\Comment The document (fluent interface).
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
        if (isset($this->data['referencesOne']['author']) && !isset($this->data['fields']['authorId'])) {
            $this->setAuthorId($this->data['referencesOne']['author']->getId());
        }
        if (isset($this->data['referencesMany']['categories'])) {
            $group = $this->data['referencesMany']['categories'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $ids = $this->getCategoryIds();
                foreach ($add as $document) {
                    $ids[] = $document->getId();
                }
                foreach ($remove as $document) {
                    if (false !== $key = array_search($document->getId(), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setCategoryIds($ids ? array_values($ids) : null);
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
        if (isset($this->data['referencesMany']['categories'])) {
            $group = $this->data['referencesMany']['categories'];
            $documents = array();
            foreach ($group->getAdd() as $document) {
                $documents[] = $document;
            }
            if ($group->isSavedInitialized()) {
                foreach ($group->getSaved() as $document) {
                    $documents[] = $document;
                }
            }
            if ($documents) {
                $this->getMandango()->getRepository('Model\Category')->save($documents);
            }
        }
    }

    /**
     * Returns the "infos" embedded many.
     *
     * @return \Mandango\Group\EmbeddedGroup The "infos" embedded many.
     */
    public function getInfos()
    {
        if (!isset($this->data['embeddedsMany']['infos'])) {
            $this->data['embeddedsMany']['infos'] = $embedded = new \Mandango\Group\EmbeddedGroup('Model\Info');
            if ($rap = $this->getRootAndPath()) {
                $embedded->setRootAndPath($rap['root'], $rap['path'].'.infos');
            }
        }

        return $this->data['embeddedsMany']['infos'];
    }

    /**
     * Adds documents to the "infos" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function addInfos($documents)
    {
        $this->getInfos()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "infos" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function removeInfos($documents)
    {
        $this->getInfos()->remove($documents);

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
        if (isset($this->data['embeddedsMany']['infos'])) {
            $this->data['embeddedsMany']['infos']->reset();
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
        if ('name' == $name) {
            return $this->setName($value);
        }
        if ('text' == $name) {
            return $this->setText($value);
        }
        if ('note' == $name) {
            return $this->setNote($value);
        }
        if ('line' == $name) {
            return $this->setLine($value);
        }
        if ('authorId' == $name) {
            return $this->setAuthorId($value);
        }
        if ('categoryIds' == $name) {
            return $this->setCategoryIds($value);
        }
        if ('author' == $name) {
            return $this->setAuthor($value);
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
        if ('text' == $name) {
            return $this->getText();
        }
        if ('note' == $name) {
            return $this->getNote();
        }
        if ('line' == $name) {
            return $this->getLine();
        }
        if ('authorId' == $name) {
            return $this->getAuthorId();
        }
        if ('categoryIds' == $name) {
            return $this->getCategoryIds();
        }
        if ('author' == $name) {
            return $this->getAuthor();
        }
        if ('categories' == $name) {
            return $this->getCategories();
        }
        if ('infos' == $name) {
            return $this->getInfos();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\Comment The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['text'])) {
            $this->setText($array['text']);
        }
        if (isset($array['note'])) {
            $this->setNote($array['note']);
        }
        if (isset($array['line'])) {
            $this->setLine($array['line']);
        }
        if (isset($array['authorId'])) {
            $this->setAuthorId($array['authorId']);
        }
        if (isset($array['categoryIds'])) {
            $this->setCategoryIds($array['categoryIds']);
        }
        if (isset($array['author'])) {
            $this->setAuthor($array['author']);
        }
        if (isset($array['categories'])) {
            $this->removeCategories($this->getCategories()->all());
            $this->addCategories($array['categories']);
        }
        if (isset($array['infos'])) {
            $embeddeds = array();
            foreach ($array['infos'] as $documentData) {
                $embeddeds[] = $embedded = new \Model\Info($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getInfos()->replace($embeddeds);
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
        $array = array();

        $array['name'] = $this->getName();
        $array['text'] = $this->getText();
        $array['note'] = $this->getNote();
        $array['line'] = $this->getLine();
        if ($withReferenceFields) {
            $array['authorId'] = $this->getAuthorId();
        }
        if ($withReferenceFields) {
            $array['categoryIds'] = $this->getCategoryIds();
        }

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave($query, $isNew, $reset = false)
    {
        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                $rootQuery = $query;
                $query =& $rootQuery;
                $rap = $this->getRootAndPath();
                if (true === $reset) {
                    $path = array('$set', $rap['path']);
                } elseif ('deep' == $reset) {
                    $path = explode('.', '$set.'.$rap['path']);
                } else {
                    $path = explode('.', $rap['path']);
                }
                foreach ($path as $name) {
                    if (0 === strpos($name, '_add')) {
                        $name = substr($name, 4);
                    }
                    if (!isset($query[$name])) {
                        $query[$name] = array();
                    }
                    $query =& $query[$name];
                }
                if (isset($this->data['fields']['name'])) {
                    $query['name'] = (string) $this->data['fields']['name'];
                }
                if (isset($this->data['fields']['text'])) {
                    $query['text'] = (string) $this->data['fields']['text'];
                }
                if (isset($this->data['fields']['note'])) {
                    $query['note'] = (string) $this->data['fields']['note'];
                }
                if (isset($this->data['fields']['line'])) {
                    $query['line'] = (string) $this->data['fields']['line'];
                }
                if (isset($this->data['fields']['authorId'])) {
                    $query['author'] = $this->data['fields']['authorId'];
                }
                if (isset($this->data['fields']['categoryIds'])) {
                    $query['categories'] = $this->data['fields']['categoryIds'];
                }
                unset($query);
                $query = $rootQuery;
            } else {
                $rap = $this->getRootAndPath();
                $documentPath = $rap['path'];
                if (isset($this->data['fields']['name']) || array_key_exists('name', $this->data['fields'])) {
                    $value = $this->data['fields']['name'];
                    $originalValue = $this->getOriginalFieldValue('name');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.name'] = (string) $this->data['fields']['name'];
                        } else {
                            $query['$unset'][$documentPath.'.name'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['text']) || array_key_exists('text', $this->data['fields'])) {
                    $value = $this->data['fields']['text'];
                    $originalValue = $this->getOriginalFieldValue('text');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.text'] = (string) $this->data['fields']['text'];
                        } else {
                            $query['$unset'][$documentPath.'.text'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['note']) || array_key_exists('note', $this->data['fields'])) {
                    $value = $this->data['fields']['note'];
                    $originalValue = $this->getOriginalFieldValue('note');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.note'] = (string) $this->data['fields']['note'];
                        } else {
                            $query['$unset'][$documentPath.'.note'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['line']) || array_key_exists('line', $this->data['fields'])) {
                    $value = $this->data['fields']['line'];
                    $originalValue = $this->getOriginalFieldValue('line');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.line'] = (string) $this->data['fields']['line'];
                        } else {
                            $query['$unset'][$documentPath.'.line'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['authorId']) || array_key_exists('authorId', $this->data['fields'])) {
                    $value = $this->data['fields']['authorId'];
                    $originalValue = $this->getOriginalFieldValue('authorId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.author'] = $this->data['fields']['authorId'];
                        } else {
                            $query['$unset'][$documentPath.'.author'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['categoryIds']) || array_key_exists('categoryIds', $this->data['fields'])) {
                    $value = $this->data['fields']['categoryIds'];
                    $originalValue = $this->getOriginalFieldValue('categoryIds');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.categories'] = $this->data['fields']['categoryIds'];
                        } else {
                            $query['$unset'][$documentPath.'.categories'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsMany'])) {
            if ($isNew) {
                if (isset($this->data['embeddedsMany']['infos'])) {
                    foreach ($this->data['embeddedsMany']['infos']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['infos'])) {
                    $group = $this->data['embeddedsMany']['infos'];
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