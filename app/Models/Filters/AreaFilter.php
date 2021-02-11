<?php

declare(strict_types=1);

namespace App\Models\Filters;

class AreaFilter implements Filter
{
    /**
     * @var int
     */
    private $minArea;

    /**
     * @var int
     */
    private $maxArea;


    public function __construct(int $minArea, int $maxArea)
    {
        if ($minArea > $maxArea) {
            $this->minArea = $maxArea;
            $this->maxArea = $minArea;
        } else {
            $this->minArea = $minArea;
            $this->maxArea = $maxArea;
        }
    }


    public function getMinArea(): int
    {
        return $this->minArea;
    }


    public function getMaxArea(): int
    {
        return $this->maxArea;
    }
}
