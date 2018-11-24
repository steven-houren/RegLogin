<?php

$servername = "localhost";
$username = "id5361824_shouren_usercredentials";
$password = "8675309";
$dbname = "id5361824_usercredentials";

try{
    $pdoConnect = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
}
catch(PDOException $e) {
    echo $e->getMessage()."<br>";
    die();
}

$EmptyRequiredFieldError = '';
$InvalidInputError = '';
$FirstNameError = '';
$LastNameError = '';
$AddressOneError = '';
$AddressTwoError = '';
$CityError = '';
$RegStateError = '';
$ZipError = '';
$CountryError = '';




if(isset($_POST['insert']))
{

    $Fname = filter_input(INPUT_POST, 'Fname', FILTER_SANITIZE_STRING);
    $Lname = filter_input(INPUT_POST, 'Lname', FILTER_SANITIZE_STRING);
    $AddressOne = filter_input(INPUT_POST, 'Address1', FILTER_SANITIZE_STRING);
    $AddressTwo = filter_input(INPUT_POST, 'Address2', FILTER_SANITIZE_STRING);
    $City = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
    $RegState = filter_input(INPUT_POST, 'State', FILTER_SANITIZE_STRING);
    $Zip = filter_input(INPUT_POST, 'Zip', FILTER_SANITIZE_STRING);
    $Country = filter_input(INPUT_POST, 'Country', FILTER_SANITIZE_STRING);

    if(empty($Fname) || empty($Lname) || empty($Lname) || empty($AddressOne) || empty($City) || empty($RegState) || empty($Zip) || empty($Country))
    {
        $EmptyRequiredFieldError = '<p>Please enter a value for all required fields.  All fields besides Address Line 2 are required.</p>';
    }
    else{

        if(preg_match('/^[a-zA-Z]*$/', $Fname) && preg_match('/^[a-zA-Z]*$/', $Lname) && preg_match('/^[0-9a-zA-Z\s]*$/', $AddressOne) && preg_match('/^[0-9a-zA-Z\s]*$/', $AddressTwo) && preg_match('/^[a-zA-Z]*$/', $City) && preg_match('/^[a-zA-Z]*$/', $RegState) && preg_match('/^[0-9]*$/', $Zip) && preg_match('/^[a-zA-Z\s]*$/', $Country))
        {

            $pdoQuery = "INSERT INTO `UserCredentials`(`FirstName`, `LastName`, `Address1`, `Address2`, `City`, `RegState`, `Zip`, `Country`) VALUES (:Fname, :Lname, :AddressOne, :AddressTwo, :City, :RegState, :Zip, :Country)";

            $pdoResult = $pdoConnect->prepare($pdoQuery);

            $pdoExec = $pdoResult->execute(array(":Fname"=>$Fname, ":Lname"=>$Lname, ":AddressOne"=>$AddressOne, ":AddressTwo"=>$AddressTwo, ":City"=>$City, ":RegState"=>$RegState, ":Zip"=>$Zip, ":Country"=>$Country));

            if($pdoExec){

                header('Location: SuccessPage.php');
            }
            else{

                header('Location: ErrorMessagePage.php');
            }

        }
        else{
            $InvalidInputError = '<p>Invalid input. Please use only numbers and letters.  Also, for Address Line 2 please use APT instead of APT# or APT#: .</p>';
        }

    }

}

?>




<html>
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">

    <style>

    body{

        background-color: #151515;
        color: white;
        font-family: Helvetica;
        margin: 0 auto;   
        margin-top: 100px;
    }

    .RegTitle{
        text-align: center;

        max-width: 500px;
        margin: auto;
    }

    .RegBox{
        max-width: 175px;
        margin: auto;
        text-align: center;   
    }

    .ErrorText{
        color: red;
    }

    </style>


    </head>

    <body>
    
        <div class="RegTitle">
            <h1>User Account Registration</h1>

            <p>Please register your user account with the following information</p><br><br>

            <span class="ErrorText"><?php echo $EmptyRequiredFieldError; ?></span><br>

            <span class="ErrorText"><?php echo $InvalidInputError; ?></span><br>

        </div>

        <div class="RegBox">    

            <form action="UserRegistration.php" method="post">
                <input type="text" name="Fname" required placeholder="First Name"><br><br>
                <input type="text" name="Lname"  required placeholder="Last Name"><br><br>
                <input type="text" name="Address1"  required placeholder="Address Line 1"><br><br>
                <input type="text" name="Address2" placeholder="Address Line 2"><br><br>
                <input type="text" name="City"  required placeholder="City"><br><br>
                <input type="text" name="State"  required placeholder="State"><br><br>
                <input type="text" name="Zip"  required placeholder="Zip"><br><br>
                <input type="text" name="Country"  required placeholder="Country"><br><br>
                <input type="submit" name="insert" value="Register"><br><br>
            </form>
        </div>
    </body>
</html>