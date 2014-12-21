<?php

namespace SiteConfig\Scope;


class Mapper {

    /**
     * @var array keys - db fields, values entity attributes
     */
    protected $columnsAsAttributesMap;

    public function __construct() {
        $this->columnsAsAttributesMap = [
            'scope' => 'scope',
        ];
    }

    /**
     * @param array $rows
     *
     * @return ScopesCollection
     */
    public function fromTableRows(array $rows) {
        $modules = new ScopesCollection();

        foreach ($rows as $row) {
            $modules[] = $this->fromTableRow($row);
        }

        return $modules;
    }

    /**
     * @param array $row
     *
     * @return Scope
     */
    public function fromTableRow(array $row) {
        $attributesValues = $this->getIntersectValuesAsKeys(array_flip($this->columnsAsAttributesMap), $row);

        return new Scope(
            $attributesValues['scope']
        );
    }

    public function toTableRow(Scope $scope) {
        $objectState = [
            'scope' => $scope->getName(),
        ];

        return $this->getIntersectValuesAsKeys($this->columnsAsAttributesMap, $objectState);
    }

    private function getIntersectValuesAsKeys($array1, $array2) {
        $result = array();

        foreach ($array1 as $key => $value) {
            if (array_key_exists($value, $array2)) {
                $result[$key] = $array2[$value];
            }
        }

        return $result;
    }

} 