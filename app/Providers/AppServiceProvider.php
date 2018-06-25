<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\IGenericRepository', 'App\Repositories\GenericRepository');
        $this->app->bind('App\Interfaces\IUtilizadorRepository', 'App\Repositories\UtilizadorRepository');
        $this->app->bind('App\Interfaces\IEmpresaRepository', 'App\Repositories\EmpresaRepository');
        $this->app->bind('App\Interfaces\IEmpresaTraducaoRepository', 'App\Repositories\EmpresaTraducaoRepository');
        $this->app->bind('App\Interfaces\IServicoRepository', 'App\Repositories\ServicoRepository');
        $this->app->bind('App\Interfaces\IServicoTraducaoRepository', 'App\Repositories\ServicoTraducaoRepository');
        $this->app->bind('App\Interfaces\IPostRepository', 'App\Repositories\PostRepository');
        $this->app->bind('App\Interfaces\IPostTraducaoRepository', 'App\Repositories\PostTraducaoRepository');
        $this->app->bind('App\Interfaces\ITagRepository', 'App\Repositories\TagRepository');
        $this->app->bind('App\Interfaces\ITagTraducaoRepository', 'App\Repositories\TagTraducaoRepository');
        

    }
}
