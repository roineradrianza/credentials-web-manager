<?php session_start(); ?>
<?php if (empty($_SESSION['email']) OR $pageTitle == "Users" AND $_SESSION['type'] != "admin") {
  header("Location:../login.php");
}?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="theme-color" content="#4e73df" />

  <title>Dashboard - <?php {echo $pageTitle;} ?></title>

  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <?php if ($pageTitle == "Tutorial"): ?>
  <link href="../../components/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.6.1/viewer.min.css">
  <link rel="stylesheet" href="../../components/css/custom.css">
  <?php else: ?>
  <link href="components/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="components/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="components/css/custom.css">
  <?php if ($pageTitle == "Links"): ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <?php endif ?> 
  <?php endif ?>

</head>
  <body id="page-top">
    <!-- Page Wrapper -->
      <div id="wrapper">