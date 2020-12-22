<script>
jQuery(document).ready(function($) {
    var retrievedObject = null;
    if (localStorage) {
        retrievedObject = localStorage.getItem('__dillionecom');
    } else {
        alert("Error: This browser is still not supported; Please use google chrome!");
    }
    var parsedArray = null;
    if (retrievedObject){
        parsedArray = JSON.parse(retrievedObject);    
    }
    if(parsedArray == null){
        $("#id-cart-value").html(0);
    }else{
        $("#id-cart-value").html(parsedArray.length);
    }
});
</script>
<script>
jQuery(document).ready(function($) {
    var retrievedObject = null;
    if (localStorage) {
        retrievedObject = localStorage.getItem('__dillionecomwish');
    } else {
        alert("Error: This browser is still not supported; Please use google chrome!");
    }
    var parsedArray = null;
    if (retrievedObject){
        parsedArray = JSON.parse(retrievedObject);    
    }
    if(parsedArray == null){
        $("#id-wish-value").html(0);
    }else{
        $("#id-wish-value").html(parsedArray.length);
    }
    
});
</script>
 