<?php
include("../../connect.php");

$placement = $_POST['placement'];
if (isset($_POST['placement'])) {
    if ($placement == 0) {

?>

        <div class="form-group">
            <!-- <label for="">AGENTS</label> -->
            <input type="text" class="form-control form-control-user" name="agent_name" placeholder="Agent's full name" required>
        </div>
        <div class="form-group">
            <input type="tel" class="form-control form-control-user" name="agent_phone" placeholder="Agent's phone no" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" name="agent_bank" placeholder="Agent's bank">
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" name="agent_account_no" placeholder="Agent's account no" >
        </div>

    <?php
    } else if ($placement == 1) {
    ?>
        <!-- <label for=""></label> -->
        <div class="form-group">
            <select name="agent" id="agent" class="form-control">
                <?php
                $findAgents =  selectAll('agents');
                foreach ($findAgents as $agent) {
                ?>
                    <option value="<?php echo $agent['idagents'] ?>">
                        <?php
                        echo $agent['fullname'];
                        ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    <?php
    } else if ($placement == 2) {
    ?>

        <div class="form-group">
            <select name="investor" id="investor" class="form-control">
                <?php
                $findAgents =  selectAll('fixed_deposit');
                foreach ($findAgents as $agent) {
                ?>
                    <option value="<?php echo $agent['idfixed_deposit'] ?>">
                        <?php
                        echo $agent['name'];
                        ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>
    <?php
    } else if ($placement == 3) {
    ?>
        <div class="form-group">
            NO AGENT
        </div>
<?php
    }
}
?>
<script>
    $(document).ready(function() {
        // to display info of picked registered agent
        $('#agent').on("click", function() {
            var agent = $(this).val();
            $.ajax({
                url: "functions/system/ajax_functions/registered_agents.php",
                method: "POST",
                data: {
                    agent: agent
                },
                success: function(data) {
                    $('#regsitered_agent').html(data);
                }
            })
        });
        $('#investor').on("click", function() {
            var investor = $(this).val();
            $.ajax({
                url: "functions/system/ajax_functions/registered_agents.php",
                method: "POST",
                data: {
                    investor: investor
                },
                success: function(data) {
                    $('#regsitered_agent').html(data);
                }
            })
        });
    });
</script>