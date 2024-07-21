<?php



Route::group(['middleware'=>['web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath','LangRedirection'],'prefix' => LaravelLocalization::setLocale() ],function(){
    
        
    Route::get('/robots.txt', function () {
            return response(file_get_contents(public_path('robots.txt')), 200)
                ->header('Content-Type', 'text/plain');
        });
        
    Route::get('/sitemap.xml','SiteMapController@index');
    Route::get('/services-sitemap.xml','SiteMapController@services');
    Route::get('/brands-sitemap.xml','SiteMapController@brands');
    Route::get('/categories-sitemap.xml','SiteMapController@categories');
    Route::get('/projects-sitemap.xml','SiteMapController@projects');
    Route::get('/pages-sitemap.xml','SiteMapController@pages');
    Route::get('/blogs-sitemap.xml','SiteMapController@blogs');
    Route::get('/galleryImages-sitemap.xml','SiteMapController@galleryImages');

    Route::get('/lang/{lang}', 'AdminController@setlang');
    Route::get('/','WebsiteController@home');
    Route::get('about-us','WebsiteController@aboutUs')->name('about-us');
    Route::get('contact-us','WebsiteController@contactUs')->name('contact-us');
    Route::post('save/contact-us','WebsiteController@saveContactUs')->name('saveContactUs');
    Route::get('page/{link}','WebsiteController@getPage');

   
    Route::get('service/{link}','WebsiteController@getServiceDetails')->name('get_service_details');
    Route::get('blog/{link}','WebsiteController@getBlogPage');
    Route::get('about-writer/{id}','WebsiteController@getWriter')->name('writer.details');
    Route::get('services','WebsiteController@getservices');
    Route::get('galleryImages','WebsiteController@getGalleryImages');
    Route::get('blogs/{link?}','WebsiteController@getBlogs')->name('get_blogs');
    Route::get('galleryVideos','WebsiteController@getGalleryVideos');
    Route::post('save/comment','WebsiteController@saveComment');


    Route::get('categories','WebsiteController@getCategories');
    Route::get('category/{link}/','WebsiteController@getCategoryProjects');
    Route::get('projects','WebsiteController@getProjects')->name('projects');
    Route::get('developer/{link}/projects','WebsiteController@getDeveloperProjects');
 
  
    Route::get('recommended/projects','WebsiteController@getRecommendedProjects');
     Route::get('project/{link}','WebsiteController@getProjectDetails');
    Route::get('search-for','WebsiteController@projectsSearchResults');
    Route::post('save-career-application','WebsiteController@saveCareerApplication');
    
    Route::get('searchAutoComplete','WebsiteController@autoCompletesearch');
    Route::post('save/training-applications','WebsiteController@saveTrainingApplications');
    
    Route::post('check-certificate','WebsiteController@checkCertificateVerification');
    

    


});


Route::group(['middleware'=>['admin','web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],'prefix'=>LaravelLocalization::setLocale()],function(){
    Route::group(['prefix'=>'admin'],function(){
        Route::get('', 'AdminController@admin');
        Route::get('translations', 'AdminController@translations');
        Route::get('/switch-theme', 'AdminController@switchTheme');
        Route::post('{name}/up/{ids}','AdminController@updatestatus');
        Route::resource('/countries', 'CountryController');
        Route::resource('/regions', 'RegionController');
        Route::resource('/areas', 'AreaController');
        Route::resource('/settings', 'SettingController');
        Route::resource('/writers', 'WriterController');
        Route::resource('/configrations', 'ConfigrationController');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('pages', 'PageController');
        Route::resource('menus', 'MenuController');
        Route::resource('menu-items', 'MenuItemController');
        Route::post('menuTypeValue', 'MenuItemController@menuTypeValue')->name('menuTypeValue');
        Route::resource('intro-sliders', 'IntroSliderController');
        Route::resource('home-sliders', 'HomeSliderController');
        Route::resource('offers-sliders', 'OfferSliderController');
        Route::resource('services', 'ServiceController');
        Route::post('services/uploadImages', 'ServiceController@uploadImages');
        Route::post('services/removeUploadImages', 'ServiceController@removeUploadImages');
        Route::post('services/deleteImege', 'ServiceController@deleteImege');
        Route::get('editAbout','AboutController@editAbout')->name('admin.editAbout');
        Route::PATCH('about/update','AboutController@update')->name('admin.about.update');
        Route::post('menuTypeValue', 'MenuItemController@menuTypeValue')->name('menuTypeValue');
        Route::resource('aboutStrucs', 'AboutStrucController');
        Route::resource('contact-us-messages', 'ContactusController');
        Route::resource('brands', 'BrandController');
        Route::resource('pages', 'PageController');
        Route::resource('blog-categories', 'BlogCategoryController');
        Route::resource('blog-items', 'BlogItemController');
        Route::post('updateFaq', 'BlogItemController@updateFaq')->name('updateFaq');
        Route::post('removeFaq', 'BlogItemController@removeFaq')->name('removeFaq');
        Route::resource('home-images', 'HomeImageController');
        Route::resource('gallery-images', 'GalleryImageController');
        Route::post('gallery-images/deleteImege', 'GalleryImageController@deleteImege');
        Route::post('gallery-images/reorder','GalleryImageController@reorderImeges');
        Route::get('gallery-image/create-pluck','GalleryImageController@createPluck');
        Route::post('gallery-images/uploadImages','GalleryImageController@uploadImages');
        Route::post('gallery-images/removeUploadImages','GalleryImageController@removeUploadImages');
        Route::post('gallery-images/storePluck','GalleryImageController@storePluck');
        Route::resource('members', 'TestimonialController');
        Route::resource('news-letters', 'NewsLetterController');
        Route::resource('projects', 'ProjectController');
        Route::post('projects/changeCategory/{id}', 'ProjectController@changeCategory');
        
        
        Route::post('projects/uploadImages', 'ProjectController@uploadImages');
        Route::post('projects/removeUploadImages', 'ProjectController@removeUploadImages');
        Route::post('projects/deleteImege', 'ProjectController@deleteImege');
        Route::resource('addresses', 'AddressController');
        Route::resource('gallery-videos', 'GalleryVideoController');
        Route::post('gallery-videos/reorder','GalleryVideoController@reorderVideos');
        Route::resource('seo-assistant', 'SeoAssistantContoller');
        Route::resource('faqs', 'FaqController');
        Route::get('editFaq', 'FaqController@editFaq');
        Route::post('storeFaq', 'FaqController@storeFaq');
        Route::post('updateGeneralFaq', 'FaqController@updateGeneralFaq')->name('updateGeneralFaq');
        Route::post('removeGeneralFaq', 'FaqController@removeGeneralFaq')->name('removeGeneralFaq');

        Route::resource('/attributes', 'AttributeController');
        Route::post('removeAttributeValue', 'AttributeController@removeAttributeValue')->name('removeAttributeValue');
        Route::post('updateAttributeValue', 'AttributeController@updateAttributeValue')->name('updateAttributeValue');

        Route::resource('careers', 'CareerController');
        Route::get('careers-applications', 'CareerController@getCareersApplications');
        
        Route::get('/certificate-excel', 'SettingController@certificateExcelView');
        Route::post('saveCertificateRecords', 'SettingController@saveCertificateRecords');

    });
});

//////////// clearing cach and cache config///////
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    return 'DONE'; //Return anything
});

Route::group(['middleware'=>['web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],'prefix' => LaravelLocalization::setLocale() ],function(){
    Auth::routes();
    Route::get('{menu}', 'WebsiteController@menus');
});


