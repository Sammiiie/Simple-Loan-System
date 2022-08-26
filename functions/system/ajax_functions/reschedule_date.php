<?php

if (isset($_POST['extend'])) {
    $extend = $_POST['extend'];
    $repaymentDate = $_POST['repayment_date'];
    $newRepaymentDate = date('Y-m-d', strtotime("+" . $extend . " days", strtotime($repaymentDate)));
?>
    <div class="form-group">
        <label for="">New repayment date</label>
        <input type="date" class="form-control form-control-user" name="new_date" value="<?php echo $newRepaymentDate ?>" readonly required>
    </div>
<?php
}
