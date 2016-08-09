<?php
//d($result);
$result = $result->result->result[0];
//dd($result);
//echo $result->id;
?>
<!DOCTYPE HTML>

<html>
<head>
    <title>Doado - Cadastro</title>
    <meta charset="utf-8" />
    <base href="<?php echo $ASSET_PATH?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <div class="inner">

            <!-- Logo -->
            <a href="index.html" class="logo">
                <span class="symbol"><img src="images/logo.svg" alt="" /></span><span class="title">Doado</span>
            </a>

            <!-- Nav -->
            <nav>
                <ul>
                    <li><a href="#menu">Menu</a></li>
                </ul>
            </nav>

        </div>
    </header>

    <?php include $FOLDER_VIEW.'includes/menu.php';?>
    <!-- Main -->
    <div id="main">
        <div class="inner">


            <!-- Form -->
            <section>
                <h2>Edição</h2>
                <form method="post" action="<?php echo ARMNavigation::linkToController('account/register');?>">
                    <input type="hidden" name="id" value="<?php if(isset($result->id))echo $result->id;?>"  />
                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <input type="text" name="login" id="login" value="<?php if(isset($result->login))echo $result->login;?>" placeholder="Login" />
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="password" name="password" id="password" value="<?php if(isset($result->password))echo $result->password;?>" placeholder="Senha" />
                        </div>

                        <div class="12u$">
                            <ul class="actions">
                                <li><input type="submit" value="ALterar" class="special" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>

        </div>
    </div>


</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
</html>