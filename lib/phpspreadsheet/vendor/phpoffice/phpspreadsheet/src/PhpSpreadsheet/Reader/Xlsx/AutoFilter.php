<?php

namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use SimpleXMLElement;

class AutoFilter
{
<<<<<<< HEAD
    /** @var Worksheet */
    private $worksheet;

    /** @var SimpleXMLElement */
=======
    private $worksheet;

>>>>>>> forked/LAE_400_PACKAGE
    private $worksheetXml;

    public function __construct(Worksheet $workSheet, SimpleXMLElement $worksheetXml)
    {
        $this->worksheet = $workSheet;
        $this->worksheetXml = $worksheetXml;
    }

    public function load(): void
    {
        // Remove all "$" in the auto filter range
<<<<<<< HEAD
        $autoFilterRange = (string) preg_replace('/\$/', '', $this->worksheetXml->autoFilter['ref'] ?? '');
=======
        $autoFilterRange = preg_replace('/\$/', '', $this->worksheetXml->autoFilter['ref']);
>>>>>>> forked/LAE_400_PACKAGE
        if (strpos($autoFilterRange, ':') !== false) {
            $this->readAutoFilter($autoFilterRange, $this->worksheetXml);
        }
    }

<<<<<<< HEAD
    private function readAutoFilter(string $autoFilterRange, SimpleXMLElement $xmlSheet): void
=======
    private function readAutoFilter($autoFilterRange, $xmlSheet): void
>>>>>>> forked/LAE_400_PACKAGE
    {
        $autoFilter = $this->worksheet->getAutoFilter();
        $autoFilter->setRange($autoFilterRange);

        foreach ($xmlSheet->autoFilter->filterColumn as $filterColumn) {
            $column = $autoFilter->getColumnByOffset((int) $filterColumn['colId']);
            //    Check for standard filters
            if ($filterColumn->filters) {
                $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_FILTER);
                $filters = $filterColumn->filters;
<<<<<<< HEAD
                if ((isset($filters['blank'])) && ((int) $filters['blank'] == 1)) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule('', '')->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
=======
                if ((isset($filters['blank'])) && ($filters['blank'] == 1)) {
                    //    Operator is undefined, but always treated as EQUAL
                    $column->createRule()->setRule(null, '')->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
>>>>>>> forked/LAE_400_PACKAGE
                }
                //    Standard filters are always an OR join, so no join rule needs to be set
                //    Entries can be either filter elements
                foreach ($filters->filter as $filterRule) {
                    //    Operator is undefined, but always treated as EQUAL
<<<<<<< HEAD
                    $column->createRule()->setRule('', (string) $filterRule['val'])->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
=======
                    $column->createRule()->setRule(null, (string) $filterRule['val'])->setRuleType(Rule::AUTOFILTER_RULETYPE_FILTER);
>>>>>>> forked/LAE_400_PACKAGE
                }

                //    Or Date Group elements
                $this->readDateRangeAutoFilter($filters, $column);
            }

            //    Check for custom filters
            $this->readCustomAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readDynamicAutoFilter($filterColumn, $column);
            //    Check for dynamic filters
            $this->readTopTenAutoFilter($filterColumn, $column);
        }
        $autoFilter->setEvaluated(true);
    }

    private function readDateRangeAutoFilter(SimpleXMLElement $filters, Column $column): void
    {
        foreach ($filters->dateGroupItem as $dateGroupItem) {
            //    Operator is undefined, but always treated as EQUAL
            $column->createRule()->setRule(
<<<<<<< HEAD
                '',
=======
                null,
>>>>>>> forked/LAE_400_PACKAGE
                [
                    'year' => (string) $dateGroupItem['year'],
                    'month' => (string) $dateGroupItem['month'],
                    'day' => (string) $dateGroupItem['day'],
                    'hour' => (string) $dateGroupItem['hour'],
                    'minute' => (string) $dateGroupItem['minute'],
                    'second' => (string) $dateGroupItem['second'],
                ],
                (string) $dateGroupItem['dateTimeGrouping']
            )->setRuleType(Rule::AUTOFILTER_RULETYPE_DATEGROUP);
        }
    }

<<<<<<< HEAD
    private function readCustomAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->customFilters)) {
=======
    private function readCustomAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->customFilters) {
>>>>>>> forked/LAE_400_PACKAGE
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_CUSTOMFILTER);
            $customFilters = $filterColumn->customFilters;
            //    Custom filters can an AND or an OR join;
            //        and there should only ever be one or two entries
            if ((isset($customFilters['and'])) && ((string) $customFilters['and'] === '1')) {
                $column->setJoin(Column::AUTOFILTER_COLUMN_JOIN_AND);
            }
            foreach ($customFilters->customFilter as $filterRule) {
                $column->createRule()->setRule(
                    (string) $filterRule['operator'],
                    (string) $filterRule['val']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_CUSTOMFILTER);
            }
        }
    }

<<<<<<< HEAD
    private function readDynamicAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->dynamicFilter)) {
=======
    private function readDynamicAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->dynamicFilter) {
>>>>>>> forked/LAE_400_PACKAGE
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_DYNAMICFILTER);
            //    We should only ever have one dynamic filter
            foreach ($filterColumn->dynamicFilter as $filterRule) {
                //    Operator is undefined, but always treated as EQUAL
                $column->createRule()->setRule(
<<<<<<< HEAD
                    '',
=======
                    null,
>>>>>>> forked/LAE_400_PACKAGE
                    (string) $filterRule['val'],
                    (string) $filterRule['type']
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_DYNAMICFILTER);
                if (isset($filterRule['val'])) {
                    $column->setAttribute('val', (string) $filterRule['val']);
                }
                if (isset($filterRule['maxVal'])) {
                    $column->setAttribute('maxVal', (string) $filterRule['maxVal']);
                }
            }
        }
    }

<<<<<<< HEAD
    private function readTopTenAutoFilter(?SimpleXMLElement $filterColumn, Column $column): void
    {
        if (isset($filterColumn, $filterColumn->top10)) {
=======
    private function readTopTenAutoFilter(SimpleXMLElement $filterColumn, Column $column): void
    {
        if ($filterColumn->top10) {
>>>>>>> forked/LAE_400_PACKAGE
            $column->setFilterType(Column::AUTOFILTER_FILTERTYPE_TOPTENFILTER);
            //    We should only ever have one top10 filter
            foreach ($filterColumn->top10 as $filterRule) {
                $column->createRule()->setRule(
                    (
                        ((isset($filterRule['percent'])) && ((string) $filterRule['percent'] === '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_PERCENT
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BY_VALUE
                    ),
                    (string) $filterRule['val'],
                    (
                        ((isset($filterRule['top'])) && ((string) $filterRule['top'] === '1'))
                        ? Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_TOP
                        : Rule::AUTOFILTER_COLUMN_RULE_TOPTEN_BOTTOM
                    )
                )->setRuleType(Rule::AUTOFILTER_RULETYPE_TOPTENFILTER);
            }
        }
    }
}
