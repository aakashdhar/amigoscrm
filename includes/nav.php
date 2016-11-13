<?php include 'includes/header.php'; ?>

<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Amigos</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="addproject.php">Add Project</a></li>
        <li><a href="modifyproject.php">Modify Project</a></li>
      </ul>
      <form class="navbar-form navbar-left" action="search.php" role="search">
        <div class="input-group">
          <input type="text" class="form-control" name="search-query" placeholder="Search for...">
           <span class="input-group-btn">
             <input type="submit" class="btn btn-primary" name="search" value="Search">
           </span>
         </div>
       </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="projection.php?month=<?= date('Y-m') ?>"><i class="fa fa-product-hunt"></i>  Projection</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-flag-o" aria-hidden="true"></i>  Follow Up <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="pendingcalls.php">Pending Calls</a></li>
            <li><a href="pendingfollowup.php">Pending Followup</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-credit-card" aria-hidden="true"></i>  Payments <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="incoming.php">Incoming</a></li>
            <li><a href="outgoing.php">Outgoing</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>  Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addsource.php">Add Source</a></li>
            <li><a href="addstatus.php">Add Status</a></li>
            <li><a href="addaccount.php">Add Bank Account</a></li>
            <li><a href="addexpensetype.php">Add Expense Type</a></li>
            <li><a href="addtype.php">Add Type</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
