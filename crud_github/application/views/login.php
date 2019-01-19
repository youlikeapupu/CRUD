<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>MEMBer</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('public')?>/css/layout.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.24.4/dist/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

  <div class="loginbox">
    <h1>Login</h1>
    <form class="form" id="logForm">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
      <label id="icon" for="email"><i class="icon-envelope "></i></label>
      <input type="text" name="email" id="email" placeholder="Email" value="kim.chiu@devilcase.com.tw" required/>
      <label id="icon" for="password"><i class="icon-shield"></i></label>
      <input type="password" name="password" id="password" placeholder="Password" value="123456" required/>
      <div class="mid">
        <input type="button" class="fbutton" value="Login" onclick="log_fun()">
      </div>
      <p>Forget your <a href="#">password</a>? / Not a <a href="#">member</a>.</p>

    </form>
  </div>
</body>
<script type="text/javascript">
  function log_fun(){
    var url='<?php echo base_url('index.php/Member/login')?>';
    var data = $('#logForm').serialize();

    $.ajax({
            url: url,   //存取Json的網址
            type: "POST",
            data: data,
            //dataType: 'value',
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            success: function (response) {
              obj = JSON.parse(response);
              swal({
                title: obj.status,
                html: obj.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#00DDAA',
              })
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console(thrownError);
            }
          });

  }
</script>
</html>