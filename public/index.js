
$(document).ready(function(){


    /* Table validation */

    $('.sandwich').children().hide();

    $('.sandwich').hover(function(){
        $(this).children().fadeIn();
    }, function(){
        $(this).children().fadeOut();
    });

    $('.min > .fas').click(function(){

        if($('#tabvalidation tr:visible').length > 1){
            $(this).parents('tr').fadeOut();
        } else {
            window.location.href='/';
        }
    });

    /*Payment*/

    $('.f-modal-alert').hide();
    $('img.img-center.gif').hide();

    $('.f-modal-alert').fadeIn();

    $('img.img-center.gif').fadeIn(2000);

});

    /*Creation de compte*/
        /*Verifie que les deux paswords match*/
        function verifynotify(field1, field2, result_id, match_html, nomatch_html) {
            this.field1 = field1;
            this.field2 = field2;
            this.result_id = result_id;
            this.match_html = match_html;
            this.nomatch_html = nomatch_html;
           
            this.check = function() {
           
              // Make sure we don't cause an error
              // for browsers that do not support getElementById
              if (!this.result_id) { return false; }
              if (!document.getElementById){ return false; }
              r = document.getElementById(this.result_id);
              if (!r){ return false; }
           
              if (this.field1.value != "" && this.field1.value == this.field2.value) {
                r.innerHTML = this.match_html;
                 $("#btnSignUp").prop("disabled", false);
           
              } else {
                r.innerHTML = this.nomatch_html;
                $("#btnSignUp").attr("disabled", "disabled");
           
              }
            }
           }
           