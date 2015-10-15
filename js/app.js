$(document).ready(function(){
    $(document).foundation();


   /* 
    if($('#time').length > 0) {
        setTimeout(function(){
            window.location.reload(1);
        }, 60000);
    }
    */
    $('.hidden').hide();

    $('#overrides').click(function() {
        $('.hidden').toggle();
    });

    $('.datepicker').datetimepicker({ dateFormat: "yy-mm-dd" });

    $('#select_all').click(function() {
        $('.machine-checkboxes').prop('checked', true);
        $('.checkbox').prop('checked', true);

    });

    $('#unselect_all').click(function() {
        $('.machine-checkboxes').prop('checked', false);
        $('.checkbox').prop('checked', false);
    });

    $('#room_filter').change(function() {
        var room_id = $(this).val();
         $.ajax({        
            url: "/service/get_machines_by_room",
            type: "get",
            dataType: "json",
            data: {room_id : room_id}
            }).done(function(response) {
                //console.log(response);
                $('#machine_list').html("");
                $.each(response, function(index, machine) {
                    //console.log(machine.ip_address);
                    $('#machine_list').append("<input type='checkbox' class='machine-checkboxes' name='machine_ids[]' value='"+machine['machine_id']+"'><label>Seat: "+machine['seat']+ ' ('+machine['ip_address']+")</label><br>");
                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });

    });

    $('#start_vms_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#start_vms_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/start_stop_vms",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>")

                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });

    $('#start_vms_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#start_vms_class_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/start_stop_vms_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>")

                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });

    $('#push_delete_torrents_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#push_delete_torrents_class_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal').foundation('reveal', 'open');
        
        $.ajax({        
            url: "/service/push_delete_torrents_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>")
                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });

    $('#push_delete_torrents_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#push_delete_torrents_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal').foundation('reveal', 'open');
        
        $.ajax({        
            url: "/service/push_delete_torrents",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>")
                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });

    $('.view_log_btn').click(function() {
        var machine_id = $(this).attr('id');
        $.ajax({        
            url: "/service/view_watchdog_log",
            type: "get",
            dataType: "json",
            async: true,
            data: {machine_id : machine_id}
            }).done(function(response) {
                console.log(response);
                
                $('#status_modal_content').html("<h2>"+response.status+"</h2>");
                $('#status_modal').foundation('reveal', 'open');
                response.cmd_output.reverse();
                $.each(response.cmd_output, function(index, value) {
                    $('#status_modal_content').append("<h4>"+value+"</h4>")
                    

                });
                
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
        
    });

    $('#reboot_btn_test').click(function() {
        var machines = [];
        $('input:checkbox.checkbox').each(function() {
            if(this.checked) {
                machines.push($(this).val());
            }
           
        });
        console.log(machines);
        $('#reboot_modal_content').html("");
        for(var i=0; i<machines.length; i++) {
            $.ajax({        
            url: "/service/reboot_machine",
            type: "get",
            dataType: "json",
            async: true,
            data: {machine_id : machines[i]}
            }).done(function(response) {
                console.log(response.status );
                /*
                $.each(response.status, function(index, value) {
                    if(value.status == 'ONLINE') {
                        $('#status_'+ value.id).html("<span class='button success tiny radius'>Online</span>");
                    } else {
                        $('#status_'+ value.id).html("<span class='button tiny warning radius'>Offline</span>");
                    }
                });
                */
                $('#reboot_modal_content').append("<h3>"+response.status+"</h3>")
                $('#reboot_modal').foundation('reveal', 'open');
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
        }
    });



    $('#shutdown_btn').click(function() {
        var machines = [];
        $('input:checkbox.checkbox').each(function () {
            if(this.checked) {
                machines.push($(this).val());
            }
           
        });

        $('#reboot_modal_content').html("");
        for(var i=0; i<machines.length; i++) {
            $.ajax({        
            url: "/service/shutdown_machine",
            type: "get",
            dataType: "json",
            async: true,
            data: {machine_id : machines[i]}
            }).done(function(response) {

                console.log(response.status );
                $('#reboot_modal_content').append("<h3>"+response.status+"</h3>")
                $('#reboot_modal').foundation('reveal', 'open');
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
        }
    });

    
    

    $('.reboot_btn').click(function() {
        console.log($(this).attr('id'));

        var machine_id = $(this).attr('id');
        $.ajax({        
            url: "/service/reboot_machine",
            type: "get",
            dataType: "json",
            async: true,
            data: {machine_id : machine_id}
            }).done(function(response) {
                console.log(response.status );
                /*
                $.each(response.status, function(index, value) {
                    if(value.status == 'ONLINE') {
                        $('#status_'+ value.id).html("<span class='button success tiny radius'>Online</span>");
                    } else {
                        $('#status_'+ value.id).html("<span class='button tiny warning radius'>Offline</span>");
                    }
                });
                */
                $('#reboot_modal_content').append("<h3>"+response.status+"</h3>")
                $('#reboot_modal').foundation('reveal', 'open');
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });


        //Get Machine Status
        if($('#status_total').length > 0) {
            setInterval(function() {
                var status_total = $('#status_total').text();
                var machines = [];

                for(var status_id = 1; status_id < status_total; status_id++) {    
                    var ip = $('#machine_ip_'+ status_id).text();
                    var machine = {
                        id:status_id,
                        ip_address:ip,
                        status:'' 
                    }
                    machines.push(machine);
                    }

                    $.ajax({        
                        url: "/service/get_machine_status",
                        type: "get",
                        dataType: "json",
                        async: true,
                        data: {machines : machines}
                        }).done(function(response) {
                            //console.log(response.status );
                            $.each(response.status, function(index, value) {
                                if(value.status == 'ONLINE') {
                                    $('#status_'+ value.id).html("<span class='button success tiny radius'>Online</span>");
                                } else {
                                    $('#status_'+ value.id).html("<span class='button tiny warning radius'>Offline</span>");
                                }
                            });
                            
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            //alert("Error submitting data!");
                            console.log(jqXHR, textStatus, errorThrown);
                        });
                    
                }, 10000); 
            } 

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
            "order": [[ 1, 'asc' ]]
        });
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