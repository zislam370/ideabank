<?php


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Register all the admin routes.
|
*/

Route::group(array('prefix' => 'admin'), function () {

    # Message Management
    Route::group(array('prefix' => 'messages'), function () {
        Route::get('/', array('as' => 'messages', 'uses' => 'Controllers\Admin\MessagesController@getIndex'));
    });

    # Post Management
    Route::group(array('prefix' => 'posts'), function () {
        Route::get('/', array('as' => 'posts', 'uses' => 'PostsController@getIndex'));
        Route::get('priority_list', array('as' => 'priority_list/posts', 'uses' => 'PostsController@getPriorityList'));
        Route::get('{id}/{priority}/set_priority', array('as' => 'set_priority/posts', 'uses' => 'PostsController@setPriority'));
        Route::get('create', array('as' => 'create/post', 'uses' => 'PostsController@getCreate'));
        Route::post('create', 'PostsController@postCreate');
        Route::get('{blogId}/edit', array('as' => 'update/post', 'uses' => 'PostsController@getEdit'));
        Route::post('{blogId}/edit', 'PostsController@postEdit');
        Route::get('{blogId}/delete', array('as' => 'delete/post', 'uses' => 'PostsController@getDelete'));
        Route::get('{blogId}/confirm-delete', array('as' => 'confirm-delete/post', 'uses' => 'PostsController@getModalDelete'));
        Route::get('{blogId}/restore', array('as' => 'restore/post', 'uses' => 'PostsController@getRestore'));
    });

    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
        Route::post('/', array('as' => 'users', 'uses' => 'Controllers\Admin\UsersController@getIndex'));
        Route::get('create', array('as' => 'create/user', 'uses' => 'Controllers\Admin\UsersController@getCreate'));
        Route::post('create', 'Controllers\Admin\UsersController@postCreate');
        Route::get('{userId}/edit', array('as' => 'update/user', 'uses' => 'Controllers\Admin\UsersController@getEdit'));
        Route::post('{userId}/edit', 'Controllers\Admin\UsersController@postEdit');
        Route::get('{userId}/delete', array('as' => 'delete/user', 'uses' => 'Controllers\Admin\UsersController@getDelete'));
        Route::get('{userId}/confirm-delete', array('as' => 'confirm-delete/user', 'uses' => 'Controllers\Admin\UsersController@getModalDelete'));
        Route::get('{userId}/restore', array('as' => 'restore/user', 'uses' => 'Controllers\Admin\UsersController@getRestore'));
        Route::get('{userId}/unsuspend', array('as' => 'unsuspend/user', 'uses' => 'Controllers\Admin\UsersController@getUnsuspend'));
    });

    # Group Management
    Route::group(array('prefix' => 'groups'), function () {
        Route::get('/', array('as' => 'groups', 'uses' => 'Controllers\Admin\GroupsController@getIndex'));
        Route::get('create', array('as' => 'create/group', 'uses' => 'Controllers\Admin\GroupsController@getCreate'));
        Route::post('create', 'Controllers\Admin\GroupsController@postCreate');
        Route::get('{groupId}/edit', array('as' => 'update/group', 'uses' => 'Controllers\Admin\GroupsController@getEdit'));
        Route::post('{groupId}/edit', 'Controllers\Admin\GroupsController@postEdit');
        Route::get('{groupId}/delete', array('as' => 'delete/group', 'uses' => 'Controllers\Admin\GroupsController@getDelete'));
        Route::get('{groupId}/confirm-delete', array('as' => 'confirm-delete/group', 'uses' => 'Controllers\Admin\GroupsController@getModalDelete'));
        Route::get('{groupId}/restore', array('as' => 'restore/group', 'uses' => 'Controllers\Admin\GroupsController@getRestore'));
    });

    # Dashboard
    Route::get('/', array('as' => 'admin', 'uses' => 'Controllers\Admin\DashboardController@getIndex'));

});

# Announcements Management
Route::group(array('prefix' => 'announcements'), function () {
    Route::get('/', array('as' => 'announcements', 'uses' => 'AnnouncementsController@getIndex'));
    Route::get('create', array('as' => 'create/announcement', 'uses' => 'AnnouncementsController@getCreate'));
    Route::post('create', 'AnnouncementsController@postCreate');
    Route::get('{blogId}/edit', array('as' => 'update/announcement', 'uses' => 'AnnouncementsController@getEdit'));
    Route::post('{blogId}/edit', 'AnnouncementsController@postEdit');
    Route::get('{blogId}/delete', array('as' => 'delete/announcement', 'uses' => 'AnnouncementsController@getDelete'));
    Route::get('{blogId}/confirm-delete', array('as' => 'confirm-delete/announcement', 'uses' => 'AnnouncementsController@getModalDelete'));
    Route::get('{blogId}/restore', array('as' => 'restore/announcement', 'uses' => 'AnnouncementsController@getRestore'));
});

/*
|--------------------------------------------------------------------------
| Authentication and Authorization Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'auth'), function () {

    # Login
    Route::get('signin', array('as' => 'signin', 'uses' => 'AuthController@getSignin'));
    Route::post('signin', 'AuthController@postSignin');

    # Register
    Route::get('signup', array('as' => 'signup', 'uses' => 'AuthController@getSignup'));
    Route::post('signup', 'AuthController@postSignup');

    Route::get('organization', array('as' => 'organization', 'uses' => 'AuthController@getSignup'));
    Route::post('organization', 'AuthController@postSignup');

    Route::get('individual', array('as' => 'individual', 'uses' => 'AuthController@getSignup'));
    Route::post('individual', 'AuthController@postSignup');

    # Account Activation
    Route::get('activate/{activationCode}', array('as' => 'activate', 'uses' => 'AuthController@getActivate'));

    # Forgot Password
    Route::get('forgot-password', array('as' => 'forgot-password', 'uses' => 'AuthController@getForgotPassword'));
    Route::post('forgot-password', 'AuthController@postForgotPassword');

    # Forgot Password Confirmation
    Route::get('forgot-password/{passwordResetCode}', array('as' => 'forgot-password-confirm', 'uses' => 'AuthController@getForgotPasswordConfirm'));
    Route::post('forgot-password/{passwordResetCode}', 'AuthController@postForgotPasswordConfirm');

    # Logout
    Route::get('logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

});

/*
|--------------------------------------------------------------------------
| Account Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::group(array('prefix' => 'account'), function () {

    # Account Dashboard
    Route::get('/', array('as' => 'account', 'uses' => 'Controllers\Account\DashboardController@getIndex'));
    Route::get('/dashboard_innovation_status', array('as' => 'dashboard_innovation_status', 'uses' => 'Controllers\Account\DashboardController@dashboard_innovation_status'));
    Route::get('/dashboard_innovation_stats', array('as' => 'dashboard_innovation_stats', 'uses' => 'Controllers\Account\DashboardController@dashboard_innovation_stats'));
    Route::get('/refresh_capdev_stat', array('as' => 'refresh_capdev_stat', 'uses' => 'Controllers\Account\DashboardController@refresh_capdev_stat'));

    Route::get('public', array('as' => 'public', 'uses' => 'PublicDashboardController@getIndex'));

    # Profile
    Route::get('profile', array('as' => 'profile', 'uses' => 'Controllers\Account\ProfileController@getIndex'));
    Route::post('profile', 'Controllers\Account\ProfileController@postIndex');

    # EditProfile
    Route::get('{id}/editprofile', array('as' => 'editprofile', 'uses' => 'EditProfileController@getIndex'));
    Route::post('{id}/editprofile', 'EditProfileController@postIndex');
    # Change Password
    Route::get('change-password', array('as' => 'change-password', 'uses' => 'Controllers\Account\ChangePasswordController@getIndex'));
    Route::post('change-password', 'Controllers\Account\ChangePasswordController@postIndex');

    # Change Email
    Route::get('change-email', array('as' => 'change-email', 'uses' => 'Controllers\Account\ChangeEmailController@getIndex'));
    Route::post('change-email', 'Controllers\Account\ChangeEmailController@postIndex');

    # Change Mobile
    Route::get('change-mobile', array('as' => 'change-mobile', 'uses' => 'Controllers\Account\ChangeMobileController@getIndex'));
    Route::post('change-mobile', 'Controllers\Account\ChangeMobileController@postIndex');

    Route::get('myideas', array('as' => 'myideas', 'uses' => 'IdeasController@getMyIdeas'));
    Route::get('mymessages', array('as' => 'mymessages', 'uses' => 'IdeasController@getMyMessages'));
    Route::get('{id}/ideas', array('as' => 'account/ideas', 'uses' => 'IdeasController@getUserIdeas'));
    Route::get('{id}/ideadetail', array('as' => 'detail/idea', 'uses' => 'IdeasController@getDetailIdea'));

    Route::get('{id}/messages', array('as' => 'account/messages', 'uses' => 'MessagesController@getIndex'));

});

Route::post('upload_image', array('as' => 'upload_image', 'uses' => 'Ck_fileController@postUpload'));



Route::group(array('prefix' => 'user'), function () {
    Route::get('{id}/profile', array('as' => 'user/profile', 'uses' => 'Controllers\Account\ProfileController@getUserProfile'));
    Route::get('{id}/ideas', array('as' => 'user/ideas', 'uses' => 'IdeasController@getUserIdeas'));
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('about-us', function () {
//    //
//    return View::make('frontend/about-us');
//});

Route::get('contact-us', array('as' => 'contact-us', 'uses' => 'ContactUsController@getIndex'));
Route::post('contact-us', 'ContactUsController@postIndex');

Route::get('all_news_media', array('as' => 'all_news_media', 'uses' => 'PostController@getIndex'));

Route::get('all_events', array('as' => 'all_events', 'uses' => 'HomeController@getEventList'));

Route::get('all_ideas', array('as' => 'all_ideas', 'uses' => 'HomeController@getIdeaList'));

Route::get('running_projects', array('as' => 'running_projects', 'uses' => 'Running_projectController@showHome'));

Route::get('sif_awardess', array('as' => 'sif_awardess', 'uses' => 'Sif_awardessController@getIndex'));
Route::post('sif_awardess', 'Sif_awardessController@postIndex');

Route::get('innovation_circle', array('as' => 'innovation_circle', 'uses' => 'Innovation_circleController@getIndex'));
Route::post('innovation_circle', 'Innovation_circleController@postIndex');

Route::get('sif_application', array('as' => 'sif_application', 'uses' => 'Sif_applicationController@getIndex'));
Route::post('sif_application', 'Sif_applicationController@postIndex');

Route::get('asked_question', array('as' => 'asked_question', 'uses' => 'Asked_questionController@getIndex'));
Route::post('asked_question', 'Asked_questionController@postIndex');

Route::get('question_about_sif', array('as' => 'question_about_sif', 'uses' => 'Question_about_sifController@getIndex'));
Route::post('question_about_sif', 'Question_about_sifController@postIndex');

Route::get('cap_dev_awardess', array('as' => 'cap_dev_awardess', 'uses' => 'Cap_dev_awardessController@getIndex'));
Route::post('cap_dev_awardess', 'Cap_dev_awardessController@postIndex');

Route::get('cap_dev_application', array('as' => 'cap_dev_application', 'uses' => 'Cap_dev_applicationController@getIndex'));
Route::post('cap_dev_application', 'Cap_dev_applicationController@postIndex');

Route::get('question_about_cap_dev', array('as' => 'question_about_cap_dev', 'uses' => 'Question_about_cap_devController@getIndex'));
Route::post('question_about_cap_dev', 'Question_about_cap_devController@postIndex');

Route::get('blog/{postSlug}', array('as' => 'view-post', 'uses' => 'PostController@getView'));
Route::post('blog/{postSlug}', 'PostController@postView');

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@showHome'));
Route::get('home', array('as' => 'home', 'uses' => 'HomeController@showHome'));

Route::get('event/{id}', array('as' => 'show-event', 'uses' => 'HomeController@getEventView'));
Route::get('idea/{id}', array('as' => 'show-idea', 'uses' => 'HomeController@getIdeaView'));

Route::get('page/{pageSlug}', array('as' => 'view-page', 'uses' => 'PubPagesController@getView'));

# sif_section
Route::get('innovative_found_by_a2i', array('as' => 'innovative_found_by_a2i', 'uses' => 'Innovative_found_by_a2iController@getIndex'));
Route::post('innovative_found_by_a2i', 'Innovative_found_by_a2iController@postIndex');


# Tweeter Management
Route::group(array('prefix' => 'tweets'), function () {
    Route::get('/', array('as' => 'tweets', 'uses' => 'TweetsController@c'));
    Route::get('create', array('as' => 'create/tweet', 'uses' => 'TweetsController@getCreate'));
    Route::post('create', 'TweetsController@postCreate');
    Route::get('{tweetId}/edit', array('as' => 'update/tweet', 'uses' => 'TweetsController@getEdit'));
    Route::post('{tweetId}/edit', 'TweetsController@postEdit');
    Route::get('{tweetId}/delete', array('as' => 'delete/tweet', 'uses' => 'TweetsController@getDelete'));
    Route::get('{tweetId}/confirm-delete', array('as' => 'confirm-delete/tweet', 'uses' => 'TweetsController@getModalDelete'));
    Route::get('{tweetId}/restore', array('as' => 'restore/tweet', 'uses' => 'TweetsController@getRestore'));
});

# Domain Management
Route::group(array('prefix' => 'domains'), function () {
    Route::get('/', array('as' => 'domains', 'uses' => 'DomainController@getCreate'));
    Route::get('{typeid}/getdomainsbytype', array('as' => 'getdomainsbytype', 'uses' => 'DomainController@getDomainsByType'));
    Route::get('{typeid}/getdomainsbyid', array('as' => 'getdomainsbyid', 'uses' => 'DomainController@getDomainsById'));
    Route::get('create', array('as' => 'create/domain', 'uses' => 'DomainController@getCreate'));
    Route::post('create', 'DomainController@postCreate');
    Route::get('{domainId}/edit', array('as' => 'update/domain', 'uses' => 'DomainController@getEdit'));
    Route::post('{domainId}/edit', 'DomainController@postEdit');
    Route::get('{domainId}/delete', array('as' => 'delete/domain', 'uses' => 'DomainController@getDelete'));
    Route::get('{domainId}/confirm-delete', array('as' => 'confirm-delete/domain', 'uses' => 'DomainController@getModalDelete'));
    Route::get('{domainId}/restore', array('as' => 'restore/domain', 'uses' => 'DomainController@getRestore'));
});

# Idea Mentors
Route::group(array('prefix' => 'cios'), function () {
    Route::get('{ideaid}/ideas', array('as' => 'idea_cios', 'uses' => 'Idea_cioController@getCios'));
    Route::get('{id}/activate', array('as' => 'activate/idea_cios', 'uses' => 'Idea_cioController@getActivate'));
    Route::get('{id}/deactivate', array('as' => 'deactivate/idea_cios', 'uses' => 'Idea_cioController@getDeactivate'));
    Route::get('{ideaid}/create', array('as' => 'create/idea_cios', 'uses' => 'Idea_cioController@getCreate'));
    Route::post('{ideaid}/create', 'Idea_cioController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_cios', 'uses' => 'Idea_cioController@getEdit'));
    Route::post('{id}/edit', 'Idea_cioController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_cios', 'uses' => 'Idea_cioController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_cios', 'uses' => 'Idea_cioController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_cios', 'uses' => 'Idea_cioController@getRestore'));
});

# Idea Mentors
Route::group(array('prefix' => 'mentors'), function () {
    Route::get('{ideaid}/ideas', array('as' => 'idea_mentors', 'uses' => 'Idea_mentorController@getMentors'));
    Route::get('{id}/activate', array('as' => 'activate/idea_mentors', 'uses' => 'Idea_mentorController@getActivate'));
    Route::get('{id}/deactivate', array('as' => 'deactivate/idea_mentors', 'uses' => 'Idea_mentorController@getDeactivate'));
    Route::get('{ideaid}/create', array('as' => 'create/idea_mentors', 'uses' => 'Idea_mentorController@getCreate'));
    Route::post('{ideaid}/create', 'Idea_mentorController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_mentors', 'uses' => 'Idea_mentorController@getEdit'));
    Route::post('{id}/edit', 'Idea_mentorController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_mentors', 'uses' => 'Idea_mentorController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_mentors', 'uses' => 'Idea_mentorController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_mentors', 'uses' => 'Idea_mentorController@getRestore'));
});

# Idea Owners
Route::group(array('prefix' => 'owners'), function () {
    Route::get('{ideaid}/ideas', array('as' => 'idea_owners', 'uses' => 'Idea_ownerController@getOwners'));
    Route::get('{id}/activate', array('as' => 'activate/idea_owners', 'uses' => 'Idea_ownerController@getActivate'));
    Route::get('{id}/deactivate', array('as' => 'deactivate/idea_owners', 'uses' => 'Idea_ownerController@getDeactivate'));
    Route::get('{ideaid}/create', array('as' => 'create/idea_owners', 'uses' => 'Idea_ownerController@getCreate'));
    Route::post('{ideaid}/create', 'Idea_ownerController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_owners', 'uses' => 'Idea_ownerController@getEdit'));
    Route::post('{id}/edit', 'Idea_ownerController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_owners', 'uses' => 'Idea_ownerController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_owners', 'uses' => 'Idea_ownerController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_owners', 'uses' => 'Idea_ownerController@getRestore'));
});

# Messages Management
Route::group(array('prefix' => 'messageses'), function () {
    Route::get('{userId}/', array('as' => 'messageses', 'uses' => 'MessagesController@getIndex'));
    Route::get('create', array('as' => 'create/message', 'uses' => 'MessagesController@getCreate'));
    Route::post('create', 'MessagesController@postCreate');
    Route::get('{senderId}/{receiverId}/view', array('as' => 'view/message', 'uses' => 'MessagesController@getUserMsg'));
    Route::get('{messageType}/submit', array('as' => 'submit/message', 'uses' => 'MessagesController@getSubmit'));
    Route::get('{messageId}/delete', array('as' => 'delete/message', 'uses' => 'MessagesController@getDelete'));
    Route::get('{messageId}/confirm-delete', array('as' => 'confirm-delete/message', 'uses' => 'MessagesController@getModalDelete'));

});

# Subscription Management
Route::group(array('prefix' => 'subscriptions'), function () {
    Route::get('/', array('as' => 'subscriptions', 'uses' => 'SubscriptionController@getIndex'));
    Route::get('create', array('as' => 'create/subscription', 'uses' => 'SubscriptionController@getCreate'));
    Route::post('create', 'SubscriptionController@postCreate');
    Route::get('{subscriptionId}/view', array('as' => 'view/subscription', 'uses' => 'SubscriptionController@getView'));
    Route::get('{subscriptionType}/submit', array('as' => 'submit/subscription', 'uses' => 'SubscriptionController@getSubmit'));
    Route::get('{subscriptionId}/delete', array('as' => 'delete/subscription', 'uses' => 'SubscriptionController@getDelete'));
    Route::get('{subscriptionId}/confirm-delete', array('as' => 'confirm-delete/subscription', 'uses' => 'SubscriptionController@getModalDelete'));

});

# Idea Management
Route::group(array('prefix' => 'ideas'), function () {
    Route::get('/', array('as' => 'ideas', 'uses' => 'IdeasController@getIndex'));
    Route::get('listgrid', array('as' => 'listgrid/idea', 'uses' => 'IdeasController@getListGrid'));
    Route::get('completedideas', array('as' => 'completedideas/ideas', 'uses' => 'IdeasController@getCompletedList'));
    Route::get('completed_list', array('as' => 'completed_list/ideas', 'uses' => 'IdeasController@getPriorityCompletedList'));
    Route::get('upcoming_list', array('as' => 'upcoming_list/ideas', 'uses' => 'IdeasController@getPriorityUpcomingList'));
    Route::get('{id}/{priority}/set_priority', array('as' => 'set_priority/idea', 'uses' => 'IdeasController@setPriority'));
    Route::get('shortlist', array('as' => 'shortlist/idea', 'uses' => 'IdeasController@getShortlist'));
    Route::get('unsortedlist', array('as' => 'unsortedlist/idea', 'uses' => 'IdeasController@getUnsortedList'));
    Route::get('exitedlist', array('as' => 'exitedideas', 'uses' => 'IdeasController@getExitedList'));
    Route::get('{advertId}/submit', array('as' => 'submit/idea', 'uses' => 'IdeasController@getSubmit'));
    Route::post('{advertId}/submit', 'IdeasController@postSubmit');
    Route::get('create', array('as' => 'create/idea', 'uses' => 'IdeasController@getCreate'));
    Route::post('create', 'IdeasController@postCreate');
    Route::get('{ideaId}/view', array('as' => 'view/idea', 'uses' => 'IdeasController@getView'));
    Route::get('{ideaId}/show', array('as' => 'show/idea', 'uses' => 'IdeasController@getShow'));
    Route::get('{ideaId}/detail', array('as' => 'detail', 'uses' => 'IdeasController@getDetail'));
    Route::post('{ideaId}/open', array('as' => 'open/idea', 'uses' => 'IdeasController@setOpen'));
    Route::get('{ideaId}/close', array('as' => 'close/idea', 'uses' => 'IdeasController@setClose'));

    Route::post('{ideaId}/reopen', array('as' => 'reopen/idea', 'uses' => 'IdeasController@setReopen'));
    Route::post('{ideaId}/exit', array('as' => 'exit/idea', 'uses' => 'IdeasController@setExit'));

    Route::get('{ideaId}/edit', array('as' => 'update/idea', 'uses' => 'IdeasController@getEdit'));
    Route::get('{ideaId}/edit', array('as' => 'edit/idea', 'uses' => 'IdeasController@getEdit'));
    Route::post('{ideaId}/edit', 'IdeasController@postEdit');
    Route::get('{ideaId}/sort', array('as' => 'sort/idea', 'uses' => 'IdeasController@getSort'));
    Route::post('{ideaId}/sort', 'IdeasController@postSort');
    Route::get('{ideaId}/delete', array('as' => 'delete/idea', 'uses' => 'IdeasController@getDelete'));
    Route::get('{ideaId}/confirm-delete', array('as' => 'confirm-delete/idea', 'uses' => 'IdeasController@getModalDelete'));
    Route::get('{ideaId}/restore', array('as' => 'restore/idea', 'uses' => 'IdeasController@getRestore'));
});

# Quick_links Management
Route::group(array('prefix' => 'quick_links'), function () {
    Route::get('/', array('as' => 'quick_links', 'uses' => 'Quick_linksController@getIndex'));
    Route::get('create', array('as' => 'create/quick_link', 'uses' => 'Quick_linksController@getCreate'));
    Route::post('create', 'Quick_linksController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/quick_link', 'uses' => 'Quick_linksController@getEdit'));
    Route::post('{id}/edit', 'Quick_linksController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/quick_link', 'uses' => 'Quick_linksController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/quick_link', 'uses' => 'Quick_linksController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/quick_link', 'uses' => 'Quick_linksController@getRestore'));
});

# Pages Management
Route::group(array('prefix' => 'pages'), function () {
    Route::get('/', array('as' => 'pages', 'uses' => 'PagesController@getIndex'));
    Route::get('create', array('as' => 'create/page', 'uses' => 'PagesController@getCreate'));
    Route::post('create', 'PagesController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/page', 'uses' => 'PagesController@getEdit'));
    Route::post('{id}/edit', 'PagesController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/page', 'uses' => 'PagesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/page', 'uses' => 'PagesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/page', 'uses' => 'PagesController@getRestore'));
});

# Banner Management
Route::group(array('prefix' => 'front_banners'), function () {
    Route::get('/', array('as' => 'front_banners', 'uses' => 'Front_bannersController@getIndex'));
    Route::get('create', array('as' => 'create/front_banner', 'uses' => 'Front_bannersController@getCreate'));
    Route::post('create', 'Front_bannersController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/front_banner', 'uses' => 'Front_bannersController@getEdit'));
    Route::post('{id}/edit', 'Front_bannersController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/front_banner', 'uses' => 'Front_bannersController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/front_banner', 'uses' => 'Front_bannersController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/front_banner', 'uses' => 'Front_bannersController@getRestore'));
});

# News-Medias Management
Route::group(array('prefix' => 'newsmedias'), function () {
    Route::get('/', array('as' => 'newsmedias', 'uses' => 'NewsmediasController@getIndex'));
    Route::get('create', array('as' => 'create/newsmedia', 'uses' => 'NewsmediasController@getCreate'));
    Route::post('create', 'NewsmediasController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/newsmedia', 'uses' => 'NewsmediasController@getEdit'));
    Route::post('{id}/edit', 'NewsmediasController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/newsmedia', 'uses' => 'NewsmediasController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/newsmedia', 'uses' => 'NewsmediasController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/newsmedia', 'uses' => 'NewsmediasController@getRestore'));
});

# Event Management
Route::group(array('prefix' => 'events'), function () {
    Route::get('/', array('as' => 'events', 'uses' => 'EventsController@getIndex'));
    Route::get('create', array('as' => 'create/event', 'uses' => 'EventsController@getCreate'));
    Route::post('create', 'EventsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/event', 'uses' => 'EventsController@getEdit'));
    Route::post('{id}/edit', 'EventsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/event', 'uses' => 'EventsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/event', 'uses' => 'EventsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/event', 'uses' => 'EventsController@getRestore'));
});

# Media Management
Route::group(array('prefix' => 'medias'), function () {
    Route::get('/', array('as' => 'medias', 'uses' => 'MediaController@getIndex'));
    Route::get('create', array('as' => 'create/media', 'uses' => 'MediaController@getCreate'));
    Route::post('create', 'MediaController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/media', 'uses' => 'MediaController@getEdit'));
    Route::post('{id}/edit', 'MediaController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/media', 'uses' => 'MediaController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/media', 'uses' => 'MediaController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/media', 'uses' => 'MediaController@getRestore'));
});

# Quick Link Management
Route::group(array('prefix' => 'quick_links'), function () {
    Route::get('/', array('as' => 'quick_links', 'uses' => 'Quick_linksController@getIndex'));
    Route::get('create', array('as' => 'create/quick_link', 'uses' => 'Quick_linksController@getCreate'));
    Route::post('create', 'Quick_linksController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/quick_link', 'uses' => 'Quick_linksController@getEdit'));
    Route::post('{id}/edit', 'Quick_linksController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/quick_link', 'uses' => 'Quick_linksController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/quick_link', 'uses' => 'Quick_linksController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/quick_link', 'uses' => 'Quick_linksController@getRestore'));
});

# Sectors Management
Route::group(array('prefix' => 'sectors'), function () {
    Route::get('/', array('as' => 'sectors', 'uses' => 'SectorsController@getIndex'));
    Route::get('create', array('as' => 'create/sector', 'uses' => 'SectorsController@getCreate'));
    Route::post('create', 'SectorsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/sector', 'uses' => 'SectorsController@getEdit'));
    Route::post('{id}/edit', 'SectorsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/sector', 'uses' => 'SectorsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/sector', 'uses' => 'SectorsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/sector', 'uses' => 'SectorsController@getRestore'));
});

# Sectors Management
Route::group(array('prefix' => 'sif_rounds'), function () {
    Route::get('/', array('as' => 'sif_rounds', 'uses' => 'Sif_roundsController@getIndex'));
    Route::get('create', array('as' => 'create/sif_round', 'uses' => 'Sif_roundsController@getCreate'));
    Route::post('create', 'Sif_roundsController@postCreate');
    Route::get('{sectorId}/edit', array('as' => 'update/sif_round', 'uses' => 'Sif_roundsController@getEdit'));
    Route::post('{sectorId}/edit', 'Sif_roundsController@postEdit');
    Route::get('{sectorId}/delete', array('as' => 'delete/sif_round', 'uses' => 'Sif_roundsController@getDelete'));
    Route::get('{sectorId}/confirm-delete', array('as' => 'confirm-delete/sif_round', 'uses' => 'Sif_roundsController@getModalDelete'));
    Route::get('{sectorId}/restore', array('as' => 'restore/sif_round', 'uses' => 'Sif_roundsController@getRestore'));
});


# Workflow Categories
Route::group(array('prefix' => 'workflow_categories'), function () {
    Route::get('/', array('as' => 'workflow_categories', 'uses' => 'Workflow_categoriesController@getIndex'));
    Route::get('create', array('as' => 'create/workflow_category', 'uses' => 'Workflow_categoriesController@getCreate'));
    Route::post('create', 'Workflow_categoriesController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/workflow_category', 'uses' => 'Workflow_categoriesController@getEdit'));
    Route::post('{id}/edit', 'Workflow_categoriesController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/workflow_category', 'uses' => 'Workflow_categoriesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/workflow_category', 'uses' => 'Workflow_categoriesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/workflow_category', 'uses' => 'Workflow_categoriesController@getRestore'));
});

# Workflow Steps
Route::group(array('prefix' => 'workflow_steps'), function () {
    Route::get('/', array('as' => 'workflow_steps', 'uses' => 'Workflow_stepsController@getIndex'));
    Route::get('{workflowId}/list', array('as' => 'list/workflow_step', 'uses' => 'Workflow_stepsController@getList'));
    Route::get('{workflowId}/create', array('as' => 'create/workflow_step', 'uses' => 'Workflow_stepsController@getCreate'));
    Route::post('{workflowId}/create', 'Workflow_stepsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/workflow_step', 'uses' => 'Workflow_stepsController@getEdit'));
    Route::post('{id}/edit', 'Workflow_stepsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/workflow_step', 'uses' => 'Workflow_stepsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/workflow_step', 'uses' => 'Workflow_stepsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/workflow_step', 'uses' => 'Workflow_stepsController@getRestore'));
});

# Workflow Step Activities
Route::group(array('prefix' => 'workflow_step_activities'), function () {
    Route::get('/', array('as' => 'workflow_step_activities', 'uses' => 'Workflow_step_activitiesController@getIndex'));
    Route::get('{workflowId}/{stepId}/list', array('as' => 'list/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getList'));
    Route::get('{workflowId}/{stepId}/create', array('as' => 'create/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getCreate'));
    Route::post('{workflowId}/{stepId}/create', 'Workflow_step_activitiesController@postCreate');
    Route::post('create', 'Workflow_step_activitiesController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getEdit'));
    Route::post('{id}/edit', 'Workflow_step_activitiesController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/workflow_step_activity', 'uses' => 'Workflow_step_activitiesController@getRestore'));
});

# Idea Steps
Route::group(array('prefix' => 'idea_steps'), function () {
    Route::get('/', array('as' => 'idea_steps', 'uses' => 'Idea_stepsController@getIndex'));
    Route::get('create', array('as' => 'create/idea_step', 'uses' => 'Idea_stepsController@getCreate'));
    Route::post('create', 'Idea_stepsController@postCreate');
    Route::get('{id}/show', array('as' => 'show/idea_step', 'uses' => 'Idea_stepsController@getView'));
    Route::get('{id}/edit', array('as' => 'update/idea_step', 'uses' => 'Idea_stepsController@getEdit'));
    Route::post('{id}/edit', 'Idea_stepsController@postEdit');
    Route::post('{id}/open', array('as' => 'open/idea_step', 'uses' => 'Idea_stepsController@setOpen'));
    Route::post('{id}/close', array('as' => 'close/idea_step', 'uses' => 'Idea_stepsController@setClose'));
    Route::get('{id}/delete', array('as' => 'delete/idea_step', 'uses' => 'Idea_stepsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_step', 'uses' => 'Idea_stepsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_step', 'uses' => 'Idea_stepsController@getRestore'));
});

# Idea Step Activities
Route::group(array('prefix' => 'idea_step_activities'), function () {
    Route::get('/', array('as' => 'idea_step_activities', 'uses' => 'Idea_step_activitiesController@getIndex'));
    Route::get('create', array('as' => 'create/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getCreate'));
    Route::post('create', 'Idea_step_activitiesController@postCreate');
    Route::get('{id}/show', array('as' => 'show/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getView'));
    Route::get('{id}/edit', array('as' => 'update/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getEdit'));
    Route::post('{id}/edit', 'Idea_step_activitiesController@postEdit');
    Route::post('{id}/achieve', array('as' => 'achieve/idea_step_activity', 'uses' => 'Idea_step_activitiesController@setAchieve'));
    Route::post('{id}/open', array('as' => 'open/idea_step_activity', 'uses' => 'Idea_step_activitiesController@setOpen'));
    Route::post('{id}/close', array('as' => 'close/idea_step_activity', 'uses' => 'Idea_step_activitiesController@setClose'));
    Route::get('{id}/delete', array('as' => 'delete/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_step_activity', 'uses' => 'Idea_step_activitiesController@getRestore'));
});


# Activity Forms
Route::group(array('prefix' => 'activity_forms'), function () {
    Route::get('/', array('as' => 'activity_forms', 'uses' => 'Activity_formsController@getIndex'));
    Route::get('create', array('as' => 'create/activity_form', 'uses' => 'Activity_formsController@getCreate'));
    Route::post('create', 'Activity_formsController@postCreate');
    Route::get('{form_id}/{activity_id}/view', array('as' => 'activity_form_view', 'uses' => 'Activity_formsController@getView'));
    Route::get('{id}/edit', array('as' => 'update/activity_form', 'uses' => 'Activity_formsController@getEdit'));
    Route::post('{id}/edit', 'Activity_formsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/activity_form', 'uses' => 'Activity_formsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/activity_form', 'uses' => 'Activity_formsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/activity_form', 'uses' => 'Activity_formsController@getRestore'));
});


# Idea Step History
Route::group(array('prefix' => 'idea_step_histories'), function () {
    Route::get('/', array('as' => 'idea_step_histories', 'uses' => 'Idea_step_historiesController@getIndex'));
    Route::get('create', array('as' => 'create/idea_step_history', 'uses' => 'Idea_step_historiesController@getCreate'));
    Route::post('create', 'Idea_step_historiesController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_step_history', 'uses' => 'Idea_step_historiesController@getEdit'));
    Route::post('{id}/edit', 'Idea_step_historiesController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_step_history', 'uses' => 'Idea_step_historiesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_step_history', 'uses' => 'Idea_step_historiesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_step_history', 'uses' => 'Idea_step_historiesController@getRestore'));
});

# Idea Step Activities History
Route::group(array('prefix' => 'idea_step_activity_histories'), function () {
    Route::get('/', array('as' => 'idea_step_activity_histories', 'uses' => 'Idea_step_activity_historiesController@getIndex'));
    Route::get('create', array('as' => 'create/idea_step_activity_history', 'uses' => 'Idea_step_activity_historiesController@getCreate'));
    Route::post('create', 'Idea_step_activity_historiesController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_step_activity_history', 'uses' => 'Idea_step_activity_historiesController@getEdit'));
    Route::post('{id}/edit', 'Idea_step_activity_historiesController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_step_activity_history', 'uses' => 'Idea_step_activity_historiesController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_step_history', 'uses' => 'Idea_step_activity_historiesController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_step_activity_history', 'uses' => 'Idea_step_activity_historiesController@getRestore'));
});

# Idea Capitalizations
Route::group(array('prefix' => 'idea_capitalizations'), function () {
    Route::get('/', array('as' => 'idea_capitalizations', 'uses' => 'Idea_capitalizationsController@getIndex'));
    Route::get('create', array('as' => 'create/idea_capitalization', 'uses' => 'Idea_capitalizationsController@getCreate'));
    Route::post('create', 'Idea_capitalizationsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_capitalization', 'uses' => 'Idea_capitalizationsController@getEdit'));
    Route::post('{id}/edit', 'Idea_capitalizationsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_capitalization', 'uses' => 'Idea_capitalizationsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_capitalization', 'uses' => 'Idea_capitalizationsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_capitalization', 'uses' => 'Idea_capitalizationsController@getRestore'));
});

# Form Lookup
Route::group(array('prefix' => 'form_lookups'), function () {
    Route::get('/', array('as' => 'form_lookups', 'uses' => 'Form_lookupsController@getIndex'));
    Route::get('create', array('as' => 'create/form_lookup', 'uses' => 'Form_lookupsController@getCreate'));
    Route::post('create', 'Form_lookupsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/form_lookup', 'uses' => 'Form_lookupsController@getEdit'));
    Route::post('{id}/edit', 'Form_lookupsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/form_lookup', 'uses' => 'Form_lookupsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/form_lookup', 'uses' => 'Form_lookupsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/form_lookup', 'uses' => 'Form_lookupsController@getRestore'));
});

#Form Lookup Data
Route::group(array('prefix' => 'form_lookup_data'), function () {
    Route::get('/', array('as' => 'form_lookup_data', 'uses' => 'Form_lookup_dataController@getIndex'));
    Route::get('create', array('as' => 'create/form_lookup_data', 'uses' => 'Form_lookup_dataController@getCreate'));
    Route::post('create', 'Form_lookup_dataController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/form_lookup_data', 'uses' => 'Form_lookup_dataController@getEdit'));
    Route::post('{id}/edit', 'Form_lookup_dataController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/form_lookup_data', 'uses' => 'Form_lookup_dataController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/form_lookup_data', 'uses' => 'Form_lookup_dataController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/form_lookup_data', 'uses' => 'Form_lookup_dataController@getRestore'));
});

# Idea Step Activity Attachment
Route::group(array('prefix' => 'idea_step_activity_attachments'), function () {
    Route::get('/', array('as' => 'idea_step_activity_attachments', 'uses' => 'Idea_step_activity_attachmentsController@getIndex'));
    Route::get('{id}/create', array('as' => 'create/idea_step_activity_attachment', 'uses' => 'Idea_step_activity_attachmentsController@getCreate'));
    Route::post('{id}/create', 'Idea_step_activity_attachmentsController@postCreate');
    Route::get('{id}/edit', array('as' => 'update/idea_step_activity_attachment', 'uses' => 'Idea_step_activity_attachmentsController@getEdit'));
    Route::post('{id}/edit', 'Idea_step_activity_attachmentsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/idea_step_activity_attachment', 'uses' => 'Idea_step_activity_attachmentsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/idea_step_activity_attachment', 'uses' => 'Idea_step_activity_attachmentsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/idea_step_activity_attachment', 'uses' => 'Idea_step_activity_attachmentsController@getRestore'));
});


# Form Concept paper
Route::group(array('prefix' => 'form_concept_papers'), function () {
//    Route::get('/', array('as' => 'form_concept_paper', 'uses' => 'Form_concept_papersController@getIndex'));
    Route::get('{id}', array('as' => 'form_concept_papers', 'uses' => 'Form_concept_papersController@getIndex'));
    Route::post('{id}', array('as' => 'form_concept_papers', 'uses' => 'Form_concept_papersController@postIndex'));
    Route::get('{id}/view', array('as' => 'view/form_concept_papers', 'uses' => 'Form_concept_papersController@getView'));
});

# Form Budget
Route::group(array('prefix' => 'form_budgets'), function () {
    Route::get('{id}', array('as' => 'form_budgets', 'uses' => 'Form_budgetsController@getIndex'));
    Route::post('{id}', array('as' => 'form_budgets', 'uses' => 'Form_budgetsController@postIndex'));
    Route::get('{id}/view', array('as' => 'view/form_budgets', 'uses' => 'Form_budgetsController@getView'));
});

# Form Inventory
Route::group(array('prefix' => 'form_inventories'), function () {
    Route::get('{id}', array('as' => 'form_inventories', 'uses' => 'Form_inventoriesController@getIndex'));
    Route::post('{id}', array('as' => 'form_inventories', 'uses' => 'Form_inventoriesController@postIndex'));
});

# Form Deliverable
Route::group(array('prefix' => 'form_deliverables'), function () {
    Route::get('{id}', array('as' => 'form_deliverables', 'uses' => 'Form_deliverablesController@getIndex'));
    Route::post('{id}', array('as' => 'form_deliverables', 'uses' => 'Form_deliverablesController@postIndex'));
});

# Form Evaluation
Route::group(array('prefix' => 'form_evaluations'), function () {
    Route::get('{id}', array('as' => 'form_evaluations', 'uses' => 'Form_evaluationsController@getIndex'));
    Route::post('{id}', array('as' => 'form_evaluations', 'uses' => 'Form_evaluationsController@postIndex'));
});

# Form Disbursments
Route::group(array('prefix' => 'form_payment_disbursments'), function () {
    Route::get('{id}', array('as' => 'form_payment_disbursments', 'uses' => 'Form_payment_disbursmentsController@getIndex'));
    Route::post('{id}', array('as' => 'form_payment_disbursments', 'uses' => 'Form_payment_disbursmentsController@postIndex'));
});

# Form Payment Schedule
Route::group(array('prefix' => 'form_payment_schedules'), function () {
    Route::get('{id}', array('as' => 'form_payment_schedules', 'uses' => 'Form_payment_schedulesController@getIndex'));
    Route::post('{id}', array('as' => 'form_payment_schedules', 'uses' => 'Form_payment_schedulesController@postIndex'));
});

# Form Stack Holders
Route::group(array('prefix' => 'form_stack_holders'), function () {
    Route::get('{id}', array('as' => 'form_stack_holders', 'uses' => 'Form_stack_holdersController@getIndex'));
    Route::post('{id}', array('as' => 'form_stack_holders', 'uses' => 'Form_stack_holdersController@postIndex'));
});

# Form Visit
Route::group(array('prefix' => 'form_visits'), function () {
    Route::get('{id}', array('as' => 'form_visits', 'uses' => 'Form_visitsController@getIndex'));
    Route::post('{id}', array('as' => 'form_visits', 'uses' => 'Form_visitsController@postIndex'));
});

# Form Fund
Route::group(array('prefix' => 'form_funds'), function () {
    Route::get('{id}', array('as' => 'form_funds', 'uses' => 'Form_fundsController@getIndex'));
    Route::post('{id}', array('as' => 'form_funds', 'uses' => 'Form_fundsController@postIndex'));
});

# Form TCV
Route::group(array('prefix' => 'form_tcvs'), function () {
    Route::get('{id}', array('as' => 'form_tcvs', 'uses' => 'Form_tcvsController@getIndex'));
    Route::post('{id}', array('as' => 'form_tcvs', 'uses' => 'Form_tcvsController@postIndex'));
});

# Form Materials
Route::group(array('prefix' => 'form_materials'), function () {
    Route::get('{id}', array('as' => 'form_materials', 'uses' => 'Form_materialsController@getIndex'));
    Route::post('{id}', array('as' => 'form_materials', 'uses' => 'Form_materialsController@postIndex'));
});

# Form Man-powers
Route::group(array('prefix' => 'form_manpowers'), function () {
    Route::get('{id}', array('as' => 'form_manpowers', 'uses' => 'Form_manpowersController@getIndex'));
    Route::post('{id}', array('as' => 'form_manpowers', 'uses' => 'Form_manpowersController@postIndex'));
});

# Form Scores
Route::group(array('prefix' => 'form_scores'), function () {
    Route::get('{id}', array('as' => 'form_scores', 'uses' => 'Form_scoresController@getIndex'));
    Route::post('{id}', array('as' => 'form_scores', 'uses' => 'Form_scoresController@postIndex'));
});

# Form Times
Route::group(array('prefix' => 'form_times'), function () {
    Route::get('{id}', array('as' => 'form_times', 'uses' => 'Form_timesController@getIndex'));
    Route::post('{id}', array('as' => 'form_times', 'uses' => 'Form_timesController@postIndex'));
});

# Form SP Panels
Route::group(array('prefix' => 'form_sp_panels'), function () {
    Route::get('{id}', array('as' => 'form_sp_panels', 'uses' => 'Form_sp_panelsController@getIndex'));
    Route::post('{id}', array('as' => 'form_sp_panels', 'uses' => 'Form_sp_panelsController@postIndex'));
});

# Form Richtexts
Route::group(array('prefix' => 'form_richtexts'), function () {
//    Route::get('/', array('as' => 'form_richtexts', 'uses' => 'Form_richtextsController@getIndex'));
    Route::get('{id}', array('as' => 'form_richtexts', 'uses' => 'Form_richtextsController@getIndex'));
    Route::post('{id}', array('as' => 'form_richtexts', 'uses' => 'Form_richtextsController@postIndex'));
});

# Form Idea Approval
Route::group(array('prefix' => 'form_idea_approvals'), function () {
//    Route::get('/', array('as' => 'form_idea_approvals', 'uses' => 'Form_idea_approvalsController@getIndex'));
    Route::get('{id}', array('as' => 'form_idea_approvals', 'uses' => 'Form_idea_approvalsController@getIndex'));
    Route::post('{id}', array('as' => 'form_idea_approvals', 'uses' => 'Form_idea_approvalsController@postIndex'));
});

# Form Activities
Route::group(array('prefix' => 'form_activities'), function () {
//    Route::get('/', array('as' => 'form_activities', 'uses' => 'Form_activitiesController@getIndex'));
    Route::get('{id}', array('as' => 'form_activities', 'uses' => 'Form_activitiesController@getIndex'));
    Route::post('{id}', array('as' => 'form_activities', 'uses' => 'Form_activitiesController@postIndex'));
});

# Advertisement
Route::group(array('prefix' => 'advertisements'), function () {
    Route::get('/', array('as' => 'advertisements', 'uses' => 'AdvertisementsController@getIndex'));
    Route::get('priority_list', array('as' => 'priority_list/advertisements', 'uses' => 'AdvertisementsController@getPriorityList'));
    Route::get('{id}/{priority}/set_priority', array('as' => 'set_priority/advertisements', 'uses' => 'AdvertisementsController@setPriority'));
    Route::get('create', array('as' => 'create/advertisement', 'uses' => 'AdvertisementsController@getCreate'));
    Route::post('create', 'AdvertisementsController@postCreate');
    Route::get('{id}/view', array('as' => 'view/advertisement', 'uses' => 'AdvertisementsController@getView'));
    Route::get('{id}/edit', array('as' => 'update/advertisement', 'uses' => 'AdvertisementsController@getEdit'));
    Route::post('{id}/edit', 'AdvertisementsController@postEdit');
    Route::get('{id}/delete', array('as' => 'delete/advertisement', 'uses' => 'AdvertisementsController@getDelete'));
    Route::get('{id}/confirm-delete', array('as' => 'confirm-delete/advertisement', 'uses' => 'AdvertisementsController@getModalDelete'));
    Route::get('{id}/restore', array('as' => 'restore/advertisement', 'uses' => 'AdvertisementsController@getRestore'));
});

# API
Route::group(array('prefix' => 'api'), function () {
    Route::get('ideas', array('as' => 'api/ideas', 'uses' => 'IdeasController@getIdeaList'));
});

