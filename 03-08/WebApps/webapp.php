<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript">
            function showgreeting()
            {
                alert("Hello CST3519_OL50");
                
                //display greeting below the button
                //using DOM (Document Object Model)
                document.getElementById("showgreetinghere").innerHTML = "Hello CST3519_OL50";
                
            }
        </script>
    </head>
    <body>
        <h2>Web Application 1</h2>
        <button onclick="showgreeting();">ClickMe!!</button>
        <p></p>
        <!-- create a placeholder to display the greeting -->
        <div id="showgreetinghere"></div>
        <?php print "Hello from PHP";        ?>
    </body>
</html>
