<?php

class LoginController extends BaseController {
	
	public function getIndex(){
		return View::make('login');
	}

	public function getGoogle(){
		// get data from input
	    $code = Input::get( 'code' );

	    // get google service
	    $googleService = OAuth::consumer( 'Google' );

	    // check if code is valid

	    // if code is provided get user data and sign in
	    if ( !empty( $code ) ) {

	        // This was a callback request from google, get the token
	        $token = $googleService->requestAccessToken( $code );

	        // Send a request with it
	        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

	        $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
	        echo $message. "<br/>";

	        //Var_dump
	        //display whole array().
	        //dd($result);
	        $user = User::whereEmail($result['email'])->first();
	        if(empty($user)) 
	        	{
	        		$user = new User;
	        		$user->email = $result['email'];
	        		$user->name = $result['name'];
	        		$user->photo = $result['picture'];
	        		$user->active = true;
	        		$user->save();
	        	}
	        Auth::login($user);
	        return Redirect::to('/')->with('message', 'Logged in with Google');
	    }
	    // if not ask for permission first
	    else {
	        // get googleService authorization
	        $url = $googleService->getAuthorizationUri();

	        // return to google login url
	        return Redirect::to( (string)$url );
	    }
	}
}