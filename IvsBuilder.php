<?php


class IvsBuilder
{
    /** @var int|null */
    private $groupsNum;
    /** @var array */
    private $varList;
    /** @var int */
    private $totalVars;
    /** @var mixed */
    private $xMax;
    /** @var mixed */
    private $xMin;

    /**
     * IvsBuilder constructor.
     * @param array $varList
     * @param null|int $numGroups
     */
    public function __construct($varList, $numGroups = null)
    {
        $this->varList = $varList;
        $this->totalVars = count($varList);
        $this->groupsNum = $numGroups ? $numGroups : (int) $this->getNumGroups();
        $this->xMax = max($this->varList);
        $this->xMin = min($this->varList);
    }

    /**
     * @return array
     */
    public function buildIvs()
    {
        $groups = $this->getGroups();
        $resultSet['totalVariants'] = $this->totalVars;
        $resultSet['series'] = $this->fillGroupsByVarsCount($groups);

        return $resultSet;
    }

    /**
     * @return float|int
     */
    private function getNumGroups()
    {
        $log10 =  log10($this->totalVars);
        return round(1 + 3.322 * $log10);
    }

    /**
     * @return int
     */
    private function getIntervalValue()
    {
        $i = ($this->xMax - $this->xMin) / $this->groupsNum;
        return round($i);
    }

    /**
     * @return array
     */
    private function getGroups()
    {
        $groups = [];
        $i = (int)$this->getIntervalValue();

        for ($min = $this->xMin; $min <= $this->xMax; $min += $i) {
//            if ($min+$i <= $this->xMax) {
                $groupUnit = [
                    'minVal' => $min,
                    'maxVal' => $min+$i,
                    'countVars' => 0
                ];
                array_push($groups, $groupUnit);
//            }
        }

        return $groups;
    }

    /**
     * @param array $groups
     * @return array
     */
    private function fillGroupsByVarsCount($groups)
    {
        $tempArr = $this->varList;
        foreach ($groups as &$group) {
            foreach ($tempArr as $key => $tempVal) {
                if ($tempVal >= $group['minVal'] && $tempVal <= $group['maxVal']) {
                    $group['countVars'] += 1;
                    unset($tempArr[$key]);
                }
            }
        }
        return $groups;
    }

}