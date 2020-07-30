function Like(artwork_id){
    $.ajax({
	    type: "POST",
        data: {status: 1, trashed: false, 'artwork_id': artwork_id},
	    url: 'add-like.php',
	    beforeSend: function(){
	        $('#like_id_'+artwork_id).html("<a class='card-link' title='Liked'><i class='fa fa-heart' aria-hidden='true'></i></a>");
        },
        success: function(data){
        	$('#like_id_'+artwork_id).html(data);
        }
	});
}



function Comment(artwork_id)
{
    if($("#comment_input_"+artwork_id).val())
    {
        $.ajax({  
            type: "POST",  
            url: 'add-comment.php',  
            data: new FormData($("#comment_form_"+artwork_id)[0]),     
            processData: false,
            contentType: false,      
            beforeSend: function()
            {	
            	$('#comment_button_'+artwork_id).hide();
                $('#comment_temp_'+artwork_id).show();
                document.getElementById("comment_form_"+artwork_id).reset();
                document.getElementById("comment_input_"+artwork_id).focus();
            },
            success: function(response)
            {
                $('#comment_button_'+artwork_id).show();
                $('#comment_temp_'+artwork_id).hide();
                $("#comment_result_"+artwork_id).append(response);

            }
        }); 
    }
    else
    {
        alert("Hello There! You didn't type any content in the textarea box.");
    }
}
