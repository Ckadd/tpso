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

Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/home', 'FrontEndController@index2')->name('index');

Route::group(['prefix' => 'rss'], function () {
    //news
    Route::get('/{lang}/news/inform.xml', 'RssController@new_inform');
    Route::get('/{lang}/news/institution.xml', 'RssController@new_institution');
    Route::get('/{lang}/news/manager.xml', 'RssController@new_manager');
    Route::get('/{lang}/news/procurement.xml', 'RssController@new_procurement');
    Route::get('/{lang}/news/job-posting.xml', 'RssController@new_jobPosting');
    Route::get('/{lang}/news/calendar.xml', 'RssController@new_calendar');
    //
    Route::get('/{lang}/content-sharing.xml', 'RssController@contentSharing');
    //get feed to web
    Route::get('/info/{id}', 'ReadRssController@getById');

});


Route::get('/reader-rss-list', 'ReadRssController@readRssList');
Route::get('/reader-rss-thumb', 'ReadRssController@readRssThumb');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    Route::get('/department-menus/{id}/edit/')->name('admin.department');
    //languages
    Route::get('language-types', 'LanguageTranslationController@listLanguage')->name('language-types');
    Route::post('language-types', 'LanguageTranslationController@addLanguage')->name('language-types');
    Route::get('language-types/{id}/destroy', 'LanguageTranslationController@destroyLanguage');
    Route::get('languages', 'LanguageTranslationController@index')->name('languages');
    Route::post('translations/update', 'LanguageTranslationController@transUpdate')->name('translation.update.json');
    Route::post('translations/updateKey', 'LanguageTranslationController@transUpdateKey')->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', 'LanguageTranslationController@destroy')->name('translations.destroy');
    Route::post('translations/create', 'LanguageTranslationController@store')->name('translations.create');
    //polls
    Route::get('polls', 'PollController@listPoll')->name('listPoll');
    Route::get('polls/create', 'PollController@createPoll');
    Route::post('polls/create', 'PollController@storePoll');
    Route::get('polls/{id}/edit', 'PollController@editPoll');
    Route::post('polls/{id}/edit', 'PollController@updatePoll');
    //polls question
    Route::get('polls/{id}/questions', 'PollController@listQuestion');
    Route::post('polls/{id}/questions/create', 'PollController@storeQuestionAndAnswer');
    Route::get('polls/{id}/questions/{question_id}/edit', 'PollController@editQuestionAndAnswer');

    Route::get('polls/form/{question_id}/edit-questions', 'PollController@getQuestion');
    Route::post('polls/{poll_id}/{question_id}/questions-update', 'PollController@updateQuestionAndAnswer');
    Route::delete('polls/del/{id}', 'PollController@destroyPoll');
    Route::delete('polls/question/del/{id}', 'PollController@destroyQuestion');
    Route::delete('polls/answer/del/{id}', 'PollController@destroyAnswer');


    //report polls
    Route::get('report-polls', 'ReportPollController@listPoll')->name('report-polls');
    Route::get('report-poll/answers-user/{id}', 'ReportPollController@showPoll');

    //manager related
    Route::get('manager-related/{id}','NewsManagerRelateController@manageRelate')->name('news.manage.relate');
    Route::post('manager-save','NewsManagerRelateController@update')->name('manage.relared.save');
    
    Route::group(['prefix' => 'api'], function () {

        Route::get('theme/{path?}', 'ThemeController@readThemeFile')->name('theme.read-file');
        Route::post('theme', 'ThemeController@updateThemeFile')->name('theme.update-file');
    });

    // custom setting
    Route::put('/custom-settings','Voyager\CustomVoyagerSettingsController@update')->name('custom.settings.update');
});

Route::get('/poll/{slug}','PollController@getPoll');
Route::post('/poll/{slug}/create','PollController@saveAnswer');


Route::get('change/{locale}', function ($locale) {
    Session::put('locale', $locale);
    App:: setLocale($locale);
    return Redirect::back();
});

// route manual

Route::get('/index',function(){
    Theme::set('dot');

    return view('index');
})->name('news'); 
Route::get('/news',function(){
    Theme::set('dot');

    return view('news');
})->name('news');

// Route::get('/contact-us',function(){
//     Theme::set('dot');

//     return view('contact-us');
// })->name('contact-us');

Route::get('/library',function(){
    Theme::set('dot');

    return view('library');
})->name('library');

Route::get('/website-map',function(){
    Theme::set('dot');

    return view('website-map');
})->name('library');

// internal-department
Route::get('/internal-department2',function(){
    Theme::set('dot');

    return view('internal-department.masterindex');
})->name('test');

// Route::get('/ebooks',function(){
//     Theme::set('dot');

//     return view('ebook-views');
// })->name('ebook');

Route::get('/graph',function(){
    Theme::set('dot');

    return view('chart-generater.graph-line1');
})->name('graph.line1');

Route::get('/graph-line2',function(){
    Theme::set('dot');

    return view('chart-generater.graph-line2');
})->name('graph.line2');

Route::get('/graph-line3',function(){
    Theme::set('dot');

    return view('chart-generater.graph-line3');
})->name('graph.line3');

Route::get('/graph-line4',function(){
    Theme::set('dot');

    return view('chart-generater.graph-line4');
})->name('graph.line4');

Route::get('/graph-bar1',function(){
    Theme::set('dot');

    return view('chart-generater.graph-bar1');
})->name('graph.bar1');

Route::get('/graph-bar2',function(){
    Theme::set('dot');

    return view('chart-generater.graph-bar2');
})->name('graph.bar2');

Route::get('/graph-pie1',function(){
    Theme::set('dot');

    return view('chart-generater.graph-pie1');
})->name('graph.pie1');

Route::get('/graph-pie2',function(){
    Theme::set('dot');

    return view('chart-generater.graph-pie2');
})->name('graph.pie2');


Route::get('/graph-organization-bar1',function(){
    Theme::set('dot');

    return view('chart-generater.graph-organization-bar1');
})->name('graph.bar1');

Route::get('/graph-organization-pie1',function(){
    Theme::set('dot');

    return view('chart-generater.graph-organization-pie1');
})->name('graph.pie1');


// Route::get('/graph-generate',function(){
//     Theme::set('dot');

//     return view('graph-generate');
// })->name('graph');

// ----- content-sharing -----
Route::prefix('/content-sharing')->group(function () {
    Route::get('/','ContensharingController@indexContent')->name('content.sharing');
    Route::get('/content-sharing-detail/{id}','ContensharingController@contentDetail')->name('sharing.detail');
    Route::get('/content-share/{id}','ContensharingController@sharesocial')->name('share.social');
    Route::get('/content-share-twitter/{id}','ContensharingController@sharetwitter')->name('share.sharetwitter');
    Route::get('/content-share-googleplus/{id}','ContensharingController@sharegoogleplus')->name('share.sharegplus');
});

// ----- intranet -----
Route::prefix('/intranet')->group(function () {
    Route::get('/','IntranetController@index')->name('intranet');
    Route::get('login','IntranetController@login')->name('intranet.login');
    Route::post('login','IntranetController@checkLogin');
    Route::get('logout','IntranetController@logout')->name('intranet.logout');
});

// ----- annual-budget -----
Route::prefix('/annual-budget')->group(function () {
    Route::get('/{id}','AnnualBudgetController@getIndex');
    Route::get('/download/{id}','AnnualBudgetController@downloadfile')->name('annualbudget.download');
});

// ----- library -----
Route::prefix('/librarys')->group(function () {
    Route::get('/','LibraryController@getIndex');
    Route::get('/detail/{id}','LibraryController@detail')->name('library.detail');
    Route::get('/library-share-facebook/{id}','LibraryController@sharefacebook')->name('library.share.facebook');
    Route::get('/library-share-twitter/{id}','LibraryController@sharetwitter')->name('library.share.twitter');
    Route::get('/library-share-googleplus/{id}','LibraryController@sharegoogleplus')->name('library.share.gplus');
});

// ----- library-view -----
Route::prefix('/library-view')->group(function () {
    Route::get('/{id}','LibraryViewController@contentDetail')->name('library.view');
});

// ----- organizational-structure -----
Route::prefix('/organizational-structure')->group(function () {
    Route::get('/','OrganizationalStructureController@getindex')->name('organization.structure.view');
});

// ----- missionStatement -----
Route::prefix('/mission-statement')->group(function () {
    Route::get('/','MissionStatementController@getindex')->name('mission.view');
    Route::get('/download/{id}','MissionStatementController@download')->name('mission.download');
    Route::get('/mission-statement-share-facebook/{id}','MissionStatementController@sharefacebook')->name('mission.share.facebook');
    Route::get('/mission-statement-share-twitter/{id}','MissionStatementController@sharetwitter')->name('mission.share.twitter');
    Route::get('/mission-statement-share-googleplus/{id}','MissionStatementController@sharegoogleplus')->name('mission.share.gplus');
});

// ----- strategics -----
Route::prefix('/strategic')->group(function () {
    Route::get('/','StrategicController@getindex')->name('strategic.view');
});

// ----- laws -----
Route::prefix('/law-Regulation')->group(function () {
    Route::get('/travel','LawRegulationController@getindextravel')->name('laws.travel.view');
    Route::get('/download/{id}/{type}','LawRegulationController@download')->name('laws.travel.download');
    Route::get('/decree','LawRegulationController@getindexdecree')->name('laws.decree.view');
    Route::get('/ministerial','LawRegulationController@getindexministerial')->name('laws.ministerial.view');
    Route::get('/rule-of-travel','LawRegulationController@getindexruleoftravel')->name('laws.ruleoftravel.view');

    Route::get('/constitution','LawRegulationController@getindexconstitution')->name('laws.constitution.view');
    Route::get('/act','LawRegulationController@getindexact')->name('laws.act.view');
    Route::get('/ordinance','LawRegulationController@getindexordinance')->name('laws.ordinance.view');
    Route::get('/regularity','LawRegulationController@getindexregularity')->name('laws.regularity.view');
    Route::get('/announce','LawRegulationController@getindexannounce')->name('laws.announce.view');

    Route::get('/detail/{id}','LawRegulationController@detail')->name('laws.detail');
    route::get('/downloadFileDetail/{id}/{filename}','LawRegulationController@downloadFile')->name('laws.download');
    Route::get('/department/{id}/{idCategory}','LawRegulationController@department')->name('laws.department');
});

// ----- calendar -----
Route::prefix('/calendar')->group(function () {
    Route::get('/','CalendarDetailController@getindex')->name('calendar.view');
    Route::get('/detail/{id}','CalendarDetailController@detail')->name('calendar.detail');
    Route::get('/search','CalendarDetailController@search')->name('calendar.search');
    Route::get('/calendar-department/{id}','CalendarDetailController@listDataByDepartment')->name('calendar.departmet');
});

// ----- organizeChart -----
Route::prefix('/organize-chart')->group(function () {
    Route::get('/','OrganizeChartController@getindex')->name('organizechart.view');
    Route::get('/detail/{id}','OrganizeChartController@detail')->name('organizechart.detail');
});

// ----- mission-and-authority -----
Route::prefix('/mission-and-authority')->group(function () {
    Route::get('/','MissionAuthorityController@getindex')->name('MissionAuthority.view');
    Route::get('/detail/{id}','MissionAuthorityController@detail')->name('MissionAuthority.detail');

    Route::get('/mission-authority-share-facebook/{id}','MissionAuthorityController@sharefacebook')->name('missionAuthority.share.facebook');
    Route::get('/mission-authority-share-twitter/{id}','MissionAuthorityController@sharetwitter')->name('missionAuthority.share.twitter');
    Route::get('/mission-authority-share-googleplus/{id}','MissionAuthorityController@sharegoogleplus')->name('missionAuthority.share.gplus');
});

// ----- standard-tourism-personnal -----
Route::prefix('/standard-tourism-personnal')->group(function () {
    Route::get('/','StandardTourismPersonnelController@getindex')->name('StandardTourismPersonnel.view');
});

// ----- form-download -----
Route::prefix('/form-download')->group(function () {
    Route::get('/','FormDownloadController@getIndex')->name('formdownload.view');
    Route::get('/download/{id}','FormDownloadController@downloadfile')->name('formdownload.download');
    Route::get('/department/{id}','FormDownloadController@departmentId')->name('formdownload.department.id');
    Route::get('/detail/{id}','FormDownloadController@detail')->name('formdownload.detail');
    route::get('/department-downloadFileDetail/{id}/{filename}','FormDownloadController@departmentIdDownload')->name('form.download.detaildownload');

    Route::get('/department/{id}/{idCategory}','FormDownloadController@Category')->name('formdownload.department.category');
    
});


// ----- faq -----
Route::prefix('/faqs')->group(function () {
    Route::get('/','FaqsController@getIndex')->name('faq.view');
    Route::get('/faq-download/{id}','FaqsController@downloadpdf')->name('faq.downloadPDF');
    Route::get('/sent-mail','FaqsController@sentmailfaq')->name('faq.sentmailfaq');
    Route::post('/search','FaqsController@search')->name('faq.search');

});

// ----- job-post -----
Route::prefix('/job-post')->group(function () {
    Route::get('/','JobpostingController@getIndex')->name('job.view');
    Route::get('/download/{id}','JobpostingController@downloadfile')->name('job.download');
    route::get('/detail/{id}','JobpostingController@detail')->name('job.detail');
    Route::get('/department/{departmentId}','JobpostingController@organization')->name('job.organization');
});

// ----- chart-stat -----
Route::prefix('/chart-stat')->group(function () {
    route::get('/detail/{id}','ChartStatisticController@detail')->name('chart.statistic.detail');

});

// ----- form-generate -----
Route::prefix('/form-generate')->group(function () {
    route::get('/{id}','FormGenerateController@detail')->name('form.generate.detail');
    route::post('add/detail','FormGenerateController@addDetail')->name('form.generate.addDetail');
    Route::get('/export-Excel/{id}','FormGenerateController@exportData')->name('form.generate.export');
});

// ----- newletter subscribe -----
Route::prefix('/newsletter-subscribe')->group(function () {
    route::get('/add-mail','NewSletterSubScribesController@addmail')->name('newsletter.subscribe.addmail');
    route::get('/edit-newsletter/{id}','NewSletterSubScribesController@editnewletter')->name('editnewletter.subscribe.editmail');
    route::get('/update-newsletter','NewSletterSubScribesController@updatenewletter')->name('updatenewletter.subscribe.updatemail');

    route::get('/add-mail/backend','NewSletterSubScribesController@addmailBackend')->name('newsletter.subscribe.addmailbackend');
    route::get('/sent-mail-category/backend','NewSletterSubScribesController@sentnewletterCategory')->name('newsletter.subscribe.sentNewsLetter');
    route::get('/sent-mail-subscribe/backend','NewSletterSubScribesController@sentnewletterCategorybyemail')->name('newsletter.subscribe.ByEmail');

});

// ----- ebook -----
Route::prefix('/ebooks')->group(function () {
    route::get('/','EbookCategoryController@getIndex')->name('ebooks.list');
    route::get('/ebooks-group/{id}','EbookCategoryController@ebookGroup')->name('ebooks.group');
    route::get('/ebooks-view/{id}','EbookCategoryController@ebookView')->name('ebooks.view');    
    route::get('/testEbook','EbookCategoryController@testEbook')->name('ebooks.list');

    Route::get('/ebooks-department/{idDepartment}/{idCategory}','EbookCategoryController@ebookDepartment')->name('ebooks.organization.category');
    Route::get('/ebooks-department/{idDepartment}','EbookCategoryController@allGroupByOrganization');
});

// ----- article -----
Route::prefix('/article')->group(function () {
    route::get('/{id}','ArticleController@detail')->name('article.detail');
});

// ----- Pages {freestyle} -----
Route::prefix('pages')->group(function () {
    route::get('/{id}','PagesController@listDataById')->name('pages.data');
});


// ----- news -----
Route::prefix('/news')->group(function () {
    Route::get('/inform','NewsController@pressReleases')->name('news.inform');
    route::get('/inform/detail/{id}','NewsController@pressReleasesDetail')->name('news.inform.detail');
    Route::get('/inform-share-facebook/{id}','NewsController@informsharefacebook')->name('inform.share.facebook');
    Route::get('/inform-share-twitter/{id}','NewsController@informsharetwitter')->name('inform.share.twitter');
    Route::get('/inform-share-googleplus/{id}','NewsController@informsharegoogleplus')->name('inform.share.gplus');
    route::get('/inform-downloadFileDetail/{id}/{filename}','NewsController@informDetailDownload')->name('news.inform.detaildownload');
    Route::get('/inform-department/{id}','NewsController@informDepartmentId')->name('new.inform.departmet');

    route::get('/institution','NewsController@institution')->name('news.institution');
    route::get('/institution-detail/{id}','NewsController@institutionDetail')->name('news.institution.detail');
    route::get('/institution/download/{id}','NewsController@downloadinstitution')->name('news.institution.download');
    route::get('/institution-downloadFileDetail/{id}/{filename}','NewsController@institutionDetailDownload')->name('news.institution.detaildownload');
    Route::get('/institution-department/{id}','NewsController@institutionDepartmentId')->name('new.institution.departmet');

    route::get('/manager','NewsController@manager')->name('news.manager');
    route::get('/manager/detail/{id}','NewsController@managerDetail')->name('news.manager.detail');
    Route::get('/manager-share-facebook/{id}','NewsController@managersharefacebook')->name('manager.share.facebook');
    Route::get('/manager-share-twitter/{id}','NewsController@managersharetwitter')->name('manager.share.twitter');
    Route::get('/manager-share-googleplus/{id}','NewsController@managersharegoogleplus')->name('manager.share.gplus');
    route::get('/manager-downloadFileDetail/{id}/{filename}','NewsController@managerDetailDownload')->name('news.manager.detaildownload');
    Route::get('/manager-department/{id}','NewsController@managerDepartmentId')->name('new.manager.departmet');

    route::get('/procurement','NewsController@procurement')->name('news.procurement');
    route::get('/procurement-detail/{id}','NewsController@procurementDetail')->name('news.procurement.detail');
    route::get('/procurement-downloadFileDetail/{id}/{filename}','NewsController@procurementDetailDownload')->name('news.procurement.detaildownload');
    route::get('/procurement-download/{id}','NewsController@procurementdownload')->name('news.procurement.download');
    Route::get('/procurement-share-facebook/{id}','NewsController@procurementsharefacebook')->name('procurement.share.facebook');
    Route::get('/procurement-share-twitter/{id}','NewsController@procurementsharetwitter')->name('procurement.share.twitter');
    Route::get('/procurement-share-googleplus/{id}','NewsController@procurementsharegoogleplus')->name('procurement.share.gplus');

    Route::get('/another/detail/{id}','NewsController@anotherDetail')->name('news.another.detail');
    Route::get('/another/download/{id}','NewsController@anotherDownload')->name('news.another.download');
    Route::get('/another/{organizationId}/{categoryId}','NewsController@another')->name('news.another');
    
    Route::get('/internal-audit-plan/department/{id}/{idCategory}','NewsController@internalAuditPlan')->name('internal.audit.plant');
    Route::get('/internal-audit-plan/detail/{id}/{idCategory}','NewsController@internalDetail')->name('internal.detail');
    Route::get('/internal-share-facebook/{id}/{idCategory}','NewsController@internalDetailsharefacebook')->name('internal.share.facebook');
    Route::get('/internal-share-twitter/{id}/{idCategory}','NewsController@internalDetailsharetwitter')->name('internal.share.twitter');

    Route::get('/guide','NewsController@guide')->name('news.guide');
    Route::get('/guide-detail/{id}','NewsController@guideDetail')->name('news.guide.detail');
    Route::get('/guide/download/{id}','NewsController@downloadGuideFirstFile')->name('news.guide.download');
    Route::get('/guide-downloadFileDetail/{id}/{filename}','NewsController@guideDetailDownload')->name('news.guide.detaildownload');
});

// Route::get('/intranet-login',function(){
//     Theme::set('dot');
//     return view('intranet-login');
// });

// ----- knowledgebase -----
Route::prefix('/tourism-services-standard')->group(function () {
    Route::get('/','KnowledgebaseController@getIndex')->name('knowledgebase.list');
    Route::get('/detail/{id}','KnowledgebaseController@detail')->name('knowledgebase.detail');
});

// ----- LandmarkStandard มาตรฐานแหล่งท่องเที่ยว-----
Route::prefix('/landmark-standard')->group(function () {
    Route::get('/','LandmarkStandardController@getIndex')->name('landmarkstandard.list');
    Route::get('/detail/{id}','LandmarkStandardController@detail')->name('landmarkstandard.detail');
});

// ----- Tour business registration standard -----
Route::prefix('/tour-business-registration-standard')->group(function () {
    Route::get('/','TourStandardController@getIndex')->name('tourstandard.list');
    Route::get('/detail/{id}','TourStandardController@detail')->name('tourstandard.detail');
});

// ----- Library book -----
Route::prefix('/library-book')->group(function () {
    Route::get('/','LibraryBookController@getIndex')->name('librarybook.list');
    Route::get('/detail/{id}','LibraryBookController@detail')->name('librarybook.detail');

    Route::get('/library-category','LibraryBookController@getCategory')->name('librarybook.category');
    Route::get('/library-category/{id}','LibraryBookController@getDataById')->name('librarybook.category.id');
});

// ----- Public Guide -----
Route::prefix('/public-guide')->group(function () {
    Route::get('/','PublicGuideController@getIndex')->name('publicguide.list');
    Route::get('/detail/{id}','PublicGuideController@detail')->name('publicguide.detail');
});

// ----- Travel Tip -----
Route::prefix('/travel-tip')->group(function () {
    Route::get('/','TravelTipController@getIndex')->name('traveltip.list');
    Route::get('/detail/{id}','TravelTipController@detail')->name('traveltip.detail');
});

// ----- internal department -----
Route::prefix('/department')->group(function () {
    Route::get('/','DepartmentController@getIndex')->name('department.list');
    Route::get('/getIndexMaster/{id}','DepartmentController@getIndexMaster');
    Route::get('/{id}','DepartmentController@getDepartmentId')->name('department.id');
});

// ----- contact-us -----
Route::prefix('/contact-us')->group(function () {
    
    Route::get('/','ContactUsController@index');


    Route::post('/send-mail','ContactUsController@sendemail')->name('contactus.sendmail');
});

// ----- graph-generate -----
Route::prefix('/graph-generate')->group(function () {
    Route::get('/{id}','GraphDataController@getDataById')->name('graphdata.byid');
    Route::get('/','GraphDataController@getIndex');
    Route::get('/getLog/{pathname}/{type}/{dbname}','GraphDataController@getLog')->name('graph.type');
    Route::get('/get-AuditLog/{pathname}/{type}/{module}','GraphDataController@getAuditLog')->name('graph.audit.type');
    Route::get('/getLog/organization/{type}','GraphDataController@getLogOraganization')->name('graph.organization');
    Route::get('/getLog-organization/{id}/{type}','GraphDataController@getLogOraganizationId')->name('graph.organizationId');

});

// ----- sitemap -----
Route::prefix('/sitemap')->group(function () {
    Route::get('/genAll','SitemapController@genAll')->name('sitemap.genAll');
});

// ----- search -----
Route::prefix('/search')->group(function () {
    Route::get('/','SearchController@indexSearch')->name('search.index');
    Route::get('/?q={q}&page={page}','SearchController@indexSearch')->name('search.q.page');
});

// ----- search -----
Route::prefix('/solr')->group(function () {
    Route::get('/ping', 'SolariumController@ping');
    Route::get('/reIndex', 'SolariumController@reIndex');
});

// ----- banner -----
Route::prefix('/banner')->group(function () {
    Route::get('/','BannerController@banner');
    Route::get('/linkUrl/{id}','BannerController@getLink')->name('banner.url');
});

Route::prefix('audit-logs')->group(function() {
    Route::get('/{module}','AuditLogController@getModule')->name('auditLog.module');
});

Route::prefix('stat')->group(function() {
    Route::get('/','DotStatDataController@getIndex');
    Route::get('/{id}','DotStatDataController@getDataMenu')->name('dotStat.menuId');
    Route::get('/{id}/search','DotStatDataController@search')->name('dotStat.search');
    Route::get('/download/{id}/{nameFile}','DotStatDataController@download')->name('dotStat.download');
});
