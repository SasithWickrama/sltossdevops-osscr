<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['$usrid'])) {
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
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/style_2.css">
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="http://ossportal/osscr/asset/css/floatbutton.css">


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
                        <select id='selUser' class="form-select">
                            <?php
                            if ($allcrdetails) {
                                $current =  $crdetails[0]['CR_REF'];
                            } else {
                                $current = "";
                            }

                            if ($allcr) {
                                foreach ($allcr as $cr) : ?>
                                    <option value='<?php echo $cr['CR_REF'] ?>' <?php if (strcmp($current, $cr['CR_REF']) == 0) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $cr['CR_REF'] ?></option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://ossportal/osscr/?a=exprojectList">CR
                            LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://ossportal/osscr/?a=logout">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>







    <main role="main" class="container">
        <div class="py-5 text-center">
        </div>
        <div class="col-md-12 col-lg-12">
            <h4 class="mb-3"><?php if ($crdetails) {
                                    echo $crdetails[0]['BPR_REF'] . ' - ' . $crdetails[0]['CR_TOPIC'] . '<br/> Start Date :' . $crdetails[0]['DATE_ITSI_RECEIVE'];
                                } else {
                                    echo "<script type='text/javascript'>alert('Invalid CR Number'); window.location.href = \"http://ossportal/osscr/?a=exprojectList\";</script>";
                                } ?> </h4>
            <br />
            <input id="selUser" type="hidden" value="<?php if ($crdetails) {
                                                            echo $crdetails[0]['CR_REF'];
                                                        } ?>" />
            <input id="crtopic" type="hidden" value="<?php if ($crdetails) {
                                                            echo $crdetails[0]['CR_TOPIC'];
                                                        } ?>" />
            <div class="row g-3">





                <h4 class="mb-3">CR Tasks</h4>

                <div style="height: 100px" id="canvasdiv">
                    <canvas id="canvas"></canvas>
                </div>

                <br />

                <!-- <h4 class="mb-3">OSS User Tasks</h4>
                <?php if (!$ammend) { ?>
                <div class="col-sm-6">
                    <select id='userlist' class="form-select">
                        <option value=''>Update User Task</option>
                        <?php
                        if ($userlist) {
                            foreach ($userlist as $cr) : ?>
                                <option value='<?php echo $cr['SID'] ?>'><?php echo $cr['SID'] . '-' . $cr['UNAME'] ?></option>
                        <?php endforeach;
                        } ?>
                    </select>
                </div>
                <?php } ?>

                <div style="height: 100px" id="canvasdivuser">
                    <canvas id="canvasuser"></canvas>
                </div> -->


                <!-- <canvas id="canvas" height="300"></canvas> -->

                <!-- <div class="row" style="padding-top: 30px; display: none;">
                    <h6 class="mb-3">MDM Tasks</h6>
                    <div class="col-2"><button type="button" id="mdmstart" class="btn btn-primary btn-sm">MDM START</button></div>
                    <div class="col-2"><button type="button" id="apcsyn" class="btn btn-primary btn-sm">APC SYNC</button></div>
                    <div class="col-2"><button type="button" id="preuatsuccess" class="btn btn-primary btn-sm">PRE UAT SUCCESS</button></div>
                    <div class="col-2"><button type="button" id="uatsucess" class="btn btn-primary btn-sm">UAT SUCCESS</button></div>
                    <div class="col-2"><button type="button" id="uatfail" class="btn btn-primary btn-sm">UAT FAIL</button></div>
                </div> -->
                <!-- <br/>
                <hr/>
                <br/>
                <div class="row" style="padding-top: 30px;">
                <h6 class="mb-3">CR Ammendment</h6>
                <div class="col-3" >
                <label class="form-label">Ammendment CR Number</label>
                <select id='amendcr' class="form-select">
                <option value='' ></option>
                            <?php

                            if ($allcr) {
                                foreach ($allcr as $cr) :
                                    if (strcmp($current, $cr['CR_REF']) != 0) { ?>
                                    <option value='<?php echo $cr['CR_REF'] ?>' ><?php echo $cr['CR_REF'] ?></option>
                            <?php }
                                endforeach;
                            } ?>
                        </select>
                </div>               
                 <div class="col-2" >
                <button class="w-10 btn btn-primary btn-sm" id="cmentsavebtn" type="button">Add CR</button>
                </div> 
                <div class="col-9" >
                </div> 
                </div>
                <br/>
                <div class="row" >
                    <?php if ($ammend) {
                        foreach ($ammend as $com) : ?>
                         <h7 ><a target="_blank"  href="http://ossportal/osscr/?a=exproject&id=<?php echo $com['CHILD_CR'] ?>"><?php echo $com['ST_DATE'] . '&emsp;' . $com['CR_TOPIC'] ?></a></h7>
                     <?php endforeach;
                    } ?>
                </div> -->

                <br />
                <hr />
                <br />
                <div class="row" style="padding-top: 30px;">
                    <h6 class="mb-3">CR Pending Status Summary</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td colspan="5"><input disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled <?php if ($crcat) {
                                                                                                                                            if ($crcat[0]['CONFIG'] == 1) {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Configuration & Developments
                                    </label>
                                </td>
                                <td colspan="3"><input disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled <?php if ($crcat) {
                                                                                                                                            if ($crcat[0]['UATMAIN'] == 1) {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        UAT
                                    </label>
                                </td>
                                <td colspan="2"><input disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled <?php if ($crcat) {
                                                                                                                                            if ($crcat[0]['WAITING'] == 1) {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        } ?>>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Waiting
                                    </label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <input disabled class="form-check-input" type="checkbox" value="" id="bsscheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['BSS'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="bsscheck">
                                        BSS
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="osscheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['OSS'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="osscheck">
                                        OSS
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="crmcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['CRM'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="crmcheck">
                                        CRM
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="mdmcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['MDM'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="mdmcheck">
                                        MDM
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="preuatcheck" <?php if ($crcat) {
                                                                                                                    if ($crcat[0]['PRE_UAT'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                } ?>>
                                    <label class="form-check-label" for="preuatcheck">
                                        PRE-UAT
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="pmuatcheck" <?php if ($crcat) {
                                                                                                                    if ($crcat[0]['PM_UAT'] == 1) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                } ?>>
                                    <label class="form-check-label" for="pmuatcheck">
                                        UAT call - PM
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="uatcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['UAT'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="uatcheck">
                                        UAT
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="prodcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['PRODUCTION'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="prodcheck">
                                        Production
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="pmcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['PM'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="pmcheck">
                                        PM
                                    </label>
                                </td>
                                <td><input disabled class="form-check-input" type="checkbox" value="" id="depcheck" <?php if ($crcat) {
                                                                                                                if ($crcat[0]['DEPENDENCY'] == 1) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } ?>>
                                    <label class="form-check-label" for="depcheck">
                                        Dependecy
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="padding-top: 30px;">

                    <div class="col-12" style="max-height: 550px; overflow: auto">
                        <h6 class="mb-3">CR Comments</h6>


                        <br />


                        <div style="max-height: 60; overflow: auto" id="crcommendiv">

                            <?php if ($comments) {
                                foreach ($comments as $com) : ?>
                                    <p style="color:<?php
                                                    if ($comtypes) {
                                                        foreach ($comtypes as $crx) :  if ($crx['COM_TYPE'] == $com['COMTYPE']) {
                                                                echo $crx['COLOUR'];
                                                            }
                                                        endforeach;
                                                    } ?>"> <?php echo '[' . $com['INSERT_DATE'] . '][' . $com['UNAME'] . ']' . $com['TEXT'] . '<hr/>' ?></p>
                            <?php endforeach;
                            } ?>
                        </div>
                        <br />

                        <div class="col-12">
                            <label class="form-label">New Comment</label>
                            <textarea type="text" id="newcomment" name="newcomment" class="form-control">   </textarea>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <!-- <?php
                                        // if ($user == "012585" || $user == "010774" || $user == "010563") { 
                                        ?>
                                <button class="w-100 btn btn-primary btn-sm" id="notifykumudubtn" type="button">Notify
                                    for Email</button>
                                <?php //}
                                ?> -->
                            </div>
                            <div class="col-2"></div>
                            <div class="col-5">
                                <button class="w-100 btn btn-primary btn-sm" id="cmentsavebtn" type="button">Save
                                    Comment</button>
                            </div>
                        </div>




                    </div>
                    <!-- <div class="col-2" style="max-height: 550px; overflow: auto">
                        <h6 class="mb-3">CR Sub Task Compleation</h6>
                        <div class="row">
                            <div class="col-8"><b>Type</b></div>
                            <div class="col-2"><b>UAT</b></div>
                            <div class="col-2"><b>PROD</b></div>
                            <hr />
                            <?php if ($comtypes) {
                                foreach ($comtypes as $com) : ?>
                                    <?php echo  '<div class="col-8" >' . $com['COM_TYPE'] . '</div><div class="col-2" ><input class="form-check-input" type="checkbox" value="" id="comUAT_' . $com['COM_TYPE'] . '"';

                                    if ($com['UAT'] == 1) {
                                        echo ' checked ';
                                    }
                                    echo '></div><div class="col-2" ><input class="form-check-input" type="checkbox" value="" id="comPROD_' . $com['COM_TYPE'] . '"';

                                    if ($com['PROD'] == 1) {
                                        echo ' checked ';
                                    }
                                    echo '></div><hr/>'; ?>
                            <?php endforeach;
                            } ?>

                        </div>
                    </div> -->
                </div>

                <!-- <div class="row" style="padding-top: 30px;">
                    <div class="col-12" style="max-height: 550px; overflow: auto">
                        <h6 class="mb-3">CRMS Comments</h6>
                        <div style="max-height: 60; overflow: auto">

                            <?php if ($crmscomments) {
                                foreach ($crmscomments as $com) : ?>
                                    <?php echo '[' . $com['INSERT_DATE'] . '][' . $com['UNAME'] . ']' . $com['TEXT'] . '<hr/>' ?>
                            <?php endforeach;
                            } ?>
                        </div>

                    </div>
                </div> -->





            </div>
        </div>
    </main>


    <!-- Modal -->
    <div class="modal fade" id="myModaluser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabeluser">User Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Task Discription</label>
                        <textarea type="text" class="form-control" id="taskdiscriptionuser" disabled>  </textarea>
                    </div>


                    <div class="col-12">
                        <label class="form-label">Task Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="oss" value="OSS">
                            <label class="form-check-label" for="oss">
                                OSS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="bss" value="BSS">
                            <label class="form-check-label" for="bss">
                                BSS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="crm" value="CRM"">
                        <label class=" form-check-label" for="crm">
                            CRM
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Task Start Date</label>
                        <input type="text" class="form-control" id="taskstartuser" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Task End Date</label>
                        <input type="text" class="form-control" id="taskenduser" />
                    </div>
                    <span id="message">There can only be one instance inprogress from one task type</span>
                    <br />
                    <div class="col-7">
                        <button class="w-100 btn btn-primary btn-sm" id="taskstartuserbutton" type="button">Start
                            Task</button>
                        <!-- <button class="w-100 btn btn-danger btn-sm" id="taskstopuserbutton" type="button">Stop Task</button> -->
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">CR Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Task Discription</label>
                        <textarea type="text" class="form-control" id="taskdiscription" disabled>  </textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Task Start Date</label>
                        <input type="text" class="form-control" id="taskstart" />
                    </div>

                    <div class="col-12">
                        <label class="form-label">Task End Date</label>
                        <input type="text" class="form-control" id="taskend" />
                    </div>
                    <span id="message">There can only be one instance inprogress from one task type</span>
                    <br />
                    <div class="col-7">
                        <button class="w-100 btn btn-primary btn-sm" id="taskstartbutton" type="button">Start
                            Task</button>
                        <button class="w-100 btn btn-danger btn-sm" id="taskstopbutton" type="button">Stop Task</button>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New CR Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="newtaskname" />
                    </div>

                    <br />
                    <div class="col-7">
                        <button class="w-100 btn btn-primary btn-sm" id="taskaddbutton" type="button">Add Task</button>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add New Comment Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="form-label">Comment Type</label>
                        <input type="text" class="form-control" id="newcomtype" />
                    </div>

                    <br />
                    <div class="col-7">
                        <button class="w-100 btn btn-primary btn-sm" id="comtypeaddbutton" type="button">Add Type</button>

                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <br /><br /><br /><br /><br /><br />


    <!-- <div class="fab-container">
        <div class="fab fab-icon-holder" style="text-align:  center; padding-top: 15px;">
            <span style="color: white;">MDM</span>
        </div>
        <ul class="fab-options">
            <li>
                <span class="fab-label" id="uatmdmstart">UAT MDM START</span>
            </li>
            <li>
                <span class="fab-label" id="uatapcsyn">UAT APC SYNC</span>
            </li>
            <li>
                <span class="fab-label" id="preuatsuccess">PRE UAT SUCCESS</span>
            </li>
            <li>
                <span class="fab-label" id="preuatfailother">PRE UAT FAIL OTHER</span>
            </li>
            <li>
                <span class="fab-label" id="preuatfailmdm">PRE UAT FAIL MDM</span>
            </li>
            <li>
                <span class="fab-label" id="uatsucess">UAT SUCCESS</span>
            </li>
            <li>
                <span class="fab-label" id="uatfailother">UAT FAIL OTHER</span>
            </li>
            <li>
                <span class="fab-label" id="uatfailmdm">UAT FAIL MDM</span>
            </li>
            <li>
                <span class="fab-label" id="Iteration">UAT ITERATION</span>
            </li>
            <li>
                <span class="fab-label" id="mdmstart">MDM START</span>
            </li>
            <li>
                <span class="fab-label" id="apcsyn">APC SYNC</span>
            </li>
            <li>
                <span class="fab-label" id="prodsuc">PRODUCTION SUCCESS</span>
            </li>
        </ul>
    </div> -->




    <!-- jQuery -->
    <script src="http://ossportal/osscr/asset/js/jquery.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- Select2 JS -->
    <script src="http://ossportal/osscr/asset/js/select2.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script> -->

    <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js"></script> -->

    <script src="http://ossportal/osscr/asset/js/moment.min.js"></script>
    <script src="http://ossportal/osscr/asset/js/Chart.min.js"></script>

    <script src="http://ossportal/osscr/asset/js/jquery-ui.js"></script>


    <script>
        $(document).ready(function() {

            $("#taskstart").datepicker();
            $("#taskend").datepicker();

            $("#taskstartuser").datepicker();
            $("#taskenduser").datepicker();

            $("#crammendmentdate").datepicker();

            $("#selUser").select2();
            $("#amendcr").select2();

            $('#selUser').on('change', function() {
                var crid = $('#selUser').val();
                document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
            });


            $('#amendcr').on('change', function() {
                var taskname = $('#amendcr').val();
                if (!taskname) {
                    return;
                }
                var crid = $('#selUser').val();

                $.post("controller/amendTaskController.php?action=insert", {
                    ccr: taskname,
                    pcr: crid,
                }, function(data, status) {
                    document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                });
            });

            $('#userlist').on('change', function() {
                var taskname = $('#userlist').val();
                if (!taskname) {
                    return;
                }


                var crid = $('#selUser').val();
                var myModal = new bootstrap.Modal(document.getElementById('myModaluser'), {});

                $.post("controller/crusertaskController.php?action=listusertask", {
                    uname: taskname,
                    id: crid,
                }, function(data, status) {
                    //var jasondata = data.json();
                    // console.log('return data ' + data.length);

                    $("#taskstartuser").datepicker("setDate", "");
                    $("#taskstartuser").datepicker("setDate", "");
                    $("#taskdiscriptionuser").val("");
                    $("#taskstartuser").prop("disabled", false);
                    $("#modalLabeluser").text(taskname);
                    if (data.length > 0) {

                        $("#taskenduser").datepicker("setDate", 'today');
                        $("#taskdiscriptionuser").prop("disabled", true);
                        $("#taskdiscriptionuser").val(data[0]['TASK_COMMENT']);
                        $("#taskstartuser").datepicker("setDate", new Date(data[0]['START_DATE']));
                        $("#taskstartuserbutton").hide();
                        $("#taskstartuser").prop("disabled", true);
                        $("#taskenduser").show();
                        $("#taskstopbuttonuser").show();
                        $("#messageuser").show();
                    } else {

                        $("#taskstartuser").datepicker("setDate", 'today');
                        $("#taskdiscriptionuser").prop("disabled", false);
                        $("#taskstartuserbutton").show();
                        // $("#taskstopuserbutton").hide();
                        $("#taskenduser").hide();
                        $("#messageuser").hide();
                    }

                });
                myModal.show();
            });



            $('#taskstartuserbutton').click(function() {
                var taskdiscription = $("#taskdiscriptionuser").val();
                var task = $("#modalLabeluser").text();
                var crid = $('#selUser').val();
                var startdate = $('#taskstartuser').val();
                var topic = $('#crtopic').val();
                if (!startdate) {
                    alert("Start Date Cannot be Null");
                    return;
                }

                var system = $('input[name="flexRadioDefault"]:checked').val();
                if (!system) {
                    alert('Task Type is Mandatory');
                    return;
                }

                $.post("controller/crusertaskController.php?action=add", {
                    uname: task,
                    id: crid,
                    taskdis: taskdiscription,
                    startd: startdate,
                    ttype: system,
                    crtopic: topic,
                }, function(data, status) {
                    //console.log('return data ' + data);
                    if (data) {
                        // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                        savecomment("Start User Task " + task);
                    }
                });

            });





            $('#taskstopuserbutton').click(function() {
                var task = $("#modalLabel").text();
                var crid = $('#selUser').val();
                var enddate = $('#taskenduser').val();
                if (!enddate) {
                    alert("End Date Cannot be Null");
                    return;
                }
                $.post("controller/crusertaskController.php?action=update", {
                    tname: task,
                    id: crid,
                    endd: enddate
                }, function(data, status) {
                    //var jasondata = data.json();
                    console.log('return data ' + data);
                    if (data) {
                        //document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                        savecomment("End task " + task);
                    }

                });

            });



            $('#tasklist').on('change', function() {
                var taskname = $('#tasklist').val();
                if (!taskname) {
                    return;
                }
                if (taskname == 'add') {
                    var myModal = new bootstrap.Modal(document.getElementById('myModal1'), {});
                    myModal.show();
                    return;
                }


                var crid = $('#selUser').val();
                var myModal = new bootstrap.Modal(document.getElementById('myModal'), {});

                $.post("controller/crtaskController.php?action=list", {
                    tname: taskname,
                    id: crid
                }, function(data, status) {
                    //var jasondata = data.json();
                    // console.log('return data ' + data.length);

                    $("#taskstart").datepicker("setDate", "");
                    $("#taskstart").datepicker("setDate", "");
                    $("#taskdiscription").val("");
                    $("#taskstart").prop("disabled", false);
                    $("#modalLabel").text(taskname);
                    if (data.length > 0) {

                        $("#taskend").datepicker("setDate", 'today');
                        $("#taskdiscription").prop("disabled", true);
                        $("#taskdiscription").val(data[0]['TASK_COMMENT']);
                        $("#taskstart").datepicker("setDate", new Date(data[0]['START_DATE']));
                        $("#taskstartbutton").hide();
                        $("#taskstart").prop("disabled", true);
                        $("#taskend").show();
                        $("#taskstopbutton").show();
                        $("#message").show();
                    } else {

                        $("#taskstart").datepicker("setDate", 'today');
                        $("#taskdiscription").prop("disabled", false);
                        $("#taskstartbutton").show();
                        $("#taskstopbutton").hide();
                        $("#taskend").hide();
                        $("#message").hide();
                    }

                });
                myModal.show();
            });

            $('#taskstartbutton').click(function() {
                var taskdiscription = $("#taskdiscription").val();
                var task = $("#modalLabel").text();
                var crid = $('#selUser').val();
                var startdate = $('#taskstart').val();
                if (!startdate) {
                    alert("Start Date Cannot be Null");
                    return;
                }
                $.post("controller/crtaskController.php?action=add", {
                    tname: task,
                    id: crid,
                    taskdis: taskdiscription,
                    startd: startdate
                }, function(data, status) {
                    //console.log('return data ' + data);
                    if (data) {
                        // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                        savecomment("Start task " + task);
                    }
                });

            });




            $('#taskstopbutton').click(function() {
                var task = $("#modalLabel").text();
                var crid = $('#selUser').val();
                var enddate = $('#taskend').val();
                if (!enddate) {
                    alert("End Date Cannot be Null");
                    return;
                }
                console.log('enddate data ' + enddate);
                $.post("controller/crtaskController.php?action=update", {
                    tname: task,
                    id: crid,
                    endd: enddate
                }, function(data, status) {
                    //var jasondata = data.json();
                    console.log('return data ' + data);
                    if (data) {
                        //document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                        savecomment("End task " + task);
                    }

                });

            });





            $('#uatmdmstart').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "U_Start of Config",
                        tag: "Add"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=add", {
                                tname: "UAT-MDM START",
                                id: crid,
                                taskdis: myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                console.log('return data ' + data);
                                // if (data) {
                                //alert()
                                savecomment("U_Start of Config Task success response: " + myArray[1]);
                                //  }
                            });

                        } else {
                            alert("U_Start of Config response with " + myArray[1]);
                            savecomment("U_Start of Config Task Start Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#uatapcsyn').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "U_Ready for APC Sync",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=add", {
                                tname: "UAT-APC SYNC",
                                id: crid,
                                taskdis: myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                //console.log('return data ' + data);
                                // if (data) {
                                // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;

                                //  }
                                savecomment("U_Ready for APC Sync success response: " + myArray[1]);
                            });

                        } else {
                            alert("U_Ready for APC Sync response with " + myArray[1]);
                            savecomment("U_Ready for APC Sync Task Start Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });



            $('#mdmstart').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "P_Start of Config",
                        tag: "Add"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=add", {
                                tname: "MDM START",
                                id: crid,
                                taskdis: myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                console.log('return data ' + data);
                                // if (data) {
                                //alert()

                                //  }
                                savecomment("P_Start of Config Task success response: " + myArray[1]);
                            });
                        } else {
                            alert("P_Start of Config response with " + myArray[1]);
                            savecomment("P_Start of Config Task Start Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#apcsyn').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "P_Ready for APC Sync",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=add", {
                                tname: "APC SYNC",
                                id: crid,
                                taskdis: myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                //console.log('return data ' + data);
                                // if (data) {
                                // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;

                                //  }
                                savecomment("P_Ready for APC Sync success response: " + myArray[1]);
                            });
                        } else {
                            alert("P_Ready for APC Sync response with " + myArray[1]);
                            savecomment("P_Ready for APC Sync Task Start Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#prodsuc').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "PROD-Success",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "PROD-SUCCESS",
                                id: crid,
                                taskdis: myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                //console.log('return data ' + data);
                                // if (data) {
                                // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;

                                //  }
                                savecomment("PROD-Success response: " + myArray[1]);
                            });
                        } else {
                            alert("PROD-Success response with " + myArray[1]);
                            savecomment("PROD-Success Task Start Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });



            $('#Iteration').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "Iteration",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "ITERATION",
                                id: crid,
                                taskdis: "Iteration  Notified " + myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                savecomment("Iteration  task response: " + myArray[1]);
                                $.post("controller/crtaskController.php?action=add", {
                                    tname: "UAT-MDM START",
                                    id: crid,
                                    taskdis: "MDM Start due to Pre-UAT Failure",
                                    startd: moment().format('MM/DD/YYYY')
                                }, function(data, status) {
                                    savecomment("MDM Start due to Pre-UAT Failure in MDM");
                                });
                            });
                        } else {
                            alert("Iteration  response with " + myArray[1]);
                            savecomment("Iteration Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#preuatsuccess').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "Pre-UAT Success",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "PRE UAT SUCCESS",
                                id: crid,
                                taskdis: "Pre UAT Success Notified " + myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                //console.log('return data ' + data);
                                //  if (data) {
                                // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;

                                //  }
                                savecomment("PRE UAT SUCCESS  task response: " + myArray[1]);
                            });
                        } else {
                            alert("PRE UAT SUCCESS response with " + myArray[1]);
                            savecomment("PRE UAT SUCCESS Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });



            $('#uatsucess').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "UAT-Success",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "UAT SUCCESS",
                                id: crid,
                                taskdis: "UAT Success Notified " + myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                //console.log('return data ' + data);
                                //  if (data) {
                                // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;

                                //  }
                                savecomment("UAT SUCCESS task  response: " + myArray[1]);
                            });
                        } else {
                            alert("UAT SUCCESS response with " + myArray[1]);
                            savecomment("UAT SUCCESS Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#preuatfailmdm').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "Pre-UAT Failure",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "PRE UAT FAIL - MDM",
                                id: crid,
                                taskdis: "Pre-UAT Failure due to MDM Notified " + myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                savecomment("Pre-UAT Failure  due to MDM task response: " + myArray[1]);
                                $.post("controller/crtaskController.php?action=add", {
                                    tname: "UAT-MDM START",
                                    id: crid,
                                    taskdis: "UAT-MDM Start due to Pre-UAT Failure",
                                    startd: moment().format('MM/DD/YYYY')
                                }, function(data, status) {
                                    savecomment("UAT-MDM Start due to Pre-UAT Failure in MDM");
                                });
                            });
                        } else {
                            alert("Pre-UAT Failure due to MDM  response with " + myArray[1]);
                            savecomment("Pre-UAT Failure due to MDM Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });

            $('#preuatfailother').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();

                    $.post("controller/crtaskController.php?action=fulladd", {
                        tname: "PRE UAT FAIL - OTHER",
                        id: crid,
                        taskdis: "Pre-UAT Failure due to Other Systems",
                        startd: moment().format('MM/DD/YYYY')
                    }, function(data, status) {
                        savecomment("Pre-UAT Failure due to Other Systems");
                    });


                }
            });

            $('#uatfailmdm').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();
                    $.post("controller/runPython.php", {
                        id: crid,
                        task: "UAT-Failure",
                        tag: "Modify"
                    }, function(data, status) {
                        console.log('return data ' + data);
                        const myArray = data.split("##");
                        if (myArray[0] == "1") {
                            $.post("controller/crtaskController.php?action=fulladd", {
                                tname: "UAT FAIL - MDM",
                                id: crid,
                                taskdis: "UAT-Failure Notified due to MDM " + myArray[1],
                                startd: moment().format('MM/DD/YYYY')
                            }, function(data, status) {
                                savecomment("UAT-Failure due to MDM  task response: " + myArray[1]);
                                $.post("controller/crtaskController.php?action=add", {
                                    tname: "UAT-MDM START",
                                    id: crid,
                                    taskdis: "UAT-MDM Start due to UAT Failure",
                                    startd: moment().format('MM/DD/YYYY')
                                }, function(data, status) {
                                    savecomment("UAT-MDM Start due to UAT Failure in MDM");
                                });
                            });

                        } else {
                            alert("UAT-Failure due to MDM due to MDM response with " + myArray[1]);
                            savecomment("UAT-Failure due to MDM Failed. Returned " + myArray[1]);
                        }
                    });
                }
            });


            $('#uatfailother').click(function() {
                if (confirm('Are you sure you want to proceed?')) {
                    var crid = $('#selUser').val();

                    $.post("controller/crtaskController.php?action=fulladd", {
                        tname: "UAT FAIL - OTHER",
                        id: crid,
                        taskdis: "UAT-Failure due to Other Systems",
                        startd: moment().format('MM/DD/YYYY')
                    }, function(data, status) {
                        savecomment("due to Other Systems");
                    });


                }
            });






            $('#taskaddbutton').click(function() {
                var task = $("#newtaskname").val();
                var crid = $('#selUser').val();
                var randomColor = Math.floor(Math.random() * 16777215).toString(16);
                $.post("controller/crtaskController.php?action=addnew", {
                    tname: task,
                    colour: "#" + randomColor,
                }, function(data, status) {
                    //console.log('return data ' + data);
                    if (data) {
                        document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                        // savecomment("Start task " + task);
                    }
                });

            });


            $('#cmentsavebtn').click(function() {
                var comment = $('#newcomment').val();
                var crid = $('#selUser').val();
                var comtype1 = $('#comtypelist').val();

                
                    comtype1 = 'External';
                

                $.post("controller/commentController.php", {
                    newcomment: comment,
                    id: crid,
                    comtype: comtype1
                }, function(data, status) {
                    //console.log("return value " + data.toString());
                    document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                    // if(data){
                    //     document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                    // }else{
                    //     alert("Error insertinf Comment");
                    // }
                });

            });


            $('#notifykumudubtn').click(function() {
                var crid = $('#selUser').val();

                $.post("controller/emailController.php?action=add", {
                    id: crid
                }, function(data, status) {
                    //console.log(data);
                    savecomment("Email Notification set to Kumudu");
                });

            });


            function createDiagonalPattern(color = 'black') {
                let shape = document.createElement('canvas')
                shape.width = 10
                shape.height = 10
                let c = shape.getContext('2d')
                c.strokeStyle = color
                c.beginPath()
                c.moveTo(2, 0)
                c.lineTo(10, 8)
                c.stroke()
                c.beginPath()
                c.moveTo(0, 8)
                c.lineTo(2, 10)
                c.stroke()
                return c.createPattern(shape, 'repeat')
            }

            function savecomment(comm) {
                var crid = $('#selUser').val();
                $.post("controller/commentController.php", {
                    newcomment: comm,
                    id: crid,
                    comtype: 'Genaral'
                }, function(data, status) {
                    document.location = "http://ossportal/osscr/?a=exproject&id=" + crid;
                });
            }

            var lablearr = [];
            var dataarr = [];
            var comentarr = [];
            var bg = [];
            var maxdate = "";
            var mindate = "";
            var count = 0;
            <?php
            if ($crtasklist) {
                foreach ($crtasklist as $cr) : ?>
                    lablearr.push('<?php echo $cr['TASKNAME'] ?>');
                    var temparr = [new Date("<?php echo $cr['START_DATE'] ?>"), new Date("<?php echo $cr['END_DATE'] ?>")];
                    dataarr.push(temparr);
                    // maxdate = new Date("<?php echo $cr['END_DATE'] ?>");
                    if (count == 0) {
                        mindate = new Date("<?php echo $cr['START_DATE'] ?>");
                        maxdate = new Date("<?php echo $cr['END_DATE'] ?>");
                    } else {
                        if (maxdate < new Date("<?php echo $cr['END_DATE'] ?>")) {
                            maxdate = new Date("<?php echo $cr['END_DATE'] ?>");
                        }

                    }
                    comentarr.push('<?php echo $cr['TASK_COMMENT'] ?>');
                    if (moment("<?php echo $cr['END_DATE'] ?>").format(
                            'DD/MM/YYYY') == moment().format(
                            'DD/MM/YYYY')) {
                        bg.push(createDiagonalPattern('<?php echo $cr['COLOUR'] ?>'));
                    } else {
                        bg.push('<?php echo $cr['COLOUR'] ?>');
                    }

                    count++;
                <?php endforeach;
                ?>

                if (count < 5) {
                    $('#canvasdiv').height(300);
                } else {
                    //if (count > 10) {
                    var height = (lablearr.length * 40) + 50;
                    $("#canvasdiv").height(height);
                    // }
                }

                var ctx = document.getElementById("canvas").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: lablearr, //[1, 2, 3, 4, 5],
                        datasets: [{
                            label: 'Task',
                            data: dataarr,
                            backgroundColor: bg,
                            borderColor: '#2C3E50',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                time: {
                                    unit: 'day',
                                    displayFormats: {
                                        day: 'YYYY-MM-DD'
                                        //day: 'DD/MM/YYYY'
                                    }
                                },
                                ticks: {
                                    min: mindate, //dates[0].getTime(),
                                    max: maxdate, //dates[dates.length - 1].getTime()
                                    maxTicksLimit: 30
                                },
                                barThickness: 6,
                                maxBarThickness: 10,
                            }],
                            yAxes: [{
                                barThickness: 20,
                                maxBarThickness: 20,
                            }]
                        },
                        tooltips: {
                            enabled: true,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index];
                                    var sdate = moment(dataarr[tooltipItem.index][0]).format(
                                        'YYYY-MM-DD');
                                    var edate = moment(dataarr[tooltipItem.index][1]).format(
                                        'YYYY-MM-DD');
                                    var com = comentarr[tooltipItem.index];
                                    if (moment(dataarr[tooltipItem.index][1]).format(
                                            'YYYY-MM-DD') == moment().format(
                                            'YYYY-MM-DD')) {
                                        var x = '** TASK PENDING **';
                                    } else {
                                        var x = '';
                                    }

                                    return ['Start Date :' + sdate, 'End Date :' + edate, 'Comment :' +
                                        com, x
                                    ];
                                }
                            }

                        }
                    }
                });
            <?php } else {
            ?>
                $("#canvas").height(100);
            <?php }
            ?>



            /************************************************** */

            var lablearr_user = [];
            var dataarr_user = [];
            var comentarr_user = [];
            var bg_user = [];
            var maxdate_user = "";
            var mindate_user = "";
            var count = 0;
            <?php
            if ($usertasks) {
                foreach ($usertasks as $cr) : ?>
                    lablearr_user.push('<?php echo $cr['UNAME'] . ' [ ' . $cr['SNAME'] . ' ]' ?>');
                    var temparr = [new Date("<?php echo $cr['START_DATE'] ?>"), new Date("<?php echo $cr['END_DATE'] ?>")];
                    dataarr_user.push(temparr);
                    // maxdate_user = new Date("<?php echo $cr['END_DATE'] ?>");
                    if (count == 0) {
                        mindate_user = new Date("<?php echo $cr['START_DATE'] ?>");
                        maxdate_user = new Date("<?php echo $cr['END_DATE'] ?>");
                    } else {
                        if (maxdate_user < new Date("<?php echo $cr['END_DATE'] ?>")) {
                            maxdate_user = new Date("<?php echo $cr['END_DATE'] ?>");
                        }

                    }
                    comentarr_user.push('<?php echo $cr['TASK_COMMENT'] ?>');
                    if (moment("<?php echo $cr['END_DATE'] ?>").format(
                            'DD/MM/YYYY') == moment().format(
                            'DD/MM/YYYY')) {
                        bg_user.push(createDiagonalPattern('#D2B4DE'));
                    } else {
                        bg_user.push('#D2B4DE');
                    }

                    count++;
                <?php endforeach;
                ?>

                if (count < 5) {
                    $('#canvasdivuser').height(300);
                } else {
                    //if (count > 10) {
                    var height = (lablearr_user.length * 40) + 50;
                    $("#canvasdivuser").height(height);
                    // }
                }

                var ctx = document.getElementById("canvasuser").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: lablearr_user, //[1, 2, 3, 4, 5],
                        datasets: [{
                            label: 'Task',
                            data: dataarr_user,
                            backgroundColor: bg_user,
                            borderColor: '#2C3E50',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                time: {
                                    unit: 'day',
                                    displayFormats: {
                                        day: 'YYYY-MM-DD'
                                        //day: 'DD/MM/YYYY'
                                    }
                                },
                                ticks: {
                                    min: mindate_user, //dates[0].getTime(),
                                    max: maxdate_user, //dates[dates.length - 1].getTime()
                                    maxTicksLimit: 30
                                },
                                barThickness: 6,
                                maxBarThickness: 10,
                            }],
                            yAxes: [{
                                barThickness: 20,
                                maxBarThickness: 20,
                            }]
                        },
                        tooltips: {
                            enabled: true,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index];
                                    var sdate = moment(dataarr_user[tooltipItem.index][0]).format(
                                        'YYYY-MM-DD');
                                    var edate = moment(dataarr_user[tooltipItem.index][1]).format(
                                        'YYYY-MM-DD');
                                    var com = comentarr_user[tooltipItem.index];
                                    if (moment(dataarr_user[tooltipItem.index][1]).format(
                                            'YYYY-MM-DD') == moment().format(
                                            'YYYY-MM-DD')) {
                                        var x = '** TASK PENDING **';
                                    } else {
                                        var x = '';
                                    }

                                    return ['Assign Date :' + sdate, 'End Date :' + edate, 'Comment :' +
                                        com, x
                                    ];
                                }
                            }

                        }
                    }
                });
            <?php } else {
            ?>
                $("#canvasuser").height(100);
            <?php }
            ?>

            /******************************************************** */

            var commarr = [];

            <?php
            if ($comments) {
                foreach ($comments as $cr) : ?>
                    var temparr = ["<?php echo $cr['COMTYPE'] ?>", "<?php echo '[' . $cr['INSERT_DATE'] . '][' . $cr['UNAME'] . ']' . $cr['TEXT'] . '<hr/>' ?>", <?php
                                                                                                                                                                    if ($comtypes) {
                                                                                                                                                                        foreach ($comtypes as $crx) :  if ($crx['COM_TYPE'] == $cr['COMTYPE']) {
                                                                                                                                                                                echo "\"" . $crx['COLOUR'] . "\"";
                                                                                                                                                                            }
                                                                                                                                                                        endforeach;
                                                                                                                                                                    } ?>];
                    commarr.push(temparr);

            <?php endforeach;
            } ?>



            $('#comtypelist').on('change', function() {
                var comtype = $('#comtypelist').val();
                if (!comtype) {
                    var htmlcotntent = "";
                    commarr.forEach(function(item) {
                        htmlcotntent += "<p style=\"color:" + item[2] + " ;\">" + item[1] + "</p>";
                    });

                    $('#crcommendiv').html(htmlcotntent);
                    return;
                }
                if (comtype == 'add') {
                    var myModal = new bootstrap.Modal(document.getElementById('myModal2'), {});
                    myModal.show();
                    return;
                }

                var htmlcotntent = "";
                commarr.forEach(function(item) {
                    if (item[0] == comtype) {
                        htmlcotntent += item[1];
                    }
                });

                $('#crcommendiv').html(htmlcotntent);

            });


            // $("#comtypelist").val("Genaral").change();

            $('#comtypeaddbutton').click(function() {
                var comtype1 = $("#newcomtype").val();
                var crid1 = $('#selUser').val();
                var randomColor = Math.floor(Math.random() * 16777215).toString(16);
                $.post("controller/comtypeController.php?action=add", {
                    comtype: comtype1,
                    id: crid1,
                    colour: "#" + randomColor,
                }, function(data, status) {
                    console.log('return data ' + data);
                    //if (data) {
                    document.location = "http://ossportal/osscr/?a=exproject&id=" + crid1;
                    // savecomment("Add New Comment type " + comtype1);
                    //}
                });

            });



            $('input[type="checkbox"]').click(function() {

                if (this.id.match("^comUAT_")) {
                    //if ($("#" + this.id).is(':checked')) {
                    if (document.getElementById(this.id).checked) {
                        sentval = 1;
                    } else {
                        sentval = 0;
                    }
                    let temp = this.id.split("_");
                    var comtype1 = temp[1];
                    var crid1 = $('#selUser').val();
                    $.post("controller/comtypeController.php?action=updateuat", {
                        comtype: comtype1,
                        id: crid1,
                        status: sentval,
                    }, function(data, status) {
                        console.log('return data ' + data);
                        //if (data) {
                        // document.location = "http://ossportal/osscr/?a=exproject&id=" + crid1;
                        savecomment("Change UAT status of " + comtype1 + " to " + sentval);
                        //}
                    });

                    return;
                }

                if (this.id.match("^comPROD_")) {
                    //if ($("#" + this.id).is(':checked')) {
                    if (document.getElementById(this.id).checked) {
                        sentval = 1;
                    } else {
                        sentval = 0;
                    }
                    let temp = this.id.split("_");
                    var comtype1 = temp[1];
                    var crid1 = $('#selUser').val();
                    $.post("controller/comtypeController.php?action=updateprod", {
                        comtype: comtype1,
                        id: crid1,
                        status: sentval,
                    }, function(data, status) {
                        console.log('return data ' + data);
                        //if (data) {
                        //document.location = "http://ossportal/osscr/?a=exproject&id=" + crid1;                        
                        savecomment("Change Prod status of " + comtype1 + " to " + sentval);
                        //}
                    });

                    return;
                }

                var sentval = '';
                if ($("#bsscheck").is(':checked')) {
                    sentval = 1 + ' ';
                } else {
                    sentval = 0 + ' ';
                }
                if ($("#osscheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#crmcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#mdmcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#preuatcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#pmuatcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#uatcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#prodcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#pmcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }
                if ($("#depcheck").is(':checked')) {
                    sentval += 1 + ' ';
                } else {
                    sentval += 0 + ' ';
                }

                var crid1 = $('#selUser').val();

                $.post("controller/pendingcatController.php?action=addcat", {
                    val: sentval,
                    id: crid1
                }, function(data, status) {
                    //if (data) {
                    document.location = "http://ossportal/osscr/?a=exproject&id=" + crid1;
                    // savecomment("Add New Comment type " + comtype1);
                    //}
                });


            });

        });
    </script>
</body>

</html>