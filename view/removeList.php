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
                    if($user == "012585" || $user == "010774"|| $user == "010563" || $user == "015765"){ ?>
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
                <h4 class="mb-3">Removed CR Details</h4>



  <div class="row g-3">
                        <table class="table" id="estable">
                            <thead>
                                <tr  class="table-primary">
                                    <th>Reference</th>
                                    <th>Topic</th>
                                    <th>Group</th>
                                    <th>Type</th>
                                    <th>Removed By</th>
                                    <th>Removed On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($rmcr) {
                                    foreach ($rmcr as $com) : ?>
                                        <tr>
                                            <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                            <td><?php echo $com['CR_TOPIC'] ?></td>
                                            <td><?php echo $com['PRO_GROUP'] ?></td>
                                            <td><?php echo $com['CR_TYPE'] ?></td>
                                            <td><?php echo $com['REMOVEDBY'] ?></td>
                                            <td><?php echo $com['REMOVEDON'] ?></td>
                                    <th></th>
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

        function removecr(cr){
            $.post("controller/removecrController.php", {
                id: cr
            }, function(data, status) {
                document.location = "http://ossportal/osscr/?a=projectList" ;
            });
        }
    </script>
</body>

</html>