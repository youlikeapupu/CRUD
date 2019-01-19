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
    <style>

      .btn_save{
        text-align: center;
      }

    </style>
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
          CREATE NEWS
          <a class="btn btn-info btn-sm" onclick="create_fun()">
            <span class=" glyphicon glyphicon-plus-sign"></span>
          </a>
        </th>
      </tr>
    </thead>
    <form method="POST" name="create_from" id="create_from" action="<?php echo base_url('index.php/News/create')?>">
    <tbody id="news_td">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name()?>" value="<?= $this->security->get_csrf_hash()?>" />
      <tr class="news_box">
        <td class="form-group col-md-4">
          <input type="text" class="form-control title" name="title[]" placeholder="Title" value="a">
        </td>
        <td class="form-group col-md-8">
          <input type="text" class="form-control depiction" name="depiction[]" placeholder="Depiction" value="aaaaaaaaaaaa">
        </td>
        <td>
        </td>
      </tr>
      <tr class="news_box">
        <td class="form-group col-md-4">
          <input type="text" class="form-control title" name="title[]" placeholder="Title" value="b">
        </td>
        <td class="form-group col-md-8">
          <input type="text" class="form-control depiction" name="depiction[]" placeholder="Depiction" value="測試測試">
        </td>
        <td>
        </td>
      </tr>
      <tr class="news_box">
        <td class="form-group col-md-4">
          <input type="text" class="form-control title" name="title[]" placeholder="Title" value="c">
        </td>
        <td class="form-group col-md-8">
          <input type="text" class="form-control depiction" name="depiction[]" placeholder="Depiction" value="測試測試測試">
        </td>
        <td>
        </td>
      </tr>
      <tr class="news_box">
        <td class="form-group col-md-4">
          <input type="text" class="form-control title" name="title[]" placeholder="Title" value="d">
        </td>
        <td class="form-group col-md-8">
          <input type="text" class="form-control depiction" name="depiction[]" placeholder="Depiction" value="ddddddddddddddddd">
        </td>
        <td>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="btn_save">
    <!-- <input type="button" class="btn btn-primary" value="SAVE"> -->
    <button type="button" class="btn btn-primary" id="create_btn" onclick="save_as()">SAVE</button>
  </div>
  </form>
</body>
<script type="text/javascript">

  function dce(id){
    var el = '';
    el = document.createElement(id);
    return el;
  }

  function create_fun(){
    var newTr = dce('tr');
    newTr.className = "news_box";

    var td1 = dce("td");
    td1.className = "form-group col-md-4";

    var td2 = dce("td");
    td2.className = "form-group col-md-8";

    var td3 = dce("td");

    var title = dce("input");
    title.placeholder = "Title";
    title.className = "form-control";
    title.className += " title";

    title.setAttribute("type", "text");
    title.setAttribute("name", "title[]");

    var depiction = dce("input");
    depiction.placeholder = "Depiction";
    depiction.className = "form-control";
    depiction.className += " depiction";

    depiction.setAttribute("type", "text");
    depiction.setAttribute("name", "depiction[]");

    // depiction.setAttribute("value", "depiction[]");

    newTr.appendChild(td1);
    newTr.appendChild(td2);
    newTr.appendChild(td3);
    td1.appendChild(title);
    td2.appendChild(depiction);
    document.getElementById("news_td").appendChild(newTr);

    // console.log('depiction.value =>'+ depiction.value);

  }

  function save_as(){
    //---
    // var title = document.getElementsByName("title[]");
    // var depiction = document.getElementsByName("depiction[]");
    // var t_arr = [];
    // var d_arr = [];
    // var data = [];
    // // var depiction = document.getElementsByName("depiction");
    // var len = title.length;
    // for (i = 0; i < len; i++) {
    // //console.log(title[i].value);
    // t_arr.push(title[i].value);
    // d_arr.push(depiction[i].value);
    // }
    // data[0] = t_arr;
    // data[1] = d_arr;
    // console.log(data);
    // --

// form-control

    // var self = document.querySelectorAll(".items")[ck_i];
    // var fc = document.querySelectorAll(".title");

    // console.log('fc.length =>' + fc.length);

    // console.log('fc.value =>' + fc[0].value);

    // var f1 = document.getElementById('create_from');
    document.getElementById('create_from').submit();

  }

</script>
</html>