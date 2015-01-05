<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),
        'Google' => array(
    		'client_id'     => '402821806731-bdf87ole30i8450njss5lt6fh4ttn4p2.apps.googleusercontent.com',
    		'client_secret' => 'RQkfzT_Xgw09Bz_VpwGo991M',
    		'scope'         => array('userinfo_email', 'userinfo_profile'),
		),  

	)

);