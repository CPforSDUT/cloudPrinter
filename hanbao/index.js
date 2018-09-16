 $(document).ready(function(){
        $('#nav li').first().css({'color':'red'});
        
        $('#nav>li').on('click',function(){
            
              $(this).children().not('i').toggle(300);
            
        });
         $('#nav>li>ul>li').on('mouseover',function(){
            
              $(this).css({'color':'red'});
            
        });
        $('#nav>li>ul>li').on('mouseout',function(){
            
              $(this).css({'color':'#aaa'});
            
        });
        
        
    })
    var navColor=0;
    $('.fa-bars').on('click',function(){   
         navColor++;
        $('#nav').slideToggle(900);
        
        $('nav').animate({'height':400+'px'});
       if( navColor%2==0){
            $('nav').animate({'height':100+'px'});
       }
                                        
                
                         })
