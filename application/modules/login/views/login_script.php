<script type="text/javascript">
$(document).ready(function () {
    $('#SubmitBTN').click(function(event){
        event.preventDefault();			
        var login_object={
            username: $('[name=username]').val(),
            password: $('[name=password]').val()
        };
        var request = $.post("<?=base_url('api/c_login/authenticate')?>", login_object);            
        request.done(function(response){
       	var data = jQuery.parseJSON(response);
        console.log(data);
        	if(data.data){
        		window.location.href = "<?=base_url('home')?>";	
        	}
        	else {
            if(data["error"][0]["message"]["incorrect"]){
              $('span[id=username]').text("");
              $('span[id=password]').text(data["error"][0]["message"]["incorrect"]);
      		  }
          else{
            $('span[id=username]').text(data["error"][0]["message"]["username"]);
            $('span[id=password]').text(data["error"][0]["message"]["password"]);
    	    }
        }
      }); 
    });
    
});

</script>