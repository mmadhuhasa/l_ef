<html>
    <head>
        <title> Custom Form Kit </title>      
    </head>
    <body>
    <center>
        <?php
        error_reporting(0);
        $merchant_data = '';
        $working_key = '729A0984E9B26F093AF8C360F571DB56'; //Shared by CCAVENUES
        $access_code = 'AVFM75FA60BH72MFHB'; //Shared by CCAVENUES

        foreach ($_POST as $key => $value) {
            $merchant_data .= $key . '=' . urlencode($value) . '&';
        }
        $encrypted_data = App\myfolder\ccAvenue::encrypt($merchant_data, $working_key); // Method for encrypting the data.
        ?>
        <form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
            {{csrf_field()}}
            <?php
            echo "<input type=hidden name=encRequest value=$encrypted_data>";
            echo "<input type=hidden name=access_code value=$access_code>";
            ?>            
        </form>
    </center>
    <script language='javascript'>document.redirect.submit();</script>
</body>
</html>

