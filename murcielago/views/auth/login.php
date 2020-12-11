
<!---<h1><?php //echo lang('login_heading');?></h1>
<p><?php //echo lang('login_subheading');?></p>

<div id="infoMessage"><?php //echo $message;?></div>

<?php //echo form_open("auth/login");?>

  <p>
    <?php //echo lang('login_identity_label', 'identity');?>
    <?php //echo form_input($identity);?>
  </p>

  <p>
    <?php //echo lang('login_password_label', 'password');?>
    <?php //echo form_input($password);?>
  </p>

  <p>
    <?php //echo lang('login_remember_label', 'remember');?>
    <?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php //echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php //echo form_close();?>

<p><a href="forgot_password"><?php //echo lang('login_forgot_password');?></a></p> -->
<html lang="en">
<head>
  <!--- Theme Made By www.w3schools.com - No Copyright -->
  <title>STIKES - Banyuwangi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= url_css() ?>assets_kasir/css/AdminLTE.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="<?php echo url_css() ?>assets/js/highcharts.js"></script>
  <link rel="icon" href="<?= url_css() ?>assets_kasir/img/icon_kasir.png" type="image/x-icon"/>

  <style type="text/css">
  .panel{
        box-shadow: 2px 2px 21px -2px #ccc !important;
            border-color: #fff;
            border:0px;
  }
    .panel-warning>.panel-heading {
    color: #fff;
    background-color: #34495e;
    border-color: #faebcc;
}
    .panel-success>.panel-heading {
    color: #ffffff;
    background-color: #00a65a;
    border-color: #d6e9c6;
}
.vertical-align{
  margin: 80px 0px;
}
body{
  background-color: #f3f3f3;
  overflow: hidden;
  background-repeat: no-repeat;
  background-size: cover;
}
.btn-dark{
  background-color: #34495e;
    border-color: #34495e;
    color: #fff;
}
  </style>
</head>
    <body>
<div class="container-fluid vertical-align">

    <div class="row ">
        <div class="col-md-4 col-md-offset-4" style="margin-top:15px;">
            <center>
            <img src="<?php echo url_css() ?>assets_kasir/photos/logo_kasir.png" width="250px">
            </center>
            <br>
            <div class="panel panel-warning" style="border-radius: 0px;">
                <div class="panel-heading" style="border-radius: 0px;"><h4>Login Stikesmart</h4></div>
                <div class="panel-body">
                  <? if(empty($message)){}else{ ?>
                  <div class="alert alert-primary">
                    <p><?= $message ?></p>
                  </div>
                  <? } ?>
                     <div class="form-group">
                        <form method="post" action="<?php echo base_url(); ?>auth/login">
                            <label>Username / Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" name="identity" class="form-control" placeholder="Masukkan Username / Email ...">
                            </div>
                            <br>
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock" style="font-size: 18px;"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password ...">
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-dark btn-flat" style="padding: 7px 35px;" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel-footer">
                  <b>Copyright Stikesmart 2018. All Rights Reserved</b>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
