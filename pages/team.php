<?php
session_start();
$user_id = $_SESSION['id'];
include_once '../php/connect.php';
?>
<div class="team-container">
    <div class="top-content">
        <div class="page-detail">
            <h2><i class="bi bi-people"></i> Teams</h2>
        </div>

        <div class="top-options">

            <div class="option" onclick="displayModal('new_team')">
                <i class="bi bi-plus"></i>
                <span>New team</span>
            </div>

            <div class="option" onclick="displayModal('join_team')">
                <i class="bi bi-bounding-box"></i>
                <span>Join team</span>
            </div>
            
        </div>
    </div>

    <!-- so adorable 😚 -->
    <div class="message-container">
        <div class="teams">
            
            <?php 
            $fetch = mysqli_query($con, "SELECT DISTINCT team_id FROM team_members WHERE member_id='{$user_id}'");
            while($teams = mysqli_fetch_assoc($fetch)){
                $team_id = $teams['team_id'];
                $team_details_fetch = mysqli_query($con, "SELECT * FROM teams WHERE team_id='{$team_id}'");
                $team_details = mysqli_fetch_assoc($team_details_fetch);

                $team_name = $team_details['team_name'];
                $team_profile = $team_details['team_profile'];
                // team Creator
                $creator_id = $team_details['creator_id'];
                $creator_details_fetch = mysqli_query($con, "SELECT * FROM users WHERE user_id='{$creator_id}'");
                $creator_details = mysqli_fetch_assoc($creator_details_fetch);

                $creator = $creator_details['user_name'];
            ?>  
            <div class="team-card" id='<?php echo $team_id ?>' onclick="fetchMessages(this.id, document.querySelector('.message-card'))">
                <div class="menu" onclick="teamMenu(document.querySelector('#t<?php echo $team_id ?>'))"><i class="bi bi-three-dots"></i></div>
                <div class="menu-options" id='t<?php echo $team_id; ?>' style="display: none;">
                    <div class="menu-option" id='<?php echo $team_id; ?>' onclick="displayModal('members', this.id);document.querySelector('#t<?php echo $team_id ?>').click()"><i class='bi bi-people'></i> Members</div> 
                    <hr>
                    <div class="menu-option" id='<?php echo $team_id; ?>' onclick="displayModal('invite', this.id);document.querySelector('#t<?php echo $team_id ?>').click()"><i class='bi bi-envelope'></i> Invite</div> 
                    <hr>
                    <div class="menu-option" id='<?php echo $team_id; ?>' onclick="confirmDelete()"><i class='bi bi-x-octagon'></i> Delete</div> 
                </div>
                <div class="team-profile">
                    <img src="assets/img/teams/<?php echo $team_profile; ?>" alt="team-profile-img">
                </div>
                <div class="team-details">
                    <h3 class="team-name"><?php echo $team_name; ?></h3>
                    <h4 class="creator"><?php echo $creator; ?></h4>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="message-card">
            
        </div>
    </div>
</div>