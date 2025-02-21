<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- jQuery UI pour l'autocomplétion -->
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <title>GESTION STOCK</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #40ab5e, #ff0000);
            color: #fff;
        }

        #wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        #page-wrapper {
            flex: 1;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .alert {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-ajouter {
            margin-top: 20px;
        }

        .btn-supprimer {
            margin-top: 10px;
        }

        footer {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            font-size: 0.9rem;
        }
         a {
            text-decoration: none;
            color: inherit;
        }
        a:hover{
            text-decoration: none;
            color: #4e4376;
        }
        .btn-primary {
            color: white;
            background-color: #4e4376;  /* Mauve */
            border-color: #4e4376;  /* Mauve */
        }

        .btn-primary:hover {
            background-color: #3f355b;  /* Teinte plus foncée de mauve */
            border-color: #3f355b;  /* Teinte plus foncée de mauve */
        }
    </style>