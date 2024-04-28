<?php 
session_start();
include_once "php/connect.php";
if ($_SESSION['id']){
    $uname = $_SESSION['name'];
    $id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $profile = $_SESSION['profile'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZERO</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendor/toastify/toast.css">
    <link rel="icon" href="assets/img/logo.png"> 
</head>
<body onload="defaultLocation()">
    <div class="loader-bg"><div class="loader"></div></div>
    <section id="app">

        <!-- beatiful side panel 😍 -->
        <section id="left-container">
            <div class="profile">
                <div class="img-container">
                    <img src="assets/img/profile/<?php echo $profile; ?>" alt="Profile-img">
                </div>
                <div class="profile-details">
                    <h4 class="userName"><?php echo $uname; ?></h4>
                    <h5 class="email"><?php echo $email; ?></h5>
                </div>
            </div>

            <div class="search-container">
                <div class="input">
                    <input type="search" placeholder="search">
                </div>
                <div class="icon">
                    <i class="bi bi-search"></i>
                </div>
            </div>
            
            <!-- The nav is looking cool ✨ -->
            <div class="navigation">
                <a href="#main" class="link " id="main">
                    <div class="option " >
                        <div class="option-icon"><i class="bi bi-sun-fill" style="color: var(--sun)"></i></div>
                        <h3 class="option-text">My Day</h3>
                        <?php 
                            $due = date("m/d/Y");
                            $myday = mysqli_query($con, "SELECT * FROM tasks WHERE user_id='{$id}' AND due='{$due}' AND completed='0'");
                            $myday = mysqli_num_rows($myday);
                            if ($myday>0){
                        ?>
                        <div class="option-label myday"><?php echo $myday; ?></div>
                        <?php } ?>
                    </div>
                </a>
                
                <a href="#important" class="link" id="important">
                    <div class="option " >
                        <div class="option-icon"><i class="bi bi-star" style="color: var(--star)"></i></div>
                        <h3 class="option-text">Important</h3>
                        <?php 
                            $important = mysqli_query($con, "SELECT * FROM tasks WHERE user_id='{$id}' AND important='1' AND completed='0'");
                            $important = mysqli_num_rows($important);
                            if ($important>0){
                        ?>
                        <div class="option-label important"><?php echo $important; ?></div>
                        <?php } ?>
                    </div>
                </a>
                
                <a href="#planned" class="link" id="planned">
                    <div class="option ">
                        <div class="option-icon"><i class="bi bi-card-list" style="color: var(--bars)"></i></div>
                        <h3 class="option-text">Planned</h3>
                        <?php 
                            $planned = mysqli_query($con, "SELECT * FROM tasks WHERE user_id='{$id}' AND due!='{$due}' AND completed='0'");
                            $planned = mysqli_num_rows($planned);
                            if ($planned>0){
                        ?>
                        <div class="option-label planned"><?php echo $planned; ?></div>
                        <?php } ?>
                    </div>
                </a>
                
                <a href="#assigned" class="link" id="assigned">
                    <div class="option " >
                        <div class="option-icon"><i class="bi bi-person" style="color: var(--user)"></i></div>
                        <h3 class="option-text">Assigned to me</h3>
                    </div>
                </a>
                
                <a href="#completed" class="link" id="completed">
                    <div class="option " >
                        <div class="option-icon"><i class="bi bi-check-circle" style="color: var(--house)"></i></div>
                        <h3 class="option-text">Completed</h3>
                        <?php 
                            $completed = mysqli_query($con, "SELECT * FROM tasks WHERE user_id='{$id}' AND completed='1'");
                            $completed = mysqli_num_rows($completed);
                            if ($completed>0){
                        ?>
                        <div class="option-label completed"><?php echo $completed; ?></div>
                        <?php } ?>
                    </div>
                </a>
                
                <hr>
                
                <a href="#team" class="link" id="team">
                    <div class="option " >
                        <div class="option-icon"><i class="bi bi-people" style="color: var(--team)"></i></div>
                        <h3 class="option-text">Collaboration</h3>
                    </div>
                </a>
                 
                <a href="#notification" class="link" id="notification">
                    <div class="bottom-option">
                        <hr>
                        <div class="option">
                            <div class="option-icon"><i class="bi bi-bell" style="color: var(--bell)"></i></div>
                            <h3 class="option-text">Notifications</h3>
                            <?php 
                            $due = date("m/d/Y");
                            $notification = mysqli_query($con, "SELECT * FROM notif WHERE user_id='{$id}' AND opened='0'");
                            $notification = mysqli_num_rows($notification);
                            if ($notification>0){
                        ?>
                        <div class="option-label notification"><?php echo $notification; ?></div>
                        <?php } ?>
                        </div>
                    </div>
                </a>
                
            </div>
            
            <!-- 😊😊 -->
        </section>

        <!-- Ahh 😡 here we go again  -->
        <section id="main-container">
            <!-- Marvelous 🤗 -->
            <div class="content">
                <!-- Where all 🎉 will be  -->
                <div class="loading-container">
                    <div class="loading"></div>
                    <div class="txt">Loading...</div>
                </div>

            </div>
        </section>

        <section id="right-container" style="display: none;">
        </section>
        
    </section>

    <button class="record-btn-call" id="click_to_record" onclick="displayModal('voice')"><img src="assets/img/ai.png" alt="Record"></button>

    <!-- What are you doin here bro 😡 -->
    <div id="calendar" style="display: none;"></div>

    <div id="modal-box" class="modal">
        <div class="modal-content">
            <span class="close" hidden>&times;</span>
            
            <div class="desc-cont" style="display: none;">
                <h3>Task Description</h3>
                <textarea id="task_desc" placeholder="Fully Describe your task..." style="width: 100%;height: 100px;outline: 0;padding: 10px;border-radius: 8px;"></textarea>
                <div class="add_container" style="margin: 10px; margin-bottom: 30px;">
                    <button style="float: right; background: var(--team); padding: 5px 20px; color: var(--text);border: none; border-radius: 8px;cursor: pointer;" onclick="span.click()">Close</button>
                </div>
            </div>

            <div class="ai_voice" style="display: none;">
                <h3 class="desc">Ai voice command</h3>
                <br><br>
                <p id="out" class="muted" style="text-align: center; font-size: 17px;">plan a trip to the back</p>
                <button class="run">Run</button>
                <!-- <br><br> -->
            </div>

            <div class="new_team">
                <form method="POST" action="php/new_team.php" enctype="multipart/form-data">

                    <div class="input-container">
                        <img src="assets/img/teams/placeholder.png" id="imagePreview" alt="team-icon">
                        <button type="button" onclick="uploadImg()">Upload</button>
                        <input type="file" id="upload-inp" name="team_profile" accept="image/*" hidden>
                    </div>
                    
                    <div class="input-container">
                        <label for="team-name">Team Name</label>
                        <input type="text" class="team-name" name="team_name" required>
                    </div>

                    <div class="input-container"><input type="submit" class='submit' name="submit" value="Create"></div>
                </form>
            </div>
        </div>
    </div> 
    <script>
        const date = "<?php echo date("D, M d") ?>";
    </script>   
    <!-- always fighting with  🤬 javascript files -->
    <script src="assets/vendor/toastify/toast.js"></script>
    <script type="text/javascript" src="assets/js/view_task.js"></script>
    <script type="text/javascript" src="assets/vendor/date/dist/datedreamer.js"></script>
    <script type="text/javascript" src="assets/js/modal.js"></script>
    <script type="text/javascript" src="assets/js/router.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <!-- <script ></script> -->
    <script>
        const todaysDate = new Date();
        new datedreamer.calendar({
            element: "#calendar",
            selectedDate: todaysDate,
            format: "MM/DD/YYYY",
            hideInputs: true,
            onChange: (e) => {
                // Get Date object from event
                due = e.detail;
                console.log(due);
            },
            theme: "lite-purple"
        });         
    </script>
    <script src="assets/js/voice.js"></script>
</body>
</html>
<?php }else{header("location: init.php");} ?>