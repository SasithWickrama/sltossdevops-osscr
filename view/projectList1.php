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
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/jquery-ui.css">


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
                        <a class="nav-link" href="#" onclick="showSeaerch()">CR Search</a>
                    </li>
                    <?php
                    if ($user == "012585" || $user == "010774" || $user == "010563") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=emailList">EMAIL LIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=exlList">EXCEPTION LIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=summary">SUMMARY</a>
                        </li>
                    <?php }
                    ?>
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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sw-tab" data-bs-toggle="tab" data-bs-target="#sw" type="button" role="tab" aria-controls="sw" aria-selected="false">Software</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="config-tab" data-bs-toggle="tab" data-bs-target="#config" type="button" role="tab" aria-controls="config" aria-selected="false">Configuration</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="other-tab" data-bs-toggle="tab" data-bs-target="#other" type="button" role="tab" aria-controls="other" aria-selected="false">Other</button>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($escr) {
                                        foreach ($escr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                echo "selected";
                                                                            } ?>>ENT</option>
                                                        <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                echo "selected";
                                                                            } ?>>SME</option>
                                                        <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                echo "selected";
                                                                            } ?>>CONSUMER</option>
                                                        <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                echo "selected";
                                                                            } ?>>SW</option>
                                                        <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                    echo "selected";
                                                                                } ?>>OTHER</option>
                                                    </select></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($smecr) {
                                        foreach ($smecr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                echo "selected";
                                                                            } ?>>ENT</option>
                                                        <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                echo "selected";
                                                                            } ?>>SME</option>
                                                        <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                echo "selected";
                                                                            } ?>>CONSUMER</option>
                                                        <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                echo "selected";
                                                                            } ?>>SW</option>
                                                        <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                    echo "selected";
                                                                                } ?>>OTHER</option>
                                                    </select></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($concr) {
                                        foreach ($concr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                echo "selected";
                                                                            } ?>>ENT</option>
                                                        <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                echo "selected";
                                                                            } ?>>SME</option>
                                                        <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                echo "selected";
                                                                            } ?>>CONSUMER</option>
                                                        <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                echo "selected";
                                                                            } ?>>SW</option>
                                                        <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                    echo "selected";
                                                                                } ?>>OTHER</option>
                                                    </select></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
                                            </tr>
                                    <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="sw" role="tabpanel" aria-labelledby="sw-tab">
                        <br />
                        <div class="row g-3">
                            <div class="col-md-3"> <button type="button" class="btn btn-success btn-sm" onclick="addSwCr()">Add New</button></div>
                        </div>
                        <br />
                        <div class="row g-3">
                            <table class="table" id="swtable">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Reference</th>
                                        <th>Topic</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Remarks</th>
                                        <th>Prority</th>
                                        <th>Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($swcr) {
                                        foreach ($swcr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <?php if (substr($com['BPR_REF'], 0, 2) == "SW") { ?>
                                                    <td></td>
                                                    <td></td>
                                                <?php } else { ?>
                                                    <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                            <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                    echo "selected";
                                                                                } ?>>ENT</option>
                                                            <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                    echo "selected";
                                                                                } ?>>SME</option>
                                                            <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                    echo "selected";
                                                                                } ?>>CONSUMER</option>
                                                            <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                    echo "selected";
                                                                                } ?>>SW</option>
                                                            <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                        echo "selected";
                                                                                    } ?>>OTHER</option>
                                                        </select></td>
                                                    <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
                                                <?php } ?>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($othercr) {
                                        foreach ($othercr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                echo "selected";
                                                                            } ?>>ENT</option>
                                                        <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                echo "selected";
                                                                            } ?>>SME</option>
                                                        <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                echo "selected";
                                                                            } ?>>CONSUMER</option>
                                                        <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                echo "selected";
                                                                            } ?>>SW</option>
                                                        <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                    echo "selected";
                                                                                } ?>>OTHER</option>
                                                    </select></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
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
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($configcr) {
                                        foreach ($configcr as $com) : ?>
                                            <tr id="tr_<?php echo $com['CR_REF'] ?>">
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
                                                <td><?php echo $com['CR_TOPIC'] ?></td>
                                                <td><?php echo $com['PRO_GROUP'] ?></td>
                                                <td><?php echo $com['CR_TYPE'] ?></td>
                                                <td><?php echo $com['REMARKS'] ?></td>
                                                <td><select onchange="prichage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="0" <?php if ($com['PRI'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>NORMAL</option>
                                                        <option style="color:#FF0000;" value="1" <?php if ($com['PRI'] == "1") {
                                                                                                        echo "selected";
                                                                                                    } ?>>HEIGH</option>
                                                    </select></td>
                                                <td><select onchange="typechage('<?php echo $com['CR_REF'] ?>',this)">
                                                        <option value="ENT" <?php if ($com['CRTYPE'] == "ENT") {
                                                                                echo "selected";
                                                                            } ?>>ENT</option>
                                                        <option value="SME" <?php if ($com['CRTYPE'] == "SME") {
                                                                                echo "selected";
                                                                            } ?>>SME</option>
                                                        <option value="CON" <?php if ($com['CRTYPE'] == "CON") {
                                                                                echo "selected";
                                                                            } ?>>CONSUMER</option>
                                                        <option value="SW" <?php if ($com['CRTYPE'] == "SW") {
                                                                                echo "selected";
                                                                            } ?>>SW</option>
                                                        <option value="OTHER" <?php if ($com['CRTYPE'] == "OTHER") {
                                                                                    echo "selected";
                                                                                } ?>>OTHER</option>
                                                    </select></td>
                                                <td><button type="button" class="btn btn-primary btn-sm" onclick="removecr('<?php echo $com['CR_REF'] ?>')">Remove</button></td>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">New Softwear CR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-lg">


                    <form enctype="multipart/form-data" action="swcrinsert.php" onsubmit="return Validate()" method="post">



                        <div class="box-body">

                            <div class="row">

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>CR Type</label>
                                        <label name="crtype" class="form-control">SWDEV</label>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>CR Reference</label>
                                        <input style="width: 300px; height: 35px;" type="text" class="form-control" id="crref" name="crref" value="<?php echo $cref; ?>" disabled="" />
                                    </div>

                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Request By (Person or Section)</label>
                                        <input style="width: 300px; height: 35px;" type="text" class="form-control" id="owner" name="owner" />
                                    </div>

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-5">


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>CR Topic</label>
                                        <input style="width: 300px; height: 35px;" type="text" class="form-control" id="crtopic" name="crtopic" required="" />
                                    </div>

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea style="width: 300px; height: 35px;" class="form-control" id="descrip" name="descrip" required=""></textarea>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Date Raised</label>
                                        <input type="text" value="<?php echo date('Y-m-d'); ?>" name="dateraise" id="inputField" style="width:300px; height: 35px;" class="form-control" required="" />

                                    </div>

                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Date Require</label>
                                        <input type="text" name="datereq" value="<?php echo date('Y-m-d'); ?>" id="inputField2" style="width:300px; height: 35px;" class="form-control" required="" />
                                    </div>

                                </div>
                            </div>
                            <br />

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Upload Documents</label><br />
                                        <input name="uploadedfile" type="file" onchange="return ValidatePDF(this);" />(CR PDF file)
                                    </div>


                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label></label><br />
                                        <input type="file" name="uploadedfile2[]" onchange="return ValidateOTHER(this);" id="file" multiple>(WORD OR EXCEL file)
                                        <label>(Hold down the Ctrl button to select multiple options)</label>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">


                                </div>

                                <div class="col-md-4">


                                </div>

                                <div class="col-md-4">

                                </div>
                            </div>




                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>
                    </form>

                </div>


                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>


    <!-- cr serach model -->

    <div class="modal fade" id="crSearchModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">New Softwear CR</h5>
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
                                                <td><a href="http://ossportal/osscr/?a=project&id=<?php echo $com['CR_REF'] ?>"><?php echo $com['BPR_REF'] ?></a></td>
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
                    </form>

                </div>


                <div class="modal-footer">

                </div>
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


            $('#crSearchList').DataTable({
                    "drawCallback": function(settings) {
                        if ($('#crSearchList_filter input').val().length > 0) {
                            $('#crSearchList tr').show();
                        } else {
                            $('#crSearchList tr').hide();
                        }
                    }
                

            });

        $("#startdate").datepicker();

        $('#swcrcreatebtn').click(function() {
            var topic = $("#topic").val();
            var remarks = $('#remarks').val();
            var startdate = $("#startdate").val();
            var requestedby = $('#requestedby').val();
            $.post("controller/swcrController.php?action=add", {
                topic: topic,
                remarks: remarks,
                startdate: startdate,
                requestby: requestedby,
            }, function(data, status) {
                //console.log('return data X' + data);
                savecomment("Softwear CR Created ", data);
            });

        });
        });

        function addSwCr() {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});
            myModal.show();
        }

        function showSeaerch() {
           // hideTable();
            var searchModel = new bootstrap.Modal(document.getElementById('crSearchModel'), {});
            searchModel.show();
        }

        crSearchList_filter

        // $('#search_box').keyup(function() {
        //     var searchStr = $(this).val();

        //     if ((searchStr).length) {
        //         renderTable();
        //     } else {
        //         hideTable();
        //     }
        // });

        function renderTable() {
            jQuery('.dataTable').show();
            jQuery('.dataTables_info').show();
            jQuery('.dataTables_paginate').show();
        }

        function hideTable() {
            jQuery('.dataTable').hide();
            jQuery('.dataTables_info').hide();
            jQuery('.dataTables_paginate').hide();
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




        function ValidatePDF(oInput) {

            if (oInput.value != "") {
                var _validFileExtensions = [".pdf"];
                if (oInput.type == "file") {
                    var sFileName = oInput.value;
                    if (sFileName.length > 0) {
                        var blnValid = false;
                        for (var j = 0; j < _validFileExtensions.length; j++) {
                            var sCurExtension = _validFileExtensions[j];
                            if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                                blnValid = true;
                                break;
                            }
                        }

                        if (!blnValid) {


                            //===================
                            theme = "blue";

                            $.jAlert({
                                'title': 'Alert',
                                'content': 'Allowed File type is:   ' + _validFileExtensions.join(", "),
                                'theme': theme,
                                'closeOnClick': true,
                                'backgroundColor': 'white',
                                'btns': [{
                                    'text': 'OK',
                                    'theme': theme
                                }]
                            });

                            //===================


                            oInput.value = "";
                            return false;
                        }
                    }
                }
            }
            return true;
        }

        function ValidateOTHER(oInput) {

            var _validFileExtensions = [".xls", ".xlsx", ".doc", ".docx"];
            if (oInput.type == "file") {
                var sFileName = oInput.value;
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }

                    if (!blnValid) {
                        //===================
                        theme = "blue";

                        $.jAlert({
                            'title': 'Alert',
                            'content': 'Allowed File type are:  ' + _validFileExtensions.join(", "),
                            'theme': theme,
                            'closeOnClick': true,
                            'backgroundColor': 'white',
                            'btns': [{
                                'text': 'OK',
                                'theme': theme
                            }]
                        });

                        //===================
                        oInput.value = "";
                        return false;
                    }
                }
            }
            return true;
        }

        function Validate() {
            /*
            var crm = document.getElementById('crm').checked;
            var mdm = document.getElementById('mdm').checked;
            var oss = document.getElementById('oss').checked;
            var bss = document.getElementById('bss').checked;
            var bssopr = document.getElementById('bssopr').checked;
            var soa = document.getElementById('soa').checked;
            //   var medeation = document.getElementById('medeation').checked;

            // if(crm==false && mdm==false && oss==false && bss==false && bssopr==false && medeation==false){
            if(crm==false && mdm==false && oss==false && bss==false && bssopr==false&& soa==false){
                //===================

                theme = "blue";

                $.jAlert({
                    'title': 'Missing',
                    'content': 'Select at least one system',
                    'theme': theme,
                    'closeOnClick': true,
                    'backgroundColor': 'white',
                    'btns': [
                        {'text':'OK', 'theme':theme}
                    ]
                });

                //===================
                return false;
            }*/

            return true;
        }
    </script>
</body>

</html>