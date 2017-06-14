/**
 * Created by arttit on 19/4/2560.
 */
$(document).ready(function () {

    $('#submitBtn').click(function () {
        var isFilled=true;


        $('form[name="add_new"] *').filter(':input').each(function(){
           // alert($(this).attr('class'));
           var $label= $(this).closest('label');
          //alert($label.attr('class'));
            //alert($(this).attr('required'));

            if(($(this).attr('required')=='required')&&($(this).val()==''))
            {
                //alert($label.attr('class'));
                isFilled=false;


                $label.addClass($label.attr('class')+ ' state-error ');



            }else{

               //  var nowState=$label.attr('class');
                 //nowState.replace("state-error", "");
                 $label.removeClass('state-error');

            }
        });

        if(isFilled)
        {
            $("#submitBtn").prop("type", "submit");
           // $("input[name='submitBtn']").trigger('click');
        }
       //alert('this');
    });






});