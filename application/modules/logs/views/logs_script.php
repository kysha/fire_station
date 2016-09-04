<script type="text/javascript">
var ppage;
var selectedpage;
var page_limit = 2;
var page_count;
var npbutton;
var showstart;
var showlast;

$(document).ready(function () {
    submitchoice();
    $('#first #second #yearchoice').datetimepicker({
        format: 'YYYY'
    });
    $('#first #second #monthchoice').datetimepicker({
        format: 'MM'
    });
});//end of document ready
function pagination(){
    $('.paging').empty();
    if(page_count>1){
        for(var y=1;y<=page_count;y++){
        var cloned = $('.pagebuttons').find('.page_count').clone();
        cloned.attr("id",y);
        cloned.attr("onclick","buttonchoice("+y+")");
        cloned.val(y);
        cloned.removeClass('.pagebuttons')
        $('.paging').append(cloned);
        }
    }
    if(selectedpage==1){
        showstart=1;
        showend= page_limit;
        for(var x=1;x<=page_count;x++){
            if(x>showend){
                $('.paging').find('#'+(x)).hide();
            }
        }
    }else if(selectedpage>1 || npbutton==next){
        if(selectedpage<showend){
            for(var x=1;x<=page_count;x++){
                if(x<showstart){
                    $('.paging').find('#'+(x)).hide();
                }else if(x>showend){
                    $('.paging').find('#'+(x)).hide();
                }else if(x==page_count){
                    showend = page_count;
                }
            }
        }else if(selectedpage==showend){
            showstart = showend;
            for(var x=1;x<=page_count;x++){
                for(var i=1,y=selectedpage;i<=page_limit;i++,y++){
                    showend = y;
                    if(page_count<showend){
                        showend=page_count;
                    }
                }
                if(x<showstart){
                    $('.paging').find('#'+(x)).hide();
                }else if(x>showend){
                    $('.paging').find('#'+(x)).hide();
                }
            }
        }
    }
    if(npbutton=="previous"){
        if(selectedpage<showstart){
            showend=selectedpage+1;
            for(var x=1;x<=page_count;x++){
                for(var i=page_limit,y=selectedpage;i>1;i--,y--){
                    showstart=y;
                    if(showstart<1){
                        showstart=1;
                    }
                }
                if(x<showstart){
                    $('.paging').find('#'+(x)).hide();
                }else if(x>showend){
                    $('.paging').find('#'+(x)).hide();
                }else{
                    $('.paging').find('#'+(x)).show();
                }
            }
        }
    }
    if(showstart==1){
        $('#previous').hide();
    }else{
        $('#previous').show();
    }
    if(showend==page_count){
        $('#next').hide();
    }else{
        $('#next').show();
    }
    if(page_count==1){
        $('#previous').hide();
        $('#next').hide();
    }
}
function processchoice(choices_object){
    $.post("<?php echo base_url('api/c_logs/logs')?>",choices_object,function(response){
        $('#tablelogs').empty();
        $('.paging').empty();
        $('#table_logs_error').hide();
        var data = jQuery.parseJSON(response);     
        if(!data["error"].length){
            var prev_fire_id;
            for (var x = 0; x < data.data.values.length; x++){
                if(prev_fire_id == data["data"]["values"][x]["fk_fire"]){
                    var cloned1 = $(".clone").find(".substationnew").clone();
                        cloned1.text(data["data"]["values"][x]["substn_name"]);
                        cloned1.attr("substation_ID",data["data"]["values"][x]["pk_respondsubstn"]);
                        $('#'+prev_fire_id).find(".substation").append(cloned1);
                    var cloned2 = $(".clone").find(".arrival_timenew").clone();                                                                              
                        cloned2.text(data["data"]["values"][x]["arvl_time"]);
                        cloned2.attr("arrivaltime_ID",data["data"]["values"][x]["pk_respondsubstn"]);
                        $('#'+prev_fire_id).find(".arrival_time").append(cloned2);
                }else{
                    var cloned = $('.clone').find('.toBeCloned').clone();
                    cloned.attr("id", data["data"]["values"][x]["pk_fire"]); // << id attribute note: on the tobeprinted() used class
                    cloned.find(".date").text(data["data"]["values"][x]["date"]);
                    cloned.find(".notification_time").text(data["data"]["values"][x]["notif_time"]);
                    cloned.find(".response_time").text(data["data"]["values"][x]["resp_time"]);
                    cloned.find(".arrival_timenew").text(data["data"]["values"][x]["arvl_time"]);
                    cloned.find(".arrival_timenew").attr("arrivaltime_ID",data["data"]["values"][x]["pk_respondsubstn"]);
                    cloned.find(".fireout_time").text(data["data"]["values"][x]["fout_time"]);
                    cloned.find(".location").text(data["data"]["values"][x]["address"]+" , "+data["data"]["values"][x]["brgy_name"]);
                    cloned.find(".substationnew").text(data["data"]["values"][x]["substn_name"]);
                    cloned.find(".substationnew").attr("substation_ID",data["data"]["values"][x]["pk_respondsubstn"]);
                    cloned.find(".category").text(data["data"]["values"][x]["category_type"]);
                    cloned.find(".notiftype").text(data["data"]["values"][x]["notification_type"]);
                    cloned.removeClass('toBeCloned');
                    prev_fire_id = data["data"]["values"][x]["pk_fire"];
                    $('#tablelogs').append(cloned);
                }
                document.getElementById("export_info").disabled = false;
            }
            if(data['data']['values']==false){
                document.getElementById("export_info").disabled = true;
                $('#previous').hide();
                $('#next').hide();
                $('#table_logs_error').show();
            }
            /*
            * PAGINATION
            */
            if(data["data"]["total_row"]>0){
                page_count = Math.ceil((data["data"]["total_row"])/(data["data"]["row_perpage"]));
                ppage = data["data"]["row_perpage"];
                pagination();
                $('.paging').find('#'+(selectedpage)).css('background','#7f7f7f');
            }
        }
    });
}
function clearAll(){
    $('#yearchoice').val("");
    $('#monthchoice').val("");
    $('#daychoice').val("");
    $('#locchoice').val("");
    $('#subchoice').val("");
    $('#categchoice').val("");
    $('#notiftypechoice').val("");
    submitchoice();
}
function submitchoice(){
    selectedpage = 1;
    choices_object={
        yearchoice: $('#yearchoice').val(),
        monthchoice: $('#monthchoice').val(),
        daychoice: $('#daychoice').val(),
        locchoice: $('#locchoice').val(),
        subchoice: $('#subchoice').val(),
        categchoice: $('#categchoice').val(),
        notiftype : $('#notiftypechoice').val(),
        ppage: 0
    }
    processchoice(choices_object);
    $('.paging').show();     
}
function buttonchoice(select_page){
    if(select_page=="next"){
        selectedpage=selectedpage+1;
        npbutton = select_page;
    }else if(select_page=="previous"){
        selectedpage=selectedpage-1;
        npbutton = select_page;
    }else{
        selectedpage = select_page;
        npbutton = " ";
    }
    ppeg=ppage*(selectedpage-1);
    choices_object={
        yearchoice: $('#yearchoice').val(),
        monthchoice: $('#monthchoice').val(),
        daychoice: $('#daychoice').val(),
        locchoice: $('#locchoice').val(),
        subchoice: $('#subchoice').val(),
        categchoice: $('#categchoice').val(),
        notiftype : $('#notiftypechoice').val(),
        ppage: ppeg
    }
    processchoice(choices_object);
}
/**
* PRINT CHOICES TO PDF
**/
function to_pdf(divName){
    $.post("<?php echo base_url('api/c_logs/generate_pdf')?>",choices_object,function(response){
        $('#tablelogs1').empty();
        var data = jQuery.parseJSON(response);
        if(!data["error"].length){
            var prev_fire_id;
            var loc_counter=0;
            var sub_counter=0;
            for (var x1 = 0; x1 < data.data.values.length; x1++){
                if(prev_fire_id == data["data"]["values"][x1]["fk_fire"]){
                    var cloned1 = $(".clone1").find(".substation1new").clone();
                        cloned1.text(data["data"]["values"][x1]["substn_name"]);
                        cloned1.attr("substation_ID1",data["data"]["values"][x1]["pk_respondsubstn"]);
                        $('.'+prev_fire_id).find(".substation1").append(cloned1);
                    var cloned2 = $(".clone1").find(".arrival_time1new").clone();
                        cloned2.text(data["data"]["values"][x1]["arvl_time"]);
                        cloned2.attr("arrivaltime_ID1",data["data"]["values"][x1]["pk_respondsubstn"]);
                        $('.'+prev_fire_id).find(".arrival_time1").append(cloned2);
                }else{
                    var cloned = $('.clone1').find('.toBeCloned1').clone();
                    cloned.attr("class", data["data"]["values"][x1]["pk_fire"]); //<< class attribute, note: processchoice() used id.
                    cloned.find(".date1").text(data["data"]["values"][x1]["date"]);
                    cloned.find(".notification_time1").text(data["data"]["values"][x1]["notif_time"]);
                    cloned.find(".response_time1").text(data["data"]["values"][x1]["resp_time"]);
                    cloned.find(".arrival_time1new").text(data["data"]["values"][x1]["arvl_time"]);
                    cloned.find(".arrival_timenew").attr("arrivaltime_ID",data["data"]["values"][x1]["pk_respondsubstn"]);
                    cloned.find(".fireout_time1").text(data["data"]["values"][x1]["fout_time"]);
                    cloned.find(".location1").text(data["data"]["values"][x1]["address"]+" , "+data["data"]["values"][x1]["brgy_name"]);
                    cloned.find(".substation1new").text(data["data"]["values"][x1]["substn_name"]);
                    cloned.find(".substation1new").attr("substation_ID1",data["data"]["values"][x1]["pk_respondsubstn"]);
                    cloned.find(".category1").text(data["data"]["values"][x1]["category_type"]);
                    cloned.find(".notiftype1").text(data["data"]["values"][x1]["notification_type"]);
                    cloned.removeClass('toBeCloned1');
                    prev_fire_id = data["data"]["values"][x1]["pk_fire"];
                    $('#tablelogs1').append(cloned);
                    x_old = x1-1;
                    if(x_old>=0){
                        if(data["data"]["values"][x1]["brgy_name"]!=data["data"]["values"][x_old]["brgy_name"]){
                            loc_counter=loc_counter+1;
                        }
                        if(data["data"]["values"][x1]["substn_name"]!=data["data"]["values"][x_old]["substn_name"]){
                            sub_counter=sub_counter+1;
                        }
                    }
                }
                if(sub_counter<1){
                    var sub = data["data"]["values"][x1]["substn_name"];
                }else{
                    var sub = "";
                }
                if(loc_counter<1){
                    var loc = data["data"]["values"][x1]["brgy_name"];
                }else{
                    var loc = "";
                }
                var cat = data["data"]["values"][x1]["category_type"];
            }
            sorted_by(cat,sub,loc);
            var printContents = document.getElementById(divName).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            location.reload();
        }
    });
}
/**
* PDF HEADER PRINT
**/
function sorted_by(cat,sub,loc){
    var by_type;                  
    var year = choices_object['yearchoice'];   
    var month = choices_object['monthchoice'];
    var day = choices_object['daychoice'];
    var category =  choices_object['categchoice'];
    var barangay = choices_object['locchoice'];
    var substation = choices_object['subchoice'];
    var arraymonth = "January,February,March,April,May,June,July,August,September,October,November,December";
    arraymonth =arraymonth.split(",");
    if(category!=""){
        category=cat;
    }
    if(month!=""){
        month = " "+arraymonth[choices_object['monthchoice']-1];
    }
    if(day!="" && (month!="" || year!="")){
        day = " "+choices_object['daychoice'];
    }else if(day!="" && (month=="" || year=="")){
        day = " ";
    }
    if(barangay!="" && loc!=""){
        barangay="in barangay "+loc;
    }else{
        barangay="";
    }
    if(choices_object['subchoice']!="" && sub!=""){
        substation="<br/> responded by "+sub+" substation";
    }else{
        substation="";
    }
    notif_type = $('#notiftypechoice').val()+" ";
    by_type = year+" "+month+" "+day+" "+category+" "+barangay+" "+substation;
    $('.notiftype').append(notif_type);
    $('.sort_type').append(by_type);
}
/**
* SUGGESTION ONKEYUP
**/
function listbarangay(){
    var brgy={
        brgy_name : $("[name=locationmodal]").val(),
        select : "brgy_name",
        from : "brgy_info"
    };
    $.post("<?php echo base_url('api/c_logs/listsuggest')?>",brgy,function(response){
        $("#dlbarangay").empty();
        var data = jQuery.parseJSON(response);
        var dataList = document.getElementById("dlbarangay");
        if(!data["error"].length){
            for (var x = 0; x < data.data.length; x++){
                var option = document.createElement("option");
                option.value = data["data"][x]["brgy_name"];
                dataList.appendChild(option);
            }
        }
    });
}
/**
* EDIT MODAL
**/
$('#LogsModal').on('show.bs.modal', function(response){
    $('#LogsModal').find('#logs_header').show();
    $('#LogsModal').find('#logs_body').show();
    $('#LogsModal').find('#logs_footer').show();
    $('#LogsModal').find('#logs_headSuccess').hide();
    $('#LogsModal').find('#logs_bodySuccess').hide();
    $('#LogsModal').find('#logs_footSuccess').hide();
    var source = $(response.relatedTarget);
    currentRow = source.closest('tr');
    responseID = currentRow.attr('id');
    $("#"+responseID).each(function(){
        /*Remove has-error class*/
        $(".categ_error").removeClass("has-error");
        $('.barangay_error').removeClass("has-error");
        $('.notifdate_error').removeClass("has-error");
        $('.notiftime_error').removeClass("has-error");
        $('.firetime_error').removeClass("has-error");
        $('.response_error').removeClass("has-error");
        $('.address_error').removeClass("has-error");
        var x=0;
        $("[name=substationmodal]").each(function(){
            $(".show_arvltime").find(".substn_error").removeClass("has-error");
            x++;
        });
        var x=0;
        $("[name=arrival_timemodal]").each(function(){
            $(".show_arvltime").find(".arvl_error").removeClass("has-error");
            x++;
        });
        /*Empty error fields*/
        $('.error_barangay').empty();
        $('.error_notiftime').empty();
        $('.error_firetime').empty();
        $('.error_response').empty();
        $('.error_address').empty();
        $(".show_arvlsubstn").empty();
        $('.edit_infoerror').empty();
        $('.edit_resperror').empty(); 
        /*Set values*/
        $("[name=logID]").attr("id",responseID);
        var notification = $(this).find(".notification_time").text();
        var response_time = $(this).find(".response_time").text();
        var fireout = $(this).find(".fireout_time").text();
        var location = $(this).find(".location").text().split(" , ");
        var category = $(this).find(".category").text();
        $("[name=notification_timemodal]").val(notification);
        $("[name=response_timemodal]").val(response_time);
        $("[name=fireout_timemodal]").val(fireout);
        $("[name=addressmodal]").val(location[0]);
        $("[name=locationmodal]").val(location[1]);
        $("[name=categorymodal]").val(category);
        var sub_arr = new Array();
        var x=0;
        $(this).find(".substation").find("p").each(function(){
            sub_arr[x] = new Array(2);
            sub_arr[x][0]=$(this).text();
            sub_arr[x][1]=$(this).attr("substation_ID");
            x++;
        })
        var arv_arr= new Array();
        var x=0;
        $(this).find(".arrival_time").find("p").each(function(){
            arv_arr[x] = new Array(2);
            arv_arr[x][0] = $(this).text();
            arv_arr[x][1] = $(this).attr("arrivaltime_ID");
            x++;
        })
        for(x=0,y=0;x<sub_arr.length,y<arv_arr.length;x++,y++){
            var cloned = $(".arrival_substn").find('.arval_substn_clone').clone();
            var arvl_data = arv_arr[y][0];
            var arvl_dataID = arv_arr[y][1];
            cloned.find("[name=arrival_timemodal]").val(arvl_data);
            cloned.find("[name=arrival_timemodal]").attr("id",arvl_dataID);
            var substn_data = sub_arr[x][0];
            var substn_dataID = sub_arr[x][1];
            cloned.find("[name=substationmodal]").val(substn_data);
            cloned.find("[name=substationmodal]").attr("id",substn_dataID);
            cloned.removeClass("arval_substn_clone");
            cloned.find(".arvl_error").attr("id","arvl"+arvl_dataID);
            cloned.find(".substn_error").attr("id","sub"+substn_dataID);
            $(".show_arvlsubstn").append(cloned);
        }
        $(".arrival_timemodal").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $("[name=notification_timemodal]").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $("[name=response_timemodal]").datetimepicker({
            format: 'HH:mm:ss'
        });
        $("[name=fireout_timemodal]").datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
});
$('#LogsModal').on("click", "#SaveLogsBTN", function(response){
    var substn_check=[];
    var arvl_check=[];
    /*Remove has-error class*/
    $('.barangay_error').removeClass("has-error");
    $('.notiftime_error').removeClass("has-error");
    $('.firetime_error').removeClass("has-error");
    $('.response_error').removeClass("has-error");
    $('.address_error').removeClass("has-error");
    /*Place data in an array to pass to object_tobBeEdited*/
    var x=0;
    $('.modal').find("[name=substationmodal]").each(function(){
        $(".modal").find(".show_arvlsubstn").find("#sub"+$(this).attr("id")).removeClass("has-error");
        substn_check[x] = $(this).attr("id")+"+"+$(this).val();
        x++;
    });
    var x=0;
        $('.modal').find("[name=arrival_timemodal]").each(function(){
        $(".modal").find(".show_arvlsubstn").find("#arvl"+$(this).attr("id")).removeClass("has-error");
        arvl_check[x] = $(this).attr("id")+"+"+$(this).val();
        x++;
    });
    /*Empty error fields*/
    $('.error_barangay').empty();
    $('.error_notiftime').empty();
    $('.error_firetime').empty();
    $('.error_response').empty();
    $('.error_address').empty();   
    $('.edit_infoerror').empty();
    $('.edit_resperror').empty(); 
    for(var x=0;x<substn_check.length;x++){
        y=substn_check[x].split("+");
        $(".modal").find(".show_arvlsubstn").find("#sub"+y[0]).find("span").empty();
    }
    for(var x=0;x<arvl_check.length;x++){
        y=arvl_check[x].split("+");
        $(".modal").find(".show_arvlsubstn").find("#arvl"+y[0]).find("span").empty();
    }
    /*compute response time*/
    var arvl_moment;
    var prevresponse;
    var response_moment;
    var resptab_count=0;
    var infotab_count=0;;
    var notif_moment = moment($('.modal').find("[name=notification_timemodal]").val());
    $('.modal').find("[name=arrival_timemodal]").each(function(){
        if ($(this).val().trim()){
            arvl_moment = moment($(this).val());
            response_moment=arvl_moment.diff(notif_moment);
            if (prevresponse<response_moment){
                response_moment=prevresponse;
            }
            prevresponse=response_moment;
        }
        var d = moment.duration(response_moment);
        if((d.months()>0 || d.years()>0) || (d.months()<0  || d.years()<0)){
            err_time = "yearmonth";
        }else if(d.days()>=1){
            err_time = d.days();
        }else if((d.hours()==0 && d.minutes()==0 && d.seconds()==0) || d.days()<0 ||
                ((d.hours()<0 || d.minutes()<0 || d.seconds()<0) && d.days()>=0)){
            err_time="error";
        }else{
            err_time="";
        }
        response_time = d.hours()+":"+d.minutes()+":"+d.seconds();
    });
    var object_toBeEdited= {
        editLogsId : $("[name=logID]").attr("id"),
        editValNotification : $('.modal').find("[name=notification_timemodal]").val(),
        editValFireout : $('.modal').find("[name=fireout_timemodal]").val(),
        editValResponse : response_time,
        error_response : err_time,
        editValLocation : $('.modal').find("[name=locationmodal]").val(),
        editValCategory : $('.modal').find("[name=categorymodal]").val(),
        editValAddress : $('.modal').find("[name=addressmodal]").val(),
        editValSubstation_check: substn_check,
        editValArival_check: arvl_check
    }
    $.post("<?php echo base_url('api/c_logs/editLogs')?>",object_toBeEdited,function(response){
        var data = jQuery.parseJSON(response);
        if(data["data"]["errors"]){
            for(var y=0;y<data["data"]["errors"]["arv"].length;y++){
                if(!(data["data"]["errors"]["arv"][y]["error"]===undefined)){
                    var arrival = data["data"]["errors"]["arv"][y]["error"];
                    var id = data["data"]["errors"]["arv"][y]["id"];
                    $(".modal").find(".show_arvlsubstn").find("#arvl"+id).addClass("has-error");
                    $(".modal").find(".show_arvlsubstn").find("#arvl"+id).find("span").show().append(arrival);
                    resptab_count=resptab_count+1;
                }
            }
            if(data["data"]["errors"]["loc"]!=""){
                var barangay = data["data"]["errors"]["loc"];
                $(".barangay_error").addClass("has-error");
                $('.error_barangay').show().append(barangay);
                infotab_count=infotab_count+1;
            }
            if(data["data"]["errors"]["address"]!=""){
                var address = data["data"]["errors"]["address"];
                $(".address_error").addClass("has-error");
                $('.error_address').show().append(address);
                infotab_count=infotab_count+1;
            }
            if(data["data"]["errors"]["notif"]!=""){
                var notif = data["data"]["errors"]["notif"];
                $(".notiftime_error").addClass("has-error");
                $('.error_notiftime').show().append(notif);
                resptab_count=resptab_count+1;
            }
            if(data["data"]["errors"]["fire"]!=""){
                var fire = data["data"]["errors"]["fire"];
                $(".firetime_error").addClass("has-error");
                $('.error_firetime').show().append(fire);
                resptab_count=resptab_count+1;
            }
            if(data["data"]["errors"]["response"]!=""){
                var resp = data["data"]["errors"]["response"];
                $(".response_error").addClass("has-error");
                $("[name=response_timemodal]").val(response_time);
                $('.error_response').show().append(resp);
                resptab_count=resptab_count+1;
            }
            if(resptab_count!=0){
                $('.edit_infoerror').append("There is/are ",resptab_count," error/s in Respondents Tab.");
            } 
            if(infotab_count!=0){
                $('.edit_resperror').append("There is/are ",infotab_count," error/s in Information Tab.");
            } 
        }else{
            $('#LogsModal').find('#logs_header').hide();
            $('#LogsModal').find('#logs_body').hide();
            $('#LogsModal').find('#logs_headSuccess').show();
            $('#LogsModal').find('#logs_bodySuccess').show();
            $('#LogsModal').find('#logs_footSuccess').show();
            for_success('edited','#LogsModal','#logs_headSuccess','#logs_bodySuccess','#logs_footSuccess');
            submitchoice();
        }
    });
});
/**
* DELETE MODAL
**/
$('#DeleteModal').on('show.bs.modal', function(response){
    $('#DeleteModal').find('#del_head').show();
    $('#DeleteModal').find('#del_body').show();
    $('#DeleteModal').find('#del_foot').show();
    $('#DeleteModal').find('#delete_body').hide();
    $('#DeleteModal').find('#delete_footer').hide();
    $('#DeleteModal').find('#delete_header').hide();
    var source = $(response.relatedTarget);
    currentRow = source.closest('tr');
    responseID = currentRow.attr('id');
    $("#"+responseID).each(function(){
        $("[name=deleteID]").attr("id",responseID);
    });
});
$('#DeleteModal').on("click", "#btn_no", function(response){
    $('#DeleteModal').modal('hide');
});
$('#DeleteModal').on("click", "#btn_yes", function(response){
    $('#DeleteModal').find('#del_head').hide();
    $('#DeleteModal').find('#del_body').hide();
    $('#DeleteModal').find('#del_foot').hide();
    $('#DeleteModal').find('#delete_body').show();
    $('#DeleteModal').find('#delete_footer').show();
    $('#DeleteModal').find('#delete_header').show();
    var deleteObject = {deleteLogsID:$("[name=deleteID]").attr("id")};
    $.post("<?php echo base_url('api/c_logs/deleteLogs')?>",deleteObject,function(response){
        var data = jQuery.parseJSON(response);
        $('#DeleteModal').find('#delete_header').removeClass('modal-header modal-header-danger');
        for_success('deleted','#DeleteModal','#delete_header','#delete_body','#delete_footer');
        submitchoice();
    });
});
function for_success(actionType,modal_name,div_head,div_body,div_foot){
    $(modal_name).find(div_body).empty();
    $(modal_name).find(div_foot).empty();
    $(modal_name).find(div_head).empty();
    $(modal_name).find(div_head).addClass('modal-header modal-header-success');
    $(modal_name).find(div_head).append('<button type="button" class="close" data-dismiss="modal">x</button><h2><i class="glyphicon glyphicon-thumbs-up"></i> Fire Information</h2>');
    $(modal_name).find(div_body).append('Information ',actionType,' Successfully!');
    $(modal_name).find(div_foot).append('<button type="submit" data-dismiss="modal" class="btn btn-success btn-md" id="edit_ok"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Ok </button>');      
}
</script>