<?php
include("../../connect.php");

$bank = $_POST['bank'];
if (isset($_POST['bank'])) {

?>

    <div class="form-group">
        <label for="">Branches</label>
        <select name="branches" id="branches" class="form-control">
            <?php
            $findBranches =  selectAll('branches', ['banks_idbanks' => $bank]);
            foreach ($findBranches as $branch) {
            ?>
                <option value="<?php echo $branch['idbranches'] ?>"><?php echo $branch['branch_name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>

<?php
}
?>