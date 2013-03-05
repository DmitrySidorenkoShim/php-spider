<?php
namespace VDB\Spider\Filter\Prefetch;

use VDB\Spider\FilterableURI;
use VDB\URI\HttpURI;
use VDB\Spider\Filter\PreFetchFilter;
use VDB\URI\URI;

/**
 * @author matthijs
 */
class RestrictToBaseUriFilter implements PreFetchFilter
{
    /** @var URI */
    private $seed;

    /**
     * @param string $seed
     */
    public function __construct($seed)
    {
        $this->seed = new HttpURI($seed);
    }

    public function match(FilterableURI $uri)
    {
        /*
         * if the URI does not contain the seed, it is not allowed
         */
        if (false === stripos($uri->toString(), $this->seed->toString())) {
            $uri->setFiltered(true, 'Doesn\'t match base URI');
            return true;
        }

        return false;
    }
}
