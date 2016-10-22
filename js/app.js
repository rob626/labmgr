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
    $('#validation_results').hide();
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

    $('#room_filter_machine_status').change(function() {
        var room_id = $(this).val();
        var params = [
                "room="+room_id
                ];
                window.location.href = "http://" + window.location.host + window.location.pathname + '?' + params.join('&');

    });

    $('#room_filter_register_machine').change(function() {
        var room_id = $(this).val();
        var params = [
                "room="+room_id
                ];
                window.location.href = "http://" + window.location.host + window.location.pathname + '?' + params.join('&');

    });

    $('#db_reset').click(function() {

        if(window.confirm("Are you sure (FULL DB Reset)?")) {
            location.href = this.href;

            $('#status_modal_content').html("");
            $('#status_modal_content').append("<p>Please wait...<p>");
            $('#status_modal').foundation('reveal', 'open');
            var data = 'truncate';
            $.ajax({        
                url: "/service/truncate_db",
                type: "get",
                dataType: "json",
                async: true,
                data: {data : data}
                }).done(function(response) {
                    //console.log(response);

                    $('#status_modal_content').append("<h3>"+response.status+"</h3>");

                    $.each(response.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
            
        } else {
            
        }
    });

    $('#cleanup_watchdog_dropins').click(function(e) {
        e.preventDefault();
        var data = $('#cleanup_watchdog_form :input').serializeArray();

        if(window.confirm("Are you sure (dropins cleanup)?")) {
            location.href = this.href;

            $('#status_modal_content').html("");
            $('#status_modal_content').append("<p>Please wait...<p>");
            $('#status_modal').foundation('reveal', 'open');
            $.ajax({        
                url: "/service/cleanup_watchdog",
                type: "get",
                dataType: "json",
                async: true,
                data: {data : data}
                }).done(function(response) {
                    console.log(response);

                    $.each(response, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value.status+"</h4>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
            
        } else {
            
        }
    });

    $('#cleanup_watchdog_FULL').click(function(e) {
        e.preventDefault();
        var data = $('#cleanup_watchdog_form :input').serializeArray();

        if(window.confirm("Are you sure (FULL WD cleanup)?")) {
            location.href = this.href;

            $('#status_modal_content').html("");
            $('#status_modal_content').append("<p>Please wait...<p>");
            $('#status_modal').foundation('reveal', 'open');
            $.ajax({        
                url: "/service/cleanup_watchdog_FULL",
                type: "get",
                dataType: "json",
                async: true,
                data: {data : data}
                }).done(function(response) {
                    console.log(response);

                    $.each(response, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value.status+"</h4>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
            
        } else {
            
        }
    });

    $('#db_reset_conference').click(function() {

        if(window.confirm("Are you sure (CONFERENCE DB Reset)?")) {
            location.href = this.href;

            $('#status_modal_content').html("");
            $('#status_modal_content').append("<p>Please wait...<p>");
            $('#status_modal').foundation('reveal', 'open');
            var data = 'truncate_conference';
            $.ajax({        
                url: "/service/truncate_conference_db",
                type: "get",
                dataType: "json",
                async: true,
                data: {data : data}
                }).done(function(response) {
                    //console.log(response);

                    $('#status_modal_content').append("<h3>"+response.status+"</h3>");

                    $.each(response.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
            
        } else {
            
        }
    });

    $('#validate_mac_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#validate_mac_form :input').serializeArray();

        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/validate_mac",
            type: "get",
            dataType: "json",
            async: true,
            
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h4>"+value+"</h4>");
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });


    
   $('#copy_file_by_machine_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#copy_file_by_machine_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/copy_file",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.exit_status, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

   $('#copy_file_from_by_machine_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#copy_file_from_by_machine_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/copy_file_from",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.exit_status, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

   $('#validate_vmx_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#validate_vmx_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/validate_vmx",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                });
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#bg_info_update_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#bg_info_update_class_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/run_cmd",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

$('#show_desktop_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#show_desktop_class_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/show_desktop",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });


    $('#run_single_cmd_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#run_single_cmd_class_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/run_cmd",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>")
                    });
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

$('#run_single_cmd_machine_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#run_single_cmd_machine_form :input').serializeArray();
        console.log(data);
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/run_cmd_machine",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");

                    $.each(value.cmd_output, function(index, value) {
                        $('#status_modal_content').append("<h4>"+value+"</h4>");
                    });

                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#start_vms_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#start_vms_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
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
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#start_vms_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#start_vms_class_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait....<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/start_stop_vms_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#find_vms_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#find_vms_class_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>")
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/find_vms_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>")
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });

    });


    $('#push_delete_torrents_class_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#push_delete_torrents_class_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>")
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/push_delete_torrents_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    if (value.status == false || typeof(value.status) == 'undefined' || value.status == null || value.status == 'null') {
                        $('#status_modal_content').append("<h3>"+value+"</h3>")
                    } else {
                        $('#status_modal_content').append("<h3>"+value.status+"</h3>")
                    }
                    
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#push_delete_torrents_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#push_delete_torrents_form :input').serializeArray();
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait...<p>");
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
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#delete_dirs_form').on('submit', function(e) {
        e.preventDefault();
        if(window.confirm("Are you sure (Delete directory)?")) {
            var data = $('#delete_dirs_form :input').serializeArray();
            $('#status_modal_content').html("Please wait...");
            $('#status_modal').foundation('reveal', 'open');
            
            $.ajax({        
                url: "/service/delete_dirs",
                type: "get",
                dataType: "json",
                async: true,
                data: {data : data}
                }).done(function(response) {
                    
                    $.each(response, function(index, value) {
                        $('#status_modal_content').append("<h3>"+value.status+"</h3>")
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
        }
    });

    $('#folder_list_btn').click(function(e) {
        e.preventDefault();
        var data = $('#delete_dirs_form :input').serializeArray();
        $('#status_modal_content').html("");
        //$('#status_modal').foundation('reveal', 'open');
        
        $.ajax({        
            url: "/service/delete_dirs_list",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $('#folder_list').html('');
                $.each(response, function(index, value) {
                    $('#folder_list').append("<input type='checkbox' name='folder_ids[]' value='"+value+"'><label>"+value+"</label><br>")
                }); 
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
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
                    $('#status_modal_content').append("<h4>"+value+"</h4>");
                });
                $('#status_modal_content').append("<p>Done.<p>");
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
        
    });

   $('.ssh_machine_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#ssh_machine_form :input').serializeArray();
        
        $('#status_modal').foundation('reveal', 'open');
        $.each(data, function(index, value) {

        });
    });

    $('.ssh_machine_btn').click(function() {
        var machine_id = $(this).attr('id');
        //$('#status_modal').addClass('full');
        $('#status_modal_content').html("");
        $.ajax({        
            url: "/service/ssh_machine",
            type: "get",
            dataType: "json",
            async: true,
            data: {machine_id : machine_id}
            }).done(function(response) {
                console.log(response);
                
                $('#status_modal').foundation('reveal', 'open');

                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h4>IP Address: "+value.ip_address+"</h4><iframe height='100%' width='100%' src='http://"+$(location).attr('host')+":4200'></iframe>")
                });
                $('#status_modal_content').append("<p>Done.<p>");
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
        
    });

    $('#reboot_btn_test').click(function() {
        if(window.confirm("Are you sure (Machine(s) reboot)?")) {
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
        }
    });

    $('.stop_all_classroom_btn').click(function() {
        var room_id = $(this).attr('id');

        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait......<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/stop_all_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {room_id : room_id}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('.reboot_classroom_btn').click(function() {
        var room_id = $(this).attr('id');
        if(window.confirm("Are you sure (Classroom reboot)?")) {

            $('#status_modal_content').html("");
            $('#status_modal_content').append("<p>Please wait.....<p>");
            $('#status_modal').foundation('reveal', 'open');

            $.ajax({        
                url: "/service/reboot_classroom",
                type: "get",
                dataType: "json",
                async: true,
                data: {room_id : room_id}
                }).done(function(response) {
                    $.each(response, function(index, value) {
                        $('#status_modal_content').append("<h3>"+value.status+"</h3>");
                    });
                    $('#status_modal_content').append("<p>Done.<p>");
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                    $('#status_modal_content').append("<p>Done.<p>");
                });
        }
    });

    $('.mouse_move_classroom_btn').click(function() {
        var room_id = $(this).attr('id');
        
        $('#status_modal_content').html("");
        $('#status_modal_content').append("<p>Please wait....<p>");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/mouse_move_classroom",
            type: "get",
            dataType: "json",
            async: true,
            data: {room_id : room_id}
            }).done(function(response) {
                $.each(response, function(index, value) {
                    $('#status_modal_content').append("<h3>"+value.status+"</h3>");
                });
                $('#status_modal_content').append("<p>Done.<p>");
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
                $('#status_modal_content').append("<p>Done.<p>");
            });
    });

    $('#shutdown_btn').click(function() {
        if(window.confirm("Are you sure (Classroom shutdown)?")) {
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
        }
    });

    $('#mouse_move_btn').click(function() {
        var machines = [];
        $('input:checkbox.checkbox').each(function () {
            if(this.checked) {
                machines.push($(this).val());
            }
           
        });

        $('#reboot_modal_content').html("");
        for(var i=0; i<machines.length; i++) {
            $.ajax({        
            url: "/service/mouse_move",
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

    $('#validate_ips_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#validate_ips_form :input').serializeArray();

        $('#status_modal_content').html("Please Wait...");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/validate_mac",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                $('#status_modal').foundation('reveal', 'close');
                $('#validation_results').show();
                
                $.each(response, function(index, value) {
                    //console.log(value);
                    $('#validation_results_table tr:last').after("<tr><td><input type='checkbox' class='checkbox' name='machine_ids[]' value='"+value.machine_id+"_"+value.new_ip+"'></td><td>"+value.room_name+"</td><td>"+value.seat+"</td><td>"+value.mac_address+"</td><td>"+value.ip_address+"</td><td style='font-weight:bold'>"+value.new_ip+"</td></tr>")
                });
 
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
    });

    $('#validation_result_form').on('submit', function(e) {
        e.preventDefault();
        var data = $('#validation_result_form :input').serializeArray();

        $('#status_modal_content').html("Please Wait...");
        $('#status_modal').foundation('reveal', 'open');

        $.ajax({        
            url: "/service/update_ips",
            type: "get",
            dataType: "json",
            async: true,
            data: {data : data}
            }).done(function(response) {
                console.log(response);
                if(response == true || response[0] == true) {
                    $('#status_modal_content').html('<h3>Updated Successfuly</h3>');
                } else {
                    $('#status_modal_content').append("<h3>Error</h3>");
                }
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                console.log(jqXHR, textStatus, errorThrown);
            });
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

    update_torrent_status();
    setInterval(function () { update_torrent_status() }, 20000);

    // Get Machine Status
    function update_torrent_status() {
        if($('#torrent_seeds_1').length > 0) {
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
                url: "/service/get_torrent_status",
                type: "get",
                dataType: "json",
                async: true,
                data: {machines : machines}
                }).done(function(response) {
                    //console.log(response);
                    $.each(response, function(index, value) {
                        $.each(value, function(index2, value2) {
                            if(value2.torrents == null) {
                                console.log('this is null');
                                $('#torrent_seeds_'+ value2.id).html('--');
                                $('#torrent_size_'+ value2.id).html('--');
                            } else {
                                var total = value2.torrents.length;
                                var seeds = 0;
                                var total_bytes = 0;
                                var remaining_bytes = 0;
                                var total_speed = 0;
                 
                                $.each(value2.torrents, function(torrent_index, torrent_value) {
                                    if(torrent_value['21'] == 'Seeding 100.0 %') {
                                        seeds++;
                                    }
                                    total_bytes += torrent_value['3'];
                                    remaining_bytes += torrent_value['18'];
                                    total_speed += torrent_value[9];
                                });
                                var completed_bytes = total_bytes - remaining_bytes;
                                $('#torrent_seeds_'+ value2.id).html(seeds+"/"+total) ;
                                if(total_bytes == 0) {
                                    $('#torrent_size_'+ value2.id).html("<span data-tooltip aria-haspopup='true' class='has-tip' title='This is a tooltip'>- @"+(total_speed/1024/1024).toFixed(0)+"<br>"+(completed_bytes/1024/1024/1024).toFixed(0)+"/"+(total_bytes/1024/1024/1024).toFixed(0)+'</span>');
                                } else {
                                    $('#torrent_size_'+ value2.id).html(((completed_bytes/total_bytes)*100).toFixed(0)+"% @"+(total_speed/1024/1024).toFixed(0)+"<br>"+(completed_bytes/1024/1024/1024).toFixed(0)+"/"+(total_bytes/1024/1024/1024).toFixed(0)) ;
                                }
                            }
                        });
                        
                    });
                    
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    //alert("Error submitting data!");
                    console.log(jqXHR, textStatus, errorThrown);
                });
            }
    }

    update_machine_status();
    setInterval(function () { update_machine_status() }, 60000);

    // Get Machine Status
    function update_machine_status() {
        if($('#status_total').length > 0) {
            var status_total = $('#status_total').text();
            var machines = [];

            for(var status_id = 1; status_id < status_total; status_id++) {    
                var ip = $('#machine_ip_'+ status_id).text();
                var machine_mac = $('#machine_mac_'+status_id).text();
                var machine = {
                    id:status_id,
                    mac_address:machine_mac,
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

                    $.each(response.status, function(index, value) {
                        console.log(response);

                        console.log(response.disk_usage);
                        if (value.disk_usage == false || typeof(value.disk_usage) == 'undefined' || value.disk_usage == null || value.disk_usage == 'null') {
                            $('#disk_usage_'+ value.id).html("<span class='button tiny secondary radius'>--</span>") ;
                        } else {
                            if(value.disk_usage > 95) {
                                $('#disk_usage_'+ value.id).html("<span class='button tiny alert radius'>"+value.disk_usage+"%</span>") ;
                            } else if(value.disk_usage > 89) {
                                $('#disk_usage_'+ value.id).html("<span class='button tiny warning radius'>"+value.disk_usage+"%</span>");
                            } else if(value.disk_usage > 79) {
                                $('#disk_usage_'+ value.id).html("<span class='button tiny success radius'>"+value.disk_usage+"%</span>");
                            } else if(value.disk_usage > 49) {
                                $('#disk_usage_'+ value.id).html("<span class='button tiny info radius'>"+value.disk_usage+"%</span>");
                            }  else {
                                $('#disk_usage_'+ value.id).html("<span class='button tiny secondary radius'>"+value.disk_usage+"%</span>");
                            }
                        }

                        if(value.lab_directories > 0 ) {
                            $('#lab_directories_'+ value.id).html("<a href='#' data-reveal-id='lab_dirs_modal_"+value.id+"'>"+value.lab_directories+"</a><div id='lab_dirs_modal_"+value.id+"' class='reveal-modal' data-reveal aria-labelledby='modalTitle' aria-hidden='true' role='dialog'><h2 id='modalTitle'>Session Directories ("+value.lab_directories+")</h2><p class='lead'><pre>"+value.lab_directory_list+"</pre></p><a class='close-reveal-modal' aria-label='Close'>&#215;</a></div>");
                        } else {
                            $('#lab_directories_'+ value.id).html(value.lab_directories);
                        }

                        if(value.vm_count > 0 ) {
                            $('#vm_count_'+ value.id).html("<a href='#' data-reveal-id='vm_count_modal_"+value.id+"'>"+value.vm_count+"</a><div id='vm_count_modal_"+value.id+"' class='reveal-modal' data-reveal aria-labelledby='modalTitle' aria-hidden='true' role='dialog'><h2 id='modalTitle'>Running VMs</h2><p class='lead'><pre>"+value.running_vm_list+"</pre></p><a class='close-reveal-modal' aria-label='Close'>&#215;</a></div>");
                        } else {
                            $('#vm_count_' + value.id).html(value.vm_count);
                        }
                    });
                    

            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                //console.log(jqXHR, textStatus, errorThrown);
            });       
        }
    }

    update_ping_status();
    setInterval(function () { update_ping_status() }, 10000);

    //Get Ping Status
    function update_ping_status() {
        if($('#status_total').length > 0) {
            var status_total = $('#status_total').text();
            var machines = [];

            for(var status_id = 1; status_id < status_total; status_id++) {    
                var ip = $('#machine_ip_'+ status_id).text();
                var machine_mac = $('#machine_mac_'+status_id).text();
                var machine = {
                    id:status_id,
                    mac_address:machine_mac,
                    ip_address:ip,
                    status:'' 
                }
                machines.push(machine);
            } 

            $.ajax({        
                url: "/service/get_ping_status",
                type: "get",
                dataType: "json",
                async: true,
                data: {machines : machines}
                }).done(function(response) {

                    $.each(response.status, function(index, value) {
                        console.log(response);

                        //console.log(response.disk_usage);
                        if(value.status == 'ONLINE') {
                            if(value.mac_status == 'FALSE') {
                                $('#status_'+ value.id).html("<span class='button warning tiny radius'>Online</span>");

                            } else {
                                $('#status_'+ value.id).html("<span class='button success tiny radius'>Online</span>");
                            }
                        } else {
                            $('#status_'+ value.id).html("<span class='button tiny alert radius'>Offline</span>");
                        }
                    });

            }).fail(function(jqXHR, textStatus, errorThrown) {
                //alert("Error submitting data!");
                //console.log(jqXHR, textStatus, errorThrown);
            });
        }
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
            "order": [[ 1, 'asc' ], [ 2, 'asc']]
        });
    }

    if($('#machine_datatable').length > 0) {
        $('#machine_datatable').dataTable({
            "paging": false,
            "order": [[ 1, 'asc' ], [ 2, 'asc']]
        });
    }

    if($('#datatable2').length > 0) {
        $('#datatable2').dataTable({
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