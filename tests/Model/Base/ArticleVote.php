<?php

namespace Model\Base;

/**
 * Base class of Model\ArticleVote document.
 */
abstract class ArticleVote extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Model\ArticleVote The document (fluent interface).
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
        if (isset($data['article'])) {
            $this->data['fields']['articleId'] = $data['article'];
        } elseif (isset($data['_fields']['article'])) {
            $this->data['fields']['articleId'] = null;
        }
        if (isset($data['user'])) {
            $this->data['fields']['userId'] = $data['user'];
        } elseif (isset($data['_fields']['user'])) {
            $this->data['fields']['userId'] = null;
        }

        return $this;
    }

    /**
     * Set the "articleId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\ArticleVote The document (fluent interface).
     */
    public function setArticleId($value)
    {
        if (!isset($this->data['fields']['articleId'])) {
            if (!$this->isNew()) {
                $this->getArticleId();
                if ($value === $this->data['fields']['articleId']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['articleId'] = null;
                $this->data['fields']['articleId'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['articleId']) {
            return $this;
        }

        if (!isset($this->fieldsModified['articleId']) && !array_key_exists('articleId', $this->fieldsModified)) {
            $this->fieldsModified['articleId'] = $this->data['fields']['articleId'];
        } elseif ($value === $this->fieldsModified['articleId']) {
            unset($this->fieldsModified['articleId']);
        }

        $this->data['fields']['articleId'] = $value;

        return $this;
    }

    /**
     * Returns the "articleId" field.
     *
     * @return mixed The $name field.
     */
    public function getArticleId()
    {
        if (!isset($this->data['fields']['articleId'])) {
            if ($this->isNew()) {
                $this->data['fields']['articleId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('articleId', $this->data['fields'])) {
                $this->addFieldCache('article');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('article' => 1));
                if (isset($data['article'])) {
                    $this->data['fields']['articleId'] = $data['article'];
                } else {
                    $this->data['fields']['articleId'] = null;
                }
            }
        }

        return $this->data['fields']['articleId'];
    }

    /**
     * Set the "userId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\ArticleVote The document (fluent interface).
     */
    public function setUserId($value)
    {
        if (!isset($this->data['fields']['userId'])) {
            if (!$this->isNew()) {
                $this->getUserId();
                if ($value === $this->data['fields']['userId']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['userId'] = null;
                $this->data['fields']['userId'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['userId']) {
            return $this;
        }

        if (!isset($this->fieldsModified['userId']) && !array_key_exists('userId', $this->fieldsModified)) {
            $this->fieldsModified['userId'] = $this->data['fields']['userId'];
        } elseif ($value === $this->fieldsModified['userId']) {
            unset($this->fieldsModified['userId']);
        }

        $this->data['fields']['userId'] = $value;

        return $this;
    }

    /**
     * Returns the "userId" field.
     *
     * @return mixed The $name field.
     */
    public function getUserId()
    {
        if (!isset($this->data['fields']['userId'])) {
            if ($this->isNew()) {
                $this->data['fields']['userId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('userId', $this->data['fields'])) {
                $this->addFieldCache('user');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('user' => 1));
                if (isset($data['user'])) {
                    $this->data['fields']['userId'] = $data['user'];
                } else {
                    $this->data['fields']['userId'] = null;
                }
            }
        }

        return $this->data['fields']['userId'];
    }

    /**
     * Set the "article" reference.
     *
     * @param \Model\Article|null $value The reference, or null.
     *
     * @return \Model\ArticleVote The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\Article.
     */
    public function setArticle($value)
    {
        if (null !== $value && !$value instanceof \Model\Article) {
            throw new \InvalidArgumentException('The "article" reference is not an instance of Model\Article.');
        }

        $this->setArticleId((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['article'] = $value;

        return $this;
    }

    /**
     * Returns the "article" reference.
     *
     * @return \Model\Article|null The reference or null if it does not exist.
     */
    public function getArticle()
    {
        if (!isset($this->data['referencesOne']['article'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('article');
            }
            if (!$id = $this->getArticleId()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Model\Article')->findOneById($id)) {
                throw new \RuntimeException('The reference "article" does not exist.');
            }
            $this->data['referencesOne']['article'] = $document;
        }

        return $this->data['referencesOne']['article'];
    }

    /**
     * Set the "user" reference.
     *
     * @param \Model\User|null $value The reference, or null.
     *
     * @return \Model\ArticleVote The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\User.
     */
    public function setUser($value)
    {
        if (null !== $value && !$value instanceof \Model\User) {
            throw new \InvalidArgumentException('The "user" reference is not an instance of Model\User.');
        }

        $this->setUserId((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['user'] = $value;

        return $this;
    }

    /**
     * Returns the "user" reference.
     *
     * @return \Model\User|null The reference or null if it does not exist.
     */
    public function getUser()
    {
        if (!isset($this->data['referencesOne']['user'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('user');
            }
            if (!$id = $this->getUserId()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Model\User')->findOneById($id)) {
                throw new \RuntimeException('The reference "user" does not exist.');
            }
            $this->data['referencesOne']['user'] = $document;
        }

        return $this->data['referencesOne']['user'];
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
        if (isset($this->data['referencesOne']['article']) && !isset($this->data['fields']['articleId'])) {
            $this->setArticleId($this->data['referencesOne']['article']->getId());
        }
        if (isset($this->data['referencesOne']['user']) && !isset($this->data['fields']['userId'])) {
            $this->setUserId($this->data['referencesOne']['user']->getId());
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['article'])) {
            $this->data['referencesOne']['article']->save();
        }
        if (isset($this->data['referencesOne']['user'])) {
            $this->data['referencesOne']['user']->save();
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
        if ('articleId' == $name) {
            return $this->setArticleId($value);
        }
        if ('userId' == $name) {
            return $this->setUserId($value);
        }
        if ('article' == $name) {
            return $this->setArticle($value);
        }
        if ('user' == $name) {
            return $this->setUser($value);
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
        if ('articleId' == $name) {
            return $this->getArticleId();
        }
        if ('userId' == $name) {
            return $this->getUserId();
        }
        if ('article' == $name) {
            return $this->getArticle();
        }
        if ('user' == $name) {
            return $this->getUser();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\ArticleVote The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['articleId'])) {
            $this->setArticleId($array['articleId']);
        }
        if (isset($array['userId'])) {
            $this->setUserId($array['userId']);
        }
        if (isset($array['article'])) {
            $this->setArticle($array['article']);
        }
        if (isset($array['user'])) {
            $this->setUser($array['user']);
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

        if ($withReferenceFields) {
            $array['articleId'] = $this->getArticleId();
        }
        if ($withReferenceFields) {
            $array['userId'] = $this->getUserId();
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
                if (isset($this->data['fields']['articleId'])) {
                    $query['article'] = $this->data['fields']['articleId'];
                }
                if (isset($this->data['fields']['userId'])) {
                    $query['user'] = $this->data['fields']['userId'];
                }
            } else {
                if (isset($this->data['fields']['articleId']) || array_key_exists('articleId', $this->data['fields'])) {
                    $value = $this->data['fields']['articleId'];
                    $originalValue = $this->getOriginalFieldValue('articleId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['article'] = $this->data['fields']['articleId'];
                        } else {
                            $query['$unset']['article'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['userId']) || array_key_exists('userId', $this->data['fields'])) {
                    $value = $this->data['fields']['userId'];
                    $originalValue = $this->getOriginalFieldValue('userId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['user'] = $this->data['fields']['userId'];
                        } else {
                            $query['$unset']['user'] = 1;
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