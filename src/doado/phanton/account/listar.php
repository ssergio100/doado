<?php
$result = $result->result->result;

?>
<!DOCTYPE HTML>

<html>
<head>
    <title>Elements - Phantom by HTML5 UP</title>
    <base href="<?php echo $ASSET_PATH?>">
    <meta charset="utf-8" />
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
              <section>
                <h2>Contas</h2>
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Login</th>
                            <th>Password</th>
                            <th colspan="4" style="text-align: center">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($result as $val){
                            $opt = ($val->active) ? '<i class="fa fa-times" aria-hidden="true" title="Clique para ativar"></i>':'<i class="fa fa-check" style="color:green" title="Clique para desativar" aria-hidden="true"></i>';
                            ?>
                        <tr>
                            <td><?php echo $val->id;?></td>
                            <td><?php echo $val->login;?></td>
                            <td><?php echo $val->password;?></td>
                            <td style="text-align: center"><a href="<?php echo ARMNavigation::getAppUrl("account/active/id.").$val->id;?>"><?php echo $opt;?></a></td>
                            <td style="text-align: center"><a href="<?php echo ARMNavigation::getAppUrl("account/reset/id.".$val->id);?>" title="Resetar password"><i class="fa fa-key" aria-hidden="true"></i></a></td>
                            <td style="text-align: center"><a href="<?php echo ARMNavigation::getAppUrl("account/edit/id.".$val->id);?>" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                            <td style="text-align: center"><a href="<?php echo ARMNavigation::getAppUrl("account/delete/id.".$val->id);?>" style="color:red" title="Deletar"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

                        </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div>
            </section>
            <!-- Buttons -->
            <!-- Form -->
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="copyright">
                <li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
        </div>
    </footer>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>

</body>
</html>