

<html>
<head>
    <style>
        *{
            font-family: "Lato", "Segoe UI", sans-serif;
            font-weight: 100;
        }
        body{
            background-color: #2067b2;
        }
        .erro .container{
            max-width: 900px;
            padding: 10px;

            margin: auto;
            text-align: center;
        }
        .erro h1{

            color:white;
        }
        span{
            font-size: 80px;
            color:white;
        }
    </style>
</head>
<body>

    <div class="erro">
        <div class="container">
            <span>:(</span>
            <h1><?=$msg?></h1>
        </div>
    </div>

</body>

</html>
