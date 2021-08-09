<?php 
    require("inc/functions.php");
    
    $titleErr = $dateErr = $timeSpentErr = $whatILearnedErr = $ResourcesToRememberErr = $loginErr = $loginSuc = "";

    if (!isset($_GET['id'])) 
    {
        header("location: index.php");
    }else
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $read_detail_entry = read_detail_entry($id);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) 
    {
        $id                  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
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
        if (empty($_POST['whatILearned']))
        {
            $whatILearnedErr = "Please enter what you learned!";
        }
        if (empty($_POST['ResourcesToRemember']))
        {
            $ResourcesToRememberErr = "Please enter resources to remember!";
        }else
        {
            $update_entry = update_entry($id, $title, $date, $timeSpent, $whatILearned, $ResourcesToRemember);
            if ($update_entry) 
            {
                header("location: detail.php?id=$id");
            }else
            {
                $loginErr = "There was an error!!!";
            }
            
        }
    }

    include("inc/header.php") 
?>
    
        <section>
            <div class="container">
                <div class="edit-entry">
                    <span style="color: red;font-size: 16px;"><?php echo $loginErr; ?></span>
                    <br>
                    <br>
                    <h2>Edit Entry</h2>
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <label for="title"> Title </label>
                        <input id="title" type="text" name="title" value="<?php echo $read_detail_entry['title']; ?>"><br>
                        <span style="color: red;font-size: 16px;"><?php echo $titleErr; ?></span><br><br>

                        <label for="date">Date</label>
                        <input id="date" type="date" name="date" value="<?php echo $read_detail_entry['date']; ?>"><br>
                        <span style="color: red;font-size: 16px;"><?php echo $dateErr; ?></span><br><br>

                        <label for="time-spent"> Time Spent</label>
                        <input id="time-spent" type="text" name="timeSpent" value="<?php echo $read_detail_entry['time_spent']; ?>"><br>
                        <span style="color: red;font-size: 16px;"><?php echo $timeSpentErr; ?></span><br><br>

                        <label for="what-i-learned">What I Learned</label>
                        <textarea id="what-i-learned" rows="5" name="whatILearned"><?php echo $read_detail_entry['learned']; ?></textarea>
                        <span style="color: red;font-size: 16px;"><?php echo $whatILearnedErr; ?></span><br><br>

                        <label for="resources-to-remember">Resources to Remember</label>
                        <textarea id="resources-to-remember" rows="5" name="ResourcesToRemember"><?php echo $read_detail_entry['resources']; ?></textarea>
                        <span style="color: red;font-size: 16px;"><?php echo $ResourcesToRememberErr; ?></span><br><br>

                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" value="Publish Entry" class="button" name="submit">
                        <a href="detail.php?id=<?php echo $id; ?>" class="button button-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </section>

<?php include("inc/footer.php"); ?>