<p id='demo'></p>
<script>
    var verify = 0;
    var id = setInterval(function(){
        verify++;
        var screen_width = window.window.innerWidth;
        if (screen_width > 775 & verify == 100){
            window.location.assign("../");
        }
        demo.innerHTML = verify;
    }, 50);
</script>