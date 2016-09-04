<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fire Station</title>
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>assets/css/login.css" rel="stylesheet"/>
    <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
</head>
<body>  
<div class="login-block">
    <h1>Login</h1>
    <form  method="post" action="<?=base_url('login/authenticate')?>"class="form-inline">
            <input type="text" name="username"  id="username" placeholder="Username">
            <span class="text-danger" id ="username" style="display:block; width:100%; font-size:12px;"></span>
            <input type="password" name="password"  id="password" placeholder="Password">
            <span class="text-danger" id ="password" style="display:block; width:100%; font-size:12px;"></span>
        <button type="submit" name="SubmitBTN" id="SubmitBTN">Submit</button>
    </form>
</div>
</body>
</html>