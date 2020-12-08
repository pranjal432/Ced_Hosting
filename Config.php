<?php

    class Dbcon {

        private $siteurl="http://localhost/training/MIS%20Application/Cedcab/";

        function __construct() {

            $this->con=new mysqli("localhost", "root", "pma", "CedHosting");
            if ($this->con->connect_error) {

                die("Connection Failed: ".$this->con->connect_error);
            }
            else
            {
                //echo "connnnnnnnneeecteddd";
            }

        }

    }

    

    






?>