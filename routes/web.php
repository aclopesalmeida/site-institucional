<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group([
    'prefix' => '/',
    'middleware' => 'gerirIdioma'
], function() {

    Route::get('', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);
    
    Route::get('/servicos', [
        'uses' => 'ServicosController@index',
        'as' => 'servicos'
    ]);
    
    Route::get('/contactos', [
        'uses' => 'ContactosController@index',
        'as' => 'contactos'
    ]);
    
    Route::post('/contactos',[
        'uses' => 'ContactosController@postIndex',
        'as' => 'contactos'
    ]);
    
    Route::get('/idioma/{idioma}', [
        'uses' => 'HomeController@mudarIdioma',
        'as' => 'mudarIdioma'
    ]);
    Route::get('/blog', [
        'uses' => 'BlogController@index',
        'as' => 'blog.posts'
    ]);

    Route::get('/blog/{post_name}/{post_id}', [
        'uses' => 'BlogController@post',
        'as' => 'blog.post'
    ])->where('post_id', '[0-9]{1,3}');
    
    Route::get('/blog/tags', [
        'uses' => 'BlogController@tags',
        'as' => 'blog.tags'
    ]);

    Route::get('/blog/posts/{tag_name}/{tag_id}', [
        'uses' => 'BlogController@postsPorTag',
        'as' => 'blog.posts_por_tag'
    ])->where('tag_id', '[0-9]{1,3}');


    Route::get('', [
        'prefix' => '/admin',
        'uses' => 'Admin\UtilizadoresController@getLogin',
        'as' => 'admin.home'
    ]);
    Route::post('', [
        'prefix' => '/admin',
        'uses' => 'Admin\UtilizadoresController@postLogin',
        'as' => 'login'
    ]);

    Route::group(['prefix' => '/admin', 
                    'middleware' => 'gerirIdioma'], 
                    function()
    {
        
        Route::get('/logout', [
            'uses' => 'Admin\UtilizadoresController@logout',
            'as' => 'admin.logout',
            'middleware' => 'auth'
        ]);

        Route::get('/utilizadores', [
            'uses' => 'Admin\UtilizadoresController@utilizadores',
            'as' => 'admin.utilizadores',
            'middleware' => 'auth'
        ]);
        Route::get('/utilizadores/criar', [
            'uses' => 'Admin\UtilizadoresController@getRegistar',
            'as' => 'admin.utilizadores.criar',
            'middleware' => 'auth'
        ]);
        Route::post('/utilizadores/criar', [
            'uses' => 'Admin\UtilizadoresController@postRegistar',
            'as' => 'admin.utilizadores.criar',
            'middleware' => 'auth'
        ]);
        Route::get('/utilizadores/editar/{id}',[
            'uses' => 'Admin\UtilizadoresController@getEditar',
            'as' => 'admin.utilizadores.editar',
            'middleware' => 'auth'
        ])->where('id', '[0-9]{1,2}');
        Route::post('/utilizadores/editar/{id}',[
            'uses' => 'Admin\UtilizadoresController@postEditar',
            'as' => 'admin.utilizadores.editar',
            'middleware' => 'auth'
        ])->where('id', '[0-9]{1,2}');
        Route::get('/utilizadores/apagar/{id}',[
            'uses' => 'Admin\UtilizadoresController@getApagar',
            'as' => 'admin.utilizadores.apagar',
            'middleware' => 'auth'
        ])->where('id', '[0-9]{1,2}');
        Route::post('/utilizadores/apagar/{id}',[
            'uses' => 'Admin\UtilizadoresController@postApagar',
            'as' => 'admin.utilizadores.apagar',
            'middleware' => 'auth'
        ])->where('id', '[0-9]{1,2}');

        Route::get('/empresa/editar', [
            'uses' => 'Admin\EmpresasController@getEditar',
            'as' => 'admin.empresa.editar',
            'middleware' => 'auth'
        ]);
        Route::post('/empresa/editar', [
            'uses' => 'Admin\EmpresasController@postEditar',
            'as' => 'admin.empresa.editar',
            'middleware' => 'auth'
        ]);


        Route::get('/servicos', [
            'uses' => 'Admin\ServicosController@index',
            'as' => 'admin.servicos',
            'middleware' => 'auth'
        ]);
        Route::get('/servicos/servico/{servico_id}', [
            'uses' => 'Admin\ServicosController@servico',
            'as' => 'admin.servicos.servico',
            'middleware' => 'auth'
        ]);
        Route::get('/servicos/criar', [
            'uses' => 'Admin\ServicosController@getCriar',
            'as' => 'admin.servicos.criar',
            'middleware' => 'auth'
        ]);
        Route::post('/servicos/criar', [
            'uses' => 'Admin\ServicosController@postCriar',
            'as' => 'admin.servicos.criar',
            'middleware' => 'auth'
        ]);
        Route::get('/servicos/editar/{servico_id}', [
            'uses' => 'Admin\ServicosController@getEditar',
            'as' => 'admin.servicos.editar',
            'middleware' => 'auth'
        ]);
        Route::post('/servicos/editar/{servico_id}', [
            'uses' => 'Admin\ServicosController@postEditar',
            'as' => 'admin.servicos.editar',
            'middleware' => 'auth'
        ]);
        Route::get('/servicos/apagar/{servico_id}', [
            'uses' => 'Admin\ServicosController@getApagar',
            'as' => 'admin.servicos.apagar',
            'middleware' => 'auth'
        ]);
        Route::post('/servicos/apagar/{servico_id}', [
            'uses' => 'Admin\ServicosController@postApagar',
            'as' => 'admin.servicos.apagar',
            'middleware' => 'auth'
        ]);



        Route::get('/posts', [
            'uses' => 'Admin\PostsController@index',
            'as' => 'admin.posts',
            'middleware' => 'auth'
        ]);
        Route::get('/posts/criar', [
            'uses' => 'Admin\PostsController@getCriar',
            'as' => 'admin.posts.criar',
            'middleware' => 'auth'
        ]);
        Route::post('/posts/criar', [
            'uses' => 'Admin\PostsController@postCriar',
            'as' => 'admin.posts.criar',
            'middleware' => 'auth'
        ]);
        // Route::get('/posts/{post_name}/{post_id}', [
        //     'uses' => 'Admin\PostsController@post',
        //     'as' => 'admin.posts.post',
        //     'middleware' => 'auth'
        // ]);
        Route::get('/posts/editar/{post_name}/{post_id}', [
            'uses' => 'Admin\PostsController@getEditar',
            'as' => 'admin.posts.editar',
            'middleware' => 'auth'
        ]);
        Route::post('/posts/editar/{post_name}/{post_id}', [
            'uses' => 'Admin\PostsController@postEditar',
            'as' => 'admin.posts.editar',
            'middleware' => 'auth'
        ]);
        Route::get('/posts/apagar/{post_name}/{post_id}', [
            'uses' => 'Admin\PostsController@getApagar',
            'as' => 'admin.posts.apagar',
            'middleware' => 'auth'
        ]);
        Route::post('/posts/apagar/{post_name}/{post_id}', [
            'uses' => 'Admin\PostsController@postApagar',
            'as' => 'admin.posts.apagar',
            'middleware' => 'auth'
        ]);
        Route::post('/posts/guardarimagem', [
            'uses' => 'Admin\PostsController@postDefinirEnderecoImagem'
        ]);

        Route::get('/tags', [
            'uses' => 'Admin\TagsController@index',
            'as' => 'admin.tags',
            'middleware' => 'auth'
        ]);
        Route::get('/tags/criar', [
            'uses' => 'Admin\TagsController@getCriar',
            'middleware' => 'auth',
            'as' => 'admin.tags.criar'
        ]);
        Route::post('/tags/criar', [
            'uses' => 'Admin\TagsController@postCriar',
            'middleware' => 'auth',
            'as' => 'admin.tags.criar'
        ]);
        Route::get('/tags/editar/{tag_id}', [
            'uses' => 'Admin\TagsController@getEditar',
            'as' => 'admin.tags.editar',
            'middleware' => 'auth'
        ]);
        Route::post('/tags/editar/{tag_id}', [
            'uses' => 'Admin\TagsController@postEditar',
            'as' => 'admin.tags.editar',
            'middleware' => 'auth'
        ]);
        Route::post('/tags/apagar/{tag_id}', [
            'uses' => 'Admin\TagsController@postApagar',
            'as' => 'admin.tags.apagar',
            'middleware' => 'auth'
        ]);
    });
    
    
});


