<?php
$page['auth'] = 5;
require "include/functions.inc";
require "include/mysql.inc";
?>
<html>
    <head>
        <title>Points Submitted</title>
        <?php include "include/head.inc"; ?>
    </head>
    <body>
        <?php
        require "include/header.inc";
        $errormsg = null;
        do {
            if (!isset($_POST['code'])) {
                $errormsg = "Error: CODE is not set!";
                break;
            }
            if (!isset($_POST['quantity'])) {
                $errormsg = "Error: QUANTITY is not set!";
                break;
            }
            if ($_POST['quantity'] > 20 || $_POST['quantity'] < 1) {
                $errormsg = "Error: QUANTITY out of range [1,20]!";
                break;
            }
            if ($_POST['multiple'] == "on") {
                $awardto = split(",", $_POST['awardedtomultiple']);
                for ($i = 0; $i < count($awardto); $i++) {
                    $awardto[$i] = trim($awardto[$i]);
                    if (!valid_net_id($awardto[$i]))
                        continue;
                    $query = sprintf("INSERT INTO `dsp`.`points_awarded` (`pointid`, `timestamp`, `awardedto`, `code`, `quantity`, `awardedby`, `comments`) VALUES "
                            . "(NULL, CURRENT_TIMESTAMP, '%s', '%s', '%d', '%s', '%s');", mysqli_real_escape_string($awardto[$i]), mysqli_real_escape_string($_POST['code']), intval($_POST['quantity']), mysqli_real_escape_string($_SESSION['user']), mysqli_real_escape_string($_POST['comments']));
                    $result = mysqli_query($query) or ( $errormsg = ('Invalid query: ' . mysqli_error()));
                }
            } else {
                $query = sprintf("INSERT INTO `dsp`.`points_awarded` (`pointid`, `timestamp`, `awardedto`, `code`, `quantity`, `awardedby`, `comments`) VALUES "
                        . "(NULL, CURRENT_TIMESTAMP, '%s', '%s', '%d', '%s', '%s');", mysqli_real_escape_string($_POST['awardedto']), mysqli_real_escape_string($_POST['code']), intval($_POST['quantity']), mysqli_real_escape_string($_SESSION['user']), mysqli_real_escape_string($_POST['comments']));
                $result = mysqli_query($query) or ( $errormsg = ('Invalid query: ' . mysqli_error()));
            }
        } while (false);
        ?>
        <form id="awardpts" action="submitaward.php" method="POST" >
            <h1>Points awarded</h1><br>
            <table class="award">
                <tr>
                    <td class="awardlabel">Code</td>
                    <td><input id="code" name="code" type="text" maxlength="5" style="width: 50px;" value="<?php echo $_POST['code']; ?>" disabled /></td>
                </tr>
                <tr>
                    <td class="awardlabel">Quantity</td>
                    <td><input id="quantity" name="quantity" type="number" min="1" max="20" value="<?php echo $_POST['quantity']; ?>" disabled /></td>
                </tr>
                <tr>
                    <td class="awardlabel">Award to</td>
                    <td> <input id="awardedto" name="awardedto" type="text" value="<?php echo $_POST['awardedto']; ?>" disabled /></td>
                </tr>
                <tr>
                    <td class="awardlabel">Award to multiple members?</td>
                    <td><input id="multiple" name="multiple" type="checkbox" <?php if ($_POST['multiple'] == "on") echo "checked"; ?> disabled /></td>
                </tr>
                <tr>
                    <td class="awardlabel">Award to <br><i>(multiple, comma separate users)</i></td>
                    <td><textarea id="awardedtomultiple" name="awardedtomultiple" type="text" disabled><?php echo $_POST['awardedtomultiple']; ?></textarea></td>
                </tr>
                <tr>
                    <td class="awardlabel">Comments</td>
                    <td><input id="comments" name="comments" type="text" style="width: 100%;" value="<?php echo $_POST['comments']; ?>" disabled /></td>
                </tr>
                <tr>
                    <td class="awardlabel">Awarded by</td>
                    <td><?php echo $_SESSION['user']; ?></td>
                </tr>
                <tr>
                    <td class="awardlabel">Awarded on</td>
                    <td><?php echo date("Y-m-d h:m:s"); ?></td>
                </tr>
                <tr><td class="<?php echo $errormsg != null ? "awardlabelfail" : "awardlabelsuccess"; ?>" colspan="2"><?php echo $errormsg != null ? $errormsg : "Points awarded successfully!"; ?></td></tr>
            </table>
        </form>
        <?php require "include/footer.inc"; ?>
    </body>
</html>

<?php
mysqli_close($mysql_link);
