<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>

            $(function() {

                $("#json-one").change(function() {

                    var dropdown = $(this);
                    var name = dropdown.val();
                    $.getJSON("magic/categories_php.php", {"name": name}, function(data) {
                        var $jsontwo = $("#json-two");
                        vals = data.name.split(",");
                        $jsontwo.empty();
                        $jsontwo.append("<option>Please select</option>")
                        $.each(vals, function(index, value) {
                            $jsontwo.append("<option>" + value + "</option>");
                        });




                    });
                });
                $("#json-two").change(function() {

                    var dropdown = $(this);
                    var name = dropdown.val();

                    $.getJSON("magic/categories_php.php", {"name": name}, function(data) {
                        var $jsonthree = $("#json-three");
                        vals = data.name.split(",");

                        $jsonthree.empty();
                        $jsonthree.append("<option>Please select</option>")
                        $.each(vals, function(index, value) {
                            $jsonthree.append("<option>" + value + "</option>");
                        });




                    });
                });
            });





        </script>
    </head>
    <body>


        <form method="post" action="magic/insertproduct.php" enctype="multipart/form-data">
            Title<input type="text" name="title"><br>
            description  <input type="text" name="description"><br>
            weight  <input type="text" name="weight"><br>
            color  <input type="text" name="color"><br>
            quantity  <input type="text" name="quantity"><br>
            price rupee   <input type="number" name="pricerupee"><br>
            price dollar   <input type="number" name="pricedollar"><br>
            Parent<select name="parent" id="json-one">
                <option>Please choose</option>
                <option>men</option>
                <option>women</option>
            </select><br>
            Sub-parent<select name="subparent1"  id="json-two"><option>Please select from above</option>  </select> 
            <br>  Sub-parent<select name="subparent2"  id="json-three"><option>Please select from above</option> </select> 
            <br> 
            rating  <input type="number" name="rating"><br>
            type     <input type="text" name="type"><br>
            
            <input type="submit" name="submit">
        </form>
    </body>
</html>


