<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
         h4 {
            background-color: #5cb85c;
            color:white !important;
            text-align: center;
            font-size: 30px;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Modal Login Example</h2>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
<p>dasdsa</p>
    </div>


<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>

</body>
</html>
