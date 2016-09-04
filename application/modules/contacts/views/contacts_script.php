<script type="text/javascript">
var num = 0;

var ppage;
var selectedpage;
var page_limit = 2;
var page_count;
var npbutton;
var showstart;
var showend;
$(document).ready(function () {
listContacts();

$('#ContactsModal').on('show.bs.modal', function(event){
    num = 1;
    $('.appendInput').empty();
    var source = $(event.relatedTarget);
    currentRow = source.closest('tr');
    eventID = currentRow.attr('id');
    $('#'+eventID).each(function() {
        var brgy = $(this).find(".barangay_name").text();
        $('[name = barangay_name]').attr('id', eventID);
        $(this).find('.contact_numbers').find(".contact_number").each(function() {
            if ($(this).text()) {
                var cloned = $('.prototypeDiv').find('.cloneInput').clone();
                var cn = $(this).text();
                cloned.find('#contact_number').val(cn);
                var cnId = $(this).attr('contact_id');
                cloned.find('.contactnum').find('span').attr('id',cnId);
                cloned.removeClass('cloneInput');
                $('.appendInput').append(cloned); 
            }
        });
        $('[name = barangay_name]').val(brgy);
    });
});

$('#ContactsModal').on("click", "#DeleteContactBTN", function(event){
    var value = $(this).parent().find('input').val();
    if(value){
        var id = $(this).parent().find('span').attr('id');
        $('#confirmDel').attr('id_t', id);
        $('#confirmDel').modal('show');
    }
    else{
        $(this).parent().remove();
    }
}); 

$('#confirmDel').on("click", ".delBTN", function(event){
    var trig = $(this).attr('id');
    var id = $('#confirmDel').attr('id_t');
    var del_object={
        delId: id,
    };
    if (trig == "delete") {
        var result = id.indexOf("temp") > -1;
        if (!result) {
            var request = $.post("<?=base_url('api/c_contacts/deleteContact')?>", del_object);
            request.done(function(response){
                $('span[id='+id+']').parent().parent().remove();
                $('p[contact_id='+id+']').remove();
            });
        } 
        else{
            $('input[id='+id+']').parent().parent().remove();           
        } 
    $('#confirmDel').modal('hide');
    $('#submitted').find('.msg').empty();
    $('#submitted').find('.msg').append('<b>Contact Information Deleted Successfully!</b>');
    $('#submitted').modal('show');
    }   
});

$('#ContactsModal').on("click", "#SaveContactBTN", function(event){
    var dataarr = [];
    var addBrgyId = $('[name = barangay_name]').attr('id');   
    $('.appendInput').find('.form-group').each(function() {
        var value = $(this).find("input").val();
        var id = $(this).find("span").attr('id');
        dataarr.push({id,value});
    });
    var edit_object={
        addBrgyId: addBrgyId,
        contacts: dataarr
    };
    var request = $.post("<?=base_url('api/c_contacts/editContact')?>", edit_object);
    request.done(function (response){
        var data = jQuery.parseJSON(response);
        if(data["data"]["errors"]){
            for (i in data["data"]["errors"]["contacts"]) {
                $.each(data["data"]["errors"]["contacts"][i], function( key, value ) {
                    if (value != "") {
                        $('span[id='+key+']').text(value);
                        $('span[id='+key+']').parent().addClass('has-error');
                    }
                    else{
                        $('span[id='+key+']').text("");            
                        $('span[id='+key+']').parent().removeClass('has-error');
                    }
                });
            }
        }
        else{
            var x = data["data"];
                if(x["editcn"]){
                    for (var i = 0; i < x["editcn"].length; i++) {
                        for (var k in x["editcn"][i]){
                            $('p[contact_id='+k+']').text(x["editcn"][i][k]);
                        }
                    }
                }
                if(x["addcn"]){
                    for (var i = 0; i < x["addcn"].length; i++) {
                        for (var k in x["addcn"][i]){
                            var cloned = $('.prototypep').find('.contact_number').clone();
                            cloned.text(x["addcn"][i][k]);
                            cloned.attr("contact_ID", k);
                            $('#'+addBrgyId).find(".contact_numbers").append(cloned);
                        }
                    }
                }
            $('#ContactsModal').modal('hide');
            $('#submitted').find('.msg').empty();
            $('#submitted').find('.msg').append('<b>Contact Information Edited Successfully!</b>');
            $('#submitted').modal('show');
        }

    });
});

$('#ContactsModal').on("click", "#AddContactBTN", function(event){
    var cloned = $('.prototypeDiv').find('.cloneInput').clone();
    num = num + 1;
    cloned.find('#contact_number').val("");
    cloned.find('#contact_number').attr('id',"temp_"+num);
    cloned.find('.contactnum').find('span').attr('id',"tmp_"+num);
    cloned.removeClass('cloneInput');
    $('.appendInput').append(cloned);
});  

});

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
    var contact_object={
        brgy_name: $("#search_brgy").val(),
        ppage : ppeg
    };
    listContacts_after(contact_object);
}

function listContacts(){
    selectedpage=1;
    var contact_object={
        brgy_name: $("#search_brgy").val(),
        ppage : 0
    };
    listContacts_after(contact_object);
    $(".paging").show();
}

function listContacts_after(contact_object){
    $('.paging').empty();
    var count_users = $.post("<?=base_url('api/c_contacts/count_cn')?>", contact_object);
    count_users.done(function (response){
        var data = jQuery.parseJSON(response);
        if(data["data"]["total_row"]>0){
            page_count = Math.ceil((data["data"]["total_row"])/(data["data"]["row_perpage"]));
            ppage = data["data"]["row_perpage"];
            pagination();
            $('.paging').find('#'+(selectedpage)).css('background','#7f7f7f');
        }
    });
    var request = $.post("<?=base_url('api/c_contacts/retrieveContacts')?>", contact_object);
    request.done(function (response) {
        var data = jQuery.parseJSON(response);
        $('#ContactsData').empty();
        if(!data["error"].length){
            var prev_brgy_ID;
            for (var x = 0; x < data.data.length; x++) {
                if (prev_brgy_ID==(data["data"][x]["pk_brgy"])){
                    var cloned = $('.prototypep').find('.contact_number').clone();
                    cloned.text(data["data"][x]["contact"]);
                    cloned.attr("contact_ID", data["data"][x]["pk_contact"]);
                    $('#'+prev_brgy_ID).find(".contact_numbers").append(cloned);                                             
                }
                else{
                    var cloned = $('.prototype').find('.dataToClone').clone();
                    cloned.attr("id", data["data"][x]["pk_brgy"]);
                    cloned.find(".barangay_name").text(data["data"][x]["brgy_name"]);
                    var cloned1 = $('.prototypep').find('.contact_number').clone();
                    cloned1.text(data["data"][x]["contact"]);
                    cloned1.attr("contact_ID", data["data"][x]["pk_contact"]);
                    cloned.find(".contact_numbers").prepend(cloned1); 
                    cloned.removeClass('dataToClone');
                    prev_brgy_ID=data["data"][x]["pk_brgy"];
                    $('#ContactsData').append(cloned);                        
               }
            }
        $('.buttons_pagination').show();
        $('#table_contacts_error').hide();
        }
        else{ 
            $('#table_contacts_error').show();
           // $('#ContactsData').append('<tr><td></td><td><p>No Results Found!</p></td><td></td></tr>');  
            $('.buttons_pagination').hide();
        }
    });
}

function to_pdf(divName){
    $('#tablecontacts').empty();
    var contact_object={
        brgy_name: $("#search_brgy").val()
    };
    var request = $.post("<?=base_url('api/c_contacts/retrieveContacts')?>", contact_object);
    request.done(function (response) {  
    var data = jQuery.parseJSON(response);          
        if(!data["error"].length){
            var prev_brgy_ID;
            for (var x = 0; x < data.data.length; x++) {
            if (prev_brgy_ID==(data["data"][x]["pk_brgy"])){
                var cloned = $('.prototypep').find('.contact_number').clone();
                cloned.text(data["data"][x]["contact"]);
                cloned.attr("contact_ID", data["data"][x]["pk_contact"]);
                $('#tablecontacts').find('#'+prev_brgy_ID).find(".contact_numbers").append(cloned);                                             
            }
            else{
                var cloned = $('.clone1').find('.toBeCloned1').clone();
                cloned.attr("id", data["data"][x]["pk_brgy"]);
                cloned.find(".barangay_name").text(data["data"][x]["brgy_name"]);
                var cloned1 = $('.prototypep').find('.contact_number').clone();
                cloned1.text(data["data"][x]["contact"]);
                cloned1.attr("contact_ID", data["data"][x]["pk_ucontact"]);
                cloned.find(".contact_numbers").append(cloned1); 
                cloned.removeClass('toBeCloned1');
                prev_brgy_ID=data["data"][x]["pk_brgy"];
                $('#tablecontacts').prepend(cloned);                        
           }
        }
            var printContents = document.getElementById(divName).innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            location.reload();
        }
    });
}
</script>