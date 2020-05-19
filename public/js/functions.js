$(function () { 
	
  $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    })

  //Aimer un article
  $(document).on('click', '#like', function(){
    var $this = $(this);
    if ($.trim($this.text()) === 'Like') {
    		$.ajax({
              url      : "/likePost",
              type   : "POST" , 
              data     : { user_id: $this.attr('data-userId'),
                           post_id: $this.attr('data-postId')
                         },
              success  : function(code) {  
                           if (code == 1) {
                            $this.empty();
                           	$this.append('<span class="fas fa-heart" style="color:red;"></span>Dislike')
                            $('#likeModalButton').click();
                            $('#likeModal .modal-title').html('Vous avez liker cet Article');
                           }
                        }       
        	});
      }
      else {
          $.ajax({
              url      : "/unlikePost",
              type   : "POST" , 
              data     : { user_id: $this.attr('data-userId'),
                           post_id: $this.attr('data-postId')
                         },
              success  : function(code) {  
                           if (code == 1) {
                            $this.empty();
                            $this.append('<span class="far fa-heart"></span>Like');
                            $('#likeModalButton').click();
                            $('#likeModal .modal-title').html('Vous avez Disliker cet Article');
                           }
                        }       
          });
      }     
    }); 


    //Enregistrer un article
    $(document).on('click', '#save', function(){
    var $this = $(this);
    if ($.trim($this.text()) === 'Enregistrer') {
        $.ajax({
              url      : "/savePost",
              type   : "POST" , 
              data     : { user_id: $this.attr('data-userId'),
                           post_id: $this.attr('data-postId')
                         },
              success  : function(code) {  
                           if (code == 1) {
                            $this.empty();
                            $this.append('<span class="fas fa-bookmark" style="color:#191970;"></span>Annuler Enregistrement')
                            $('#saveModalButton').click();
                            $('#saveModal .modal-title').html('Vous avez Enregistrer cet Article');
                           }
                        }       
          });
      }
      else {
          $.ajax({
              url      : "/unsavePost",
              type   : "POST" , 
              data     : { user_id: $this.attr('data-userId'),
                           post_id: $this.attr('data-postId')
                         },
              success  : function(code) {  
                           if (code == 1) {
                            $this.empty();
                            $this.append('<span class="far fa-bookmark"></span>Enregistrer');
                            $('#saveModalButton').click();
                            $('#saveModal .modal-title').html('Vous avez Annuler Enregistrement de cet Article');
                           }
                        }       
          });
      }     
    });


    //Annuler Enregistrement page articles enregistres
    $(document).on('click', '#unsave', function(){
    var $this = $(this);
    
          $.ajax({
              url      : "/unsavePost",
              type   : "POST" , 
              data     : { user_id: $this.attr('data-userId'),
                           post_id: $this.attr('data-postId')
                         },
              success  : function(code) {  
                           if (code == 1) {
                            $this.parents('#card').remove();
                            $('#saveModalButton').click();
                            $('#saveModal .modal-title').html('Vous avez Annuler Enregistrement de cet Article');
                           }
                        }       
          });
           
    });    
	

});