$(document).ready(function(){
        $('.sidebar-toggle').on('click', function(event){
                $('body').toggleClass('sidebar-collapse');
        })

        if(window.innerWidth < 993)
        {
                $('.sidebar-toggle').on('click', function(event){
                        $('body').toggleClass('sidebar-open');
                })
        }

});

