<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Wax\Core\Contracts\AuthorizationRepositoryContract;

class BinsPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $binsGroup = $authRepo->getOrCreateGroup('Bins');
        $binsPrivilege = $authRepo->getOrCreatePrivilege('Bins');
        $adminGroup = $authRepo->getOrCreateGroup('Administrator');

        $authRepo->grant($binsPrivilege, $binsGroup);
        $authRepo->grant($binsPrivilege, $adminGroup);

        User::where('id', '<>', 1)
            ->get()
            ->each(function ($user) use ($authRepo, $binsGroup) {
                $authRepo->addUserToGroup($user, $binsGroup);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $authRepo = app(AuthorizationRepositoryContract::class);

        $binsPrivilege = $authRepo->getOrCreatePrivilege('Bins');
        $adminGroup = $authRepo->getGroup('Administrator');
        $binsGroup = $authRepo->getOrCreateGroup('Bins');

        $authRepo->revoke($binsPrivilege, $adminGroup);
        $authRepo->revoke($binsPrivilege, $binsGroup);

        $binsPrivilege->delete();
        $binsGroup->delete();
    }
}
