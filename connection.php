<?php
 $db = mysqli_connect('localhost', 'root', '','emp_backend') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'emp_backend' ) or die(mysqli_error($db));
