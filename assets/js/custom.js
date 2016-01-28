/*----full payment registration calculations---*/
$(document).ready(function(){
        function calcfulltotal(){
            var fnop = parseInt($('#fnop').text());
            var focc = parseInt($('#calcfocc').text());
            var fhfr = parseInt($('#calcfhfr').text());
            var ffull = parseInt($('[name="tour_amount"]').val());
            var calcftotal = fnop*(focc+fhfr+ffull)*104/100;
            calcftotal = Math.ceil(calcftotal);
            $('#calcftotal').text(calcftotal.toString());
            $('[name="tour_full_pay"]').val(calcftotal.toString());
            
        }
        calcfulltotal();
        
        $('[name="tour_hfr"]').on('click', function(){
            var hfrval = parseInt($('#fhfr_val').text());
            var fnop = parseInt($('#fnop').text());
            if($(this).is(':checked')){
                $('#calcfhfr').html((hfrval*fnop).toString());
                calcfulltotal();
            }else{
                $('#calcfhfr').html(0);
                calcfulltotal();
            }
            
        });
        $('#focc_val').change(function(){
            var occval = parseInt($('#focc_val').val());
            var fnop = parseInt($('#fnop').text());
            var index = $(this).children(':selected').index();
            var occ;
            if(index==0){occ = 'Q';}
            if(index==1){occ = 'T';}
            if(index==2){occ = 'D';}
            if(index==3){occ = 'S';}
            $('[name="tour_occupancy"]').val(occ);
            $('#calcfocc').html((occval*fnop).toString());
            calcfulltotal();
            
        });

/*----date picker----*/
$('.datepick').each(function(){
    var date = $(this).children('.dpyear').val()+'-'+$(this).children('.dpmonth').val()+'-'+$(this).children('.dpday').val();
    $(this).children().last().val(date);
});
$('.dpday').change(function(){
    var day = $(this).val();
    var month = $(this).parent().children('.dpmonth').val();
    var year = $(this).parent().children('.dpyear').val();
    var date = year+'-'+month+'-'+day;
    $(this).parent().children().last().val(date);
});
$('.dpmonth').change(function(){
    var month = $(this).val();
    var day = $(this).parent().children('.dpday').val();
    var year = $(this).parent().children('.dpyear').val();
    var date = year+'-'+month+'-'+day;
    $(this).parent().children().last().val(date);
});
$('.dpyear').change(function(){
    var year = $(this).val();
    var month = $(this).parent().children('.dpmonth').val();
    var day = $(this).parent().children('.dpday').val();
    var date = year+'-'+month+'-'+day;
    $(this).parent().children().last().val(date);
});

});