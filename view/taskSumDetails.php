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
        table {
            table-layout: fixed;
            width: 100%; /* Ensure the table takes the full width */
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
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSeaerch()">CR SEARCH</a>
                    </li>
                    <?php
                    if ($user == "012585" || $user == "010774" || $user == "010563" || $user == "015765") { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=emailList">EMAIL LIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=exlList">EXCEPTION LIST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://ossportal/osscr/?a=summary">SUMMARY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://ossportal/osscr/?a=projectList">CR LIST</a>
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
                <h4 class="mb-3">CR Summary Details</h4>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link  active" id="crsoss-tab" data-bs-toggle="tab" data-bs-target="#crsoss" type="button" role="tab" aria-controls="crsoss" aria-selected="false">CR Summary Oss</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="crsoss" role="tabpanel" aria-labelledby="crsoss-tab">
                        <div class="row g-3 p-2">
                            <div class="accordion" id="accordionSumDetailsOss">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingConfig">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConfig" aria-expanded="true" aria-controls="collapseConfig">
                                       Summary
                                    </button>
                                    </h2>
                                    <div id="collapseConfig" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionSumDetailsOss">
                                    <div class="accordion-body">
                                        <table class="table" id="TbCrDataOss" style="width: 100%">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="5">Configuration & Development</th>
                                                    <th colspan="3">UAT</th>
                                                    <th colspan="2">Waiting</th>
                                                </tr>
                                                <tr>
                                                    <th>CR_REF</th>
                                                    <th>BSS</th>
                                                    <th>OSS</th>
                                                    <th>CRM</th>
                                                    <th>MDM</th>
                                                    <th>PRE-UAT</th>
                                                    <th>UAT call-PM</th>
                                                    <th>UAT</th>
                                                    <th>PRODUCTION</th>
                                                    <th>PM</th>
                                                    <th>DEPENDENCY</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

<script src="http://ossportal/osscr/asset/js/jquery-ui.js"></script>

<script>
    $(document).ready(function() {

        $.ajax({
            url: 'controller/taskSumDetailsController.php?action=crSumDetailsOss',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data)
                console.log(data['result'])
                new DataTable('#TbCrDataOss', {
                    search: true,
                    ordering:  false,
                    data: data['result'],
                    // AutoWidth: true, 
                    responsive: false,
                    columns: [
                                { data: 'CR_REF'},
                                { data: "BSS",
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'OSS',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'CRM',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'MDM', 
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'PRE_UAT', 
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'PM_UAT', 
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                },
                                { data: 'UAT',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                 },
                                 { data: 'PRODUCTION',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                 },
                                { data: 'PM',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                 },
                                { data: 'DEPENDENCY',
                                    render: function(data, type, row) {
                                        if(data == 0) {
                                            return '';
                                        }else if (data == 1) {
                                            return row.CR_REF;
                                        }
                                    }
                                 }
                            ],
                            columnDefs: [
                                { width: '10%', targets: 0 },
                                { width: '9%', targets: 1 },
                                { width: '9%', targets: 2 },
                                { width: '9%', targets: 3 },
                                { width: '9%', targets: 4 },
                                { width: '9%', targets: 5 },
                                { width: '9%', targets: 6 },
                                { width: '9%', targets: 7 },
                                { width: '9%', targets: 9 },
                                { width: '9%', targets: 9 },
                                { width: '9%', targets: 10},
                            ]
                    });

            }
        });

    });
</script>

</body>
</html>