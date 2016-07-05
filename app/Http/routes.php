<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //$projects = \App\Project::all();
    return view('welcome');
    //->with('projects', $projects);
});

//API routes

Route::group(['prefix' => 'api/v1'], function() {

    /*
     * Métodos públicos
     */

    // Autenticação de tokens
    Route::post('authenticate', 'ApiAuthenticateController@authenticate');

    Route::post('users', ['as' => 'post.users', 'uses' => 'UsersController@postUser']);
    Route::get('courses', ['as' => 'get.courses', 'uses' => 'CoursesController@getAll']);

    Route::group(['middleware' => 'jwt.auth'], function () {
        /*
         * Routes para os Users.
         */
        // URL: /users ALIAS INTERNO: 'get.users' CONTROLADOR: UsersController FUNÇÃO: getAll
        Route::get('users', ['as' => 'get.users', 'uses' => 'UsersController@getAll']);
        Route::get('users/{identification}', ['as' => 'get.users.single', 'uses' => 'UsersController@getUser']);
        Route::put('users/{identification}', ['as' => 'put.users', 'uses' => 'UsersController@putUser']);
        Route::delete('users/{identification}', ['as' => 'delete.users', 'uses' => 'UsersController@deleteUser']);
        //Event_User table routes
        Route::post('users/{identification}/events/{event_id}', ['as' => 'post.users.events', 'uses' => 'UsersController@postEvent']);
        Route::delete('users/{identification}/events/{event_id}', ['as' => 'delete.users.events', 'uses' => 'UsersController@deleteEvent']);
        //Project_User table routes
        Route::post('users/{identification}/projects/{project_id}', ['as' => 'post.users.projects', 'uses' => 'UsersController@postProject']);
        Route::delete('users/{identification}/projects/{project_id}', ['as' => 'delete.users.projects', 'uses' => 'UsersController@deleteProject']);
        //Organization_User
        Route::post('users/{identification}/organizations/{organization_id}', ['as' => 'post.users.organizations', 'uses' => 'UsersController@postOrganization']);
        Route::delete('users/{identification}/organizations/{organization_id}', ['as' => 'delete.users.organizations', 'uses' => 'UsersController@deleteOrganization']);
        //Programming_Language_User
        Route::post('users/{identification}/programming_languages/{programming_language_id}', ['as' => 'post.users.programming_languages', 'uses' => 'UsersController@postProgrammingLanguage']);
        Route::delete('users/{identification}/programming_languages/{programming_language_id}', ['as' => 'delete.users.programming_languages', 'uses' => 'UsersController@deleteProgrammingLanguage']);

        /*
         * Roles Routes
         */
        Route::get('roles', ['as' => 'get.roles', 'uses' => 'RolesController@getAll']);
        Route::get('roles/{id}', ['as' => 'get.roles.single', 'uses' => 'RolesController@getRole']);
        Route::post('roles', ['as' => 'post.roles', 'uses' => 'RolesController@postRole']);
        Route::put('roles/{id}', ['as' => 'put.roles', 'uses' => 'RolesController@putRole']);
        Route::delete('roles/{id}', ['as' => 'delete.roles', 'uses' => 'RolesController@deleteRole']);

        /*
         * Courses Routes
         */
        Route::get('courses/{id}', ['as' => 'get.courses.single', 'uses' => 'CoursesController@getCourse']);
        Route::post('courses', ['as' => 'post.courses', 'uses' => 'CoursesController@postCourse']);
        Route::put('courses/{id}', ['as' => 'put.courses', 'uses' => 'CoursesController@putCourse']);
        Route::delete('courses/{id}', ['as' => 'delete.courses', 'uses' => 'CoursesController@deleteCourse']);

        /*
         * Requisitions Routes
         */
        Route::get('requisitions', ['as' => 'get.requisitions', 'uses' => 'RequisitionsController@getAll']);
        Route::get('requisitions/{id}', ['as' => 'get.requisitions.single', 'uses' => 'RequisitionsController@getRequisition']);
        Route::post('requisitions', ['as' => 'post.requisitions', 'uses' => 'RequisitionsController@postRequisition']);
        Route::put('requisitions/{id}', ['as' => 'put.requisitions', 'uses' => 'RequisitionsController@putRequisition']);
        Route::delete('requisitions/{id}', ['as' => 'delete.requisitions', 'uses' => 'RequisitionsController@deleteRequisition']);
        //requisitions_materials table
        Route::post('requisitions/{id}/materials', ['as' => 'post.requisitions.materials', 'uses' => 'RequisitionsController@postMaterials']);

        /*
         * Programming_Languages Routes
         */
        Route::get('programming_languages', ['as' => 'get.programming_languages', 'uses' => 'ProgrammingLanguagesController@getAll']);
        Route::get('programming_languages/{id}', ['as' => 'get.programming_languages.single', 'uses' => 'ProgrammingLanguagesController@getProgrammingLanguage']);
        Route::post('programming_languages', ['as' => 'post.programming_languages', 'uses' => 'ProgrammingLanguagesController@postProgrammingLanguage']);
        Route::put('programming_languages/{id}', ['as' => 'put.programming_languages', 'uses' => 'ProgrammingLanguagesController@putProgrammingLanguage']);
        Route::delete('programming_languages/{id}', ['as' => 'delete.programming_languages', 'uses' => 'ProgrammingLanguagesController@deleteProgrammingLanguage']);

        /*
         * Organizations Routes
         */
        Route::get('organizations', ['as' => 'get.organizations', 'uses' => 'OrganizationsController@getAll']);
        Route::get('organizations/{id}', ['as' => 'get.organizations.single', 'uses' => 'OrganizationsController@getOrganization']);
        Route::post('organizations', ['as' => 'post.organizations', 'uses' => 'OrganizationsController@postOrganization']);
        Route::put('organizations/{id}', ['as' => 'put.organizations', 'uses' => 'OrganizationsController@putOrganization']);
        Route::delete('organizations/{id}', ['as' => 'delete.organizations', 'uses' => 'OrganizationsController@deleteOrganization']);

        /*
         * Materials Routes
         */
        Route::get('materials', ['as' => 'get.materials', 'uses' => 'MaterialsController@getAll']);
        Route::get('materials/{id}', ['as' => 'get.materials.single', 'uses' => 'MaterialsController@getMaterial']);
        Route::post('materials', ['as' => 'post.materials', 'uses' => 'MaterialsController@postMaterial']);
        Route::put('materials/{id}', ['as' => 'put.materials', 'uses' => 'MaterialsController@putMaterial']);
        Route::delete('materials/{id}', ['as' => 'delete.materials', 'uses' => 'MaterialsController@deleteMaterial']);

        /*
         * Events Routes
         */
        Route::get('events', ['as' => 'get.events', 'uses' => 'EventsController@getAll']);
        Route::get('events/{id}', ['as' => 'get.events.single', 'uses' => 'EventsController@getEvent']);
        Route::post('events', ['as' => 'post.events', 'uses' => 'EventsController@postEvent']);
        Route::put('events/{id}', ['as' => 'put.events', 'uses' => 'EventsController@putEvent']);
        Route::delete('events/{id}', ['as' => 'delete.events', 'uses' => 'EventsController@deleteEvent']);
        //Event_Organization table routes
        Route::post('events/{id}/organizations/{organization_id}', ['as' => 'post.events.organizations', 'uses' => 'EventsController@postOrganization']);
        Route::delete('events/{id}/organizations/{organization_id}', ['as' => 'delete.events.organizations', 'uses' => 'EventsController@deleteOrganization']);

        /*
         * Guests Routes
         */
        Route::get('guests', ['as' => 'get.guests', 'uses' => 'GuestsController@getAll']);
        Route::get('guests/{id}', ['as' => 'get.guests.single', 'uses' => 'GuestsController@getGuest']);
        Route::post('guests', ['as' => 'post.guests', 'uses' => 'GuestsController@postGuest']);
        Route::put('guests/{id}', ['as' => 'put.guests', 'uses' => 'GuestsController@putGuest']);
        Route::delete('guests/{id}', ['as' => 'delete.guests', 'uses' => 'GuestsController@deleteGuest']);
        //Event_Guest table routes
        Route::post('guests/{id}/events/{event_id}', ['as' => 'post.guests.events', 'uses' => 'GuestsController@postEvent']);
        Route::delete('guests/{id}/events/{event_id}', ['as' => 'delete.guests.events', 'uses' => 'GuestsController@deleteEvent']);

        /*
         * Projects Routes
         */
        Route::get('projects', ['as' => 'get.projects', 'uses' => 'ProjectsController@getAll']);
        Route::get('projects/{id}', ['as' => 'get.projects.single', 'uses' => 'ProjectsController@getProject']);
        Route::post('projects', ['as' => 'post.projects', 'uses' => 'ProjectsController@postProject']);
        Route::put('projects/{id}', ['as' => 'put.projects', 'uses' => 'ProjectsController@putProject']);
        Route::delete('projects/{id}', ['as' => 'delete.projects', 'uses' => 'ProjectsController@deleteProject']);
        //Organization_Project table routes
        Route::post('projects/{id}/organizations/{organization_id}', ['as' => 'post.projects.organizations', 'uses' => 'ProjectsController@postOrganization']);
        Route::delete('projects/{id}/organizations/{organization_id}', ['as' => 'delete.projects.organizations', 'uses' => 'ProjectsController@deleteOrganization']);
        //Programming_Language_Project table routs
        Route::post('projects/{id}/programming_languages/{programming_language_id}', ['as' => 'post.projects.programming_languages', 'uses' => 'ProjectsController@postProgrammingLanguage']);
        Route::delete('projects/{id}/programming_languages/{programming_language_id}', ['as' => 'delete.projects.programming_languages', 'uses' => 'ProjectsController@deleteProgrammingLanguage']);
    });

});


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
