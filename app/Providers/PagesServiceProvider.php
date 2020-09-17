<?php

namespace App\Providers;

use App\Repositories\PagesRepository;
use Illuminate\Database\Eloquent\Model;
use Wax\Pages\Models\Page;
use Wax\Pages\Providers\PagesServiceProvider as WaxPagesServiceProvider;

class PagesServiceProvider extends WaxPagesServiceProvider
{
    public function register()
    {
        parent::register();

        // just want to override this
        $this->app->bind(
            'Wax\Pages\Contracts\PagesRepositoryContract',
            PagesRepository::class
        );

        // and this
        $this->app->when(PagesRepository::class)
            ->needs(Model::class)
            ->give(Page::class);
    }
}
