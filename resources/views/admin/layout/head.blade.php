<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Disposisi Polisi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        header {
            position: fixed;
            width: 100%;
            max-width: 1200px;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #444;
            color: white;

            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 1001;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .menu-toggle {
            font-size: 30px;
            cursor: pointer;
        }

        .icons {
            /* display: flex; */
            gap: 15px;
        }

        .icons i {
            font-size: 25px;
            cursor: pointer;
        }

        .side-menu {
            width: 250px;
            background-color: #444;
            color: white;
            height: 100vh;
            position: fixed;
            left: -250px;
            top: 60px;
            transition: left 0.3s ease-in-out;
            padding-top: 20px;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0 10px 10px 0;
        }

        .side-menu ul {
            list-style: none;
            padding: 0;
        }

        .side-menu ul li {
            padding: 15px;
            text-align: left;
        }

        .side-menu ul li a {
            color: white;
            text-decoration: none;
            display: block;
            font-weight: bold;
        }

        .container {
            margin-top: 120px;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 15px;
            }
        }

        header {
            position: fixed;
            width: 100%;
            max-width: 1200px;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #444;
            color: white;
            padding: 10px 20px;
            z-index: 1001;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-toggle {
            font-size: 30px;
            cursor: pointer;
        }

        .icons {
            float: right;
            margin-top: 10px;
        }

        .icons>.dropdown {
            margin-left: 10px;
            float: left;
        }

        .icons i {
            font-size: 25px;
            cursor: pointer;
            color: white;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        /* Media query untuk mobile */
        @media (max-width: 768px) {
            .icons {
                float: right;
                margin-top: 10px;
            }
        }

        .surat-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .surat-item {
            background: white;
            color: black;
            padding: 15px;
            border-radius: 5px;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .tab-content {
            margin-top: 20px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #ddd;
            color: black;
        }

        .pagination {
            display: flex;
            justify-content: center;
            padding-top: 20px;
        }

        .pagination li {
            cursor: pointer;
        }

        .pagination li.disabled {
            pointer-events: none;
        }

        .pagination li .page-link {
            color: rgb(177, 187, 197);
        }

        .pagination li.active .page-link {
            color: #fff;
            background-color: #6c757d;
        }



        .nav-tabs .nav-item .nav-link {
            background-color: #f8f9fa;
            color: #555;
            border-color: #ddd;
        }

        .nav-tabs .nav-item .nav-link:hover {
            background-color: #ddd;
        }

        .nav-tabs .nav-item .nav-link.active {
            background-color: rgb(135, 151, 167);
            color: white;
            border-color: rgb(124, 139, 155);
        }

        .pagination .page-item .page-link {
            color: #777;
            background-color: #f8f9fa;
            border-color: #ddd;
        }

        .pagination .page-item.active .page-link {
            background-color: rgb(110, 121, 133);
            color: white;
            border-color: rgb(128, 145, 163);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f8f9fa;
            border-color: #ddd;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            width: 100%;
        }

        .action-buttons button {
            padding: 5px 10px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .tab-title {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
    @include('sweetalert::alert')
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="Fri, 01 Jan 1990 00:00:00 GMT">

</head>