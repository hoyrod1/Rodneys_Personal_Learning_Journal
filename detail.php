<?php 
    require("inc/functions.php");

    if (!isset($_GET['id'])) 
    {
        header("location: index.php");
    }else
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $read_detail_entry = read_detail_entry($id);
    }
    // if (isset($_GET['msg'])) 
    // {
    //     $message = filter_input(INPUT_GET, "msg", FILTER_SANITIZE_STRING);
    // }

    include("inc/header.php") 
?>    

        <section>
            <div class="container">
                <div class="entry-list single">
                   <!--  <?php
                        if (isset($message)) 
                        {
                             echo "<p style='color;green:background-color:lightgrey;margin:5px;padding:5px;>$message</p>";
                        }  
                    ?>
 -->                    <article>
                        <h1><?php echo $read_detail_entry['title']; ?></h1>
                        <time datetime="2016-01-31"><?php echo $read_detail_entry['date']; ?></time>
                        <div class="entry">
                            <h3>Time Spent: </h3>
                            <p><?php echo $read_detail_entry['time_spent']; ?></p>
                        </div>
                        <div class="entry">
                            <h3>What I Learned:</h3>
                            <p><?php echo $read_detail_entry['learned']; ?></p>
                        </div>
                        <div class="entry">
                            <h3>Resources to Remember:</h3>
                            <ul>
                                <li><a href=""><?php echo $read_detail_entry['resources']; ?></a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            <div class="edit">
                <p><a href="edit.php?id=<?php echo $read_detail_entry['id']; ?>">Edit Entry</a></p>
            </div>
        </section>
        
<?php include("inc/footer.php"); ?>