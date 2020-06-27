<?php

    session_start();

    $username = "";
    $email = "";
    $errors = array();
    //connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'registration');

    //if the register button is clicked
    if(isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $phone = mysqli_real_escape_string($db,$_POST['phone']);
        $password1 = mysqli_real_escape_string($db,$_POST['password1']);
        $password2 = mysqli_real_escape_string($db,$_POST['password2']);
        
        //ensure that form fields are filled properly
        if(empty($username)){
            array_push($errors, "Username is required"); 
        }
        if(empty($email)){
            array_push($errors, "Email is required"); 
        }
        if(empty($phone)){
            array_push($errors, "Mobile Number is required"); 
        }
        if(empty($password1)){
            array_push($errors, "Password is required"); 
        }
        if($password1 != $password2) {
            array_push($errors, "The two passwords do not match");
        }

        if(count($errors)==0){
            $password = md5($password1);
            $sql = "INSERT INTO users (username, email, phone, password)
                        VALUES('$username','$email','$phone','$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location:index.php'); //redirect to homepage 
            }
        }

        //log user in from login page
        if(isset($_POST['login'])){
                $username = mysqli_real_escape_string($db,$_POST['username']);
                $password = mysqli_real_escape_string($db,$_POST['password']);
            
            //ensure that form fields are filled properly
            if(empty($username)){
                array_push($errors, "Username is required"); 
            }
            if(empty($password)){
                array_push($errors, "Password is required"); 
            }
            if(count($errors) == 0 ) {
                $password=md5($password); //encrypt password before comparing with that from database
                $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $result=mysqli_query($db,$query);
                if(mysqli_num_rows($result) == 1){
                    //log user in
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "You are now logged in!";
                    header('location:index.php'); //redirect to homepage 
                }else{
                    array_push($errors, "Wrong username/password combination");
                }
            }

        }

         //logout
         if(isset($_GET['logout'])){
             session_destroy();
             unset($_SESSION['username']);
             header('location: login.php');
    }
?>