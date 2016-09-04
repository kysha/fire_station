<script>
    $('.edit_settings').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('.edit_settings').on('show.bs.modal', function(response){
        showusername();
    }).modal('show');
    
    function showusername(){
        $.post("<?php echo base_url('api/c_settings/show_admin')?>",function(response){
            var data = jQuery.parseJSON(response);
            if(!data["error"].length){
                $("[name=user_name]").val(data["data"]["username"]);
                $("[name=admin_id]").val(data["data"]["id"]);
            }
        });
     }
     $('.edit_settings').on("click", "#submitEditBTN", function(response){
            $(".error_uname").empty();
            $(".error_oldpass").empty();
            $(".error_newpass").empty();
            $(".error_confirmpass").empty();
            $(".uname_error").removeClass("has-error");
            $(".oldpass_error").removeClass("has-error");
            $(".newpass_error").removeClass("has-error");
            $(".confirmpass_error").removeClass("has-error");
            
            var set_object = {
                id : $("[name=admin_id]").val(),
                username : $("[name=user_name]").val(),
                old_pass : $("[name=user_old_password]").val(),
                new_pass : $("[name=user_new_password]").val(),
                confirm_pass : $("[name=user_confirm_password]").val()
            }
            
            $.post("<?php echo base_url('api/c_settings/edit_admin')?>",set_object,function(response){
                var data = jQuery.parseJSON(response);
                if(data["data"]["errors"]){
                    if(data["data"]["errors"]["username"]!=""){
                        console.log("a",data["data"]["errors"]["user_name"]);
                        $(".uname_error").addClass("has-error");
                        $(".error_uname").show().append(data["data"]["errors"]["username"]);
                    }
                    if(data["data"]["errors"]["old_pass"]!=""){
                        $(".oldpass_error").addClass("has-error");
                        $(".error_oldpass").show().append(data["data"]["errors"]["old_pass"]);
                    }
                    if(data["data"]["errors"]["new_pass"]!=""){
                        $(".newpass_error").addClass("has-error");
                        $(".error_newpass").show().append(data["data"]["errors"]["new_pass"]);
                    }
                    if(data["data"]["errors"]["confirm_pass"]!=""){
                        $(".confirmpass_error").addClass("has-error");
                        $(".error_confirmpass").show().append(data["data"]["errors"]["confirm_pass"]);
                    }
                }else{
                    history.go(-1);
                }
            });
     });
     $('.edit_settings').on("click", "#cancelEditBTN", function(response){
        history.go(-1);
     });
</script>