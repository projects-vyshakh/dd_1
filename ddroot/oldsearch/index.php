<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Doctors Diary</title>

  <!-- Bootstrap Core CSS -->
  <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="./dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- jQuery -->
  <script src="./bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="./bower_components/bootstrap/dist/js/bootstrap.min.js"></script>




  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Doctors Diary</a>
      </div>
      <ul class="nav navbar-top-links navbar-right">

      </ul>
    </nav>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Dashboard</h1>
          <div class="row">
            <div class="col-lg-8">
              <div class="form-group" action="./ajaxTable.php"  id="searchDropdown" >
                <?php
          require_once './dbconnect.php';
          $db = new Phonebook;
          ?>
          <div class="alert alert-info alert-dismissable">
          <form class="searchNow" id="search">
          <div class="searchBar">
                            <input type="text" id="searchText" style="width:80%; display: inline-block;" class="form-control" placeholder="Please enter a patient id here.." id="searchText">
                            <button  class="btn btn-primary" name="submit" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                        </form>

                </div>
              </div>
            </div>
            <!-- /.col-lg-12 -->
          </div>

      <div class="row">
        <div id="ajx_table"></div>
      </div>
      <!-- /.row -->



    </div>
    <!-- /#page-wrapper -->

  </div>
  <!-- /#wrapper -->




</body>

</html>
<script type="text/javascript">
     $("#search").submit(function (e) {
        e.preventDefault();
        var searchText = $('#searchText').val();
        if(searchText == "") {
          return false;
        }
        if (searchText != "") {
            $.ajax({
                type: "POST",
                url: "ajaxTable.php",
                cache: false,
                data: {q: searchText},
                dataType: "html",
                beforeSend: function () {
                  $('#ajx_table').html('<div class="col-lg-12"><i id="tag_entry_spinner" class="fa fa-refresh fa-spin fa-3x "></i> Please wait..</div>');

                },
                success: function (data)
                {
                    $('#ajx_table').html(data);

                }
            });
        }
    }); 


</script>
<style type="text/css">
  .h1,
  h1 {
    font-size: 30px;
  }
</style>
