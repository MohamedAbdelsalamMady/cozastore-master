<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    
    
    <style>
    /*
Style of Sign In
*/
	.wrap-modal-signin {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
	margin-top: 35px;
}

.container-signin {
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    width: 90%;
    max-width: 400px;
    position: relative;
}

.btn-hide-modal-signin {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #aaa;
}

.signin-form {
    display: flex;
    flex-direction: column;
}

.signin-form-btn {
    background-color: #333;
    color: #fff;
    padding: 15px;
	margin-left: 35%;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    text-transform: uppercase;
    font-weight: bold;
}

.signin-form-btn:hover {
    background-color: #555;
}

.signin-social-item {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #dd4b39;
    color: #fff;
    text-align: center;
    line-height: 40px;
    margin: 10px 5px;
}

.signin-social-item i {
    font-size: 18px;
}

.wrap-input {
    position: relative;
    width: 100%;
}

.wrap-input input {
    width: 100%;
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    padding: 15px;
    font-size: 16px;
}

.wrap-input .focus-input100 {
    position: absolute;
    left: 15px;
    top: 15px;
    pointer-events: none;
    color: #aaa;
    transition: all 0.4s;
}

.wrap-input input:focus + .focus-input100,
.wrap-input input:not(:placeholder-shown) + .focus-input100 {
    top: -10px;
    left: 10px;
    font-size: 12px;
    color: #333;
}

/*
Style of Register and Account
*/

.container-register
 {
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.register-form
 {
    display: flex;
    flex-direction: column;
}

.register-form-btn
 {
    background-color: #333;
    color: #fff;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    text-transform: uppercase;
    font-weight: bold;
}

.register-form-btn:hover
 {
    background-color: #555;
}

.register-social-item,
.signin-social-item {
    display: inline-block;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #dd4b39;
    color: #fff;
    text-align: center;
    line-height: 40px;
    margin: 10px 5px;
}

.register-social-item i,
.signin-social-item i {
    font-size: 18px;
}


.container-account {
    width: 100%;
    max-width: 600px;
    margin: 50px auto;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.account-form {
    display: flex;
    flex-direction: column;
}

.account-form .wrap-input {
    position: relative;
    margin-bottom: 25px;
}

.account-form .label-input100 {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
    display: block;
}

.account-form .input100 {
    width: 100%;
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    padding: 15px;
    font-size: 16px;
    background: #f9f9f9;
    transition: border-color 0.3s ease;
}

.account-form .input100:focus {
    border-color: #333;
    background: #fff;
}

.account-form .container-account-form-btn {
    margin-top: 20px;
}

.account-form .account-form-btn {
    background-color: #333;
    color: #fff;
    padding: 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.account-form .account-form-btn:hover {
    background-color: #555;
}

.account-form .focus-input100 {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #aaa;
    transition: all 0.4s;
}

.account-form .input100:focus + .focus-input100,
.account-form .input100:not(:placeholder-shown) + .focus-input100 {
    top: -10px;
    left: 10px;
    font-size: 12px;
    color: #333;
}
</style>
<!--===============================================================================================-->

