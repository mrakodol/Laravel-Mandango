<?php

namespace Model\Base;

/**
 * Base class of Model\Article document.
 */
abstract class Article extends \Mandango\Document\Document implements \ArrayAccess
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
     * @return \Model\Article The document (fluent interface).
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
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }
        if (isset($data['content'])) {
            $this->data['fields']['content'] = (string) $data['content'];
        } elseif (isset($data['_fields']['content'])) {
            $this->data['fields']['content'] = null;
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
        if (isset($data['text'])) {
            $this->data['fields']['text'] = (string) $data['text'];
        } elseif (isset($data['_fields']['text'])) {
            $this->data['fields']['text'] = null;
        }
        if (isset($data['isActive'])) {
            $this->data['fields']['isActive'] = (bool) $data['isActive'];
        } elseif (isset($data['_fields']['isActive'])) {
            $this->data['fields']['isActive'] = null;
        }
        if (isset($data['date'])) {
            $this->data['fields']['date'] = new \DateTime(); $this->data['fields']['date']->setTimestamp($data['date']->sec);
        } elseif (isset($data['_fields']['date'])) {
            $this->data['fields']['date'] = null;
        }
        if (isset($data['basatos'])) {
            $this->data['fields']['database'] = (string) $data['basatos'];
        } elseif (isset($data['_fields']['basatos'])) {
            $this->data['fields']['database'] = null;
        }
        if (isset($data['author'])) {
            $this->data['fields']['authorId'] = $data['author'];
        } elseif (isset($data['_fields']['author'])) {
            $this->data['fields']['authorId'] = null;
        }
        if (isset($data['information'])) {
            $this->data['fields']['informationId'] = $data['information'];
        } elseif (isset($data['_fields']['information'])) {
            $this->data['fields']['informationId'] = null;
        }
        if (isset($data['like'])) {
            $this->data['fields']['likeRef'] = $data['like'];
        } elseif (isset($data['_fields']['like'])) {
            $this->data['fields']['likeRef'] = null;
        }
        if (isset($data['likeUnset'])) {
            $this->data['fields']['likeUnset_reference_field'] = $data['likeUnset'];
        } elseif (isset($data['_fields']['likeUnset'])) {
            $this->data['fields']['likeUnset_reference_field'] = null;
        }
        if (isset($data['friend'])) {
            $this->data['fields']['friendRef'] = $data['friend'];
        } elseif (isset($data['_fields']['friend'])) {
            $this->data['fields']['friendRef'] = null;
        }
        if (isset($data['friendUnset'])) {
            $this->data['fields']['friendUnset_reference_field'] = $data['friendUnset'];
        } elseif (isset($data['_fields']['friendUnset'])) {
            $this->data['fields']['friendUnset_reference_field'] = null;
        }
        if (isset($data['categories'])) {
            $this->data['fields']['categoryIds'] = $data['categories'];
        } elseif (isset($data['_fields']['categories'])) {
            $this->data['fields']['categoryIds'] = null;
        }
        if (isset($data['related'])) {
            $this->data['fields']['relatedRef'] = $data['related'];
        } elseif (isset($data['_fields']['related'])) {
            $this->data['fields']['relatedRef'] = null;
        }
        if (isset($data['elements'])) {
            $this->data['fields']['elementsRef'] = $data['elements'];
        } elseif (isset($data['_fields']['elements'])) {
            $this->data['fields']['elementsRef'] = null;
        }
        if (isset($data['source'])) {
            $embedded = $this->getMandango()->create('Model\Source');
            $embedded->setRootAndPath($this, 'source');
            if (isset($data['_fields']['source'])) {
                $data['source']['_fields'] = $data['_fields']['source'];
            }
            $embedded->setDocumentData($data['source']);
            $this->data['embeddedsOne']['source'] = $embedded;
        }
        if (isset($data['simpleEmbedded'])) {
            $embedded = $this->getMandango()->create('Model\SimpleEmbedded');
            $embedded->setRootAndPath($this, 'simpleEmbedded');
            if (isset($data['_fields']['simpleEmbedded'])) {
                $data['simpleEmbedded']['_fields'] = $data['_fields']['simpleEmbedded'];
            }
            $embedded->setDocumentData($data['simpleEmbedded']);
            $this->data['embeddedsOne']['simpleEmbedded'] = $embedded;
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
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
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
     * Set the "content" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setContent($value)
    {
        if (!isset($this->data['fields']['content'])) {
            if (!$this->isNew()) {
                $this->getContent();
                if ($value === $this->data['fields']['content']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['content'] = null;
                $this->data['fields']['content'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['content']) {
            return $this;
        }

        if (!isset($this->fieldsModified['content']) && !array_key_exists('content', $this->fieldsModified)) {
            $this->fieldsModified['content'] = $this->data['fields']['content'];
        } elseif ($value === $this->fieldsModified['content']) {
            unset($this->fieldsModified['content']);
        }

        $this->data['fields']['content'] = $value;

        return $this;
    }

    /**
     * Returns the "content" field.
     *
     * @return mixed The $name field.
     */
    public function getContent()
    {
        if (!isset($this->data['fields']['content'])) {
            if ($this->isNew()) {
                $this->data['fields']['content'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('content', $this->data['fields'])) {
                $this->addFieldCache('content');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('content' => 1));
                if (isset($data['content'])) {
                    $this->data['fields']['content'] = (string) $data['content'];
                } else {
                    $this->data['fields']['content'] = null;
                }
            }
        }

        return $this->data['fields']['content'];
    }

    /**
     * Set the "note" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setNote($value)
    {
        if (!isset($this->data['fields']['note'])) {
            if (!$this->isNew()) {
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
            if ($this->isNew()) {
                $this->data['fields']['note'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('note', $this->data['fields'])) {
                $this->addFieldCache('note');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('note' => 1));
                if (isset($data['note'])) {
                    $this->data['fields']['note'] = (string) $data['note'];
                } else {
                    $this->data['fields']['note'] = null;
                }
            }
        }

        return $this->data['fields']['note'];
    }

    /**
     * Set the "line" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setLine($value)
    {
        if (!isset($this->data['fields']['line'])) {
            if (!$this->isNew()) {
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
            if ($this->isNew()) {
                $this->data['fields']['line'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('line', $this->data['fields'])) {
                $this->addFieldCache('line');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('line' => 1));
                if (isset($data['line'])) {
                    $this->data['fields']['line'] = (string) $data['line'];
                } else {
                    $this->data['fields']['line'] = null;
                }
            }
        }

        return $this->data['fields']['line'];
    }

    /**
     * Set the "text" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setText($value)
    {
        if (!isset($this->data['fields']['text'])) {
            if (!$this->isNew()) {
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
            if ($this->isNew()) {
                $this->data['fields']['text'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('text', $this->data['fields'])) {
                $this->addFieldCache('text');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('text' => 1));
                if (isset($data['text'])) {
                    $this->data['fields']['text'] = (string) $data['text'];
                } else {
                    $this->data['fields']['text'] = null;
                }
            }
        }

        return $this->data['fields']['text'];
    }

    /**
     * Set the "isActive" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setIsActive($value)
    {
        if (!isset($this->data['fields']['isActive'])) {
            if (!$this->isNew()) {
                $this->getIsActive();
                if ($value === $this->data['fields']['isActive']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['isActive'] = null;
                $this->data['fields']['isActive'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['isActive']) {
            return $this;
        }

        if (!isset($this->fieldsModified['isActive']) && !array_key_exists('isActive', $this->fieldsModified)) {
            $this->fieldsModified['isActive'] = $this->data['fields']['isActive'];
        } elseif ($value === $this->fieldsModified['isActive']) {
            unset($this->fieldsModified['isActive']);
        }

        $this->data['fields']['isActive'] = $value;

        return $this;
    }

    /**
     * Returns the "isActive" field.
     *
     * @return mixed The $name field.
     */
    public function getIsActive()
    {
        if (!isset($this->data['fields']['isActive'])) {
            if ($this->isNew()) {
                $this->data['fields']['isActive'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('isActive', $this->data['fields'])) {
                $this->addFieldCache('isActive');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('isActive' => 1));
                if (isset($data['isActive'])) {
                    $this->data['fields']['isActive'] = (bool) $data['isActive'];
                } else {
                    $this->data['fields']['isActive'] = null;
                }
            }
        }

        return $this->data['fields']['isActive'];
    }

    /**
     * Set the "date" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setDate($value)
    {
        if (!isset($this->data['fields']['date'])) {
            if (!$this->isNew()) {
                $this->getDate();
                if ($value === $this->data['fields']['date']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['date'] = null;
                $this->data['fields']['date'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['date']) {
            return $this;
        }

        if (!isset($this->fieldsModified['date']) && !array_key_exists('date', $this->fieldsModified)) {
            $this->fieldsModified['date'] = $this->data['fields']['date'];
        } elseif ($value === $this->fieldsModified['date']) {
            unset($this->fieldsModified['date']);
        }

        $this->data['fields']['date'] = $value;

        return $this;
    }

    /**
     * Returns the "date" field.
     *
     * @return mixed The $name field.
     */
    public function getDate()
    {
        if (!isset($this->data['fields']['date'])) {
            if ($this->isNew()) {
                $this->data['fields']['date'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('date', $this->data['fields'])) {
                $this->addFieldCache('date');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('date' => 1));
                if (isset($data['date'])) {
                    $this->data['fields']['date'] = new \DateTime(); $this->data['fields']['date']->setTimestamp($data['date']->sec);
                } else {
                    $this->data['fields']['date'] = null;
                }
            }
        }

        return $this->data['fields']['date'];
    }

    /**
     * Set the "database" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setDatabase($value)
    {
        if (!isset($this->data['fields']['database'])) {
            if (!$this->isNew()) {
                $this->getDatabase();
                if ($value === $this->data['fields']['database']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['database'] = null;
                $this->data['fields']['database'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['database']) {
            return $this;
        }

        if (!isset($this->fieldsModified['database']) && !array_key_exists('database', $this->fieldsModified)) {
            $this->fieldsModified['database'] = $this->data['fields']['database'];
        } elseif ($value === $this->fieldsModified['database']) {
            unset($this->fieldsModified['database']);
        }

        $this->data['fields']['database'] = $value;

        return $this;
    }

    /**
     * Returns the "database" field.
     *
     * @return mixed The $name field.
     */
    public function getDatabase()
    {
        if (!isset($this->data['fields']['database'])) {
            if ($this->isNew()) {
                $this->data['fields']['database'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('database', $this->data['fields'])) {
                $this->addFieldCache('basatos');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('basatos' => 1));
                if (isset($data['basatos'])) {
                    $this->data['fields']['database'] = (string) $data['basatos'];
                } else {
                    $this->data['fields']['database'] = null;
                }
            }
        }

        return $this->data['fields']['database'];
    }

    /**
     * Set the "authorId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setAuthorId($value)
    {
        if (!isset($this->data['fields']['authorId'])) {
            if (!$this->isNew()) {
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
            if ($this->isNew()) {
                $this->data['fields']['authorId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('authorId', $this->data['fields'])) {
                $this->addFieldCache('author');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('author' => 1));
                if (isset($data['author'])) {
                    $this->data['fields']['authorId'] = $data['author'];
                } else {
                    $this->data['fields']['authorId'] = null;
                }
            }
        }

        return $this->data['fields']['authorId'];
    }

    /**
     * Set the "informationId" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setInformationId($value)
    {
        if (!isset($this->data['fields']['informationId'])) {
            if (!$this->isNew()) {
                $this->getInformationId();
                if ($value === $this->data['fields']['informationId']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['informationId'] = null;
                $this->data['fields']['informationId'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['informationId']) {
            return $this;
        }

        if (!isset($this->fieldsModified['informationId']) && !array_key_exists('informationId', $this->fieldsModified)) {
            $this->fieldsModified['informationId'] = $this->data['fields']['informationId'];
        } elseif ($value === $this->fieldsModified['informationId']) {
            unset($this->fieldsModified['informationId']);
        }

        $this->data['fields']['informationId'] = $value;

        return $this;
    }

    /**
     * Returns the "informationId" field.
     *
     * @return mixed The $name field.
     */
    public function getInformationId()
    {
        if (!isset($this->data['fields']['informationId'])) {
            if ($this->isNew()) {
                $this->data['fields']['informationId'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('informationId', $this->data['fields'])) {
                $this->addFieldCache('information');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('information' => 1));
                if (isset($data['information'])) {
                    $this->data['fields']['informationId'] = $data['information'];
                } else {
                    $this->data['fields']['informationId'] = null;
                }
            }
        }

        return $this->data['fields']['informationId'];
    }

    /**
     * Set the "likeRef" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setLikeRef($value)
    {
        if (!isset($this->data['fields']['likeRef'])) {
            if (!$this->isNew()) {
                $this->getLikeRef();
                if ($value === $this->data['fields']['likeRef']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['likeRef'] = null;
                $this->data['fields']['likeRef'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['likeRef']) {
            return $this;
        }

        if (!isset($this->fieldsModified['likeRef']) && !array_key_exists('likeRef', $this->fieldsModified)) {
            $this->fieldsModified['likeRef'] = $this->data['fields']['likeRef'];
        } elseif ($value === $this->fieldsModified['likeRef']) {
            unset($this->fieldsModified['likeRef']);
        }

        $this->data['fields']['likeRef'] = $value;

        return $this;
    }

    /**
     * Returns the "likeRef" field.
     *
     * @return mixed The $name field.
     */
    public function getLikeRef()
    {
        if (!isset($this->data['fields']['likeRef'])) {
            if ($this->isNew()) {
                $this->data['fields']['likeRef'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('likeRef', $this->data['fields'])) {
                $this->addFieldCache('like');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('like' => 1));
                if (isset($data['like'])) {
                    $this->data['fields']['likeRef'] = $data['like'];
                } else {
                    $this->data['fields']['likeRef'] = null;
                }
            }
        }

        return $this->data['fields']['likeRef'];
    }

    /**
     * Set the "likeUnset_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setLikeUnset_reference_field($value)
    {
        if (!isset($this->data['fields']['likeUnset_reference_field'])) {
            if (!$this->isNew()) {
                $this->getLikeUnset_reference_field();
                if ($value === $this->data['fields']['likeUnset_reference_field']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['likeUnset_reference_field'] = null;
                $this->data['fields']['likeUnset_reference_field'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['likeUnset_reference_field']) {
            return $this;
        }

        if (!isset($this->fieldsModified['likeUnset_reference_field']) && !array_key_exists('likeUnset_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['likeUnset_reference_field'] = $this->data['fields']['likeUnset_reference_field'];
        } elseif ($value === $this->fieldsModified['likeUnset_reference_field']) {
            unset($this->fieldsModified['likeUnset_reference_field']);
        }

        $this->data['fields']['likeUnset_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "likeUnset_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getLikeUnset_reference_field()
    {
        if (!isset($this->data['fields']['likeUnset_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['likeUnset_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('likeUnset_reference_field', $this->data['fields'])) {
                $this->addFieldCache('likeUnset');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('likeUnset' => 1));
                if (isset($data['likeUnset'])) {
                    $this->data['fields']['likeUnset_reference_field'] = $data['likeUnset'];
                } else {
                    $this->data['fields']['likeUnset_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['likeUnset_reference_field'];
    }

    /**
     * Set the "friendRef" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setFriendRef($value)
    {
        if (!isset($this->data['fields']['friendRef'])) {
            if (!$this->isNew()) {
                $this->getFriendRef();
                if ($value === $this->data['fields']['friendRef']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['friendRef'] = null;
                $this->data['fields']['friendRef'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['friendRef']) {
            return $this;
        }

        if (!isset($this->fieldsModified['friendRef']) && !array_key_exists('friendRef', $this->fieldsModified)) {
            $this->fieldsModified['friendRef'] = $this->data['fields']['friendRef'];
        } elseif ($value === $this->fieldsModified['friendRef']) {
            unset($this->fieldsModified['friendRef']);
        }

        $this->data['fields']['friendRef'] = $value;

        return $this;
    }

    /**
     * Returns the "friendRef" field.
     *
     * @return mixed The $name field.
     */
    public function getFriendRef()
    {
        if (!isset($this->data['fields']['friendRef'])) {
            if ($this->isNew()) {
                $this->data['fields']['friendRef'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('friendRef', $this->data['fields'])) {
                $this->addFieldCache('friend');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('friend' => 1));
                if (isset($data['friend'])) {
                    $this->data['fields']['friendRef'] = $data['friend'];
                } else {
                    $this->data['fields']['friendRef'] = null;
                }
            }
        }

        return $this->data['fields']['friendRef'];
    }

    /**
     * Set the "friendUnset_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setFriendUnset_reference_field($value)
    {
        if (!isset($this->data['fields']['friendUnset_reference_field'])) {
            if (!$this->isNew()) {
                $this->getFriendUnset_reference_field();
                if ($value === $this->data['fields']['friendUnset_reference_field']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['friendUnset_reference_field'] = null;
                $this->data['fields']['friendUnset_reference_field'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['friendUnset_reference_field']) {
            return $this;
        }

        if (!isset($this->fieldsModified['friendUnset_reference_field']) && !array_key_exists('friendUnset_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['friendUnset_reference_field'] = $this->data['fields']['friendUnset_reference_field'];
        } elseif ($value === $this->fieldsModified['friendUnset_reference_field']) {
            unset($this->fieldsModified['friendUnset_reference_field']);
        }

        $this->data['fields']['friendUnset_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "friendUnset_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getFriendUnset_reference_field()
    {
        if (!isset($this->data['fields']['friendUnset_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['friendUnset_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('friendUnset_reference_field', $this->data['fields'])) {
                $this->addFieldCache('friendUnset');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('friendUnset' => 1));
                if (isset($data['friendUnset'])) {
                    $this->data['fields']['friendUnset_reference_field'] = $data['friendUnset'];
                } else {
                    $this->data['fields']['friendUnset_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['friendUnset_reference_field'];
    }

    /**
     * Set the "categoryIds" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setCategoryIds($value)
    {
        if (!isset($this->data['fields']['categoryIds'])) {
            if (!$this->isNew()) {
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
            if ($this->isNew()) {
                $this->data['fields']['categoryIds'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('categoryIds', $this->data['fields'])) {
                $this->addFieldCache('categories');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('categories' => 1));
                if (isset($data['categories'])) {
                    $this->data['fields']['categoryIds'] = $data['categories'];
                } else {
                    $this->data['fields']['categoryIds'] = null;
                }
            }
        }

        return $this->data['fields']['categoryIds'];
    }

    /**
     * Set the "relatedRef" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setRelatedRef($value)
    {
        if (!isset($this->data['fields']['relatedRef'])) {
            if (!$this->isNew()) {
                $this->getRelatedRef();
                if ($value === $this->data['fields']['relatedRef']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['relatedRef'] = null;
                $this->data['fields']['relatedRef'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['relatedRef']) {
            return $this;
        }

        if (!isset($this->fieldsModified['relatedRef']) && !array_key_exists('relatedRef', $this->fieldsModified)) {
            $this->fieldsModified['relatedRef'] = $this->data['fields']['relatedRef'];
        } elseif ($value === $this->fieldsModified['relatedRef']) {
            unset($this->fieldsModified['relatedRef']);
        }

        $this->data['fields']['relatedRef'] = $value;

        return $this;
    }

    /**
     * Returns the "relatedRef" field.
     *
     * @return mixed The $name field.
     */
    public function getRelatedRef()
    {
        if (!isset($this->data['fields']['relatedRef'])) {
            if ($this->isNew()) {
                $this->data['fields']['relatedRef'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('relatedRef', $this->data['fields'])) {
                $this->addFieldCache('related');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('related' => 1));
                if (isset($data['related'])) {
                    $this->data['fields']['relatedRef'] = $data['related'];
                } else {
                    $this->data['fields']['relatedRef'] = null;
                }
            }
        }

        return $this->data['fields']['relatedRef'];
    }

    /**
     * Set the "elementsRef" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function setElementsRef($value)
    {
        if (!isset($this->data['fields']['elementsRef'])) {
            if (!$this->isNew()) {
                $this->getElementsRef();
                if ($value === $this->data['fields']['elementsRef']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['elementsRef'] = null;
                $this->data['fields']['elementsRef'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['elementsRef']) {
            return $this;
        }

        if (!isset($this->fieldsModified['elementsRef']) && !array_key_exists('elementsRef', $this->fieldsModified)) {
            $this->fieldsModified['elementsRef'] = $this->data['fields']['elementsRef'];
        } elseif ($value === $this->fieldsModified['elementsRef']) {
            unset($this->fieldsModified['elementsRef']);
        }

        $this->data['fields']['elementsRef'] = $value;

        return $this;
    }

    /**
     * Returns the "elementsRef" field.
     *
     * @return mixed The $name field.
     */
    public function getElementsRef()
    {
        if (!isset($this->data['fields']['elementsRef'])) {
            if ($this->isNew()) {
                $this->data['fields']['elementsRef'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('elementsRef', $this->data['fields'])) {
                $this->addFieldCache('elements');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('elements' => 1));
                if (isset($data['elements'])) {
                    $this->data['fields']['elementsRef'] = $data['elements'];
                } else {
                    $this->data['fields']['elementsRef'] = null;
                }
            }
        }

        return $this->data['fields']['elementsRef'];
    }

    /**
     * Set the "author" reference.
     *
     * @param \Model\Author|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
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
            if (!$this->isNew()) {
                $this->addReferenceCache('author');
            }
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
     * Set the "information" reference.
     *
     * @param \Model\ArticleInformation|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Model\ArticleInformation.
     */
    public function setInformation($value)
    {
        if (null !== $value && !$value instanceof \Model\ArticleInformation) {
            throw new \InvalidArgumentException('The "information" reference is not an instance of Model\ArticleInformation.');
        }

        $this->setInformationId((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['information'] = $value;

        return $this;
    }

    /**
     * Returns the "information" reference.
     *
     * @return \Model\ArticleInformation|null The reference or null if it does not exist.
     */
    public function getInformation()
    {
        if (!isset($this->data['referencesOne']['information'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('information');
            }
            if (!$id = $this->getInformationId()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Model\ArticleInformation')->findOneById($id)) {
                throw new \RuntimeException('The reference "information" does not exist.');
            }
            $this->data['referencesOne']['information'] = $document;
        }

        return $this->data['referencesOne']['information'];
    }

    /**
     * Set the "like" polymorphic reference.
     *
     * @param Mandango\Document\Document|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Mandango\Document\Document.
     */
    public function setLike($value)
    {
        if (!$value instanceof \Mandango\Document\Document) {
            throw new \InvalidArgumentException('The reference is not a mandango document.');
        }

        if (null === $value || $value->isNew()) {
            $fieldValue = null;
        } else {
            $discriminatorValue = get_class($value);
            $fieldValue = array(
                '_mandangoDocumentClass' => $discriminatorValue,
                'id' => $value->getId(),
            );
        }
        $this->setLikeRef($fieldValue);

        $this->data['referencesOne']['like'] = $value;

        return $this;
    }

    /**
     * Returns the "like" polymorphic reference.
     *
     * @return \Mandango\Document\Document|null The reference or null if it does not exist.
     */
    public function getLike()
    {
        if (!isset($this->data['referencesOne']['like'])) {
            if (!$ref = $this->getLikeRef()) {
                return null;
            }
            $discriminatorValue = $ref['_mandangoDocumentClass'];
            if (!$document = $this->getMandango()->getRepository($discriminatorValue)->findOneById($ref['id'])) {
                throw new \RuntimeException('The reference "like" does not exist.');
            }
            $this->data['referencesOne']['like'] = $document;
        }

        return $this->data['referencesOne']['like'];
    }

    /**
     * Set the "likeUnset" polymorphic reference.
     *
     * @param Mandango\Document\Document|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Mandango\Document\Document.
     */
    public function setLikeUnset($value)
    {
        if (!$value instanceof \Mandango\Document\Document) {
            throw new \InvalidArgumentException('The reference is not a mandango document.');
        }

        if (null === $value || $value->isNew()) {
            $fieldValue = null;
        } else {
            $discriminatorValue = get_class($value);
            $fieldValue = array(
                '_mandangoDocumentClass' => $discriminatorValue,
                'id' => $value->getId(),
            );
        }
        $this->setLikeUnset_reference_field($fieldValue);

        $this->data['referencesOne']['likeUnset'] = $value;

        return $this;
    }

    /**
     * Returns the "likeUnset" polymorphic reference.
     *
     * @return \Mandango\Document\Document|null The reference or null if it does not exist.
     */
    public function getLikeUnset()
    {
        if (!isset($this->data['referencesOne']['likeUnset'])) {
            if (!$ref = $this->getLikeUnset_reference_field()) {
                return null;
            }
            $discriminatorValue = $ref['_mandangoDocumentClass'];
            if (!$document = $this->getMandango()->getRepository($discriminatorValue)->findOneById($ref['id'])) {
                throw new \RuntimeException('The reference "likeUnset" does not exist.');
            }
            $this->data['referencesOne']['likeUnset'] = $document;
        }

        return $this->data['referencesOne']['likeUnset'];
    }

    /**
     * Set the "friend" polymorphic reference.
     *
     * @param Mandango\Document\Document|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Mandango\Document\Document.
     */
    public function setFriend($value)
    {
        if (!$value instanceof \Mandango\Document\Document) {
            throw new \InvalidArgumentException('The reference is not a mandango document.');
        }

        if (null === $value || $value->isNew()) {
            $fieldValue = null;
        } else {
            if (false === $discriminatorValue = array_search(get_class($value), array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
))) {
                throw new \InvalidArgumentException(sprintf('The class "%s" is not a possible reference in the reference "friend" of the class "Model\Article".', get_class($value)));
            }
            $fieldValue = array(
                'name' => $discriminatorValue,
                'id' => $value->getId(),
            );
        }
        $this->setFriendRef($fieldValue);

        $this->data['referencesOne']['friend'] = $value;

        return $this;
    }

    /**
     * Returns the "friend" polymorphic reference.
     *
     * @return \Mandango\Document\Document|null The reference or null if it does not exist.
     */
    public function getFriend()
    {
        if (!isset($this->data['referencesOne']['friend'])) {
            if (!$ref = $this->getFriendRef()) {
                return null;
            }
            $discriminatorMapValues = array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
);
            $discriminatorValue = $discriminatorMapValues[$ref['name']];
            if (!$document = $this->getMandango()->getRepository($discriminatorValue)->findOneById($ref['id'])) {
                throw new \RuntimeException('The reference "friend" does not exist.');
            }
            $this->data['referencesOne']['friend'] = $document;
        }

        return $this->data['referencesOne']['friend'];
    }

    /**
     * Set the "friendUnset" polymorphic reference.
     *
     * @param Mandango\Document\Document|null $value The reference, or null.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Mandango\Document\Document.
     */
    public function setFriendUnset($value)
    {
        if (!$value instanceof \Mandango\Document\Document) {
            throw new \InvalidArgumentException('The reference is not a mandango document.');
        }

        if (null === $value || $value->isNew()) {
            $fieldValue = null;
        } else {
            if (false === $discriminatorValue = array_search(get_class($value), array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
))) {
                throw new \InvalidArgumentException(sprintf('The class "%s" is not a possible reference in the reference "friendUnset" of the class "Model\Article".', get_class($value)));
            }
            $fieldValue = array(
                'name' => $discriminatorValue,
                'id' => $value->getId(),
            );
        }
        $this->setFriendUnset_reference_field($fieldValue);

        $this->data['referencesOne']['friendUnset'] = $value;

        return $this;
    }

    /**
     * Returns the "friendUnset" polymorphic reference.
     *
     * @return \Mandango\Document\Document|null The reference or null if it does not exist.
     */
    public function getFriendUnset()
    {
        if (!isset($this->data['referencesOne']['friendUnset'])) {
            if (!$ref = $this->getFriendUnset_reference_field()) {
                return null;
            }
            $discriminatorMapValues = array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
);
            $discriminatorValue = $discriminatorMapValues[$ref['name']];
            if (!$document = $this->getMandango()->getRepository($discriminatorValue)->findOneById($ref['id'])) {
                throw new \RuntimeException('The reference "friendUnset" does not exist.');
            }
            $this->data['referencesOne']['friendUnset'] = $document;
        }

        return $this->data['referencesOne']['friendUnset'];
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
            $this->data['referencesMany']['categories'] = new \Mandango\Group\ReferenceGroup('Model\Category', $this, 'categoryIds');
        }

        return $this->data['referencesMany']['categories'];
    }

    /**
     * Adds documents to the "categories" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Article The document (fluent interface).
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
     * @return \Model\Article The document (fluent interface).
     */
    public function removeCategories($documents)
    {
        $this->getCategories()->remove($documents);

        return $this;
    }

    /**
     * Returns the "related" polymorphic reference.
     *
     * @return \Mandango\Group\PolymorphicReferenceGroup The reference.
     */
    public function getRelated()
    {
        if (!isset($this->data['referencesMany']['related'])) {
            $this->data['referencesMany']['related'] = new \Mandango\Group\PolymorphicReferenceGroup('_mandangoDocumentClass', $this, 'relatedRef', false);
        }

        return $this->data['referencesMany']['related'];
    }

    /**
     * Adds documents to the "related" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function addRelated($documents)
    {
        $this->getRelated()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "related" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function removeRelated($documents)
    {
        $this->getRelated()->remove($documents);

        return $this;
    }

    /**
     * Returns the "elements" polymorphic reference.
     *
     * @return \Mandango\Group\PolymorphicReferenceGroup The reference.
     */
    public function getElements()
    {
        if (!isset($this->data['referencesMany']['elements'])) {
            $this->data['referencesMany']['elements'] = new \Mandango\Group\PolymorphicReferenceGroup('type', $this, 'elementsRef', array (
  'element' => 'Model\\FormElement',
  'textarea' => 'Model\\TextareaFormElement',
  'radio' => 'Model\\RadioFormElement',
));
        }

        return $this->data['referencesMany']['elements'];
    }

    /**
     * Adds documents to the "elements" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function addElements($documents)
    {
        $this->getElements()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "elements" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function removeElements($documents)
    {
        $this->getElements()->remove($documents);

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
        if (isset($this->data['referencesOne']['information']) && !isset($this->data['fields']['informationId'])) {
            $this->setInformationId($this->data['referencesOne']['information']->getId());
        }
        if (isset($this->data['referencesOne']['like']) && !isset($this->data['fields']['likeRef'])) {
            $document = $this->data['referencesOne']['like'];
            $discriminatorValue = get_class($document);
            $this->setLikeRef(array(
                '_mandangoDocumentClass' => $discriminatorValue,
                'id' => $document->getId(),
            ));
        }
        if (isset($this->data['referencesOne']['likeUnset']) && !isset($this->data['fields']['likeUnset_reference_field'])) {
            $document = $this->data['referencesOne']['likeUnset'];
            $discriminatorValue = get_class($document);
            $this->setLikeUnset_reference_field(array(
                '_mandangoDocumentClass' => $discriminatorValue,
                'id' => $document->getId(),
            ));
        }
        if (isset($this->data['referencesOne']['friend']) && !isset($this->data['fields']['friendRef'])) {
            $document = $this->data['referencesOne']['friend'];
            if (false === $discriminatorValue = array_search(get_class($document), array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
))) {
                throw new \RuntimeException(sprintf('The class "%s" is not a possible reference in the reference "friend" of the class "Model\Article".', get_class($document)));
            }
            $this->setFriendRef(array(
                'name' => $discriminatorValue,
                'id' => $document->getId(),
            ));
        }
        if (isset($this->data['referencesOne']['friendUnset']) && !isset($this->data['fields']['friendUnset_reference_field'])) {
            $document = $this->data['referencesOne']['friendUnset'];
            if (false === $discriminatorValue = array_search(get_class($document), array (
  'au' => 'Model\\Author',
  'ct' => 'Model\\Category',
  'us' => 'Model\\User',
))) {
                throw new \RuntimeException(sprintf('The class "%s" is not a possible reference in the reference "friendUnset" of the class "Model\Article".', get_class($document)));
            }
            $this->setFriendUnset_reference_field(array(
                'name' => $discriminatorValue,
                'id' => $document->getId(),
            ));
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
        if (isset($this->data['referencesMany']['related'])) {
            $group = $this->data['referencesMany']['related'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $ids = $this->getRelatedRef();
                foreach ($add as $document) {
                    $discriminatorValue = get_class($document);
                    $ids[] = array(
                        '_mandangoDocumentClass' => $discriminatorValue,
                        'id' => $document->getId(),
                    );
                }
                foreach ($remove as $document) {
                    $discriminatorValue = get_class($document);
                    if (false !== $key = array_search($search = array(
                        '_mandangoDocumentClass' => $discriminatorValue,
                        'id' => $document->getId(),
                    ), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setRelatedRef($ids ? array_values($ids) : null);
            }
        }
        if (isset($this->data['referencesMany']['elements'])) {
            $group = $this->data['referencesMany']['elements'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $discriminatorMapValues = array (
  'element' => 'Model\\FormElement',
  'textarea' => 'Model\\TextareaFormElement',
  'radio' => 'Model\\RadioFormElement',
);
                $ids = $this->getElementsRef();
                foreach ($add as $document) {
                    if (false === $discriminatorValue = array_search(get_class($document), $discriminatorMapValues)) {
                        throw new \RuntimeException(sprintf('The class "%s" is not a possible reference in the reference "elements" of the class "Model\Article".', get_class($document)));
                    }
                    $ids[] = array(
                        'type' => $discriminatorValue,
                        'id' => $document->getId(),
                    );
                }
                foreach ($remove as $document) {
                    if (false === $discriminatorValue = array_search(get_class($document), $discriminatorMapValues)) {
                        throw new \RuntimeException(sprintf('The class "%s" is not a possible reference in the reference "elements" of the class "Model\Article".', get_class($value)));
                    }
                    if (false !== $key = array_search($search = array(
                        'type' => $discriminatorValue,
                        'id' => $document->getId(),
                    ), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setElementsRef($ids ? array_values($ids) : null);
            }
        }
        if (isset($this->data['embeddedsOne']['source'])) {
            $this->data['embeddedsOne']['source']->updateReferenceFields();
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
        if (isset($this->data['referencesOne']['information'])) {
            $this->data['referencesOne']['information']->save();
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
        if (isset($this->data['embeddedsOne']['source'])) {
            $this->data['embeddedsOne']['source']->saveReferences();
        }
    }

    /**
     * Set the "source" embedded one.
     *
     * @param \Model\Source|null $value The "source" embedded one.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the value is not an instance of Model\Source or null.
     */
    public function setSource($value)
    {
        if (null !== $value && !$value instanceof \Model\Source) {
            throw new \InvalidArgumentException('The "source" embedded one is not an instance of Model\Source.');
        }
        if (null !== $value) {
            if ($this instanceof \Mandango\Document\Document) {
                $value->setRootAndPath($this, 'source');
            } elseif ($rap = $this->getRootAndPath()) {
                $value->setRootAndPath($rap['root'], $rap['path'].'.source');
            }
        }

        if (!\Mandango\Archive::has($this, 'embedded_one.source')) {
            $originalValue = isset($this->data['embeddedsOne']['source']) ? $this->data['embeddedsOne']['source'] : null;
            \Mandango\Archive::set($this, 'embedded_one.source', $originalValue);
        } elseif (\Mandango\Archive::get($this, 'embedded_one.source') === $value) {
            \Mandango\Archive::remove($this, 'embedded_one.source');
        }

        $this->data['embeddedsOne']['source'] = $value;

        return $this;
    }

    /**
     * Returns the "source" embedded one.
     *
     * @return \Model\Source|null The "source" embedded one.
     */
    public function getSource()
    {
        if (!isset($this->data['embeddedsOne']['source'])) {
            if ($this->isNew()) {
                $this->data['embeddedsOne']['source'] = null;
            } elseif (!isset($this->data['embeddedsOne']) || !array_key_exists('source', $this->data['embeddedsOne'])) {
                $exists = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId(), 'source' => array('$exists' => 1)));
                if ($exists) {
                    $embedded = new \Model\Source($this->getMandango());
                    $embedded->setRootAndPath($this, 'source');
                    $this->data['embeddedsOne']['source'] = $embedded;
                } else {
                    $this->data['embeddedsOne']['source'] = null;
                }
            }
        }

        return $this->data['embeddedsOne']['source'];
    }

    /**
     * Set the "simpleEmbedded" embedded one.
     *
     * @param \Model\SimpleEmbedded|null $value The "simpleEmbedded" embedded one.
     *
     * @return \Model\Article The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the value is not an instance of Model\SimpleEmbedded or null.
     */
    public function setSimpleEmbedded($value)
    {
        if (null !== $value && !$value instanceof \Model\SimpleEmbedded) {
            throw new \InvalidArgumentException('The "simpleEmbedded" embedded one is not an instance of Model\SimpleEmbedded.');
        }
        if (null !== $value) {
            if ($this instanceof \Mandango\Document\Document) {
                $value->setRootAndPath($this, 'simpleEmbedded');
            } elseif ($rap = $this->getRootAndPath()) {
                $value->setRootAndPath($rap['root'], $rap['path'].'.simpleEmbedded');
            }
        }

        if (!\Mandango\Archive::has($this, 'embedded_one.simpleEmbedded')) {
            $originalValue = isset($this->data['embeddedsOne']['simpleEmbedded']) ? $this->data['embeddedsOne']['simpleEmbedded'] : null;
            \Mandango\Archive::set($this, 'embedded_one.simpleEmbedded', $originalValue);
        } elseif (\Mandango\Archive::get($this, 'embedded_one.simpleEmbedded') === $value) {
            \Mandango\Archive::remove($this, 'embedded_one.simpleEmbedded');
        }

        $this->data['embeddedsOne']['simpleEmbedded'] = $value;

        return $this;
    }

    /**
     * Returns the "simpleEmbedded" embedded one.
     *
     * @return \Model\SimpleEmbedded|null The "simpleEmbedded" embedded one.
     */
    public function getSimpleEmbedded()
    {
        if (!isset($this->data['embeddedsOne']['simpleEmbedded'])) {
            if ($this->isNew()) {
                $this->data['embeddedsOne']['simpleEmbedded'] = null;
            } elseif (!isset($this->data['embeddedsOne']) || !array_key_exists('simpleEmbedded', $this->data['embeddedsOne'])) {
                $exists = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId(), 'simpleEmbedded' => array('$exists' => 1)));
                if ($exists) {
                    $embedded = new \Model\SimpleEmbedded($this->getMandango());
                    $embedded->setRootAndPath($this, 'simpleEmbedded');
                    $this->data['embeddedsOne']['simpleEmbedded'] = $embedded;
                } else {
                    $this->data['embeddedsOne']['simpleEmbedded'] = null;
                }
            }
        }

        return $this->data['embeddedsOne']['simpleEmbedded'];
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
     * @return \Model\Article The document (fluent interface).
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
     * @return \Model\Article The document (fluent interface).
     */
    public function removeComments($documents)
    {
        $this->getComments()->remove($documents);

        return $this;
    }

    /**
     * Returns the "votesUsers" relation many-through.
     *
     * @return \Mandango\Query The "votesUsers" relation many-through.
     */
    public function getVotesUsers()
    {
        $ids = array();
        foreach ($this->getMandango()->getRepository('Model\ArticleVote')->getCollection()
            ->find(array('article' => $this->getId()), array('user' => 1))
        as $value) {
            $ids[] = $value['user'];
        }

        return $this->getMandango()->getRepository('Model\User')->createQuery(array('_id' => array('$in' => $ids)));
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['referencesMany']['categories'])) {
            $this->data['referencesMany']['categories']->reset();
        }
        if (isset($this->data['referencesMany']['related'])) {
            $this->data['referencesMany']['related']->reset();
        }
        if (isset($this->data['referencesMany']['elements'])) {
            $this->data['referencesMany']['elements']->reset();
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
        if ('title' == $name) {
            return $this->setTitle($value);
        }
        if ('content' == $name) {
            return $this->setContent($value);
        }
        if ('note' == $name) {
            return $this->setNote($value);
        }
        if ('line' == $name) {
            return $this->setLine($value);
        }
        if ('text' == $name) {
            return $this->setText($value);
        }
        if ('isActive' == $name) {
            return $this->setIsActive($value);
        }
        if ('date' == $name) {
            return $this->setDate($value);
        }
        if ('database' == $name) {
            return $this->setDatabase($value);
        }
        if ('authorId' == $name) {
            return $this->setAuthorId($value);
        }
        if ('informationId' == $name) {
            return $this->setInformationId($value);
        }
        if ('likeRef' == $name) {
            return $this->setLikeRef($value);
        }
        if ('likeUnset_reference_field' == $name) {
            return $this->setLikeUnset_reference_field($value);
        }
        if ('friendRef' == $name) {
            return $this->setFriendRef($value);
        }
        if ('friendUnset_reference_field' == $name) {
            return $this->setFriendUnset_reference_field($value);
        }
        if ('categoryIds' == $name) {
            return $this->setCategoryIds($value);
        }
        if ('relatedRef' == $name) {
            return $this->setRelatedRef($value);
        }
        if ('elementsRef' == $name) {
            return $this->setElementsRef($value);
        }
        if ('author' == $name) {
            return $this->setAuthor($value);
        }
        if ('information' == $name) {
            return $this->setInformation($value);
        }
        if ('like' == $name) {
            return $this->setLike($value);
        }
        if ('likeUnset' == $name) {
            return $this->setLikeUnset($value);
        }
        if ('friend' == $name) {
            return $this->setFriend($value);
        }
        if ('friendUnset' == $name) {
            return $this->setFriendUnset($value);
        }
        if ('source' == $name) {
            return $this->setSource($value);
        }
        if ('simpleEmbedded' == $name) {
            return $this->setSimpleEmbedded($value);
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
        if ('content' == $name) {
            return $this->getContent();
        }
        if ('note' == $name) {
            return $this->getNote();
        }
        if ('line' == $name) {
            return $this->getLine();
        }
        if ('text' == $name) {
            return $this->getText();
        }
        if ('isActive' == $name) {
            return $this->getIsActive();
        }
        if ('date' == $name) {
            return $this->getDate();
        }
        if ('database' == $name) {
            return $this->getDatabase();
        }
        if ('authorId' == $name) {
            return $this->getAuthorId();
        }
        if ('informationId' == $name) {
            return $this->getInformationId();
        }
        if ('likeRef' == $name) {
            return $this->getLikeRef();
        }
        if ('likeUnset_reference_field' == $name) {
            return $this->getLikeUnset_reference_field();
        }
        if ('friendRef' == $name) {
            return $this->getFriendRef();
        }
        if ('friendUnset_reference_field' == $name) {
            return $this->getFriendUnset_reference_field();
        }
        if ('categoryIds' == $name) {
            return $this->getCategoryIds();
        }
        if ('relatedRef' == $name) {
            return $this->getRelatedRef();
        }
        if ('elementsRef' == $name) {
            return $this->getElementsRef();
        }
        if ('author' == $name) {
            return $this->getAuthor();
        }
        if ('information' == $name) {
            return $this->getInformation();
        }
        if ('like' == $name) {
            return $this->getLike();
        }
        if ('likeUnset' == $name) {
            return $this->getLikeUnset();
        }
        if ('friend' == $name) {
            return $this->getFriend();
        }
        if ('friendUnset' == $name) {
            return $this->getFriendUnset();
        }
        if ('categories' == $name) {
            return $this->getCategories();
        }
        if ('related' == $name) {
            return $this->getRelated();
        }
        if ('elements' == $name) {
            return $this->getElements();
        }
        if ('source' == $name) {
            return $this->getSource();
        }
        if ('simpleEmbedded' == $name) {
            return $this->getSimpleEmbedded();
        }
        if ('comments' == $name) {
            return $this->getComments();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\Article The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['content'])) {
            $this->setContent($array['content']);
        }
        if (isset($array['note'])) {
            $this->setNote($array['note']);
        }
        if (isset($array['line'])) {
            $this->setLine($array['line']);
        }
        if (isset($array['text'])) {
            $this->setText($array['text']);
        }
        if (isset($array['isActive'])) {
            $this->setIsActive($array['isActive']);
        }
        if (isset($array['date'])) {
            $this->setDate($array['date']);
        }
        if (isset($array['database'])) {
            $this->setDatabase($array['database']);
        }
        if (isset($array['authorId'])) {
            $this->setAuthorId($array['authorId']);
        }
        if (isset($array['informationId'])) {
            $this->setInformationId($array['informationId']);
        }
        if (isset($array['likeRef'])) {
            $this->setLikeRef($array['likeRef']);
        }
        if (isset($array['likeUnset_reference_field'])) {
            $this->setLikeUnset_reference_field($array['likeUnset_reference_field']);
        }
        if (isset($array['friendRef'])) {
            $this->setFriendRef($array['friendRef']);
        }
        if (isset($array['friendUnset_reference_field'])) {
            $this->setFriendUnset_reference_field($array['friendUnset_reference_field']);
        }
        if (isset($array['categoryIds'])) {
            $this->setCategoryIds($array['categoryIds']);
        }
        if (isset($array['relatedRef'])) {
            $this->setRelatedRef($array['relatedRef']);
        }
        if (isset($array['elementsRef'])) {
            $this->setElementsRef($array['elementsRef']);
        }
        if (isset($array['author'])) {
            $this->setAuthor($array['author']);
        }
        if (isset($array['information'])) {
            $this->setInformation($array['information']);
        }
        if (isset($array['like'])) {
            $this->setLike($array['like']);
        }
        if (isset($array['likeUnset'])) {
            $this->setLikeUnset($array['likeUnset']);
        }
        if (isset($array['friend'])) {
            $this->setFriend($array['friend']);
        }
        if (isset($array['friendUnset'])) {
            $this->setFriendUnset($array['friendUnset']);
        }
        if (isset($array['categories'])) {
            $this->removeCategories($this->getCategories()->all());
            $this->addCategories($array['categories']);
        }
        if (isset($array['related'])) {
            $this->removeRelated($this->getRelated()->all());
            $this->addRelated($array['related']);
        }
        if (isset($array['elements'])) {
            $this->removeElements($this->getElements()->all());
            $this->addElements($array['elements']);
        }
        if (isset($array['source'])) {
            $embedded = new \Model\Source($this->getMandango());
            $embedded->fromArray($array['source']);
            $this->setSource($embedded);
        }
        if (isset($array['simpleEmbedded'])) {
            $embedded = new \Model\SimpleEmbedded($this->getMandango());
            $embedded->fromArray($array['simpleEmbedded']);
            $this->setSimpleEmbedded($embedded);
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
        $array = array('id' => $this->getId());

        $array['title'] = $this->getTitle();
        $array['content'] = $this->getContent();
        $array['note'] = $this->getNote();
        $array['line'] = $this->getLine();
        $array['text'] = $this->getText();
        $array['isActive'] = $this->getIsActive();
        $array['date'] = $this->getDate();
        $array['database'] = $this->getDatabase();
        if ($withReferenceFields) {
            $array['authorId'] = $this->getAuthorId();
        }
        if ($withReferenceFields) {
            $array['informationId'] = $this->getInformationId();
        }
        if ($withReferenceFields) {
            $array['likeRef'] = $this->getLikeRef();
        }
        if ($withReferenceFields) {
            $array['likeUnset_reference_field'] = $this->getLikeUnset_reference_field();
        }
        if ($withReferenceFields) {
            $array['friendRef'] = $this->getFriendRef();
        }
        if ($withReferenceFields) {
            $array['friendUnset_reference_field'] = $this->getFriendUnset_reference_field();
        }
        if ($withReferenceFields) {
            $array['categoryIds'] = $this->getCategoryIds();
        }
        if ($withReferenceFields) {
            $array['relatedRef'] = $this->getRelatedRef();
        }
        if ($withReferenceFields) {
            $array['elementsRef'] = $this->getElementsRef();
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
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['content'])) {
                    $query['content'] = (string) $this->data['fields']['content'];
                }
                if (isset($this->data['fields']['note'])) {
                    $query['note'] = (string) $this->data['fields']['note'];
                }
                if (isset($this->data['fields']['line'])) {
                    $query['line'] = (string) $this->data['fields']['line'];
                }
                if (isset($this->data['fields']['text'])) {
                    $query['text'] = (string) $this->data['fields']['text'];
                }
                if (isset($this->data['fields']['isActive'])) {
                    $query['isActive'] = (bool) $this->data['fields']['isActive'];
                }
                if (isset($this->data['fields']['date'])) {
                    $query['date'] = $this->data['fields']['date']; if ($query['date'] instanceof \DateTime) { $query['date'] = $this->data['fields']['date']->getTimestamp(); } elseif (is_string($query['date'])) { $query['date'] = strtotime($this->data['fields']['date']); } $query['date'] = new \MongoDate($query['date']);
                }
                if (isset($this->data['fields']['database'])) {
                    $query['basatos'] = (string) $this->data['fields']['database'];
                }
                if (isset($this->data['fields']['authorId'])) {
                    $query['author'] = $this->data['fields']['authorId'];
                }
                if (isset($this->data['fields']['informationId'])) {
                    $query['information'] = $this->data['fields']['informationId'];
                }
                if (isset($this->data['fields']['likeRef'])) {
                    $query['like'] = $this->data['fields']['likeRef'];
                }
                if (isset($this->data['fields']['likeUnset_reference_field'])) {
                    $query['likeUnset'] = $this->data['fields']['likeUnset_reference_field'];
                }
                if (isset($this->data['fields']['friendRef'])) {
                    $query['friend'] = $this->data['fields']['friendRef'];
                }
                if (isset($this->data['fields']['friendUnset_reference_field'])) {
                    $query['friendUnset'] = $this->data['fields']['friendUnset_reference_field'];
                }
                if (isset($this->data['fields']['categoryIds'])) {
                    $query['categories'] = $this->data['fields']['categoryIds'];
                }
                if (isset($this->data['fields']['relatedRef'])) {
                    $query['related'] = $this->data['fields']['relatedRef'];
                }
                if (isset($this->data['fields']['elementsRef'])) {
                    $query['elements'] = $this->data['fields']['elementsRef'];
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
                if (isset($this->data['fields']['content']) || array_key_exists('content', $this->data['fields'])) {
                    $value = $this->data['fields']['content'];
                    $originalValue = $this->getOriginalFieldValue('content');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['content'] = (string) $this->data['fields']['content'];
                        } else {
                            $query['$unset']['content'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['note']) || array_key_exists('note', $this->data['fields'])) {
                    $value = $this->data['fields']['note'];
                    $originalValue = $this->getOriginalFieldValue('note');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['note'] = (string) $this->data['fields']['note'];
                        } else {
                            $query['$unset']['note'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['line']) || array_key_exists('line', $this->data['fields'])) {
                    $value = $this->data['fields']['line'];
                    $originalValue = $this->getOriginalFieldValue('line');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['line'] = (string) $this->data['fields']['line'];
                        } else {
                            $query['$unset']['line'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['text']) || array_key_exists('text', $this->data['fields'])) {
                    $value = $this->data['fields']['text'];
                    $originalValue = $this->getOriginalFieldValue('text');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['text'] = (string) $this->data['fields']['text'];
                        } else {
                            $query['$unset']['text'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['isActive']) || array_key_exists('isActive', $this->data['fields'])) {
                    $value = $this->data['fields']['isActive'];
                    $originalValue = $this->getOriginalFieldValue('isActive');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['isActive'] = (bool) $this->data['fields']['isActive'];
                        } else {
                            $query['$unset']['isActive'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['date']) || array_key_exists('date', $this->data['fields'])) {
                    $value = $this->data['fields']['date'];
                    $originalValue = $this->getOriginalFieldValue('date');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['date'] = $this->data['fields']['date']; if ($query['$set']['date'] instanceof \DateTime) { $query['$set']['date'] = $this->data['fields']['date']->getTimestamp(); } elseif (is_string($query['$set']['date'])) { $query['$set']['date'] = strtotime($this->data['fields']['date']); } $query['$set']['date'] = new \MongoDate($query['$set']['date']);
                        } else {
                            $query['$unset']['date'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['database']) || array_key_exists('database', $this->data['fields'])) {
                    $value = $this->data['fields']['database'];
                    $originalValue = $this->getOriginalFieldValue('database');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['basatos'] = (string) $this->data['fields']['database'];
                        } else {
                            $query['$unset']['basatos'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['authorId']) || array_key_exists('authorId', $this->data['fields'])) {
                    $value = $this->data['fields']['authorId'];
                    $originalValue = $this->getOriginalFieldValue('authorId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['author'] = $this->data['fields']['authorId'];
                        } else {
                            $query['$unset']['author'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['informationId']) || array_key_exists('informationId', $this->data['fields'])) {
                    $value = $this->data['fields']['informationId'];
                    $originalValue = $this->getOriginalFieldValue('informationId');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['information'] = $this->data['fields']['informationId'];
                        } else {
                            $query['$unset']['information'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['likeRef']) || array_key_exists('likeRef', $this->data['fields'])) {
                    $value = $this->data['fields']['likeRef'];
                    $originalValue = $this->getOriginalFieldValue('likeRef');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['like'] = $this->data['fields']['likeRef'];
                        } else {
                            $query['$unset']['like'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['likeUnset_reference_field']) || array_key_exists('likeUnset_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['likeUnset_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('likeUnset_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['likeUnset'] = $this->data['fields']['likeUnset_reference_field'];
                        } else {
                            $query['$unset']['likeUnset'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['friendRef']) || array_key_exists('friendRef', $this->data['fields'])) {
                    $value = $this->data['fields']['friendRef'];
                    $originalValue = $this->getOriginalFieldValue('friendRef');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['friend'] = $this->data['fields']['friendRef'];
                        } else {
                            $query['$unset']['friend'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['friendUnset_reference_field']) || array_key_exists('friendUnset_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['friendUnset_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('friendUnset_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['friendUnset'] = $this->data['fields']['friendUnset_reference_field'];
                        } else {
                            $query['$unset']['friendUnset'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['categoryIds']) || array_key_exists('categoryIds', $this->data['fields'])) {
                    $value = $this->data['fields']['categoryIds'];
                    $originalValue = $this->getOriginalFieldValue('categoryIds');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['categories'] = $this->data['fields']['categoryIds'];
                        } else {
                            $query['$unset']['categories'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['relatedRef']) || array_key_exists('relatedRef', $this->data['fields'])) {
                    $value = $this->data['fields']['relatedRef'];
                    $originalValue = $this->getOriginalFieldValue('relatedRef');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['related'] = $this->data['fields']['relatedRef'];
                        } else {
                            $query['$unset']['related'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['elementsRef']) || array_key_exists('elementsRef', $this->data['fields'])) {
                    $value = $this->data['fields']['elementsRef'];
                    $originalValue = $this->getOriginalFieldValue('elementsRef');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['elements'] = $this->data['fields']['elementsRef'];
                        } else {
                            $query['$unset']['elements'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsOne'])) {
            $originalValue = $this->getOriginalEmbeddedOneValue('source');
            if (isset($this->data['embeddedsOne']['source'])) {
                $resetValue = $reset ? $reset : (!$isNew && $this->data['embeddedsOne']['source'] !== $originalValue);
                $query = $this->data['embeddedsOne']['source']->queryForSave($query, $isNew, $resetValue);
            } elseif (array_key_exists('source', $this->data['embeddedsOne'])) {
                if ($originalValue) {
                    $rap = $originalValue->getRootAndPath();
                    $query['$unset'][$rap['path']] = 1;
                }
            }
            $originalValue = $this->getOriginalEmbeddedOneValue('simpleEmbedded');
            if (isset($this->data['embeddedsOne']['simpleEmbedded'])) {
                $resetValue = $reset ? $reset : (!$isNew && $this->data['embeddedsOne']['simpleEmbedded'] !== $originalValue);
                $query = $this->data['embeddedsOne']['simpleEmbedded']->queryForSave($query, $isNew, $resetValue);
            } elseif (array_key_exists('simpleEmbedded', $this->data['embeddedsOne'])) {
                if ($originalValue) {
                    $rap = $originalValue->getRootAndPath();
                    $query['$unset'][$rap['path']] = 1;
                }
            }
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