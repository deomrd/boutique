<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
     <link href="assets/css/font-awesome.css" rel="stylesheet" />
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .menu-item {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 250px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .menu-item i {
            font-size: 50px;
            color: #4e4376;
        }

        .menu-item h4 {
            margin-top: 15px;
            font-size: 1.2rem;
            color: #333;
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

        footer {
            text-align: center;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            font-size: 0.9rem;
        }
        .header-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #4e4376;  /* Mauve */
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: fit-content;
        }

        .header-title h2 {
            font-size: 1.6em;
            margin: 0;
        }

        .header-title a {
            border: 2px solid white;
            border-radius: 20px;
            background: white;
            padding: 8px 12px;
            color: #4e4376;
            text-decoration: none;
            font-size: 15px;
        }

        .header-title a:hover {
            background: #ff4a34;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #4e4376;  /* Mauve */
            color: white;
            font-size: 1.1em;
        }

        .table td {
            background-color: #f9f9f9;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tr:hover td {
            background-color: #ddd;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #4e4376;  /* Mauve */
            color: white;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .pagination a:hover {
            background-color: #3f355b;  /* Teinte plus foncée de mauve */
            transform: translateY(-2px);
        }

        .pagination .active {
            background-color: #3f355b;  /* Teinte plus foncée de mauve */
            pointer-events: none;
        }
    </style>