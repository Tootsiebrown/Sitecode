<?php

namespace App\Wax;

use Wax\Maintenance as MaintenanceBase;

class Maintenance extends MaintenanceBase
{
    public function notices()
    {
        $notices = parent::notices();
        // check for additional (custom) notices here--

        return $notices;
    }

    public function runAll()
    {
        parent::runAll();
        // do additional custom tasks here--
    }
}
