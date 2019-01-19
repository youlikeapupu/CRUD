<!DOCTYPE html>
<html>
<head>
	<title>MEMber SHow</title>
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
      <th colspan="3">LIST</th>
    </tr>
    <tr>
      <th>#</th>
      <th colspan="2">
        <a href="<?php echo base_url('index.php/Member/reg')?>">
          <input type="button" class="btn btn-info" value="register">
        </a>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($r->result() as $k => $v) {
    ?>
    <tr>
      <td><?php echo $k+1 ;?></td>
      <td><?php echo $v->email ;?></td>
      <td>
        <a href="<?php echo base_url('index.php/Member/show').'/'.$v->id?>" class="btn btn-info btn-sm" target="_blank">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a class="btn btn-info btn-sm" onclick="del_fun(<?php echo $v->id;?>)">
          <span class="glyphicon glyphicon-remove"></span>
        </a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
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