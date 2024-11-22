<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
    $user = $_SESSION['$usrid'];
    $ulevel = $_SESSION['$p_level'];
} else {
    header("Location: http://ossportal/osscr/");
    exit;
}

if(strcmp($ulevel,'1') != 0) {
    header("Location: http://ossportal/osscr/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSS CR Track</title>

    <link rel="stylesheet" href="http://ossportal/osscr/asset/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="http://ossportal/osscr/asset/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/style_2.css">
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>


</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1abc9c;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h3 style="color: #30336b">OSS CR Track</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php
                    if ($user == "012585" || $user == "010774" || $user == "010563" || $user == "015765") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=emailList">EMAIL LIST</a>
                        </li>
                    <?php }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://ossportal/osscr/?a=projectList">CR LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://ossportal/osscr/?a=logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">

        <main>
            <div class="py-5 text-center">
            </div>
            <div class="col-md-12 col-lg-12">
                <h4 class="mb-3">Summary</h4>



                <div class="row g-3">
                    <table  id="estable">
                        <thead>
                            <tr class="table-primary">
                                <th>CR Type</th>
                                <th>BSS</th>
                                <th>OSS</th>
                                <th>CRM</th>
                                <th>MDM</th>
                                <th>PRE-UAT</th>
                                <th style="background-color: #4D4D93; color: white;" >Configuration & Developments</th>
                                <th>UAT call - PM</th>
                                <th>UAT</th>
                                <th>Production</th>
                                <th style="background-color: #ffc300; color: white;">UAT</th>
                                <th>PM</th>
                                <th>Dependecy</th>
                                <th style="background-color: #E11469; color: white;"> Waiting</th>
                                <th style="background-color: #2a7b9b; color: white;">Total CR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($rmcr) {
                                foreach ($rmcr as $com) : ?>
                                    <tr>
                                        <td><?php echo $com['CRTYPE'] ?></a></td>
                                        <td><?php echo $com['BSS'] ?></td>
                                        <td><?php echo $com['OSS'] ?></td>
                                        <td><?php echo $com['CRM'] ?></td>
                                        <td><?php echo $com['MDM'] ?></td>
                                        <td><?php echo $com['PRE_UAT'] ?></td>
                                        <td style="background-color: #4D4D93; color: white;"><?php echo $com['CONFIG'] ?></td>
                                        <td><?php echo $com['PM_UAT'] ?></td>
                                        <td><?php echo $com['UAT'] ?></td>
                                        <td><?php echo $com['PRODUCTION'] ?></td>
                                        <td style="background-color: #ffc300; color: white;"><?php echo $com['UATMAIN'] ?></td>
                                        <td><?php echo $com['PM'] ?></td>
                                        <td><?php echo $com['DEPENDENCY'] ?></td>
                                        <td style="background-color: #E11469; color: white;"><?php echo $com['WAITING'] ?></td>
                                        <td style="background-color: #2a7b9b; color: white;"><?php echo  $com['CONFIG'] + $com['UATMAIN'] + $com['WAITING'] ?></td>
                                    </tr>
                            <?php endforeach;
                            } ?>
                        </tbody>
                    </table>

                </div>


            </div>



    </div>
    </main>




    <br /><br /><br /><br /><br /><br />

    </div>





    <!-- jQuery -->
    <script src="http://ossportal/osscr/asset/js/jquery.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- Select2 JS -->
    <script src="http://ossportal/osscr/asset/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8" src="http://ossportal/osscr/asset/js/jquery.dataTables.js"></script>

    <script src="http://ossportal/osscr/asset/js/moment.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#estable').DataTable();
        });

        function removecr(cr) {
            $.post("controller/removecrController.php", {
                id: cr
            }, function(data, status) {
                document.location = "http://ossportal/osscr/?a=projectList";
            });
        }
    </script>
</body>

</html>