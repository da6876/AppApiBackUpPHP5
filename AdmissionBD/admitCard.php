<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }


        td {
            padding: 5px;
        }

        .tableHeaderTop {
            text-align: center;
        }

        .tableHeaderTop headers {
            font-size: 20px;
            font-weight: bold;

        }

        .tableHeaderTop span {
            font-size: 14px;
            font-weight: normal;

        }

        .tableTopImage {
            text-align: center;
            position: center;

        }


        .tablePersonalInfo b {
            font-size: 13px;
            display: inline-block;
            width: 30%;
            position: relative;
            padding-right: 10px; /* Ensures colon does not overlay the text */
        }

        .tablePersonalInfo b::after {
            font-size: 13px;
            content: ":";
            position: absolute;
            right: 10px;
        }

        .tablePersonalInfo span {
            font-size: 13px;
            vertical-align: middle;
        }



        .tableApplicantId span {
            border: 1px solid black;
            box-sizing: border-box;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 2px;
            padding-bottom: 2px;
            align-items: flex-start;
        }

        .tableApplicantId {
            text-align: center;
            font-size: 15px;
            vertical-align: top;
        }


        .tableEduData1 b {
            font-size: 13px;
            display: inline-block;
            width: 30%;
            position: relative;
            padding-right: 10px; /* Ensures colon does not overlay the text */

        }

        .tableEduData1 b::after {
            font-size: 13px;
            content: ":";
            position: absolute;
            right: 10px;


        }

        .tableEduData1 span {
            font-size: 13px;
            vertical-align: middle;

        }


        .tableEduData2 b {
            font-size: 13px;
            display: inline-block;
            width: 40%;
            position: relative;
            padding-right: 10px; /* Ensures colon does not overlay the text */

        }

        .tableEduData2 b::after {
            font-size: 13px;
            content: ":";
            position: absolute;
            right: 10px;


        }

        .tableEduData2 span {
            font-size: 13px;
            vertical-align: middle;

        }

        .tableEduData3 {

            align-content: center;
        }

        .tableEduData3 b {
            font-size: 13px;
            display: inline-block;
            width: 40%;
            position: relative;
            padding-right: 10px; /* Ensures colon does not overlay the text */

        }

        .tableEduData3 b::after {
            font-size: 13px;
            content: ":";
            position: absolute;
            right: 10px;


        }

        .tableEduData3 span {
            font-size: 13px;
            vertical-align: middle;

        }

        .page-break {
            page-break-after: always;
        }

        .admistxt {
            text-align: center;
            font-size: 14px;
        }

        #tableadmitcard2 tr td {
            border: 0px solid #1b1e21;
        }
        #headertable{
            border-bottom: 2px solid #e0e5ec;
        }
        #tabledata {

            border: 2px solid #1b1e21;
            border-radius: 2px;
            padding: 5px;
        }
    </style>


</head>

<?php
//error_reporting(0);
$admission = "(DESCRIPTION = 
					(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.20.25)(PORT = 1521))
					(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = mbp)))";

				$conn = ocilogon( "ADMISSIONBD", "ADMISSIONBD",$admission,"AL32UTF8");

?>
<body>

<button id="cmd">Generate PDF</button>
<div id="content">
    <div class="row">

        <div class="col-md-12" style="margin-bottom: 60px">

            <div class="col-md-12" style="margin-top: 25px;">

                <div class="card-body " id='printTable'>
				<?php

				$P_User = "01720821221";
				$P_ORG_CODE = "00007";
				$P_STU_APPLY_ID = "53";
				$P_TRACKING_NUMBER = "10000077";
				/* $P_USER_PHONE=$_POST['P_USER_PHONE'];
				$P_USER_PASSWORD=md5($_POST['P_USER_PASSWORD']); */

				$curs = oci_new_cursor($conn);

				$REG = oci_parse($conn, 
				"begin DPG_ADBD_STU_ADMIT_RESULT_MR.DPD_STU_ADMIT_CARD
				(:CURDATA,
				:P_ORG_CODE,
				:P_STU_APPLY_ID,
				:P_TRACKING_NUMBER,
				:P_User
				);
				end;");

				oci_bind_by_name($REG, ":CURDATA", $curs, -1, OCI_B_CURSOR);
				oci_bind_by_name($REG, ":P_ORG_CODE", $P_ORG_CODE, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_STU_APPLY_ID", $P_STU_APPLY_ID, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_TRACKING_NUMBER", $P_TRACKING_NUMBER, -1, SQLT_CHR);
				oci_bind_by_name($REG, ":P_User", $P_User, -1, SQLT_CHR);

				oci_execute($REG);
				oci_execute($curs);
				while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
					$output[]=$row;
					
				?>
                        <div class="table-responsive" id="tabledata">

                            <table class="table" id="headertable" width="100%">



                                <tbody>
                                <tr>
                                    <td class="tableTopImage" colspan="2">
                                        <img src="{{$studentData->org_image}} alt="Org Image" height="80px"/>
                                    </td>
                                    <td class="tableHeaderTop" colspan="4" style="text-align: center">
                                        <headers><?php echo $row['ORG_NAME']?></headers>
                                        <br>
                                        <span> Campus : <?php echo $row['CAMPUS_DESC']?></span><br>
                                        <span> Website : <u><?php echo $row['WEB_ADDR']?></u></span><br>
                                        <span> EIIN :<?php echo $row['EIIN']?> School Code : <?php echo $row['SCHOOL_CODE']?> College Code : <?php echo $row['COLLEGE_CODE']?></span>

                                    </td>
                                    <td colspan="3">
                                        <img src="{{$studentData->student_photo}}" alt="Student Image"
                                             height="100px"/>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table" id="tableadmitcard2" width="100%" >

                                <tbody>
                                <tr>
                                    <td colspan="9" class="admistxt"><b>Apply for admission to study
                                            : <?php echo $row['CLASS_DESC']?>
                                           ( <?php echo $row['VERSION_DESC']?> Version )</b></td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="tablePersonalInfo">
                                        <b>Student Name </b> <span><?php echo $row['STUDENT_NAME']?></span><br>
                                        <b>Father Name </b> <span><?php echo $row['FATHER_NAME']?></span><br>
                                        <b>Mother Name </b> <span><?php echo $row['MOTHER_NAME']?></span><br>
                                    </td>
                                    <td colspan="2" class="tableApplicantId">
                                        <b>Applicant ID </b> <br>
                                        <span>
                                            <?php echo $row['TRACKING_NUMBER']?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9"><b><u>Application Information</u></b></td>
                                </tr>

                                </tbody>
                            </table>


                            <table class="table" id="tableadmitcard3" width="100%">
                                <tbody>
                                <tr>
                                    <td colspan="3" class="tableEduData1">
                                        <b>Session </b> <span><?php echo $row['SESSION_DESC']?></span><br>
                                        <b>Class </b> <span><?php echo $row['CLASS_DESC']?></span>
                                    </td>
                                    <td colspan="3" class="tableEduData2">
                                        <b>Group </b> <span><?php echo $row['GROUP_DESC']?></span><br>
                                        <b>Campus</b> <span><?php echo $row['CAMPUS_DESC']?></span>
                                    </td>
                                    <td colspan="3" width="30%" class="tableEduData3">
                                        <b>Shift </b> <span><?php echo $row['SHIFT_DESC']?></span><br>
                                        <b>Version</b> <span><?php echo $row['VERSION_DESC']?></span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
						
                            <!-- <div class="page-break"></div>-->

                            <table class="table" id="tableadmitcard4" width="100%">
                                <tbody>
                                <tr>
                                    <td colspan="9" class="stuFooter">Instruction : <br>


                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    <?php
							}
										
						oci_free_statement($REG);
						oci_close($conn);
					?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });
</script>
</html>


