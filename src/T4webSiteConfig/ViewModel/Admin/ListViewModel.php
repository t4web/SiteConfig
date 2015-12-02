<?php

namespace T4webSiteConfig\ViewModel\Admin;

use ArrayObject;
use Zend\View\Model\ViewModel;
use Sebaks\Crud\View\Model\ListViewModelInterface;
use T4webDomainInterface\Infrastructure\RepositoryInterface;

class ListViewModel extends ViewModel implements ListViewModelInterface
{

    /**
     * @var RepositoryInterface
     */
    private $scopeRepository;

    /**
     * @param RepositoryInterface $scopeRepository
     */
    public function __construct(RepositoryInterface $scopeRepository)
    {
        $this->scopeRepository = $scopeRepository;
    }

    /**
     * @return ArrayObject
     */
    public function getCollection()
    {
        return $this->getVariable('collection');
    }

    /**
     * @param ArrayObject $collection
     */
    public function setCollection(ArrayObject $collection)
    {
        $this->setVariable('collection', $collection);
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return $this->getVariable('filter');
    }

    /**
     * @param array $filter
     */
    public function setFilter(array $filter)
    {
        $this->setVariable('filter', $filter);
    }

    /**
     * @param int $id
     */
    public function setScopeId($id)
    {
        $this->setVariable('scopeId', $id);
    }

    /**
     * @return null|\T4webDomainInterface\EntityInterface
     */
    public function getScope()
    {
        return $this->scopeRepository->findById($this->getVariable('scopeId'));
    }
}