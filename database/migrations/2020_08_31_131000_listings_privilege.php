<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Wax\Core\Contracts\AuthorizationRepositoryContract;

class ListingsPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $listingsGroup = $authRepo->getOrCreateGroup('Listings');
        $listingsPrivilege = $authRepo->getOrCreatePrivilege('Listings');
        $adminGroup = $authRepo->getOrCreateGroup('Administrator');

        $authRepo->grant($listingsPrivilege, $listingsGroup);
        $authRepo->grant($listingsPrivilege, $adminGroup);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $listingsPrivilege = $authRepo->getOrCreatePrivilege('Listings');
        $adminGroup = $authRepo->getGroup('Administrator');
        $listingsGroup = $authRepo->getOrCreateGroup('Listings');

        $authRepo->revoke($listingsPrivilege, $adminGroup);
        $authRepo->revoke($listingsPrivilege, $listingsGroup);

        $listingsPrivilege->delete();
        $listingsGroup->delete();
    }
}
