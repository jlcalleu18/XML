<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<h2>Login App</h2>
    <?php
        //get user inputs
        $usernameIn = $_GET["usernameTxtBx"];
        $pwdIn = $_GET["pwdTxtBx"];

       // print"Username: " . $usernameIm . ", Password: " .$pwdIn;

        //read cvs file
        $fileName = "/Applications/MAMP/htdocs/03-08/Login_App/usernamepwd.csv";

        //Open the file for reading -> results in a stream of strings separated by carriage return

        $fileStream = fopen($fileName, "r");

        //variable to hold each record (up to the carriage return)
        $fileLine = "";

        //variable used to skip th first record (header line)
        $reading = 1;

        //boolean variable when a match is found
        $found = false;
        
        //looping 
        while (($fileLine = fgetcsv($fileStream,1000,";")) !== FALSE) {
            if ($reading > 1) {
                //getting username and password from the array 
                $usernameinCVS = $fileLine[0];
                $pwdinCSV = $fileLine[1];

                //checking for a match for the input pair (username,password)
                //using PHP funtion strcasecmp() which case sensitive
                //for case insensitive use strsmp() which we will use tit
                if (strcmp($usernameinCVS,$usernameIn) == 0 and
                    strcmp($pwdinCSV,$pwdIn) == 0){
                    $found = true;
                    print"Welcome to CST3519";
                    break;
                }

            }else $reading =2;
        }
        if ($found == false) print "Invalid username and password";
    ?>
</body>
</html>