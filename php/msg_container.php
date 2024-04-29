<div class='message-card'>
<?php
session_start();
$user_id = $_SESSION['id'];
include_once "connect.php";
if (isset($_GET['id'])) {
    $team_id = mysqli_real_escape_string($con, $_GET['id']);

    $team_details_fetch = mysqli_query($con, "SELECT * FROM teams WHERE team_id='{$team_id}'");

    $team_details = mysqli_fetch_assoc($team_details_fetch);

    // team details
    $team_name = $team_details['team_name'];
    $team_profile = $team_details['team_profile'];
?>
<div class='card-header'>
    <div class='team-profile'>
        <img src='assets/img/teams/<?php echo $team_profile; ?>' alt='team-profile-img' title='<?php echo $team_name; ?>'>
    </div>
</div>
<div class='card-body'>
<div class='message-holder'>



</div>            
    </div>
    <form id='send-msg-form'>
    <div class='card-footer'>
            <div class='emoji-container' id='emoji'><i class='bi bi-emoji-wink'></i></div>
            <div class='input-container'> <input type='text' placeholder='Start typing' id='message'> </div>
            <div class='send-container'><i class='bi bi-send' id='send-btn'></i></div>
        </div>
    </form>
</div>
<?php } ?>