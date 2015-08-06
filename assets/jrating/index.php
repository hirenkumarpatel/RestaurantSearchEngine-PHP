 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="jRating.jquery.css" type="text/css" />

    </head>
    <body>
        <div class="rating-bar" data-average="0" data-id="8"></div>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jRating.jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.basic').jRating();

                $('.rating-bar').jRating({
                    length: 5,
                    decimalLength: 1,
                    
                });


            });
        </script>

    </body>
</html>
