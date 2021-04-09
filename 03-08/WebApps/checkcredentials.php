<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <h2>Web Application 1</h2>
    <p></p>
    <!-- start PHP code -->
    <?php
        //get input credentias(name,passsword)
        $userName = $_GET["usernameTxtBx"];
        $passWord = $_GET["pwdTxtBx"];

        // print"Username: " . $userName . ", Password: " .$passWord;

        // store pairs of credentials (usernqme,pasword) in an array
        $credentialArray = array(
            array("Marry", "abc"),
            array("John", "cde")
        );
        // print"Frist Record of Array: ".$credentialArray[0][0].", ".$credentialArray[0][1];

        // Assume the individual values of the pair (username, password) 
        // are both unique
        //check if inputs are in the array
        //arrray size
        $arraySize = count($credentialArray);

        //boolean variable for a match
        $found = false;

        //string comparation, case insensitive: strcasecmp(str1,str2) returns >0 or <0 or = 0 (str1 = str2)
         //string comparation, case sensitive: strcasecmp(str1,str2) returns >0 or <0 or = 0 (str1 = str2)

        //loop through all the array records 
        for ($index=0; $index < $arraySize; $index++) { 
            if (strcasecmp($credentialArray[$index][0],$userName) == 0 and 
            strcasecmp($credentialArray[$index][1],$passWord) == 0) {
                $found = true;
                print "welcome ".$credentialArray[$index][0]." to CST3519_OL50";
                break;
            }
        }
        if ($found == false)
            print "Username and password not in file"
    
        
        ?>
</body>
</html>