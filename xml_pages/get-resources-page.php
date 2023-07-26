<?php
include_once("../includes/session.php");
include_once("../includes/DB.php");
include_once("../includes/functions.php");
include_once("../includes/DateTime.php");
global $connectingDB;

$resource = $_GET["resource"];
$post_style = $_GET["post_style"];
$sortBy = $_GET['sortBy'] === "oldest" ? "DESC" : "ASC";


$sql = 'SELECT * FROM resources WHERE catagory = "' . $resource . '" ORDER BY date_added '. $sortBy;
$stmt = $connectingDB -> prepare($sql);
$stmt->execute();
$Result = $stmt->rowcount();

if ($Result === 0){
    echo "<span>No resources yet. Be the first to create one!";
}else{
    $count = 0;
    while ($DataRow = $stmt->fetch()){
    $resource_id = $DataRow["resource_id"];
    $title = $DataRow['title'];
    $first_name = $DataRow['f_name'];
    $last_name = $DataRow['l_name'];
    $date_added = $DataRow['date_added'];
    $content = gzuncompress($DataRow["content"]);
    $prev_image = gzuncompress($DataRow['preview_img']);
    $count +=1;

    if ($post_style === "bubble"){
    ?> 
    <article class="blob-post">
        <a class="img" href="./clicked-resource.php?id=<?php echo $resource_id?>">
            <img src="<?php echo $prev_image ?>" alt="">
        </a>
        <div class="text-container">
            <a class="title" href="./clicked-resource.php?id=<?php echo $resource_id?>">
                <?php echo $title ?>
            </a>
            <div class="author-time">
            <?php
                if ($first_name != 0){
                ?>
                 <span class="author">By: <?php echo ucfirst($first_name) . " " . ucfirst($last_name)?></span>
                 <?php 

                }else{
                    ?>
                    <span class="author">By: Unkown</span>
                <?php
                }

            ?>
            <span class="time"><?php echo $date_added?></span>
            </div>
        </div>
    </article>
    <?php

    }else{
    ?>
    <article class="list-post">
        <a class="img" href="./clicked-resource.php?id=<?php echo $resource_id?>">
            <img src="<?php echo $prev_image ?>" alt="">
        </a>
        <div class="text-container">
            <a class="title" href="./clicked-resource.php?id=<?php echo $resource_id?>">
                    <?php echo $title ?>
            </a>
            <div class="author-time">
            <?php
            if ($first_name != 0){
            ?>
                <span class="author">By: <?php echo ucfirst($first_name) . " " . ucfirst($last_name)?></span>
                <?php 

            }else{
                ?>
                <span class="author">By: Unkown</span>
            <?php
            }

                ?>
                <div class="seperator">|</div>
                <span class="time"><?php echo $date_added?></span>
            </div>
            <div class="description-container descriptionNum-<?php echo $count?>">
                <span class="desciption">
                    <?php echo $content ?>
                </span>
            </div>
        </div>
    </article>

    <?php

    }
    
    }
}


?>