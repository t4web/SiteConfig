<?php

namespace SiteConfig\Value;

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
     * @return ValuesCollection
     */
    public function getAll(array $criteria = [])
    {
        return $this->repository->findAll($criteria);
    }

    /**
     * @param Value $value
     *
     * @return int
     */
    public function create(Value $value)
    {
        return $this->repository->add($value);
    }

}