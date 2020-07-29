<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wax\Core\Contracts\AuthorizationRepositoryContract;

class ProfilerPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $profilerGroup = $authRepo->getOrCreateGroup('Profiler');
        $profilerPrivilege = $authRepo->getOrCreatePrivilege('Profiler');
        $adminGroup = $authRepo->getOrCreateGroup('Administrator');

        $authRepo->grant($profilerPrivilege, $profilerGroup);
        $authRepo->grant($profilerPrivilege, $adminGroup);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $profilerPrivilege = $authRepo->getPrivilege('Profiler');
        $adminGroup = $authRepo->getGroup('Administrator');
        $profilerGroup = $authRepo->getGroup('Profiler');

        $authRepo->revoke($profilerPrivilege, $profilerGroup);
        $authRepo->revoke($profilerPrivilege, $adminGroup);

        $profilerPrivilege->delete();
        $profilerGroup->delete();
    }
}
