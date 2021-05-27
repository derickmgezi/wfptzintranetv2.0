<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\User;
use Auth;
use Validator;
use DB;
use App\AccessLog;
use Session;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class LoginController extends Controller{
    /**
     * Redirect the user to the Azure authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(){
        return Socialite::driver('azure')->redirect();
    }

    /**
     * Obtain the user information from Azure.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(){
        $azureuser = Socialite::driver('azure')->user();
        //dd($azureuser);

        //Check if Azure User exists in the Internal Local Database
        $localuser = User::where('email', $azureuser->email)
                         ->where('status',1)
                         ->first();

        if($localuser){
            if(Auth::loginUsingId($localuser->id, true)){
                // Authentication passed...

                $unreadnewsupdates = DB::select("SELECT * FROM news LEFT JOIN (SELECT view_id FROM views WHERE viewed_by = " . Auth::id() . " GROUP BY views.view_id) AS readposts ON readposts.view_id = news.id WHERE readposts.view_id IS NULL  AND status = 1 ORDER BY id DESC");
                session(['unreadnewsupdates' => count($unreadnewsupdates)]);
                
                $unreadstories = DB::select("SELECT * FROM stories LEFT JOIN (SELECT story_id FROM storyviews WHERE viewed_by = ".Auth::id()." GROUP BY storyviews.story_id) AS readstories ON readstories.story_id = stories.id WHERE readstories.story_id IS NULL  AND status = 1 ORDER BY id DESC");
                session(['unreadstories' => count($unreadstories)]);
                
                //Get data from WFP HR API
                // Create a client with a base URI
                $client = new Client([
                    'base_uri' => env('WFP_GLASS_BASE_URI')
                    ]);
                
                // Get Glass User info from API
                //$response = $client->request('GET', '?q=country_iso_code_alpha_3:TZA', [
                //$response = $client->request('GET', '?q=email:william.laswai@wfp.org', [
                $response = $client->request('GET', '?q=email:'.$azureuser->email, [
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.env('WFP_GLASS_BEARER_TOKEN')
                    ],
                //    RequestOptions::QUERY => [
                //        'email' => 'derick.ruganuza@wfp.org'
                //    ]
                ]);
                
                //Get Body will all users
                //dd($response);
                //dd($response->getStatusCode());
                //dd($response->getReasonPhrase());
                //dd($response->getHeaders());
                //dd($response->getBody());
                //dd((string) $response->getBody());
                //dd($response->getBody()->read(10));
                //dd($response->getBody()->getContents());
                
                //Convert JSON Data into an Array
                $array_response = json_decode($response->getBody(), true);
                
                //Convert Array into a collection
                $collection_response = collect($array_response);
                
                //Data
                //dd($collection_response);

                //Multiple Actual User Data
                //$glass_users= collect($collection_response['hits']['hits']);
                
                //Single Actual User Data
                $glass_user= collect($collection_response['hits']['hits'][0]['_source']);
                //dd($glass_user);
                //dd($glass_user->get('nte'));
             
                //Update Local database User details incase they differ with details from Azure
                // if($localuser->country != $azureuser->user['country'] || $localuser->region != $azureuser->user['department']){
                //     $user = User::find($localuser->id);
                //     $user->country = $azureuser->user['country'];
                //     $user->region = $azureuser->user['department'];
                //     $user->save();
                // }

                //Update Local database User nte incase they differ with that from Glass
                if($localuser->nte != $glass_user->get('nte')){
                    $user = User::find($localuser->id);
                    $user->nte = $glass_user->get('nte');
                    $user->title = $glass_user->get('position_title');
                    $user->country = $glass_user->get('country_name');
                    $user->region = $glass_user->get('region_code');
                    $user->save();
                }

                return redirect()->intended(Session::get('intended_url'));
            }
        }else{
            $access_log = new AccessLog;
            $access_log->link_accessed = str_replace(url('/'),"",url()->current());
            $access_log->action_taken = "Sign in to Wazo";
            $access_log->user = $azureuser->user['mailNickname'];
            $access_log->action_details = "Redirected back to Sign in Page; Access Denied";
            $access_log->action_status = "Failed";
            $access_log->save();

            return redirect('/')->with('error', 'Access Denied. Please contact any local IT Officer in Tanzania or send an email to tanzaniza.itservicedesk@wfp.org for support');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
