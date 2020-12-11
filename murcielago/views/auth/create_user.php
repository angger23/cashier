<!--
<h1><?php //echo lang('create_user_heading');?></h1>
<p><?php //echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php //echo $message;?></div>

<?php //echo form_open("auth/create_user");?>

      <p>
            <?php //echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php //echo form_input($first_name);?>
      </p>

      <p>
            <?php //echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php //echo form_input($last_name);?>
      </p>
      
      <?php
      //if($identity_column!=='email') {
          //echo '<p>';
          //echo lang('create_user_identity_label', 'identity');
          //echo '<br />';
          //echo form_error('identity');
          //echo form_input($identity);
          //echo '</p>';
      //}
      ?>

      <p>
            <?php //echo lang('create_user_company_label', 'company');?> <br />
            <?php //echo form_input($company);?>
      </p>

      <p>
            <?php //echo lang('create_user_email_label', 'email');?> <br />
            <?php //echo form_input($email);?>
      </p>

      <p>
            <?php //echo lang('create_user_phone_label', 'phone');?> <br />
            <?php //echo form_input($phone);?>
      </p>

      <p>
            <?php //echo lang('create_user_password_label', 'password');?> <br />
            <?php //echo form_input($password);?>
      </p>

      <p>
            <?php //echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php //echo form_input($password_confirm);?>
      </p>


      <p><?php //echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php //echo form_close();?>
-->
<div class="container container-table">
    <div class="row vertical-center-row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:15px;">
            <br>
            <div class="panel panel-success">
                <div class="panel-heading"><h4>Tambah Karyawan</h4></div>
                <div class="panel-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo base_url(); ?>auth/create_user">
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Perusahaan</label>
                                <input type="text" name="company2" class="form-control" value="STIKES" disabled>
                                <input type="hidden" name="company" class="form-control" value="STIKES">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>No Hp</label>
                                <input type="number" name="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirm" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Pilih Posisi Karyawan</label>
                                <div class="radio">
                                  <label><input type="radio" name="optradio" value="2">Pengurus Toko</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="optradio" value="3">Kasir Toko</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" type="text">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
</html>
