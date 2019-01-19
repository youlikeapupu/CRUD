<!DOCTYPE html>
<html>
<head>
	<title>MEMber INfo</title>
	  <meta charset="utf-8">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public')?>/css/show.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.24.4/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<table>
  <thead>
    <tr>
      <th colspan="3">INFO</th>
    </tr>
    <tr>
      <th>#</th>
      <th colspan="2"></th>
    </tr>
  </thead>
  <form method="post" name="edit" id="edit" action="<?php echo base_url('index.php/Member/edit').'/'.$r->id?>">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>">
  <tbody>
    <tr>
      <td>email</td>
      <td colspan="2"><input type="text" class="form-control" name="email" value="<?php echo $r->email?>"></td>
    </tr>
    <tr>
      <td>name</td>
      <td colspan="2"><input type="text" class="form-control" name="name" value="<?php echo $r->name?>"></td>
    </tr>
    <tr>
      <td>gender</td>
      <td colspan="2"><input type="text" class="form-control" name="gender" value="<?php echo $r->gender?>"></td>
    </tr>
    <tr>
      <td>LV</td>
      <td colspan="2"><input type="text" class="form-control" name="lv" value="<?php echo $r->lv?>"></td>
    </tr>
      <tr>
      <td></td>
      <td colspan="2"><input type="submit" class="btn btn-primary" value="submit"></td>
    </tr>
  </tbody>
  </form>
</table>
</body>
<script type="text/javascript">
  function del_fun(id){
    var url='<?php echo base_url('index.php/Member/del_user')?>';
    var token = '<?php echo $this->security->get_csrf_hash()?>';
    var data = {id :id,
                csrf_test_name : token};
    //console.log(data);

    $.ajax({
            url: url,
            type: "POST",
            cache:false,
            dataType: 'json',
            data: data,
            success: function (response) {
              // obj = JSON.parse(response);
              swal({
                title: response.status,
                //html: obj.message,
                text: response.message,
                confirmButtonText: 'OK',
                confirmButtonColor: '#00DDAA',
              }).then((r) => {
                //console.log(obj);
                 location.reload();
              })
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError);
            }
          });

  }
</script>
</html>