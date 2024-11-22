<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSS CR Track</title>

 

    <!-- <link href="asset/css/easy-gantt.css" /> -->
    <link href="asset/css/gantt.css" />

</head>

<body>
    <div class="container">

        <main>
            <div class="py-5 text-center">
                <h2>OSS CR Track</h2>
            </div>
            <div class="col-md-12 col-lg-12">
                <h4 class="mb-3">CR Details</h4>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <select id='selUser' class="form-select">
                            <?php
                            if ($crdetails) {
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
                    </div>



                    <div class="col-12">
                        <label class="form-label">CR TOPIC</label>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control" id="username" placeholder="" disabled value="<?php if ($crdetails) {
                                                                                                                        echo $crdetails[0]['CR_TOPIC'];
                                                                                                                    } ?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Discription</label>
                        <textarea type="text" class="form-control" disabled>  <?php if ($crdetails) {
                                                                                    echo $crdetails[0]['CR_DESC'];
                                                                                } ?>   </textarea>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Remarks</label>
                        <textarea type="text" class="form-control" id="owner" placeholder="" disabled><?php if ($crdetails) {
                                                                                                            echo $crdetails[0]['REMARKS'];
                                                                                                        } ?></textarea>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Product Owner</label>
                        <input type="text" class="form-control" id="owner" placeholder="" disabled value="<?php if ($crdetails) {
                                                                                                                echo $crdetails[0]['PRO_OWNER'];
                                                                                                            } ?>">
                    </div>

                    <div class="col-6">
                        <label for="address2" class="form-label">Product Group</label>
                        <input type="text" class="form-control" id="group" placeholder="" disabled value="<?php if ($crdetails) {
                                                                                                                echo $crdetails[0]['PRO_GROUP'];
                                                                                                            } ?>">
                    </div>


                    <div class="col-6">
                        <label for="address2" class="form-label">CR Type</label>
                        <input type="text" class="form-control" id="group" placeholder="" disabled value="<?php if ($crdetails) {
                                                                                                                echo $crdetails[0]['CR_TYPE'];
                                                                                                            } ?>">
                    </div>

                    <h4 class="mb-3">OSS Comments</h4>
                    <div style="max-height: 250px; overflow: auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Time</td>
                                    <td>User</td>
                                    <td>Comment</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($comments) {
                                    foreach ($comments as $com) : ?>
                                        <tr>
                                            <td><?php echo $com['INSERT_DATE'] ?></td>
                                            <td><?php echo $com['USERID'] ?></td>
                                            <td><?php echo $com['TEXT'] ?></td>
                                        </tr>
                                <?php endforeach;
                                } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                        <label class="form-label">New Comment</label>
                        <textarea type="text" id="newcomment" name="newcomment" class="form-control">   </textarea>
                    </div>
                    <div class="col-10"></div>
                    <div class="col-2">
                        <button class="w-100 btn btn-primary btn-sm" id="cmentsavebtn" type="button">Save Comment</button>
                    </div>

                    <h4 class="mb-3">CR Tasks</h4>
                    <div class="col-sm-6">
                        <select id='tasklist' class="form-select">
                        <option value=''>Update Task</option>
                            <?php
                            if ($tasklist) {
                                foreach ($tasklist as $cr) : ?>
                                    <option value='<?php echo $cr['TASK_NAME'] ?>'><?php echo $cr['TASK_NAME'] ?></option>
                            <?php endforeach;
                            } ?>
                        </select>
                    </div>

                    <div id="chart"></div>
                </div>
            </div>
        </main>


        <!-- Modal -->
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
                        <span id="message">There can only be one instance inprogress from one task type</span>
                        <br />
                        <div class="col-2">
                            <button class="w-100 btn btn-primary btn-sm" id="taskstartbutton" type="button">Start Task</button>
                            <button class="w-100 btn btn-danger btn-sm" id="taskstopbutton" type="button">Stop Task</button>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <br /><br /><br /><br /><br /><br />

    </div>





    <!-- jQuery -->
 
    <script src="asset/js/gantt.js"></script> 



    <script>
        $(document).ready(function() {

           

            var data =  [
    {
      recordID: 1,
      row: "Row for ID #1",
      tooltip: "Tooltips here! Get your tooltips!",
      start: "Wed Jun 03 2020 14:21:55",
      end: "Wed Jun 03 2020 20:21:55",
      urls: "https://www.cssscript.com"
    },
    {
      recordID: 2,
      row: "Row for ID #2",
      tooltip: "Tooltip for row 2",
      start: "Jun 03 2020 11:00:00",
      end: "Jun 03 2020 15:23:43",
      urls: "https://www.cssscript.com"
    },
    {
      recordID: 1,
      row: "Row for ID #1",
      tooltip: "Tooltip unique to this item",
      start: "Wed Jun 03 2020 06:00:00",
      end: "Wed Jun 03 2020 10:00:00",
      urls: "https://www.cssscript.com"
    }
];


var params = {
    sidebarHeader: "Unused right now",
    noDataFoundMessage: "No data found",
    startTimeAlias: "start",
    endTimeAlias: "end",
    idAlias: "recordID",
    rowAlias: "row",
    linkAlias: "urls",
    tooltipAlias: "tooltip",
    groupBy: null,
    groupByAlias: null,
    refreshFunction: refreshFunction
}

function refreshFunction() {
  return data;
}

var ganttChart = new Gantt("chart", params);

ganttChart.refreshData();


        });
    </script>
</body>

</html>