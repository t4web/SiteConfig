<?php

namespace SiteConfig\Value;


class Mapper {

    /**
     * @var array keys - db fields, values entity attributes
     */
    protected $columnsAsAttributesMap;

    public function __construct() {
        $this->columnsAsAttributesMap = [
            'name' => 'name',
            'value' => 'value',
        ];
    }

    /**
     * @param array $rows
     *
     * @return ValuesCollection
     */
    public function fromTableRows(array $rows) {
        $values = new ValuesCollection();

        foreach ($rows as $row) {
            $values[] = $this->fromTableRow($row);
        }

        return $values;
    }

    /**
     * @param array $row
     *
     * @return Scope
     */
    public function fromTableRow(array $row) {
        $attributesValues = $this->getIntersectValuesAsKeys(array_flip($this->columnsAsAttributesMap), $row);

        return new Value(
            $attributesValues['name'],
            $attributesValues['value']
        );
    }

    public function toTableRow(Scope $scope) {
        $objectState = [
            'name' => $scope->getName(),
            'value' => $scope->getValue(),
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