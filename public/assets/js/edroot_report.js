id = 0;
$(function()
{


    $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getStream",
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
            if (data != false || data != "")
            {

                streamid = data.streamid;
                batchname = data.batchname;
                alert(batchname);
            }
            else {
                alert("Stream not specified");
            }

        }
    });


});
function performance_chart()
{
    //alert("No exam conducted so far1");
    //var studentid=36;
    var temp;
    var percentile;
    $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getPerformance",
        dataType: 'json',
        success: function(data, textStatus, jqXHR) {
            if (data != false || data != "")
            {

                temp = data;
            }
            else {
                alert("No exam conducted so far");
            }

        }
    });
    return temp;
}
function getCalendar(month, year)
{
    var temp = 0;
    var color;
    var nv = new Array();
    $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getExamData&studentid=" + studentid + "&month=" + month + "&year=" + year,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            if (data != false || data != "")
            {

                for (temp = 0; temp < data.length; temp++)
                {
                    alpha = new Date(data[temp].year, data[temp].month - 1, data[temp].day);
                    switch (data[temp].subjectid)
                    {
                        case '1':
                            color = "#02C870";
                            break;
                        case '2':
                            color = "#FF5454";
                            break;
                        case '3':
                            color = "#00B0D2";
                            break;
                        case '4':
                            color = "#9ACD32";
                            break;
                        case '5':
                            color = "#008080";
                            break;
                        case '6':
                            color = " #66FF99";
                            break;
                        default:
                            color = "#F13452";
                    }
                    temp_obj = {
                        title: data[temp].topic,
                        id: '1',
                        start: alpha,
                        backgroundColor: color,
                        borderColor: color,
                        id: temp,
                                examid: data[temp].examid,
                    },
                            nv.push(temp_obj);
                }
                //alert(nv[3].title);	
            }
        }
    });


    return nv;
}
function assignId() {
    id = id + 1;
    return id;
}





function showDetails(id)
{

    //$('#my-modal').modal('show');
    var examid = nv[id].examid;
    var count = 0;
    document.getElementById("title").innerHTML = "<div style='float:left;'>EXAM STUDENT REPORT</div><div style='text-align:center;'>" + nv[id].title.toUpperCase() + "</div>";

    $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getCrosswot&studentid=" + studentid + "&examid=" + examid,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            document.getElementById("studentdetails").innerHTML = "<div style='float:left;width:100%;padding:10px;border-top:1px solid black;border-bottom:1px solid black;font-size:20px;'><div style='float:left;'><b style='margin:0px;border-right:1px solid white;padding-right:10px;'>Name</b>" + data[0].studentname + "</div>" + "<div style='float:right;text-align:right;align:center;'><b style='border-right:1px solid white;padding-right:5px;'>Batch</b>" + data[0].batch + "</div></div>";
            var you = (data[0].overallmarks / data[0].maxmarks) * 100;
            var average = (data[0].average / data[0].maxmarks) * 100;
            var topper = (data[0].toppermarks / data[0].maxmarks) * 100;
            //alert(you);
            document.getElementById("rank").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].overallrank + "</div><div style='background-color: #F5B619;opacity: 0.7;; display: block; position:relative; width: 90%; height: 12px;'></div><div style='font-size:20px;margin-left:35%;'>Rank</div>";
            document.getElementById("you").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].overallmarks + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8; opacity: 0.7;;display: block; position:relative; width: 90%; height: 12px;'><div id='you1'style='background-color:#00B0D2;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:42%;'>You</div>";
            document.getElementById("average").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].average + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8;opacity: 0.7;; display: block; position:relative; width: 90%; height: 12px;'><div id='average1'style='background-color:#02C870;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:38%;'>Average</div>";
            document.getElementById("topper").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].toppermarks + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8; opacity: 0.7;;display: block; position:relative; width: 90%; height: 12px;'><div id='topper1'style='background-color:#FF5454;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:38%;'>Topper</div>";
            document.getElementById("crossswot_header").innerHTML = "<div style='font-size:20px;width:100%;border-bottom:1px solid black;padding-bottom:5px;'><div style='float:left;'>CROS</div><div style='float:left;color:orange;'>SWOT</div>*</div>";
            document.getElementById("square").innerHTML = "<div style='width:100%;display:-webkit-box;-webkit-box-pack: center;display:-moz-box;-moz-box-pack: center;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;-webkit-box-flex:1;-moz-box-flex:1;'><div class='square' style='height:20px;width:20px;background-color:#02C870;opacity: 0.7;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Correct</div><div class='square' style='height:20px;width:20px;background-color:#FF5454;opacity: 0.7;;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Incorrect</div><div class='square' style='height:20px;width:20px;background-color:white;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Not attempted</div></div></br>";
            $("#you1").width(you + '%');
            $("#average1").width(average + '%');
            $("#topper1").width(topper + '%');
            var len = data[0].crosswot.length;
            var row = len / 3;
            var s = "";
            s = s + "<br><tr style='line-height:15px;'><th style='width:10%;'>Q.no.</th>";
            //s=s+"";

            //alert(data[0].crosswot.length);
            for (count = 0; count < row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black; width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = 0; count < row; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center'  style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center'  style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center'  style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = 0; count < row; count++)
            {
                s = s + "<td align='center'  style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr></table>";
            document.getElementById("crosswotanalysis_row1").innerHTML = s;

            //XXXXXXXXXXXXXXXXXXXX----question no 30-60-----------XXXXXXXXXXXXXXXXXXXXXXXX
            s = "";
            s = s + "<tr style='line-height: 15px;'><th style='width:10%;'>Q.no.</th>";
            for (count = row; count < 2 * row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = row; count < 2 * row; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center' style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center' style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center' style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = row; count < 2 * row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr>";
            // $("#crosswotanalysis_row2").append(s);
            document.getElementById('crosswotanalysis_row2').innerHTML = s;

            //XXXXXXXXXXXXXXXXXXXX----question no 60-90--------XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

            // alert(count);
            s = "";
            s = s + "<tr style='line-height: 15px;'><th style='width:10%;'>Q.no.</th>";
            for (count = 2 * row; count < len; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = 2 * row; count < len; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center' style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center' style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center' style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = 2 * row; count < len; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr>";
            document.getElementById('crosswotanalysis_row3').innerHTML = s;
            document.getElementById('text1').innerHTML = "Question numbers in increasing order of difficulty ----->";
        }

    });
    $('#my-modal').modal('show');
    delete data;
}

function get_esr(examid)
{
        $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getCrosswot&studentid=" + studentid + "&examid=" + examid,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            document.getElementById("studentdetails").innerHTML = "<div style='float:left;width:100%;padding:10px;border-top:1px solid black;border-bottom:1px solid black;font-size:20px;'><div style='float:left;'><b style='margin:0px;border-right:1px solid white;padding-right:10px;'>Name</b>" + data[0].studentname + "</div>" + "<div style='float:right;text-align:right;align:center;'><b style='border-right:1px solid white;padding-right:5px;'>Batch</b>" + data[0].batch + "</div></div>";
            var you = (data[0].overallmarks / data[0].maxmarks) * 100;
            var average = (data[0].average / data[0].maxmarks) * 100;
            var topper = (data[0].toppermarks / data[0].maxmarks) * 100;
            //alert(you);
            document.getElementById("rank").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].overallrank + "</div><div style='background-color: #F5B619;opacity: 0.7;; display: block; position:relative; width: 90%; height: 12px;'></div><div style='font-size:20px;margin-left:35%;'>Rank</div>";
            document.getElementById("you").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].overallmarks + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8; opacity: 0.7;;display: block; position:relative; width: 90%; height: 12px;'><div id='you1'style='background-color:#00B0D2;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:42%;'>You</div>";
            document.getElementById("average").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].average + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8;opacity: 0.7;; display: block; position:relative; width: 90%; height: 12px;'><div id='average1'style='background-color:#02C870;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:38%;'>Average</div>";
            document.getElementById("topper").innerHTML = "<div style='font-size:20px;margin-left:40%;'>" + data[0].toppermarks + "/" + data[0].maxmarks + "</div><div style='background-color: #e8e8e8; opacity: 0.7;;display: block; position:relative; width: 90%; height: 12px;'><div id='topper1'style='background-color:#FF5454;opacity: 0.7;;height:100%;float:left;'></div></div><div style='font-size:20px;margin-left:38%;'>Topper</div>";
            document.getElementById("crossswot_header").innerHTML = "<div style='font-size:20px;width:100%;border-bottom:1px solid black;padding-bottom:5px;'><div style='float:left;'>CROS</div><div style='float:left;color:orange;'>SWOT</div>*</div>";
            document.getElementById("square").innerHTML = "<div style='width:100%;display:-webkit-box;-webkit-box-pack: center;display:-moz-box;-moz-box-pack: center;-webkit-box-orient:horizontal;-moz-box-orient:horizontal;-webkit-box-flex:1;-moz-box-flex:1;'><div class='square' style='height:20px;width:20px;background-color:#02C870;opacity: 0.7;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Correct</div><div class='square' style='height:20px;width:20px;background-color:#FF5454;opacity: 0.7;;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Incorrect</div><div class='square' style='height:20px;width:20px;background-color:white;border:1px solid black;margin-left:8%;'></div><div style='margin-left:10px;'>Not attempted</div></div></br>";
            $("#you1").width(you + '%');
            $("#average1").width(average + '%');
            $("#topper1").width(topper + '%');
            var len = data[0].crosswot.length;
            var row = len / 3;
            var s = "";
            s = s + "<br><tr style='line-height:15px;'><th style='width:10%;'>Q.no.</th>";
            //s=s+"";

            //alert(data[0].crosswot.length);
            for (count = 0; count < row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black; width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = 0; count < row; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center'  style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center'  style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center'  style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = 0; count < row; count++)
            {
                s = s + "<td align='center'  style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr></table>";
            document.getElementById("crosswotanalysis_row1").innerHTML = s;

            //XXXXXXXXXXXXXXXXXXXX----question no 30-60-----------XXXXXXXXXXXXXXXXXXXXXXXX
            s = "";
            s = s + "<tr style='line-height: 15px;'><th style='width:10%;'>Q.no.</th>";
            for (count = row; count < 2 * row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = row; count < 2 * row; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center' style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center' style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center' style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = row; count < 2 * row; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr>";
            // $("#crosswotanalysis_row2").append(s);
            document.getElementById('crosswotanalysis_row2').innerHTML = s;

            //XXXXXXXXXXXXXXXXXXXX----question no 60-90--------XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

            // alert(count);
            s = "";
            s = s + "<tr style='line-height: 15px;'><th style='width:10%;'>Q.no.</th>";
            for (count = 2 * row; count < len; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;width:" + (90 / len * 3) + "%'>" + data[0].crosswot[count].qno + "</td>";
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>Response</th>";
            for (count = 2 * row; count < len; count++)
            {
                //alert(data[0].crosswot[count].resopnse)
                switch (data[0].crosswot[count].response)
                {
                    case ' ALPHA ':
                        s = s + "<td align='center' style='background-color:#02C870;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' BETA ':
                        s = s + "<td align='center' style='background-color:#FF5454;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    case ' GAMMA ':
                        s = s + "<td align='center' style='background-color:white;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                        break;
                    default:
                        s = s + "<td align='center' style='background-color:orange;opacity: 0.7;color:black;padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].markedans.toUpperCase() + "</td>";
                }
            }
            s = s + "</tr><tr style='line-height: 15px;'><th style='width:10%;'>AnsKey</th>";
            for (count = 2 * row; count < len; count++)
            {
                s = s + "<td align='center' style='padding-left:auto;border: 1px solid black;'>" + data[0].crosswot[count].correctans.toUpperCase() + "</td>";
            }
            s = s + "</tr>";
            document.getElementById('crosswotanalysis_row3').innerHTML = s;
            document.getElementById('text1').innerHTML = "Question numbers in increasing order of difficulty ----->";
        }

    });
}
function create_table()
{
    var s = "";
    var count;
    $.ajax({
        type: 'POST',
        async: false,
        url: "edroot_report.php",
        data: "action=getProficiency&studentid=" + studentid,
        dataType: 'json',
        success: function(data, textStatus, jqXHR)
        {
            if (!data.phy_weak)
                data.phy_weak = {};

            if (!data.phy_strong)
                data.phy_strong = {};
            if (!data.chem_strong)
                data.chem_strong = {};
            if (!data.maths_strong)
                data.maths_strong = {};
            if (!data.bio_strong)
                data.bio_strong = {};
            if (!data.chem_weak)
                data.chem_weak = {};
            if (!data.maths_weak)
                data.maths_weak = {};
            if (!data.bio_weak)
                data.bio_weak = {};
            if (!data.bio_strong)
                data.bio_strong = {};

            s = "<thead> <tr><th>Physics</th><th>Chemistry</th><th>Maths</th></tr></thead><tbody><tr><td><table><tr><th>Topicname</th><th>Proficiency</th></tr>";
            //document.getElementById("sptable").innerHTML=s; 
            for (count = 0; count < data.phy_weak.length; count++)
            {
                s = s + "<tr><td>" + data.phy_weak[count].topicname + "</td><td>" + data.phy_weak[count].proficiency + "</td></tr>";
            }
            for (count = 0; count < data.phy_strong.length; count++)
            {
                s = s + "<tr><td>" + data.phy_strong[count].topicname + "</td><td>" + data.phy_strong[count].proficiency + "</td></tr>";
            }
            s = s + "</table></td><td><table><tr><th>Topicname</th><th>Proficiency</th></tr>";

            for (count = 0; count < data.chem_weak.length; count++)
            {
                s = s + "<tr><td>" + data.chem_weak[count].topicname + "</td><td>" + data.chem_weak[count].proficiency + "</td></tr>";
            }
            for (count = 0; count < data.chem_strong.length; count++)
            {
                s = s + "<tr><td>" + data.chem_strong[count].topicname + "</td><td>" + data.chem_strong[count].proficiency + "</td></tr>";
            }



            s = s + "</table></td><td><table><tr><th>Topicname</th><th>Proficiency</th></tr>";

            for (count = 0; count < data.maths_weak.length; count++)
            {
                s = s + "<tr><td>" + data.maths_weak[count].topicname + "</td><td>" + data.maths_weak[count].proficiency + "</td></tr>";
            }
            for (count = 0; count < data.chem_strong.length; count++)
            {
                s = s + "<tr><td>" + data.maths_strong[count].topicname + "</td><td>" + data.maths_strong[count].proficiency + "</td></tr>";
            }
            s = s + "</table></td>";
            $("#sptable").append(s);
            //alert(get_stream().streamid);
            //alert(data.phy_strong.length);									   
        }
    });
}





