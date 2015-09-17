$(document).ready(function(){
   /* 
    if($('#time').length > 0) {
        setTimeout(function(){
            window.location.reload(1);
        }, 60000);
    }
    */
    $(document).foundation();

    $('.datepicker').datetimepicker({ dateFormat: "yy-mm-dd" });

    function formatTime(strDate) {
        var date = new Date(strDate);

        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'pm' : 'am';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        if(hours < 10) {
            hours = '0' + hours;
        }
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;

        //output format: 08:05:00 am - 10:05:00 am
        return strTime;
    }
/*
    $.ajax({
        url: "http://9.58.66.15/cgi-bin/dynamic/topbar.html",
        success: function(result) {
            var html = $('<div>').html(result);
            console.log(html);
            var status = html.find('.statusBox').html();
            alert(status);
        }
    });
*/
    function startTime() {
        var today=new Date();

        var weekday = new Array(7);
        weekday[0]=  "Sunday";
        weekday[1] = "Monday";
        weekday[2] = "Tuesday";
        weekday[3] = "Wednesday";
        weekday[4] = "Thursday";
        weekday[5] = "Friday";
        weekday[6] = "Saturday";
        var d = weekday[today.getDay()];

        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";
        var monthtext = month[today.getMonth()];

        var daynum = today.getDate();

        var h=today.getHours();
        var m=today.getMinutes();
          var ampm = h >= 12 ? 'pm' : 'am';
          h = h % 12;
          h = h ? h : 12; // the hour '0' should be '12'

        
        var s=today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        if($('#time').length > 0) {
            document.getElementById('time').innerHTML = d+", "+ monthtext +" "+daynum+" - "+h+":"+m+":"+s+ " "+ampm;
        }
        
        var t = setTimeout(function(){startTime()},500);
    }

    function checkTime(i) {
        if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
    startTime();
    
    
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
    $( "#whereami" ).dialog({
        width: 600
    });

    if($('.bxSlider').length > 0) {
        $('.bxslider').bxSlider({
          auto: true,
          autoControls: false,
          controls: false,
        });
    }

    
    if($('#datatable').length > 0) {
        $('#datatable').dataTable({
            "paging": false,
            "order": [[ 0, 'asc' ]]
        });
    }
    
    if($('#mac').length > 0) {
        var mac = $('#mac').text();
        console.log("Mac: " + mac);
        setInterval(function() {
            $.ajax({        
                url: "/service/",
                type: "get",
                dataType: "json",
                data: {id : mac}
                }).done(function(response) {
                    console.log(response);
                    var now_time = '';
                    var next_time = '';
                    if (typeof response.now['start'] == 'undefined') {
                        response.now['start'] = '';
                        response.now['end'] = '';

                    } else {
                        /*
                        response.now['start'] = formatTime(response.now['start']);
                        response.now['end'] = formatTime(response.now['end']);
                        */
                        now_time = response.now['start'] +" - "+ response.now['end'];
                        
                    }
                    if (typeof response.next['start'] == 'undefined') {
                        response.next['start'] = '';
                        response.next['end'] = '';
                    } else {
                        /*
                        response.next['start'] = formatTime(response.next['start']);
                        response.next['end'] = formatTime(response.next['end']);
                        */
                        next_time = response.next['start'] +" - "+ response.next['end'];
                    }
                    $('.now').html("<h2><span style='color:green;'>Now</span> &nbsp &nbsp &nbsp"+ now_time +"<h3>" + response.now['description'] + "</h3>");
                    $('.next').html("<h2><span style='color:green;'>Next</span> &nbsp &nbsp &nbsp"+ next_time +"<h3>" + response.next['description'] + "</h3>");
                    //$('#next_ticker').append("<li><h2><span style='color:green;'>Next</span> &nbsp &nbsp &nbsp"+ next_time +"<h3>" + response.next['description'] + "</h3></li>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                });
            }, 3000000);
    }

    //Get Pi Status
        if($('#status_total').length > 0) {
            setInterval(function() {
                var status_total = $('#status_total').text();
                var devices = [];

                for(var status_id = 0; status_id < status_total; status_id++) {    
                    var mac = $('#status_mac_'+ status_id).text();
                    var device = {
                        id:status_id,
                        device_mac:mac,
                        status:'' 
                    }
                    devices.push(device);
                    }

                    $.ajax({        
                        url: "/service/get_pi_status",
                        type: "get",
                        dataType: "json",
                        async: false,
                        data: {devices : devices}
                        }).done(function(response) {
                            //console.log(response.status );
                            $.each(response.status, function(index, value) {
                                //console.log(value);
                                if(value.status == 'ONLINE') {
                                    $('#status_'+ index).html("<span class='button success small'>Online</span>");
                                } else {
                                    $('#status_'+ index).html("<span class='button alert small'>Offline</span>");
                                }
                            });
                            
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            //alert("Error submitting data!");
                            console.log(jqXHR, textStatus, errorThrown);
                        });
                    
                }, 10000); 
            } 

            /*//Work developing on colorpicker function
        $.ajax({      
                url: "/service/",
                type: "get",
                dataType: "json",
                data: {id : mac}
                }).done(function(response) {
                    console.log(response);
                    var now_time = '';
                    var next_time = '';
                    if (typeof response.now['start'] == 'undefined') {
                        response.now['start'] = '';
                        response.now['end'] = '';
                    } else {
                        now_time = response.now['start'] +" - "+ response.now['end'];                     
                    }
                    if (typeof response.next['start'] == 'undefined') {
                        response.next['start'] = '';
                        response.next['end'] = '';
                    } else {
                        next_time = response.next['start'] +" - "+ response.next['end'];
                    }
                    $('.now').html("<h2><span style='color:green;'>Now</span> &nbsp &nbsp &nbsp"+ now_time +"<h3>" + response.now['description'] + "</h3>");
                    $('.next').html("<h2><span style='color:green;'>Next</span> &nbsp &nbsp &nbsp"+ next_time +"<h3>" + response.next['description'] + "</h3>");
                    //$('#next_ticker').append("<li><h2><span style='color:green;'>Next</span> &nbsp &nbsp &nbsp"+ next_time +"<h3>" + response.next['description'] + "</h3></li>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                });
            }, 3000000);
    }*/
        
        /** Working... But slow and freezes screen
        if($('#status_total').length > 0) {
            setInterval(function() {
                var status_total = $('#status_total').text();
                
                for(var status_id = 1; status_id < status_total; status_id++) {    
                    var mac = $('#status_mac_'+ status_id).text();

                    $.ajax({        
                        url: "/service/get_pi_status",
                        type: "get",
                        dataType: "json",
                        async: false,
                        data: {id : mac}
                        }).done(status_id, function(response) {
                            console.log(response.status + ' ' + status_id);
                            if(response.status == 'ONLINE') {
                                $('#status_'+ status_id).html("<span class='button success small'>Online</span>");
                            } else {
                                $('#status_'+ status_id).html("<span class='button alert small'>Offline</span>");
                            }
                            
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            //alert("Error submitting data!");
                            console.log(jqXHR, textStatus, errorThrown);
                        });
                        
                    }
                    
                }, 10000); 
            }   */

});