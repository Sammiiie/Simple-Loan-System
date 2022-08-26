<?php
include("../../connect.php");

if (isset($_POST['agent'])) {
    $agent = $_POST['agent'];
    $findAgent = selectOne('agents', ['idagents' => $agent]);
?>
    <div class="form-group">
        <!-- <label for="">AGENTS</label> -->
        <input type="text" class="form-control form-control-user" name="agent_name" value="<?php echo $findAgent['fullname'] ?>"required>
    </div>
    <div class="form-group">
        <input type="tel" class="form-control form-control-user" name="agent_phone" value="<?php echo $findAgent['phone'] ?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="agent_bank" value="<?php echo $findAgent['bank'] ?>" >
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="agent_account_no" value="<?php echo $findAgent['bank_account'] ?>">
    </div>

<?php
} else if (isset($_POST['investor'])) {
    $agent = $_POST['investor'];
    $findAgent = selectOne('fixed_deposit', ['idfixed_deposit' => $agent]);
?>
    <div class="form-group">
        <!-- <label for="">AGENTS</label> -->
        <input type="text" class="form-control form-control-user" name="agent_name" value="<?php echo $findAgent['name'] ?>" required>
    </div>
    <div class="form-group">
        <input type="tel" class="form-control form-control-user" name="agent_phone" value="<?php echo $findAgent['phone_no'] ?>">
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="agent_bank" value="<?php echo $findAgent['bank'] ?>" >
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="agent_account_no" value="<?php echo $findAgent['bank_account'] ?>">
    </div>

<?php
}
