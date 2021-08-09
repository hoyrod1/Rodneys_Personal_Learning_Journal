<?php 
    require("inc/functions.php");

    //$title = $date = $timeSpent = $whatILearned = $ResourcesToRemember = "";
    $titleErr = $dateErr = $timeSpentErr = $whatILearnedErr = $ResourcesToRememberErr = $loginErr =  "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) 
    {
        $title               = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING) ;
        $date                = filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING) ;
        $dateMatch           = explode("-", $date) ;
        $timeSpent           = filter_input(INPUT_POST, "timeSpent", FILTER_SANITIZE_NUMBER_INT) ;
        $whatILearned        = filter_input(INPUT_POST, "whatILearned", FILTER_SANITIZE_STRING) ;
        $ResourcesToRemember = filter_input(INPUT_POST, "ResourcesToRemember", FILTER_SANITIZE_STRING) ;
    
        if (empty($_POST['title']))
        {
            $titleErr = "Please create a title";
        }
        if (!preg_match("/^[a-zA-Z-' ]*$/", $title)) 
        {
            $titleErr = "Please only letters and white space allowed";
        }
        if (empty($_POST['date']))
        {
            $dateErr = "Please enter a date";
        }
        if (count($dateMatch) != 3 || strlen($dateMatch[0]) != 4 || strlen($dateMatch[1]) != 2 || strlen($dateMatch[2]) != 2 || !checkdate($dateMatch[1], $dateMatch[2], $dateMatch[0])) 
        {
            $dateErr = "Invalid Date!";
        }
        if (empty($_POST['timeSpent']))
        {
            $timeSpentErr = "Please enter a time in minutes or hours!";
        }
        // if (!preg_match("/^[a-zA-Z0-9]*$/", $timeSpent)) 
        // {
        //     $timeSpentErr = "Please only enter numbers!";
        // }
        if (empty($_POST['whatILearned']))
        {
            $whatILearnedErr = "Please enter what you learned!";
        }
        // if (!preg_match("/^[a-zA-Z0-9-.,' ]*$/", $whatILearnedErr)) 
        // {
        //     $whatILearnedErr = "Please only letters, numbers, periods, comma's, single quotes, double quotes and white space allowed";
        // }
        if (empty($_POST['ResourcesToRemember']))
        {
            $ResourcesToRememberErr = "Please enter resources to remember!";
        }else
        {
            $inser_entry = insert_entry($title, $date, $timeSpent, $whatILearned, $ResourcesToRemember);
            if ($inser_entry) 
            {
                header("location: index.php");
            }else
            {
                $loginErr = "There was an error!!!";
            }
            
        }
        // if (!preg_match("/^[a-zA-Z0-9-,.\"_' ]*$/", $ResourcesToRemember)) 
        // {
        //     $ResourcesToRemembere = "Please only letters, numbers, periods, comma's, single quotes, double quotes and white space allowed";
        // }

    }
    
    include("inc/header.php") 
?>

        <section>
            <div class="container">
                <div class="new-entry">
                    <span style="color: red;font-size: 16px;"><?php echo $loginErr; ?></span><br><br>
                    <h2>New Entry</h2>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <label for="title"> Title</label>
                        <input id="title" type="text" name="title" value="<?php if(isset($_POST['title'])){ echo htmlspecialchars($title);} ?>">
                        <span style="color: red;font-size: 16px;"><?php echo $titleErr; ?></span><br><br>

                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php if(isset($_POST['date'])){ echo htmlspecialchars($date);} ?>">
                        <span style="color: red;font-size: 16px;"><?php echo $dateErr; ?></span><br><br>

                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" value="<?php if(isset($_POST['timeSpent'])){ echo htmlspecialchars($timeSpent);} ?>">
                        <span style="color: red;font-size: 16px;"><?php echo $timeSpentErr; ?></span><br><br>
                        
                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php if(isset($_POST['whatILearned'])){ echo htmlspecialchars($whatILearned); }?></textarea>
                        <span style="color: red;font-size: 16px;"><?php echo $whatILearnedErr; ?></span><br><br>
                        
                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php if(isset($_POST['ResourcesToRemember'])){ echo htmlspecialchars($ResourcesToRemember);} ?></textarea>
                        <span style="color: red;font-size: 16px;"><?php echo $ResourcesToRememberErr; ?></span><br><br>
                        
                        <input type="submit" value="Publish Entry" class="button" name="submit">
                        <a href="#" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>

<?php include("inc/footer.php"); ?>