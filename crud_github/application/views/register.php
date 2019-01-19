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

  <div class="testbox">
    <h1>Registration</h1>

    <form class="form" id="regForm">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" />
      <hr>
      <div class="accounttype">
        <input type="radio" value="1" id="radioOne" name="account"checked/>
        <label for="radioOne" class="radio" chec>Personal</label>
        <input type="radio" value="2" id="radioTwo" name="account"/>
        <label for="radioTwo" class="radio">Company</label>
      </div>
      <hr>
      <label id="icon" for="email"><i class="icon-envelope "></i></label>
      <input type="text" name="email" id="email" placeholder="Email" value="r@devilcase.com.tw" required/>
      <label id="icon" for="name"><i class="icon-user"></i></label>
      <input type="text" name="name" id="name" placeholder="Name" value="中" required/>
      <label id="icon" for="password"><i class="icon-shield"></i></label>
      <input type="password" name="password" id="password" placeholder="Password" value="123456" required/>
      <div class="gender">
        <input type="radio" value="1" id="male" name="gender" checked/>
        <label for="male" class="radio" chec>Male</label>
        <input type="radio" value="0" id="female" name="gender" />
        <label for="female" class="radio">Female</label>
      </div>
      <input type="button" class="fbutton" value="Register" onclick="reg_fun()">
    </form>
  </div>
</body>
<script type="text/javascript">
  function reg_fun(){
    var url='<?php echo base_url('index.php/Member/register')?>';
    var data = $('#regForm').serialize();

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
                //html: obj.message,
                text: obj.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#00DDAA',
              }).then((r) => {
                //console.log(obj);
                document.location.href= '<?php echo base_url('index.php/Member/login')?>';
              })
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console(thrownError);
            }
          });

  }
</script>
</html>