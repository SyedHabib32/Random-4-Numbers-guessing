<?php

function autoGenerateNum()
    {
        $randno = array();

        $randno[] = rand(0, 9);
        $randno[] = rand(0, 9);
        $randno[] = rand(0, 9);
        $randno[] = rand(0, 9);

        return $randno;
    }

$attempt = array();
$attemptNum =0;
$values = array();


if (isset($_POST['submit'])) {
    // gets values from posts
    $values[] = $_POST['num1'];
    $values[] = $_POST['num2'];
    $values[] = $_POST['num3'];
    $values[] = $_POST['num4'];

    $attempt = $_POST['attempt']; // this is string coming from hidden field
    $randnumString = $_POST['randnum']; // this is string coming from hidden field

    $randnum = explode(',', $randnumString);

    // values are array now going to convert to string
    $valuesString = implode(',', $values);

    // atempt convert to array .....
    if (!empty($attempt)) {

        $attempt = explode('#', $attempt);
        $attempt[] = $valuesString;
    } else {
        $attempt = array();
        $attempt[] = $valuesString;

    }

    $attemptNum = count($attempt);

    if($attemptNum >= 10)
    print "<h3>You attempt too much</h3>"."<br>";

    print 'Attempts:<pre>';
    echo "<h2>".$attemptNum."</h2>";
    print '</pre>';


    print 'All attempts inserted values:<pre>';
    print_r($attempt);
    print '</pre>';

    // now we push new inserted values to this below array.

    print 'Last inserted Values:<pre>';
    print_r($values);
    print '</pre>';
}


$pos = "";

do {
    if ($pos == 4) {
        $attempt = null;
        $randnum = null;
        echo "<h2 id='matched'>Congrats! Your guess is matched </h2>";
        break;
    } else {

        if (empty($randnum))
            $randnum = autoGenerateNum();
        echo "<h1> Guess the Four digit: </h1>"."<br>";
        print 'Random No.:<pre>';
        print_r($randnum);
        print '</pre>';

        function guess($attempt, $randnum)
        {

            $attempt = implode('#', $attempt);
            $randnum = implode(',', $randnum);

            echo "<form method='post' id='form' autofill='off' action='index.php'>";
            echo "<input type='text' name='num1' maxlength='1' required/>" . "&nbsp;";
            echo "<input type='text' name='num2' maxlength='1' required/>" . "&nbsp;";
            echo "<input type='text' name='num3' maxlength='1' required/>" . "&nbsp;";
            echo "<input type='text' name='num4' maxlength='1' required/>" . "&nbsp;";
            echo "<input type='hidden' name='attempt' value='$attempt' maxlength='1'/>" . "&nbsp;";
            echo "<input type='hidden' name='randnum' value='$randnum' maxlength='1'/>" . "&nbsp;";
            echo "<input type='submit' name='submit' value='Submit'/>" . "&nbsp;";
            echo "<button onclick='resetWindow();' name='reset'>Reset</button>";
            echo "</form>";
            echo "<button onclick='resetWindow();' style='display:none;' id='reset' name='reset'>Reset</button>";
        }

        guess($attempt, $randnum);

        echo "<br>";

        $acc = "";
        $pos = "";
        // echo "loop start" . "<br>";
        // print_r($randnum);
        // echo "<br>";
            // gets values from posts
            $_POST['num1']='';
            $_POST['num2']='';
            $_POST['num3']='';
            $_POST['num4']='';
         if (isset($_POST['submit'])) {
                $values[] = $_POST['num1'];
                $values[] = $_POST['num2'];
                $values[] = $_POST['num3'];
                $values[] = $_POST['num4'];
        // print_r($values);
        for ($i = 0; $i < 4; $i++) {

            if ($values[$i] == $randnum[$i]) {
                $pos++;
                // echo "<br>". $values[$i] . "==" . $randnum[$i];
            }

        }

        $result=array_intersect($randnum,$values);
        // print_r($result);
         $acc = sizeof($result);
        echo("<br><h3>Accurance are:</h3><h2>". $acc."</h2>");
        echo("<h3>Match position are:</h3><h2> " . $pos."</h2>");

    }}
} while ($pos == 4);

?>
<script>

var attemptnum = "<?php echo $attemptNum ?>";
var pos="<?php echo $pos ?>";
if(attemptnum==10){
    document.getElementById("form").style.display="none";
    document.getElementById("reset").style.display="block";
}
if(pos==4){
        document.getElementById("matched").style.display="block";
        document.getElementById("form").style.display="none";
        document.getElementById("reset").style.display="block";
    }
console.log(attemptnum);
function resetWindow(){
    window.location = "index.php?debug=true";  
    };

</script>
