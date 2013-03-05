<?php

namespace Model\Base;

/**
 * Base class of query of Model\TextElement document.
 */
abstract class TextElementQuery extends \Mandango\Query
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        $repository = $this->getRepository();
        $mandango = $repository->getMandango();
        $documentClass = $repository->getDocumentClass();
        $identityMap =& $repository->getIdentityMap()->allByReference();
        $isFile = $repository->isFile();
        $identityMaps = array();
        $mandango = $this->getRepository()->getMandango();
        $isFile = $this->getRepository()->isFile();

        if ($fields = $this->getFields()) {
            $fields['type'] = 1;
            $this->fields($fields);
        }

        $fields = array();
        foreach (array_keys($this->getFields()) as $field) {
            if (false === strpos($field, '.')) {
                $fields[$field] = 1;
                continue;
            }
            $f =& $fields;
            foreach (explode('.', $field) as $name) {
                if (!isset($f[$name])) {
                    $f[$name] = array();
                }
                $f =& $f[$name];
            }
            $f = 1;
        }

        $documents = array();
        foreach ($this->createCursor() as $id => $data) {
            $documentClass = null;
            $identityMap = null;
            if (isset($data['type'])) {
                if ('texttextelement' == $data['type']) {
                    if (!isset($identityMaps['texttextelement'])) {
                        $identityMaps['texttextelement'] = $mandango->getRepository('Model\TextTextElement')->getIdentityMap()->allByReference();
                    }
                    $documentClass = 'Model\TextTextElement';
                    $identityMap = $identityMaps['texttextelement'];
                }
            }
            if (null === $documentClass) {
                if (!isset($identityMaps['_root'])) {
                    $identityMaps['_root'] = $this->getRepository()->getIdentityMap()->allByReference();
                }
                $documentClass = 'Model\TextElement';
                $identityMap = $identityMaps['_root'];
            }
            if (isset($identityMap[$id])) {
                $document = $identityMap[$id];
                $document->addQueryHash($this->getHash());
            } else {
                if ($isFile) {
                    $file = $data;
                    $data = $file->file;
                    $data['file'] = $file;
                }
                $data['_query_hash'] = $this->getHash();
                $data['_fields'] = $fields;

                $document = new $documentClass($mandango);
                $document->setDocumentData($data);

                $identityMap[$id] = $document;
            }
            $documents[$id] = $document;
        }

        if ($references = $this->getReferences()) {
            $mandango = $this->getRepository()->getMandango();
            $metadata = $mandango->getMetadataFactory()->getClass($this->getRepository()->getDocumentClass());
            foreach ($references as $referenceName) {
                // one
                if (isset($metadata['referencesOne'][$referenceName])) {
                    $reference = $metadata['referencesOne'][$referenceName];
                    $field = $reference['field'];

                    $ids = array();
                    foreach ($documents as $document) {
                        if ($id = $document->get($field)) {
                            $ids[] = $id;
                        }
                    }
                    if ($ids) {
                        $mandango->getRepository($reference['class'])->findById(array_unique($ids));
                    }

                    continue;
                }

                // many
                if (isset($metadata['referencesMany'][$referenceName])) {
                    $reference = $metadata['referencesMany'][$referenceName];
                    $field = $reference['field'];

                    $ids = array();
                    foreach ($documents as $document) {
                        if ($id = $document->get($field)) {
                            foreach ($id as $i) {
                                $ids[] = $i;
                            }
                        }
                    }
                    if ($ids) {
                        $mandango->getRepository($reference['class'])->findById(array_unique($ids));
                    }

                    continue;
                }

                // invalid
                throw new \RuntimeException(sprintf('The reference "%s" does not exist in the class "%s".', $referenceName, $documentClass));
            }
        }

        return $documents;
    }

    /**
     * {@inheritdoc}
     */
    public function createCursor()
    {
        $criteria = $savedCriteria = $this->getCriteria();
        $types = $this->getRepository()->getInheritableTypes();
        $types[] = 'textelement';
        $criteria = array_merge($criteria, array('type' => array('$in' => $types)));
        $this->criteria($criteria);

        $cursor = parent::createCursor();

        $this->criteria($savedCriteria);

        return $cursor;
    }
}