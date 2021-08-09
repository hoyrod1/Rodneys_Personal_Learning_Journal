<?php 
    require("inc/functions.php");
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_POST['delete'])) 
    {
        $id = filter_input(INPUT_POST, "delete", FILTER_SANITIZE_NUMBER_INT);
        if (delete_entry($id)) 
        {
            header('location: index.php?msg=Entry+Deleted');
        }else
        {
            header('location: index.php?msg=Entry+Could+Not+Be+Deleted');
        }
    }
    if (isset($_GET['msg'])) 
    {
        $message = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
    }
    
    include("inc/header.php") 
?>

        <section>
            <div class="container">
                <div class="entry-list">
                        <?php 
                            if (isset($message)) 
                            {
                                echo "<p style='color:green;text-align:center;'>" .$message. "</p>";
                            } 
                            $list = read_list_entry();
                            foreach ($list as $key) 
                            {
                                echo "<article style='background-color:grey;margin-bottom:5px;padding:20px;border-radius:10px;'>";
                                echo "<h2 style='text-decoration:underline;'><a href='detail.php?id=" . $key['id'] . "'>"  . $key['title'] . "</a></h2>";
                                echo "<p style='color:orange;margin-bottom:10px;font-size:30px;'><time datetime='2016-01-31'>" . $key['date'] . "</time></p>";
                                echo "<p>";
                                echo "<form action='" .htmlspecialchars($_SERVER['PHP_SELF']) . "' method='POST' onsubmit=\"return confirm('Are you sure you want to delete this task?');\">";
                                echo "<input type='hidden' name='delete' value='" .$key['id']. "'>";
                                echo "<input type='submit' value='Delete' style='background-color:lightgrey;color:red;font-size:15px;padding:5px;border-radius:10px;'>";
                                echo "</form>";
                                echo "</p>";
                                echo "</article>";
                            }
                        ?>
                </div>
            </div>
        </section>

<?php include("inc/footer.php"); ?>