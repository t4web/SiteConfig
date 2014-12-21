<?php

namespace SiteConfig\Scope;

class Service
{
    /**
     * @var DbRepository
     */
    private $repository;

    public function __construct(DbRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $criteria
     * @return ScopesCollection
     */
    public function getAll(array $criteria = [])
    {
        return $this->repository->findAll($criteria);
    }

}