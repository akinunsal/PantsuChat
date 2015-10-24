<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 

    // This if statement checks to determine whether the edit form has been submitted
    // If it has, then the account updating code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    {
        // If the user is changing their E-Mail address, we need to make sure that 
        // the new value does not conflict with a value that is already in the system. 
        // If the user is not changing their E-Mail address this check is not needed.
        if($_POST['osuname'] != $_SESSION['user']['osuname']) 
        { 
            // Define our SQL query 
            $query = " 
                SELECT 
                    1 
                FROM users 
                WHERE 
                    osuname = :osuname
            "; 
            
            // Define our query parameter values 
            $query_params = array( 
                ':osuname' => $_POST['osuname'] 
            ); 
            
            try 
            { 
                // Execute the query 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results (if any) 
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("This osu! username is already in use by another account."); 
            } 
        }    
        
                // Initial query parameter values 
        $query_params = array( 
            ':osuname' => $_POST['osuname'], 
            ':user_id' => $_SESSION['user']['id'], 
        ); 
        
                $query = " 
            UPDATE users 
            SET 
                osuname = :osuname 
        "; 
        
        $query .= " 
            WHERE 
                id = :user_id 
        "; 

        try 
        { 
            // Execute the query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
        // This redirects the user back to the members-only page after they register 
        header("Location: private.php"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to private.php"); 
    }
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<h1>Edit Account</h1> 
<form action="edit_osuname.php" method="post"> 
    Username:<br /> 
    <b><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></b> 
    <br /><br /> 
    osu! username:<br /> 
    <input type="text" name="osuname" value="" /><br />
    <i>osu! Username only. UserID doesn't work.</i>
    <input type="submit" value="Update Account" /> 
</form>