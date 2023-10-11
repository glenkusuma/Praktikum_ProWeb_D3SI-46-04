<?php
if (isset($_POST['highlight'])) {
// Form inputs
$paragraph =  $_POST['paragraph'];
$find_string = $_POST['find_string'];

// Highlight the found string in yellow
$highlighted_paragraph = preg_replace('/' . $find_string . '/i', '<span style="color: 
blue;">$0</span>', $paragraph);
}
?>
<!-- Display the highlighted paragraph -->
<h3> Highlighted paragraph </h3>
<?= isset($highlighted_paragraph) ? $highlighted_paragraph : ''?>
<br>
<br>
<table>
<form action="<?php htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
    <tr>
        <td>paragraph</td>
        <td><textarea name="paragraph" rows="10" cols="50"></textarea></td>
    </tr>
    <tr>
        <td>find_string</td>
        <td><input type="text" name="find_string" placeholder="Enter the string to find"></td>
    </tr>
    <tr>
        <td></td>
        <td><input name="highlight" type="submit" value="highlight"></td>
    </tr>
</form>
</table>
