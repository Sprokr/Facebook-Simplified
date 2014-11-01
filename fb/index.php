
<?php include('project_header.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simplified Facebook  </title>
</head>

<body>
<form action="project_transact_user.php" method="post">
<table style="height: 300px;">
                                    <tr bgcolor="#99CC00">
                                        <td  align="center" width="20%">
                                            LOGIN
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td>
                                            Not Already member? <a href="registration.php"><font color="#0099FF"><u>Register Now.</u></font></a> It's free
                                        </td>

                                    </tr>
                                    <tr align="center">
                                        <td>&nbsp;
                                            
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td >
                                            E-mail Address
                                        </td>

                                    </tr>
                                    <tr align="center">
                                        <td>
                                            <input name="email" id="email" type="email" required>
                                            <span id="email" style="color:Red;visibility:hidden;">*</span>
                                        </td>
                                    </tr>
                                    <tr align="center">

                                        <td class="running" align="center">
                                            Password
            
                                        </td>
                                    </tr>
                                    <tr align="center">
                                        <td align="center">
                                            <input name="password" id="password" type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                                           
                                            <span id="password" style="color:Red;visibility:hidden;">*</span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="submit" name="action" src="imgnew/login.jpg" style="border-color: rgb(0, 0, 0); height: 22px; width: 15%; border-width: 0px;" value="Login" type="image">
                                            
                                        </td>
                                    </tr>
</table>

</form>

</body>
</html>
<?php
include('project_footer.php');

?>
