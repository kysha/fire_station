<script type="text/javascript">
var num = 0;
$(document).ready(function () {
    listSubstation();

$('#ContactsModal').on('show.bs.modal', function(event){
    num = 1;
    $('.appendInput').empty();
    var source = $(event.relatedTarget);
    currentRow = source.closest('tr');
    eventID = currentRow.attr('id');
    $('#'+eventID).each(function() {
        var sub = $(this).find(".sub_name").text();
        $('[name = sub_name]').attr('id', eventID);
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
        $('[name = sub_name]').val(sub);
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
            var request = $.post("<?=base_url('api/c_substation/deleteContact')?>", del_object);
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
    var addBrgyId = $('[name = sub_name]').attr('id');
    $('.appendInput').find('.form-group').each(function() {
        var value = $(this).find("input").val();
        var id = $(this).find("span").attr('id');
        dataarr.push({id,value});
    });
    var edit_object={
        addBrgyId: addBrgyId,
        contacts: dataarr
    };
        var request = $.post("<?=base_url('api/c_substation/editContact')?>", edit_object);
    request.done(function (response){
        var data = jQuery.parseJSON(response);
        console.log(data);
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

function listSubstation(){
    var contact_object={
        sub_name: $("#search_sub").val()
    };
    var request = $.post("<?=base_url('api/c_substation/retrieveContacts')?>", contact_object);
    request.done(function (response) {
        var data = jQuery.parseJSON(response);
        console.log(data);
        $('#ContactsData').empty();
        if(!data["error"].length){
            var prev_brgy_ID;
            for (var x = 0; x < data.data.length; x++) {
                if (prev_brgy_ID==(data["data"][x]["pk_substn"])){
                    var cloned = $('.prototypep').find('.contact_number').clone();
                    cloned.text(data["data"][x]["contact"]);
                    cloned.attr("contact_ID", data["data"][x]["pk_scontact"]);
                    $('#'+prev_brgy_ID).find(".contact_numbers").append(cloned);                                              
                }
                else{
                    var cloned = $('.prototype').find('.dataToClone').clone();
                    cloned.attr("id", data["data"][x]["pk_substn"]);
                    cloned.find(".sub_name").text(data["data"][x]["substn_name"]);
                    var cloned1 = $('.prototypep').find('.contact_number').clone();
                    cloned1.text(data["data"][x]["contact"]);
                    cloned1.attr("contact_ID", data["data"][x]["pk_scontact"]);
                    cloned.find(".contact_numbers").append(cloned1); 
                    cloned.removeClass('dataToClone');
                    prev_brgy_ID=data["data"][x]["pk_substn"];
                    $('#ContactsData').prepend(cloned);                        
               }
            }
        }
    });
}
function to_pdf(divName){
    $('#tablecontacts').empty();
    var contact_object={
        sub_name: $("#search_sub").val()
    };
    var request = $.post("<?=base_url('api/c_substation/retrieveContacts')?>", contact_object);
    request.done(function (response) {  
    var data = jQuery.parseJSON(response);          
        if(!data["error"].length){
            var prev_brgy_ID;
            for (var x = 0; x < data.data.length; x++) {
            if (prev_brgy_ID==(data["data"][x]["pk_substn"])){
                var cloned = $('.prototypep').find('.contact_number').clone();
                cloned.text(data["data"][x]["contact"]);
                cloned.attr("contact_ID", data["data"][x]["pk_scontact"]);
                $('#tablecontacts').find('#'+prev_brgy_ID).find(".contact_numbers").append(cloned);                                             
            }
            else{
                var cloned = $('.clone1').find('.toBeCloned1').clone();
                cloned.attr("id", data["data"][x]["pk_substn"]);
                cloned.find(".sub_name").text(data["data"][x]["substn_name"]);
                var cloned1 = $('.prototypep').find('.contact_number').clone();
                cloned1.text(data["data"][x]["contact"]);
                cloned1.attr("contact_ID", data["data"][x]["pk_scontact"]);
                cloned.find(".contact_numbers").append(cloned1); 
                cloned.removeClass('toBeCloned1');
                prev_brgy_ID=data["data"][x]["pk_substn"];
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