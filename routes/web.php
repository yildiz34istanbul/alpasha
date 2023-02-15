<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Tracking_Report;
use App\Http\Controllers\TrackingTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\Clients\ClientController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\NewTrackingController;
use App\Http\Controllers\ProductAjaxController;
use App\Http\Livewire\TrackStatus;
use App\Models\User;
use App\Models\Client;
use App\Models\Tracking;
use App\Models\Track_status;
use App\Models\TrackingReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Nexmo\Laravel\Facade\Nexmo;


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


//Route::get('clinet/email/verify', function () {
  //  return view('auth.verify-email');
//})->middleware('auth')->name('client.verification.notice');


Route::fallback(function () {
        //$user=auth('client')->check()?auth('client')->user():auth()->user();
      if (auth('client')->check())
       return redirect()->route('client.dashboard');
        else

       return redirect()->route('dashboard');


   });
   Auth::routes(['verify' => true]);
   Route::get('/password/forgot',[UserController::class,'showForgotForm'])->name('forgot.password.form');
   Route::post('/password/forgot',[UserController::class,'sendResetLink'])->name('forgot.password.link');
   Route::get('/password/reset/{token}',[UserController::class,'showResetForm'])->name('reset.password.form');
   Route::post('/password/reset',[UserController::class,'resetPassword'])->name('reset.password');
   //Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});
Route::group(['middleware' => ['auth:web']], function () {

    Route::get('/confirm-form', function () {
        return view('confirm.form');
    })->name('confirm.form');
    Route::post('/confirm', [\App\Http\Controllers\Auth\LoginController::class, 'confirm'])->name('auth.confirm');

});
Route::group(['middleware' => ['auth:client']], function () {

    Route::get('/client/confirm-form', function () {
        return view('confirm.client-form');
    })->name('client.confirm.form');
    Route::post('/client/confirm', [\App\Http\Controllers\Clients\ClientController::class, 'confirm'])->name('client.auth.confirm');


});

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'confirm']
    ], function () {


    //==============================dashboard============================


    //** Route::view('/track',TrackStatus::class);
    Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
        $id = auth::user()->id;
        $userData = User::find($id);
        $Tracking = Tracking::all();
        $track_st = Tracking::select('*')->where('tacking_status_id', '=', 1)->get();
        $clients = Client::all();
        $users = User::all();
        $Tracking_Archives = Tracking::onlyTrashed()->latest()->count();

        $track_cartons_number = Tracking::select('cartons_number')->sum('cartons_number');
        $track_pieces_number = Tracking::select('pieces_number')->sum('pieces_number');
        $track_invoice_value = Tracking::select('invoice_value')->sum('invoice_value');
        $track_st_Palestine = Tracking::where('country_id', '=', 1)->count();
        $track_st_Jordan = Tracking::where('country_id', '=', 2)->count();
        $track_Emirates = Tracking::where('country_id', '=', 3)->count();
        $track_Saudi = Tracking::where('country_id', '=', 4)->count();
        $track_Kuwait = Tracking::where('country_id', '=', 5)->count();
        $track_Egypt = Tracking::where('country_id', '=', 6)->count();
        $track_QATAR = Tracking::where('country_id', '=', 7)->count();
        $track_SANMARTIN = Tracking::where('country_id', '=', 8)->count();
        $track_USA = Tracking::where('country_id', '=', 9)->count();
        $track_OMAN = Tracking::where('country_id', '=', 10)->count();
        $track_Namibia = Tracking::where('country_id', '=', 11)->count();


        $noty = Auth::user()->unreadNotifications;
        return view('dashboard', compact('userData', 'Tracking', 'track_st', 'noty', 'clients', 'users', 'track_cartons_number', 'track_pieces_number',
            'track_invoice_value', 'track_st_Palestine', 'track_st_Jordan', 'track_Emirates', 'track_Saudi', 'track_Kuwait',
            'track_Egypt', 'track_QATAR', 'track_SANMARTIN','Tracking_Archives','track_USA','track_OMAN','track_Namibia'));
    })->name('dashboard');

   //  Route::fallback(function () {
        //$user=auth('client')->check()?auth('client')->user():auth()->user();
     // if (auth('client')->check())
     //  return redirect()->route('client.dashboard');
     //   else

    //   return redirect()->route('dashboard');


 //  });



    //==============================Trackingk route ============================
    Route::group(['middleware' => ['auth']], function () {
        // Route::get('/track',TrackStatus::class);
        // Route::get('/trackall', [TrackingController::class, 'Status'])->name('Status');
        Route::get('/tracking/all', [TrackingController::class, 'AllTrack'])->name('tracking.all');
        Route::post('/tracking/add', [TrackingController::class, 'AddTrack'])->name('store.tracking');
        Route::get('/tracking/edit/{id}', [TrackingController::class, 'Edit']);
        Route::post('/tracking/update/{id}', [TrackingController::class, 'Update'])->name('Update');
        Route::post('/SoftDelete/track/{id}', [TrackingController::class, 'SoftDelete'])->name('SoftDelete');
        Route::get('/Archives', [TrackingController::class, 'Archives'])->name('Archives');
        Route::post('/delete/track/{id}', [TrackingController::class, 'Delete'])->name('Delete');
        Route::get('/restore/track/{id}', [TrackingController::class, 'Restore']);
        Route::get('/UpdateTracking', [TrackingController::class, 'UpdateTracking'])->name('UpdateTracking');
        Route::get('/tracking/pdf/{id}', [TrackingController::class, 'TrackPdf'])->name('TrackPdf');
        Route::post('/updateall/track', [TrackingController::class, 'Update_all'])->name('update.all');
        Route::post('/tracking/addvalue/{id}', [TrackingController::class, 'AddValue'])->name('add.value');
        Route::post('/tracking/updatvalue/{id}', [TrackingController::class, 'UpdatValuePieces'])->name('Updat.ValuePieces');
        // excel import
        Route::post('/tracking/import/', [TrackingController::class, 'TrackExcelimport'])->name('Track.import');
        /// User Noty //
        Route::get('/notifications', [NotificationsController::class, 'All'])->name('notification.all');
        Route::get('/read/notifications', [NotificationsController::class, 'Read_Notification'])->name('notification.read');
        Route::get('/MarkAsRead', [NotificationsController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');



//==============================status track============================


        //==============================report============================

        Route::get('/report', [Tracking_Report::class, 'index'])->name('report');
        Route::post('Search_tracking', [Tracking_Report::class, 'Search_tracking'])->name('Search_tracking');
        Route::get('/reportnumber', [Tracking_Report::class, 'Report'])->name('reportnumber');
        Route::post('Search_number', [Tracking_Report::class, 'SearchTrackNumber'])->name('SearchTrackNumber');
        Route::get('/tracking-report/pdf/', [Tracking_Report::class, 'TrackReportPdf'])->name('TrackReportPdf');
        // Route::get('/tracking-report/pdf/{id}', [Tracking_Report::class, 'TrackReportPdf'])->name('TrackReportPdf');
        Route::get('/teack-order', [Tracking_Report::class, 'order'])->name('Track.order');
        Route::post('/Search_order', [Tracking_Report::class, 'SearchOrder'])->name('Search.order');
        // Route::get('/search', [Tracking_Report::class, 'orderajax'])->name('orderajax');

        //==============================tracking invoices ============================

        Route::get('/tracking-invoices/{id}', [InvoicesController::class, 'AddInvoices'])->name('add.invoices');
        Route::post('/invoices/add/{id}', [InvoicesController::class, 'InvoicesStore'])->name('store.invoices');
        Route::get('/download', [InvoicesController::class, 'Download_Invoices'])->name('download.invoices');
        Route::post('Delete_invoices', [InvoicesController::class, 'Delete_Invoices'])->name('Delete_Invoices');


        //============================== admin ============================

        Route::get('/Countries', [CountryController::class, 'index'])->name('all.country');
        Route::get('/TrackingType', [TrackingTypeController::class, 'index'])->name('all.TrackingType');
    });
    Route::group(['middleware' => ['auth','isadmin']], function () {

        Route::get('/users', function () {
            $users = DB::table('users')->get();

            return view('users.index', compact('users'));
        })->name('all.user');

        Route::get('/add/user', [UserController::class, 'index'])->name('add.user');

        Route::post('/user/add', [UserController::class, 'store'])->name('store.user');
        Route::post('/user/edit/{id}', [UserController::class, 'edit'])->name('edit.user');
        Route::post('/user/update/{id}', [UserController::class, 'Update'])->name('Update.user');
        Route::post('/delete/user/{id}', [UserController::class, 'Delete'])->name('Delete.user');





        //============================== Client add Show and edit ============================

        Route::get('/clients/show', [AdminClientController::class, 'ClientIndexShow'])->name('all.clients.show');
        Route::post('/clients/add', [AdminClientController::class, 'AddNewClient'])->name('add.clients');
        Route::get('/client/view/{id}', [AdminClientController::class, 'ClientView'])->name('client.view');
        Route::post('/client/active/{id}', [AdminClientController::class, 'ClientActive'])->name('Client.active');
        Route::post('/client/notify/{id}', [AdminClientController::class, 'ClientNotify'])->name('Client.notify');
        Route::post('/client/update/{id}', [AdminClientController::class, 'UpdateClient'])->name('Client.Update');
        Route::post('/delete/client/{id}', [AdminClientController::class, 'DeleteClient'])->name('Delete.Client');
   //============================== Ajax Client add Show and edit ============================
        Route::get('/allclients', [AdminClientController::class, 'ClientsAjaxAll'])->name('ajax.clients.all');
        Route::get('get/clients', [AdminClientController::class, 'GetAllClients'])->name('get.ajax.clients');
        Route::post('/getclientDetails',[AdminClientController::class, 'getClientDetails'])->name('get.client.details');
        Route::post('/activeclinet',[AdminClientController::class, 'ActiveStatus'])->name('update.status');
        Route::post('/client/notify', [AdminClientController::class, 'SendNotify'])->name('Send.notify');

        //============================== Client Account Show and add ============================
        Route::get('/clients/account', [ClientAccountController::class, 'ClientAccountShow'])->name('Account.clients.show');
        Route::post('/clients/account/add/{id}', [ClientAccountController::class, 'AccountAdd'])->name('Account.add');
        //============================== Client Payment ============================
        Route::get('/clients/payment', [ClientAccountController::class, 'ClientPaymentShow'])->name('Payment.clients.show');
        Route::post('/client/payment/add/{id}', [ClientAccountController::class, 'ClientPaymentAdd'])->name('Paument.Account.Add');
        Route::get('/clients/payment/{id}', [ClientAccountController::class, 'PaymentShow'])->name('Payment.show');
        Route::get('/fetchtest', [ClientAccountController::class, 'fetchtest'])->name('fetch');
        Route::post('/fetchtest', [ClientAccountController::class, 'store'])->name('fetch.story');
        Route::get('fetch/listing', [ClientAccountController::class, 'getClient'])->name('fetch.listing');
           ////////
           Route::get('/fetchtrack', [ClientAccountController::class, 'fetchtrack'])->name('fetch.track');
           Route::get('fetch/track2', [ClientAccountController::class, 'getTrack'])->name('get.Track');
           Route::post('/track/delete', [ClientAccountController::class, 'deletet'])->name('trac.delete');
           Route::post('/add/value', [ClientAccountController::class, 'addvaluet'])->name('add.value2');
           Route::post('/edit/track/{id}', [ClientAccountController::class, 'Updatetrc'])->name('Update.trc');
           Route::get('/edittrack/{id}', [ClientAccountController::class, 'EditTrc'])->name('edit.trc');

 //============================== ajax tacking ============================
 Route::get('/getalltracking', [NewTrackingController::class, 'fetchtrack'])->name('ajax.track');
 Route::get('fetch/track', [NewTrackingController::class, 'getTracknew'])->name('get.ajax.Track');
 Route::post('/add/tracking1', [NewTrackingController::class, 'StoreTrack'])->name('ajax.story');
 Route::post('/gettrackDetails',[NewTrackingController::class, 'getTrackDetails'])->name('get.track.details');
 Route::post('/updatevalue',[NewTrackingController::class, 'updateTrackValue'])->name('update.track.value');
 Route::post('/editedetails',[NewTrackingController::class, 'EditeDetailsTrack'])->name('Edite.DetailsTrack');
 Route::post('/updatestatus',[NewTrackingController::class, 'UpdateStetusTrack'])->name('Update.Stetus.track');


        //============================== Countries ============================


        Route::post('/Country/add', [CountryController::class, 'storeCountry'])->name('store.country');
        Route::post('/delete/Country/{id}', [CountryController::class, 'destroyCountry'])->name('Delete.country');


        //============================== track type ============================


        Route::post('/TrackingType/add', [TrackingTypeController::class, 'storeTrackingType'])->name('store.TrackingType');
        Route::post('/delete/TrackingType/{id}', [TrackingTypeController::class, 'destroyTrackingType'])->name('Delete.TrackingType');


    });


     Route::get('/Coun', [CountryController::class, 'testcount'])->name('test.count');

//============================== user profile ============================
    Route::middleware('auth','confirm')->prefix('profile')->group(function () {

        Route::get('/view', [ProfileController::class, 'ProfileView'])->name('ProfileView');

        Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

        Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');

        Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

        Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

    });


    Route::get('/getstut', [TrackingController::class, 'getstut']);


});

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'guest']
    ], function () {
    Route::prefix('client')->group(function () {

        Route::get('/login', [ClientController::class, 'ClientIndex'])->name('client_login_from');
        Route::post('/login/owner', [ClientController::class, 'ClientLogin'])->name('client.login');


        Route::get('/register', [ClientController::class, 'ClientRegister'])->name('client.register');

        Route::post('/register/create', [ClientController::class, 'ClientRegisterCreate'])->name('client.register.create');

    });
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:client','confirm']
    ], function () {
    Route::prefix('client')->group(function () {

        /* ------------- Client Profile -------------- */
        Route::get('/profile/view', [ClientController::class, 'ClientProfileView'])->name('ClientProfile.View');

        Route::get('/profile/edit', [ClientController::class, 'ClientProfileEdit'])->name('Clientprofile.edit');

        Route::post('/profile/store', [ClientController::class, 'ClientProfileStore'])->name('Clientprofile.store');

        Route::get('/password/view', [ClientController::class, 'ClientPasswordView'])->name('Clientpassword.view');

        Route::post('/password/update', [ClientController::class, 'ClientPasswordUpdate'])->name('Clientpassword.update');
        Route::get('/delete/account', [ClientController::class, 'ClientDeleteAccount'])->name('Delete.Account');
        Route::post('/delete/accountclient', [ClientController::class, 'ClientDeleteAccountStore'])->name('ClientDelete.Account');
        Route::get('/delete/message', [ClientController::class, 'DeleteMessage'])->name('Delete.Message');

        Route::get('/dashboard', [ClientController::class, 'ClientDashboard'])->name('client.dashboard');

       /* ------------- Client Notifications Route -------------- */
        Route::get('/Clientnotifications', [NotificationsController::class, 'ClientNotificationsAll'])->name('Client.notification.all');
        Route::get('/read/Clientnotifications', [NotificationsController::class, 'Client_Read_Notification'])->name('Client.notification.read');
        Route::get('/ClientMarkAsRead', [NotificationsController::class, 'ClientMarkAsRead_all'])->name('ClientMarkAsRead_all');
        /* ------------- Client tracking Route -------------- */

        Route::get('/tracking/show', [ClientController::class, 'ClientTrackShow'])->name('Track.show')->middleware('client');
        Route::get('/invoices/show', [ClientController::class, 'ClientinvoiceShow'])->name('invoice.show')->middleware('client');
          Route::get('/trackinvoices/show/{id}', [ClientController::class, 'ClientTrackinvoice'])->name('Track.invoice')->middleware('client');
        Route::get('/payment/show', [ClientController::class, 'ClientPaymentShow'])->name('payment.show')->middleware('client');
        Route::get('/logout',[ClientController::class, 'ClientLogout'])->name('client.logout')->middleware('client');
        Route::get('/reportnumber', [Tracking_Report::class, 'Report'])->name('client.reportnumber');
        Route::post('Search_number', [Tracking_Report::class, 'SearchTrackNumber'])->name('client.SearchTrackNumber');
    });
});


Auth::routes();

Route::get('/sms', [Controller::class, 'indexx']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test2', function () {
    \Illuminate\Support\Facades\Mail::to('lightofdarkness658@gmail.com')->send(new \App\Mail\WelcomeMail('hasan', '55', '55'));
});

Route::get('/cache', function () {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('storage:link');
});
Route::get('storage/{folder}/{date}/{filename}', function ($folder, $date, $filename) {


   $path = storage_path('app/' . $folder . "/" . $date . "/" . $filename);


    if (!File::exists($path)) {
       abort(404);
   }

   $file = File::get($path);
   $type = File::mimeType($path);

  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);

    return $response;
});
Route::get('/test', function () {
    //$nexmo = app('Nexmo\Client');
    $user = User::all();
    foreach ($user as $u) {
       // \App::setLocale($u->locale);
       // $m=__('track.Update track number').' '.$request->tracking_number.' '.__('track.to status').' '.($track->status->Status_Name);
       // event(new NotificationEvent($m,"user", $u->id, $request->tracking_number, $request->tacking_status_id));
       // Mail::to($u->email)->send(new \App\Mail\WelcomeMail($u->name, $request->tracking_number,$track->status->Status_Name,$request->tacking_status_id));
       Nexmo::message()->send([
        'to'=>$u->phone,
        'from'=>'sender',
        'text'=>'code number test ',

    ]);

    }


   // $c = new \App\Events\NotificationEvent("check", "client", 114, 1, 1);
   // event($c);
   // return $c->message;
   return "test sms";

});
