<?php

namespace App\Service;

use App\Dao\LinkDao;


class LinkService
{

    protected LinkDao $linkDao;

    public function __construct(LinkDao $linkDao)
    {
        $this->linkDao =  $linkDao;
    }


}
