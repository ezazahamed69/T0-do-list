<?php 
require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do-List</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="./to-do-list.png" type="image/x-icon">
</head>
<body>
    <div class="main-section">
       <div class="add-section">
        <h1> To Do List </h1>
          <form action="./add.php" method="POST" >
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="title" 
                     style="border-color: #5a92c3"
                     placeholder="This is required" />
              <button type="submit">Add Task</span></button>

             <?php 
            }
            else
            { 
                ?>
              <input type="text" 
                     name="title" 
                     placeholder="Enter your to do list" 
                     />
              <button type="submit">Add Today's list </button>
             <?php } ?>
          </form>
       </div>
       <?php 
          $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
       ?>
       <div class="show-todo-section">
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <h1></h1>
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <?php if($todo['checked']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $todo['title'] ?></h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $todo['title'] ?></h2>
                    <?php } ?>
                    <br>
                    <p><?php echo $todo['date_time'] ?></p> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="./jquery-3.2.1.min.js"></script>
    <script src="./main.js"></script>
</body>
</html>