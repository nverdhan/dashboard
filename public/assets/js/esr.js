studentid = 49;
fetchexam = function(monthVal) {

    $("#myTabContent").html("");
    htmlcontent = '<div class="tab-pane fade active in table-responsive" style="overflow: hidden; width: 100%; height: auto;"> \n <table class="table"> \n <thead> \n <tr> \n <th class="per35">Test Topic</th> \n <th class="per15">Test Date</th> \n <th class="per15">Percentile</th> \n </tr> \n </thead> \n <tbody>';
    var studentVal = studentid;
    if (studentVal !== "") {
        $.ajax({
            type: 'POST',
            async: false,
            url: "edroot_report.php",
            data: "action=getEsrExams&studentid=" + studentVal + "&monthid=" + monthVal,
            dataType: 'json',
            success: function(data, textStatus, jqXHR) {
                if (data !== false || data !== "") {
                    for (i = 0; i < data.length; i++) {
                        thisdate = new Date(data[i].examdate.split('-').join(','));
                        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                        if (data[i].attendance == ' P') {
                            htmlcontent += '<tr onmouseover="this.style.cursor=' + '\'pointer\'"' + 'onclick=get_esr(' + data[i].examid + ')> \n <td>' + data[i].testtopic + '</td> \n <td>' + thisdate.getDate() + ' ' + monthNames[thisdate.getMonth()] + ' ' + thisdate.getFullYear() + '</td> \n <td>';
                            if (data[i].percentile <= 50) {
                                htmlcontent += '<div class="progress progress-striped"> \n <div style="width: ' + data[i].percentile + '%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="' + data[i].percentile + '" role="progressbar" class="progress-bar progress-bar-danger">' + Math.round(data[i].percentile) + '%</div> </div> </td> </tr>';
                            }
                            if (data[i].percentile > 50 && data[i].percentile <= 90) {
                                htmlcontent += '<div class="progress progress-striped"> \n <div style="width: ' + data[i].percentile + '%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="' + data[i].percentile + '" role="progressbar" class="progress-bar progress-bar-lime">' + Math.round(data[i].percentile) + '%</div> </div> </td> </tr>';
                            }
                            if (data[i].percentile > 90) {
                                htmlcontent += '<div class="progress progress-striped"> \n <div style="width: ' + data[i].percentile + '%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="' + data[i].percentile + '" role="progressbar" class="progress-bar progress-bar-success">' + Math.round(data[i].percentile) + '%</div> </div> </td> </tr>';
                            }
                        } else {
                            htmlcontent += '<tr> \n <td>' + data[i].testtopic + '</td> \n <td>' + thisdate.getDate() + ' ' + monthNames[thisdate.getMonth()] + ' ' + thisdate.getFullYear() + '</td> \n <td>';
                            htmlcontent += 'Absent </td> </tr>';
                        }


                    }
                    
                    htmlcontent += '\n </tbody> </table> \n </div>';

                }
                else {
                    alert("No exam conducted so far");
                }
            }
        });
    } else {
        $("#examnamestudentlistCntr").hide();
        $("#viewStudentReportButton").hide();
    }

    $("#myTabContent").html(htmlcontent);
};

