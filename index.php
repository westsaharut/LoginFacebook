<html>
    <head>
        <title>Login Facebook West</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    </head>
    <body>
        <script>
            var bFbStatus = false;
            var fbID = "";
            var fbName = "";
            var fbEmail = "";

            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '392948474479784',
                    cookie     : true,
                    xfbml      : true,
                    version    : 'v2.11'
                });
                FB.AppEvents.logPageView();   
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) { return; }
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));


            function statusChangeCallback(response){

                    if(bFbStatus == false){
                        fbID = response.authResponse.userID;

                        if (response.status == 'connected') {
                            getCurrentUserInfo(response)
                        } else {
                            FB.login(function(response) {
                                if (response.authResponse){
                                    getCurrentUserInfo(response)
                                } else {
                                    console.log('Auth cancelled.')
                                }
                            }, { scope: 'email' });
                        }
                    }

                    bFbStatus = true;
            }

            function getCurrentUserInfo() {
                FB.api('/me?fields=name,email', function(userInfo) {

                    fbName = userInfo.name;
                    fbEmail = userInfo.email;

                    console.log(fbID);
                    console.log(fbName);
                    console.log(fbEmail);
                });
            }

            function checkLoginState() {
                FB.getLoginStatus(function(response) {
                    statusChangeCallback(response);
                });
            }
        </script>
        <div style="padding: 100" align="center">
            <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" scope="public_profile,email" onlogin="checkLoginState();" auto-logout-link="true"></div>
        </div>        
    </body>
</html>