<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+RDFa 1.1//EN">
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>{{ title }}</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
    <div style="margin:0 auto; width:1000px;">
    <div style="background:#eee;border: 1px solid #444;height: 100px; width: 1000px;padding:10px;">
        <h1>Your Shopping Cart</h1>
        <div id="clear" style="cursor:pointer;float:right;">Clear shopping cart</div>
        <p id="items">You have {{ count }} item(s) in your shopping cart</p>
    </div>
    <br/>
    <div>{{ content }}</div>
    </div>
<script type="text/javascript">
$(document).ready(function() {
    $('.items').bind('click', function() {
        var t = $(this), count = $('#items');
        $.ajax({
            type: 'POST',
            url: '/index.php',
            data: {ajax: 'add', 'id': t.attr('id').replace(/item_/, '')},
            dataType: "json",
            success: function(data) {
                count.text('You have %s item(s) in your shopping cart'.replace(/%s/, data.count));
                t.remove();
            },
            failure: function(err) {
                alert(err);
            }
        });
    });
    
    $('#clear').bind('click', function() {
        $.ajax({
            type: 'POST',
            url: '/index.php',
            data: {ajax: 'clear'},
            dataType: "json",
            success: function(data) {
                window.location.reload();
            },
            failure: function(err) {
                alert(err);
            }
        });
    });
});
</script>
</body>
</html>
