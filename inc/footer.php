
    <!-- Existing head content -->
    <style>
        @keyframes rainbow {
            0% { color: red; }
            14% { color: orange; }
            28% { color: yellow; }
            42% { color: green; }
            56% { color: blue; }
            70% { color: indigo; }
            84% { color: violet; }
            100% { color: red; }
        }

        .rainbow-text {
            animation: rainbow 3s linear infinite;
            display: inline-block;
        }
    </style>

<body>
    <!-- Rest of your body content -->

    <!-- Footer -->     
    <footer class="footer bg-dark">       
        <div class="container">         
            <p class="m-0 text-center text-white"><?php echo date('Y'); ?>&copy; Inventory System | CREATED BY <span class="rainbow-text">K.D.S DILSHAN</span></p>       
        </div>     
    </footer>      

    <!-- Bootstrap core JavaScript -->     
    <script src="vendor/jquery/jquery.min.js"></script>     
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 	 	
    
    <!-- Datatables script --> 	
    <script type="text/javascript" charset="utf8" src="vendor/DataTables/datatables.js"></script> 	
    <script type="text/javascript" charset="utf8" src="vendor/DataTables/sumsum.js"></script> 	 	
    
    <!-- Chosen files for select boxes --> 	
    <script src="vendor/chosen/chosen.jquery.min.js"></script> 	
    <link rel="stylesheet" href="vendor/chosen/chosen.css" /> 	 	
    
    <!-- Datepicker JS --> 	
    <script src="vendor/datepicker164/js/bootstrap-datepicker.min.js"></script> 	 	
    
    <!-- Bootbox JS --> 	
    <script src="vendor/bootbox/bootbox.min.js"></script> 	 	
    
    <!-- Custom scripts --> 	
    <script src="assets/js/scripts.js"></script> 	
    <script src="assets/js/login.js"></script> 
