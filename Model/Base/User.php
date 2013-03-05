<?php

namespace Model\Base;

/**
 * Base class of Model\User document.
 */
abstract class User extends \Mandango\Document\Document
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
     * @return \Model\User The document (fluent interface).
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
        if (isset($data['fbid'])) {
            $this->data['fields']['fbid'] = (int) $data['fbid'];
        } elseif (isset($data['_fields']['fbid'])) {
            $this->data['fields']['fbid'] = null;
        }
        if (isset($data['name'])) {
            $this->data['fields']['name'] = (string) $data['name'];
        } elseif (isset($data['_fields']['name'])) {
            $this->data['fields']['name'] = null;
        }
        if (isset($data['username'])) {
            $this->data['fields']['username'] = (string) $data['username'];
        } elseif (isset($data['_fields']['username'])) {
            $this->data['fields']['username'] = null;
        }
        if (isset($data['email'])) {
            $this->data['fields']['email'] = (string) $data['email'];
        } elseif (isset($data['_fields']['email'])) {
            $this->data['fields']['email'] = null;
        }
        if (isset($data['gender'])) {
            $this->data['fields']['gender'] = (string) $data['gender'];
        } elseif (isset($data['_fields']['gender'])) {
            $this->data['fields']['gender'] = null;
        }
        if (isset($data['birthday'])) {
            $this->data['fields']['birthday'] = (string) $data['birthday'];
        } elseif (isset($data['_fields']['birthday'])) {
            $this->data['fields']['birthday'] = null;
        }
        if (isset($data['hometown'])) {
            $this->data['fields']['hometown'] = (string) $data['hometown'];
        } elseif (isset($data['_fields']['hometown'])) {
            $this->data['fields']['hometown'] = null;
        }
        if (isset($data['location'])) {
            $this->data['fields']['location'] = (string) $data['location'];
        } elseif (isset($data['_fields']['location'])) {
            $this->data['fields']['location'] = null;
        }
        if (isset($data['picture'])) {
            $this->data['fields']['picture'] = (string) $data['picture'];
        } elseif (isset($data['_fields']['picture'])) {
            $this->data['fields']['picture'] = null;
        }
        if (isset($data['visibility'])) {
            $this->data['fields']['visibility'] = (string) $data['visibility'];
        } elseif (isset($data['_fields']['visibility'])) {
            $this->data['fields']['visibility'] = null;
        }
        if (isset($data['hierarchy'])) {
            $this->data['fields']['hierarchy'] = (string) $data['hierarchy'];
        } elseif (isset($data['_fields']['hierarchy'])) {
            $this->data['fields']['hierarchy'] = null;
        }
        if (isset($data['batch'])) {
            $this->data['fields']['batch'] = (string) $data['batch'];
        } elseif (isset($data['_fields']['batch'])) {
            $this->data['fields']['batch'] = null;
        }
        if (isset($data['created'])) {
            $this->data['fields']['created'] = new \DateTime(); $this->data['fields']['created']->setTimestamp($data['created']->sec);
        } elseif (isset($data['_fields']['created'])) {
            $this->data['fields']['created'] = null;
        }
        if (isset($data['updated'])) {
            $this->data['fields']['updated'] = new \DateTime(); $this->data['fields']['updated']->setTimestamp($data['updated']->sec);
        } elseif (isset($data['_fields']['updated'])) {
            $this->data['fields']['updated'] = null;
        }
        if (isset($data['onsearch'])) {
            $this->data['fields']['onsearch'] = (string) $data['onsearch'];
        } elseif (isset($data['_fields']['onsearch'])) {
            $this->data['fields']['onsearch'] = null;
        }

        return $this;
    }

    /**
     * Set the "fbid" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setFbid($value)
    {
        if (!isset($this->data['fields']['fbid'])) {
            if (!$this->isNew()) {
                $this->getFbid();
                if ($value === $this->data['fields']['fbid']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['fbid'] = null;
                $this->data['fields']['fbid'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['fbid']) {
            return $this;
        }

        if (!isset($this->fieldsModified['fbid']) && !array_key_exists('fbid', $this->fieldsModified)) {
            $this->fieldsModified['fbid'] = $this->data['fields']['fbid'];
        } elseif ($value === $this->fieldsModified['fbid']) {
            unset($this->fieldsModified['fbid']);
        }

        $this->data['fields']['fbid'] = $value;

        return $this;
    }

    /**
     * Returns the "fbid" field.
     *
     * @return mixed The $name field.
     */
    public function getFbid()
    {
        if (!isset($this->data['fields']['fbid'])) {
            if ($this->isNew()) {
                $this->data['fields']['fbid'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('fbid', $this->data['fields'])) {
                $this->addFieldCache('fbid');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('fbid' => 1));
                if (isset($data['fbid'])) {
                    $this->data['fields']['fbid'] = (int) $data['fbid'];
                } else {
                    $this->data['fields']['fbid'] = null;
                }
            }
        }

        return $this->data['fields']['fbid'];
    }

    /**
     * Set the "name" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
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
     * Set the "username" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setUsername($value)
    {
        if (!isset($this->data['fields']['username'])) {
            if (!$this->isNew()) {
                $this->getUsername();
                if ($value === $this->data['fields']['username']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['username'] = null;
                $this->data['fields']['username'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['username']) {
            return $this;
        }

        if (!isset($this->fieldsModified['username']) && !array_key_exists('username', $this->fieldsModified)) {
            $this->fieldsModified['username'] = $this->data['fields']['username'];
        } elseif ($value === $this->fieldsModified['username']) {
            unset($this->fieldsModified['username']);
        }

        $this->data['fields']['username'] = $value;

        return $this;
    }

    /**
     * Returns the "username" field.
     *
     * @return mixed The $name field.
     */
    public function getUsername()
    {
        if (!isset($this->data['fields']['username'])) {
            if ($this->isNew()) {
                $this->data['fields']['username'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('username', $this->data['fields'])) {
                $this->addFieldCache('username');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('username' => 1));
                if (isset($data['username'])) {
                    $this->data['fields']['username'] = (string) $data['username'];
                } else {
                    $this->data['fields']['username'] = null;
                }
            }
        }

        return $this->data['fields']['username'];
    }

    /**
     * Set the "email" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setEmail($value)
    {
        if (!isset($this->data['fields']['email'])) {
            if (!$this->isNew()) {
                $this->getEmail();
                if ($value === $this->data['fields']['email']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['email'] = null;
                $this->data['fields']['email'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['email']) {
            return $this;
        }

        if (!isset($this->fieldsModified['email']) && !array_key_exists('email', $this->fieldsModified)) {
            $this->fieldsModified['email'] = $this->data['fields']['email'];
        } elseif ($value === $this->fieldsModified['email']) {
            unset($this->fieldsModified['email']);
        }

        $this->data['fields']['email'] = $value;

        return $this;
    }

    /**
     * Returns the "email" field.
     *
     * @return mixed The $name field.
     */
    public function getEmail()
    {
        if (!isset($this->data['fields']['email'])) {
            if ($this->isNew()) {
                $this->data['fields']['email'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('email', $this->data['fields'])) {
                $this->addFieldCache('email');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('email' => 1));
                if (isset($data['email'])) {
                    $this->data['fields']['email'] = (string) $data['email'];
                } else {
                    $this->data['fields']['email'] = null;
                }
            }
        }

        return $this->data['fields']['email'];
    }

    /**
     * Set the "gender" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setGender($value)
    {
        if (!isset($this->data['fields']['gender'])) {
            if (!$this->isNew()) {
                $this->getGender();
                if ($value === $this->data['fields']['gender']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['gender'] = null;
                $this->data['fields']['gender'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['gender']) {
            return $this;
        }

        if (!isset($this->fieldsModified['gender']) && !array_key_exists('gender', $this->fieldsModified)) {
            $this->fieldsModified['gender'] = $this->data['fields']['gender'];
        } elseif ($value === $this->fieldsModified['gender']) {
            unset($this->fieldsModified['gender']);
        }

        $this->data['fields']['gender'] = $value;

        return $this;
    }

    /**
     * Returns the "gender" field.
     *
     * @return mixed The $name field.
     */
    public function getGender()
    {
        if (!isset($this->data['fields']['gender'])) {
            if ($this->isNew()) {
                $this->data['fields']['gender'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('gender', $this->data['fields'])) {
                $this->addFieldCache('gender');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('gender' => 1));
                if (isset($data['gender'])) {
                    $this->data['fields']['gender'] = (string) $data['gender'];
                } else {
                    $this->data['fields']['gender'] = null;
                }
            }
        }

        return $this->data['fields']['gender'];
    }

    /**
     * Set the "birthday" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setBirthday($value)
    {
        if (!isset($this->data['fields']['birthday'])) {
            if (!$this->isNew()) {
                $this->getBirthday();
                if ($value === $this->data['fields']['birthday']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['birthday'] = null;
                $this->data['fields']['birthday'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['birthday']) {
            return $this;
        }

        if (!isset($this->fieldsModified['birthday']) && !array_key_exists('birthday', $this->fieldsModified)) {
            $this->fieldsModified['birthday'] = $this->data['fields']['birthday'];
        } elseif ($value === $this->fieldsModified['birthday']) {
            unset($this->fieldsModified['birthday']);
        }

        $this->data['fields']['birthday'] = $value;

        return $this;
    }

    /**
     * Returns the "birthday" field.
     *
     * @return mixed The $name field.
     */
    public function getBirthday()
    {
        if (!isset($this->data['fields']['birthday'])) {
            if ($this->isNew()) {
                $this->data['fields']['birthday'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('birthday', $this->data['fields'])) {
                $this->addFieldCache('birthday');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('birthday' => 1));
                if (isset($data['birthday'])) {
                    $this->data['fields']['birthday'] = (string) $data['birthday'];
                } else {
                    $this->data['fields']['birthday'] = null;
                }
            }
        }

        return $this->data['fields']['birthday'];
    }

    /**
     * Set the "hometown" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setHometown($value)
    {
        if (!isset($this->data['fields']['hometown'])) {
            if (!$this->isNew()) {
                $this->getHometown();
                if ($value === $this->data['fields']['hometown']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['hometown'] = null;
                $this->data['fields']['hometown'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['hometown']) {
            return $this;
        }

        if (!isset($this->fieldsModified['hometown']) && !array_key_exists('hometown', $this->fieldsModified)) {
            $this->fieldsModified['hometown'] = $this->data['fields']['hometown'];
        } elseif ($value === $this->fieldsModified['hometown']) {
            unset($this->fieldsModified['hometown']);
        }

        $this->data['fields']['hometown'] = $value;

        return $this;
    }

    /**
     * Returns the "hometown" field.
     *
     * @return mixed The $name field.
     */
    public function getHometown()
    {
        if (!isset($this->data['fields']['hometown'])) {
            if ($this->isNew()) {
                $this->data['fields']['hometown'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('hometown', $this->data['fields'])) {
                $this->addFieldCache('hometown');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('hometown' => 1));
                if (isset($data['hometown'])) {
                    $this->data['fields']['hometown'] = (string) $data['hometown'];
                } else {
                    $this->data['fields']['hometown'] = null;
                }
            }
        }

        return $this->data['fields']['hometown'];
    }

    /**
     * Set the "location" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setLocation($value)
    {
        if (!isset($this->data['fields']['location'])) {
            if (!$this->isNew()) {
                $this->getLocation();
                if ($value === $this->data['fields']['location']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['location'] = null;
                $this->data['fields']['location'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['location']) {
            return $this;
        }

        if (!isset($this->fieldsModified['location']) && !array_key_exists('location', $this->fieldsModified)) {
            $this->fieldsModified['location'] = $this->data['fields']['location'];
        } elseif ($value === $this->fieldsModified['location']) {
            unset($this->fieldsModified['location']);
        }

        $this->data['fields']['location'] = $value;

        return $this;
    }

    /**
     * Returns the "location" field.
     *
     * @return mixed The $name field.
     */
    public function getLocation()
    {
        if (!isset($this->data['fields']['location'])) {
            if ($this->isNew()) {
                $this->data['fields']['location'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('location', $this->data['fields'])) {
                $this->addFieldCache('location');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('location' => 1));
                if (isset($data['location'])) {
                    $this->data['fields']['location'] = (string) $data['location'];
                } else {
                    $this->data['fields']['location'] = null;
                }
            }
        }

        return $this->data['fields']['location'];
    }

    /**
     * Set the "picture" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setPicture($value)
    {
        if (!isset($this->data['fields']['picture'])) {
            if (!$this->isNew()) {
                $this->getPicture();
                if ($value === $this->data['fields']['picture']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['picture'] = null;
                $this->data['fields']['picture'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['picture']) {
            return $this;
        }

        if (!isset($this->fieldsModified['picture']) && !array_key_exists('picture', $this->fieldsModified)) {
            $this->fieldsModified['picture'] = $this->data['fields']['picture'];
        } elseif ($value === $this->fieldsModified['picture']) {
            unset($this->fieldsModified['picture']);
        }

        $this->data['fields']['picture'] = $value;

        return $this;
    }

    /**
     * Returns the "picture" field.
     *
     * @return mixed The $name field.
     */
    public function getPicture()
    {
        if (!isset($this->data['fields']['picture'])) {
            if ($this->isNew()) {
                $this->data['fields']['picture'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('picture', $this->data['fields'])) {
                $this->addFieldCache('picture');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('picture' => 1));
                if (isset($data['picture'])) {
                    $this->data['fields']['picture'] = (string) $data['picture'];
                } else {
                    $this->data['fields']['picture'] = null;
                }
            }
        }

        return $this->data['fields']['picture'];
    }

    /**
     * Set the "visibility" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setVisibility($value)
    {
        if (!isset($this->data['fields']['visibility'])) {
            if (!$this->isNew()) {
                $this->getVisibility();
                if ($value === $this->data['fields']['visibility']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['visibility'] = null;
                $this->data['fields']['visibility'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['visibility']) {
            return $this;
        }

        if (!isset($this->fieldsModified['visibility']) && !array_key_exists('visibility', $this->fieldsModified)) {
            $this->fieldsModified['visibility'] = $this->data['fields']['visibility'];
        } elseif ($value === $this->fieldsModified['visibility']) {
            unset($this->fieldsModified['visibility']);
        }

        $this->data['fields']['visibility'] = $value;

        return $this;
    }

    /**
     * Returns the "visibility" field.
     *
     * @return mixed The $name field.
     */
    public function getVisibility()
    {
        if (!isset($this->data['fields']['visibility'])) {
            if ($this->isNew()) {
                $this->data['fields']['visibility'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('visibility', $this->data['fields'])) {
                $this->addFieldCache('visibility');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('visibility' => 1));
                if (isset($data['visibility'])) {
                    $this->data['fields']['visibility'] = (string) $data['visibility'];
                } else {
                    $this->data['fields']['visibility'] = null;
                }
            }
        }

        return $this->data['fields']['visibility'];
    }

    /**
     * Set the "hierarchy" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setHierarchy($value)
    {
        if (!isset($this->data['fields']['hierarchy'])) {
            if (!$this->isNew()) {
                $this->getHierarchy();
                if ($value === $this->data['fields']['hierarchy']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['hierarchy'] = null;
                $this->data['fields']['hierarchy'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['hierarchy']) {
            return $this;
        }

        if (!isset($this->fieldsModified['hierarchy']) && !array_key_exists('hierarchy', $this->fieldsModified)) {
            $this->fieldsModified['hierarchy'] = $this->data['fields']['hierarchy'];
        } elseif ($value === $this->fieldsModified['hierarchy']) {
            unset($this->fieldsModified['hierarchy']);
        }

        $this->data['fields']['hierarchy'] = $value;

        return $this;
    }

    /**
     * Returns the "hierarchy" field.
     *
     * @return mixed The $name field.
     */
    public function getHierarchy()
    {
        if (!isset($this->data['fields']['hierarchy'])) {
            if ($this->isNew()) {
                $this->data['fields']['hierarchy'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('hierarchy', $this->data['fields'])) {
                $this->addFieldCache('hierarchy');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('hierarchy' => 1));
                if (isset($data['hierarchy'])) {
                    $this->data['fields']['hierarchy'] = (string) $data['hierarchy'];
                } else {
                    $this->data['fields']['hierarchy'] = null;
                }
            }
        }

        return $this->data['fields']['hierarchy'];
    }

    /**
     * Set the "batch" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setBatch($value)
    {
        if (!isset($this->data['fields']['batch'])) {
            if (!$this->isNew()) {
                $this->getBatch();
                if ($value === $this->data['fields']['batch']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['batch'] = null;
                $this->data['fields']['batch'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['batch']) {
            return $this;
        }

        if (!isset($this->fieldsModified['batch']) && !array_key_exists('batch', $this->fieldsModified)) {
            $this->fieldsModified['batch'] = $this->data['fields']['batch'];
        } elseif ($value === $this->fieldsModified['batch']) {
            unset($this->fieldsModified['batch']);
        }

        $this->data['fields']['batch'] = $value;

        return $this;
    }

    /**
     * Returns the "batch" field.
     *
     * @return mixed The $name field.
     */
    public function getBatch()
    {
        if (!isset($this->data['fields']['batch'])) {
            if ($this->isNew()) {
                $this->data['fields']['batch'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('batch', $this->data['fields'])) {
                $this->addFieldCache('batch');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('batch' => 1));
                if (isset($data['batch'])) {
                    $this->data['fields']['batch'] = (string) $data['batch'];
                } else {
                    $this->data['fields']['batch'] = null;
                }
            }
        }

        return $this->data['fields']['batch'];
    }

    /**
     * Set the "created" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setCreated($value)
    {
        if (!isset($this->data['fields']['created'])) {
            if (!$this->isNew()) {
                $this->getCreated();
                if ($value === $this->data['fields']['created']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['created'] = null;
                $this->data['fields']['created'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['created']) {
            return $this;
        }

        if (!isset($this->fieldsModified['created']) && !array_key_exists('created', $this->fieldsModified)) {
            $this->fieldsModified['created'] = $this->data['fields']['created'];
        } elseif ($value === $this->fieldsModified['created']) {
            unset($this->fieldsModified['created']);
        }

        $this->data['fields']['created'] = $value;

        return $this;
    }

    /**
     * Returns the "created" field.
     *
     * @return mixed The $name field.
     */
    public function getCreated()
    {
        if (!isset($this->data['fields']['created'])) {
            if ($this->isNew()) {
                $this->data['fields']['created'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('created', $this->data['fields'])) {
                $this->addFieldCache('created');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('created' => 1));
                if (isset($data['created'])) {
                    $this->data['fields']['created'] = new \DateTime(); $this->data['fields']['created']->setTimestamp($data['created']->sec);
                } else {
                    $this->data['fields']['created'] = null;
                }
            }
        }

        return $this->data['fields']['created'];
    }

    /**
     * Set the "updated" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setUpdated($value)
    {
        if (!isset($this->data['fields']['updated'])) {
            if (!$this->isNew()) {
                $this->getUpdated();
                if ($value === $this->data['fields']['updated']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['updated'] = null;
                $this->data['fields']['updated'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['updated']) {
            return $this;
        }

        if (!isset($this->fieldsModified['updated']) && !array_key_exists('updated', $this->fieldsModified)) {
            $this->fieldsModified['updated'] = $this->data['fields']['updated'];
        } elseif ($value === $this->fieldsModified['updated']) {
            unset($this->fieldsModified['updated']);
        }

        $this->data['fields']['updated'] = $value;

        return $this;
    }

    /**
     * Returns the "updated" field.
     *
     * @return mixed The $name field.
     */
    public function getUpdated()
    {
        if (!isset($this->data['fields']['updated'])) {
            if ($this->isNew()) {
                $this->data['fields']['updated'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('updated', $this->data['fields'])) {
                $this->addFieldCache('updated');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('updated' => 1));
                if (isset($data['updated'])) {
                    $this->data['fields']['updated'] = new \DateTime(); $this->data['fields']['updated']->setTimestamp($data['updated']->sec);
                } else {
                    $this->data['fields']['updated'] = null;
                }
            }
        }

        return $this->data['fields']['updated'];
    }

    /**
     * Set the "onsearch" field.
     *
     * @param mixed $value The value.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function setOnsearch($value)
    {
        if (!isset($this->data['fields']['onsearch'])) {
            if (!$this->isNew()) {
                $this->getOnsearch();
                if ($value === $this->data['fields']['onsearch']) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['onsearch'] = null;
                $this->data['fields']['onsearch'] = $value;
                return $this;
            }
        } elseif ($value === $this->data['fields']['onsearch']) {
            return $this;
        }

        if (!isset($this->fieldsModified['onsearch']) && !array_key_exists('onsearch', $this->fieldsModified)) {
            $this->fieldsModified['onsearch'] = $this->data['fields']['onsearch'];
        } elseif ($value === $this->fieldsModified['onsearch']) {
            unset($this->fieldsModified['onsearch']);
        }

        $this->data['fields']['onsearch'] = $value;

        return $this;
    }

    /**
     * Returns the "onsearch" field.
     *
     * @return mixed The $name field.
     */
    public function getOnsearch()
    {
        if (!isset($this->data['fields']['onsearch'])) {
            if ($this->isNew()) {
                $this->data['fields']['onsearch'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('onsearch', $this->data['fields'])) {
                $this->addFieldCache('onsearch');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('onsearch' => 1));
                if (isset($data['onsearch'])) {
                    $this->data['fields']['onsearch'] = (string) $data['onsearch'];
                } else {
                    $this->data['fields']['onsearch'] = null;
                }
            }
        }

        return $this->data['fields']['onsearch'];
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
        if ('fbid' == $name) {
            return $this->setFbid($value);
        }
        if ('name' == $name) {
            return $this->setName($value);
        }
        if ('username' == $name) {
            return $this->setUsername($value);
        }
        if ('email' == $name) {
            return $this->setEmail($value);
        }
        if ('gender' == $name) {
            return $this->setGender($value);
        }
        if ('birthday' == $name) {
            return $this->setBirthday($value);
        }
        if ('hometown' == $name) {
            return $this->setHometown($value);
        }
        if ('location' == $name) {
            return $this->setLocation($value);
        }
        if ('picture' == $name) {
            return $this->setPicture($value);
        }
        if ('visibility' == $name) {
            return $this->setVisibility($value);
        }
        if ('hierarchy' == $name) {
            return $this->setHierarchy($value);
        }
        if ('batch' == $name) {
            return $this->setBatch($value);
        }
        if ('created' == $name) {
            return $this->setCreated($value);
        }
        if ('updated' == $name) {
            return $this->setUpdated($value);
        }
        if ('onsearch' == $name) {
            return $this->setOnsearch($value);
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
        if ('fbid' == $name) {
            return $this->getFbid();
        }
        if ('name' == $name) {
            return $this->getName();
        }
        if ('username' == $name) {
            return $this->getUsername();
        }
        if ('email' == $name) {
            return $this->getEmail();
        }
        if ('gender' == $name) {
            return $this->getGender();
        }
        if ('birthday' == $name) {
            return $this->getBirthday();
        }
        if ('hometown' == $name) {
            return $this->getHometown();
        }
        if ('location' == $name) {
            return $this->getLocation();
        }
        if ('picture' == $name) {
            return $this->getPicture();
        }
        if ('visibility' == $name) {
            return $this->getVisibility();
        }
        if ('hierarchy' == $name) {
            return $this->getHierarchy();
        }
        if ('batch' == $name) {
            return $this->getBatch();
        }
        if ('created' == $name) {
            return $this->getCreated();
        }
        if ('updated' == $name) {
            return $this->getUpdated();
        }
        if ('onsearch' == $name) {
            return $this->getOnsearch();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Model\User The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['fbid'])) {
            $this->setFbid($array['fbid']);
        }
        if (isset($array['name'])) {
            $this->setName($array['name']);
        }
        if (isset($array['username'])) {
            $this->setUsername($array['username']);
        }
        if (isset($array['email'])) {
            $this->setEmail($array['email']);
        }
        if (isset($array['gender'])) {
            $this->setGender($array['gender']);
        }
        if (isset($array['birthday'])) {
            $this->setBirthday($array['birthday']);
        }
        if (isset($array['hometown'])) {
            $this->setHometown($array['hometown']);
        }
        if (isset($array['location'])) {
            $this->setLocation($array['location']);
        }
        if (isset($array['picture'])) {
            $this->setPicture($array['picture']);
        }
        if (isset($array['visibility'])) {
            $this->setVisibility($array['visibility']);
        }
        if (isset($array['hierarchy'])) {
            $this->setHierarchy($array['hierarchy']);
        }
        if (isset($array['batch'])) {
            $this->setBatch($array['batch']);
        }
        if (isset($array['created'])) {
            $this->setCreated($array['created']);
        }
        if (isset($array['updated'])) {
            $this->setUpdated($array['updated']);
        }
        if (isset($array['onsearch'])) {
            $this->setOnsearch($array['onsearch']);
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

        $array['fbid'] = $this->getFbid();
        $array['name'] = $this->getName();
        $array['username'] = $this->getUsername();
        $array['email'] = $this->getEmail();
        $array['gender'] = $this->getGender();
        $array['birthday'] = $this->getBirthday();
        $array['hometown'] = $this->getHometown();
        $array['location'] = $this->getLocation();
        $array['picture'] = $this->getPicture();
        $array['visibility'] = $this->getVisibility();
        $array['hierarchy'] = $this->getHierarchy();
        $array['batch'] = $this->getBatch();
        $array['created'] = $this->getCreated();
        $array['updated'] = $this->getUpdated();
        $array['onsearch'] = $this->getOnsearch();

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
                if (isset($this->data['fields']['fbid'])) {
                    $query['fbid'] = (int) $this->data['fields']['fbid'];
                }
                if (isset($this->data['fields']['name'])) {
                    $query['name'] = (string) $this->data['fields']['name'];
                }
                if (isset($this->data['fields']['username'])) {
                    $query['username'] = (string) $this->data['fields']['username'];
                }
                if (isset($this->data['fields']['email'])) {
                    $query['email'] = (string) $this->data['fields']['email'];
                }
                if (isset($this->data['fields']['gender'])) {
                    $query['gender'] = (string) $this->data['fields']['gender'];
                }
                if (isset($this->data['fields']['birthday'])) {
                    $query['birthday'] = (string) $this->data['fields']['birthday'];
                }
                if (isset($this->data['fields']['hometown'])) {
                    $query['hometown'] = (string) $this->data['fields']['hometown'];
                }
                if (isset($this->data['fields']['location'])) {
                    $query['location'] = (string) $this->data['fields']['location'];
                }
                if (isset($this->data['fields']['picture'])) {
                    $query['picture'] = (string) $this->data['fields']['picture'];
                }
                if (isset($this->data['fields']['visibility'])) {
                    $query['visibility'] = (string) $this->data['fields']['visibility'];
                }
                if (isset($this->data['fields']['hierarchy'])) {
                    $query['hierarchy'] = (string) $this->data['fields']['hierarchy'];
                }
                if (isset($this->data['fields']['batch'])) {
                    $query['batch'] = (string) $this->data['fields']['batch'];
                }
                if (isset($this->data['fields']['created'])) {
                    $query['created'] = $this->data['fields']['created']; if ($query['created'] instanceof \DateTime) { $query['created'] = $this->data['fields']['created']->getTimestamp(); } elseif (is_string($query['created'])) { $query['created'] = strtotime($this->data['fields']['created']); } $query['created'] = new \MongoDate($query['created']);
                }
                if (isset($this->data['fields']['updated'])) {
                    $query['updated'] = $this->data['fields']['updated']; if ($query['updated'] instanceof \DateTime) { $query['updated'] = $this->data['fields']['updated']->getTimestamp(); } elseif (is_string($query['updated'])) { $query['updated'] = strtotime($this->data['fields']['updated']); } $query['updated'] = new \MongoDate($query['updated']);
                }
                if (isset($this->data['fields']['onsearch'])) {
                    $query['onsearch'] = (string) $this->data['fields']['onsearch'];
                }
            } else {
                if (isset($this->data['fields']['fbid']) || array_key_exists('fbid', $this->data['fields'])) {
                    $value = $this->data['fields']['fbid'];
                    $originalValue = $this->getOriginalFieldValue('fbid');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['fbid'] = (int) $this->data['fields']['fbid'];
                        } else {
                            $query['$unset']['fbid'] = 1;
                        }
                    }
                }
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
                if (isset($this->data['fields']['username']) || array_key_exists('username', $this->data['fields'])) {
                    $value = $this->data['fields']['username'];
                    $originalValue = $this->getOriginalFieldValue('username');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['username'] = (string) $this->data['fields']['username'];
                        } else {
                            $query['$unset']['username'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['email']) || array_key_exists('email', $this->data['fields'])) {
                    $value = $this->data['fields']['email'];
                    $originalValue = $this->getOriginalFieldValue('email');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['email'] = (string) $this->data['fields']['email'];
                        } else {
                            $query['$unset']['email'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['gender']) || array_key_exists('gender', $this->data['fields'])) {
                    $value = $this->data['fields']['gender'];
                    $originalValue = $this->getOriginalFieldValue('gender');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['gender'] = (string) $this->data['fields']['gender'];
                        } else {
                            $query['$unset']['gender'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['birthday']) || array_key_exists('birthday', $this->data['fields'])) {
                    $value = $this->data['fields']['birthday'];
                    $originalValue = $this->getOriginalFieldValue('birthday');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['birthday'] = (string) $this->data['fields']['birthday'];
                        } else {
                            $query['$unset']['birthday'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['hometown']) || array_key_exists('hometown', $this->data['fields'])) {
                    $value = $this->data['fields']['hometown'];
                    $originalValue = $this->getOriginalFieldValue('hometown');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['hometown'] = (string) $this->data['fields']['hometown'];
                        } else {
                            $query['$unset']['hometown'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['location']) || array_key_exists('location', $this->data['fields'])) {
                    $value = $this->data['fields']['location'];
                    $originalValue = $this->getOriginalFieldValue('location');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['location'] = (string) $this->data['fields']['location'];
                        } else {
                            $query['$unset']['location'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['picture']) || array_key_exists('picture', $this->data['fields'])) {
                    $value = $this->data['fields']['picture'];
                    $originalValue = $this->getOriginalFieldValue('picture');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['picture'] = (string) $this->data['fields']['picture'];
                        } else {
                            $query['$unset']['picture'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['visibility']) || array_key_exists('visibility', $this->data['fields'])) {
                    $value = $this->data['fields']['visibility'];
                    $originalValue = $this->getOriginalFieldValue('visibility');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['visibility'] = (string) $this->data['fields']['visibility'];
                        } else {
                            $query['$unset']['visibility'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['hierarchy']) || array_key_exists('hierarchy', $this->data['fields'])) {
                    $value = $this->data['fields']['hierarchy'];
                    $originalValue = $this->getOriginalFieldValue('hierarchy');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['hierarchy'] = (string) $this->data['fields']['hierarchy'];
                        } else {
                            $query['$unset']['hierarchy'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['batch']) || array_key_exists('batch', $this->data['fields'])) {
                    $value = $this->data['fields']['batch'];
                    $originalValue = $this->getOriginalFieldValue('batch');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['batch'] = (string) $this->data['fields']['batch'];
                        } else {
                            $query['$unset']['batch'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['created']) || array_key_exists('created', $this->data['fields'])) {
                    $value = $this->data['fields']['created'];
                    $originalValue = $this->getOriginalFieldValue('created');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['created'] = $this->data['fields']['created']; if ($query['$set']['created'] instanceof \DateTime) { $query['$set']['created'] = $this->data['fields']['created']->getTimestamp(); } elseif (is_string($query['$set']['created'])) { $query['$set']['created'] = strtotime($this->data['fields']['created']); } $query['$set']['created'] = new \MongoDate($query['$set']['created']);
                        } else {
                            $query['$unset']['created'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['updated']) || array_key_exists('updated', $this->data['fields'])) {
                    $value = $this->data['fields']['updated'];
                    $originalValue = $this->getOriginalFieldValue('updated');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['updated'] = $this->data['fields']['updated']; if ($query['$set']['updated'] instanceof \DateTime) { $query['$set']['updated'] = $this->data['fields']['updated']->getTimestamp(); } elseif (is_string($query['$set']['updated'])) { $query['$set']['updated'] = strtotime($this->data['fields']['updated']); } $query['$set']['updated'] = new \MongoDate($query['$set']['updated']);
                        } else {
                            $query['$unset']['updated'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['onsearch']) || array_key_exists('onsearch', $this->data['fields'])) {
                    $value = $this->data['fields']['onsearch'];
                    $originalValue = $this->getOriginalFieldValue('onsearch');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['onsearch'] = (string) $this->data['fields']['onsearch'];
                        } else {
                            $query['$unset']['onsearch'] = 1;
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