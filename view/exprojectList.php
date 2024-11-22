<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user = $_SESSION['$usrid'];
    $ulevel = $_SESSION['$p_level'];
} else {
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
                        <a class="nav-link" href="#" onclick="showSeaerch()">CR SEARCH</a>
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
                <h4 class="mb-3">CR Details</h4>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="es-tab" data-bs-toggle="tab" data-bs-target="#es" type="button" role="tab" aria-controls="es" aria-selected="true">Enterprise Solution</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sme-tab" data-bs-toggle="tab" data-bs-target="#sme" type="button" role="tab" aria-controls="sme" aria-selected="false">SME</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="con-tab" data-bs-toggle="tab" data-bs-target="#con" type="button" role="tab" aria-controls="con" aria-selected="false">Consumer</button>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sw-tab" data-bs-toggle="tab" data-bs-target="#sw" type="button" role="tab" aria-controls="sw" aria-selected="false">Software</button>
                    </li> -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="config-tab" data-bs-toggle="tab" data-bs-target="#config" type="button" role="tab" aria-controls="config" aria-selected="false">Configuration</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab" aria-controls="other" aria-selected="false">Other</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bpr-tab" data-bs-toggle="tab" data-bs-target="#bpr" type="button" role="tab" aria-controls="bpr" aria-selected="false">BPR</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="fin-tab" data-bs-toggle="tab" data-bs-target="#fin" type="button" role="tab" aria-controls="fin" aria-selected="false">Finance</button>
                    </li>
                </ul>



                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="es" role="tabpanel" aria-labelledby="es-tab">
                        <div class="row g-3">
                            <table class="table" id="estable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($escr) {
                                        foreach ($escr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php if ($com['PRI'] == "0") {
                                                        echo "NORMAL";
                                                    }
                                                    if ($com['PRI'] == "1") {
                                                        echo "HEIGH";
                                                    } ?></td>
                                                <td><?php echo $com['CRTYPE'] ?></td>

                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="sme" role="tabpanel" aria-labelledby="sme-tab">
                        <div class="row g-3">
                            <table class="table" id="smetable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($smecr) {
                                        foreach ($smecr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php if ($com['PRI'] == "0") {
                                                        echo "NORMAL";
                                                    }
                                                    if ($com['PRI'] == "1") {
                                                        echo "HEIGH";
                                                    } ?></td>
                                                <td><?php echo $com['CRTYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="con" role="tabpanel" aria-labelledby="con-tab">
                        <div class="row g-3">
                            <table class="table" id="contable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($concr) {
                                        foreach ($concr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php if ($com['PRI'] == "0") {
                                                        echo "NORMAL";
                                                    }
                                                    if ($com['PRI'] == "1") {
                                                        echo "HEIGH";
                                                    } ?></td>
                                                <td><?php echo $com['CRTYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                        <div class="row g-3">
                            <table class="table" id="othertable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($othercr) {
                                        foreach ($othercr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php if ($com['PRI'] == "0") {
                                                        echo "NORMAL";
                                                    }
                                                    if ($com['PRI'] == "1") {
                                                        echo "HEIGH";
                                                    } ?></td>
                                                <td><?php echo $com['CRTYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
                        <div class="row g-3">
                            <table class="table" id="configtable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($configcr) {
                                        foreach ($configcr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php if ($com['PRI'] == "0") {
                                                        echo "NORMAL";
                                                    }
                                                    if ($com['PRI'] == "1") {
                                                        echo "HEIGH";
                                                    } ?></td>
                                                <td><?php echo $com['CRTYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>



                    <div class="tab-pane fade" id="bpr" role="tabpanel" aria-labelledby="bpr-tab">
                        <div class="row g-3">
                            <table class="table" id="bprtable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($bprcr) {
                                        foreach ($bprcr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>

                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>

                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>


                    <div class="tab-pane fade" id="fin" role="tabpanel" aria-labelledby="fin-tab">
                        <div class="row g-3">
                            <table class="table" id="fintable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($financecr) {
                                        foreach ($financecr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>

                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </main>




        <br /><br /><br /><br /><br /><br />

    </div>
    <!-- cr serach model -->

    <div class="modal fade" id="crSearchModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">CR Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-lg">




                    <div class="box-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-hover" id="crSearchList">
                                    <thead>
                                        <th>Reference</th>
                                        <th> Topic</th>
                                    </thead>
                                    <?php if ($allcr) {
                                        foreach ($allcr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                        <?php endforeach;
                                    } ?>

                                </table>
                            </div>

                        </div>
                        <br />
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>
                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>


    <!-- end of cr search model -->




    <!-- jQuery -->
    <script src="http://ossportal/osscr/asset/js/jquery.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- Select2 JS -->
    <script src="http://ossportal/osscr/asset/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8" src="http://ossportal/osscr/asset/js/jquery.dataTables.js"></script>

    <script src="http://ossportal/osscr/asset/js/moment.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/Chart.min.js"></script>

    <script src="http://ossportal/osscr/asset/js/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $('#estable').DataTable();
            $('#smetable').DataTable();
            $('#contable').DataTable();
            $('#swtable').DataTable();
            $('#othertable').DataTable();
            $('#configtable').DataTable();
            $('#bprtable').DataTable();
            $('#fintable').DataTable();

            $('#crSearchList').DataTable({
                "drawCallback": function(settings) {
                    if ($('#crSearchList_filter input').val().length > 0) {
                        $('#crSearchList tr').show();
                    } else {
                        $('#crSearchList tr').hide();
                    }
                }


            });
        });

        function showSeaerch() {
            var searchModel = new bootstrap.Modal(document.getElementById('crSearchModel'), {});
            searchModel.show();
        }



        function removecr(cr) {
            $.post("controller/removecrController.php", {
                id: cr
            }, function(data, status) {
                document.location = "http://ossportal/osscr/?a=projectList";
            });
        }

        function prichage(cr, x) {
            var val = x.value;
            // console.log('val '+val);             
            // console.log('cr '+cr);
            $.post("controller/pendingcatController.php?action=addpri", {
                val: val,
                id: cr
            }, function(data, status) {
                //document.location = "http://ossportal/osscr/?a=projectList" ;
                savecomment("Changed Priority to " + val, cr);
            });
        }

        function typechage(cr, x) {
            var val = x.value;
            // console.log('val '+val);             
            // console.log('cr '+cr);
            $.post("controller/pendingcatController.php?action=addtype", {
                val: val,
                id: cr
            }, function(data, status) {
                //document.location = "http://ossportal/osscr/?a=projectList" ;
                savecomment("Changed CR type to " + val, cr);
            });
        }


        function savecomment(comm, crid) {
            $.post("controller/commentController.php", {
                newcomment: comm,
                id: crid,
                comtype: 'Genaral'
            }, function(data, status) {
                // document.location = "http://ossportal/osscr/?a=projectList";
                $('#tr_' + crid).remove();
            });
        }
    </script>
</body>

</html>