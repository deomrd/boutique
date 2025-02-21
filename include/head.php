<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <script>
    function imprimer(factPrint) {
     var printContents = document.getElementById(factPrint).innerHTML;    
     var originalContents = document.body.innerHTML;      
     document.body.innerHTML = printContents;     
     window.print();     
     document.body.innerHTML = originalContents;
     }
  </script>
  <style>
        #wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
      .back-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background: #4e4376;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .back-btn:hover {
            background: #2b5876;
        }
  </style>
</head>