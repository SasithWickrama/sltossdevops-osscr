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
                <h4 class="mb-3">Email Notify List</h4>

                <div class="row g-3">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="table-primary">
                                <th>CR Number</th>
                                <th>Product Owner</th>
                                <th>Comments</th>
                                <th>Request By</th>
                                <th>Request On</th>
                                <th>No of Reminders</th>
                                <th>Last Reminder On</th>
                                <th>Compleate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($allemail) {
                                foreach ($allemail as $com) : ?>
                                    <tr>
                                        <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CRNO'] ?>"><?php echo $com['CRNO'] ?></a></td>
                                        <td><?php echo $com['PRO_OWNER'] ?></td>
                                        <td><button class="button" onClick="window.open('http://ossportal/osscr/?a=comments&id=<?php echo $com['CRNO'] ?>', 'about', 'width=800,height=500,scrollbars=yes');">
                                                <span class="icon">Open</span>
                                            </button></td>
                                        <td><?php echo $com['UNAME'] ?></td>
                                        <td><?php echo $com['REQUEST_ON'] ?></td>
                                        <td><?php echo $com['REM'] ?></td>
                                        <td><?php echo $com['LAST_REM'] ?></td>
                                        <td><button class="btn btn-primary btn-sm" id="taskstartbutton" type="button" onclick="closetask('<?php echo $com['CRNO'] ?>')">Done</button></td>
                                    </tr>
                            <?php endforeach;
                            } ?>
                        </tbody>
                    </table>

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
            $('#myTable').DataTable();
        });

        function closetask(crid) {
            $.post("controller/emailController.php?action=close", {
                id: crid
            }, function(data, status) {
                //console.log(data);
                savecomment("Email Notification sent",crid);
            });
        }

        function savecomment(comm,crid) {
            $.post("controller/commentController.php", {
                newcomment: comm,
                id: crid,
                comtype:'Genaral'
            }, function(data, status) {
                document.location = "http://ossportal/osscr/?a=emailList";
            });
        }
    </script>
</body>

</html>