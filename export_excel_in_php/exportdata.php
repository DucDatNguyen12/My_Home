<?php
$con = mysqli_connect('localhost', 'root', '', 'export_excel');

$output = '';
if (isset($_POST['export'])) {
    $qry = "SELECT * FROM user_detail";
    $res = mysqli_query($con,  $qry);
    if (mysqli_num_rows($res) > 0) {
        $output .= '
                <table border="1" id="example>
                <thead>
                <th style="width: 200px;">Name</th>
                <th style="width: 300px;">Emal</th>
                <th style="width: 200px;">Photo</th>
                </thead>
            ';

        while ($data = mysqli_fetch_array($res)) {
            $name = $data['name'];
            $email = $data['email'];
            $dp = $data['dp'];

            $output .= '
                    <tr style="height: 110px;">
                        <td>' . $name . '</td>
                        <td>' . $email . '</td>
                        <td><img  style="width:100px; height:100px;" src="http://localhost/export_excel_in_php/' . $dp . '" ></td>
                    </tr>
                ';
        }

        $output .= '</tbody></table>';
        header('Content-Type: application/force-download');
        header('Content-Disposition: attachment; filename=UserData.xls');
        header('Content-Transfer-Encoding: BINARY');

        echo $output;
    } else {
        echo '
            <script type="text/javascript">
                alert("Recode Not Found! Select Corrent Data Range");
                window.location.href = "index.php";
            </script>
            ';
    }
}
?>

<style>
    /* @media print {
        img {
            height: 120px;
            width: 100px;
        }
    } */
</style>