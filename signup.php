<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1" name="viewport">
   <link href="img/family-logo.png" rel="icon">
   <title>Homies - signup</title>
   <link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet"><!-- Latest compiled and minified CSS -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"><!-- jQuery library -->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
   </script><!-- Latest compiled JavaScript -->

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
   </script>



   <script src="script/signup.js">
   </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js">
   </script>

   <link href="https://fonts.googleapis.com/css?family=Mina:700" rel="stylesheet">
   <link href="css/stylesheet.css" rel="stylesheet" type="text/css">
   <link href="css/signup.css" rel="stylesheet" type="text/css">
   
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	
	 <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">


   
</head><!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
<body>
   <header>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <nav class="navbar navbar-default" role="navigation">
                  <!-- Brand and toggle get grouped for better mobile display -->
                 <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Homies<span class="dot"></span></a>
                  </div>
                </nav>
            </div>
         </div>
      </div>
   </header>
   <main style="background-color:#efefef">
      <div class="box">

        <center>
		<br>
        <h1 style="background-color: #f05768; color:white; padding:6px; width:70%; border-radius:4px;">REGISTER</h1>
        <hr>
      </center>
         <!-- multistep form -->
            <form action="signup-success.php" method="POST" id="msform">
              <!-- progressbar -->
              <ul id="progressbar">
                <li class="active">Account Setup</li>
                <li>Personal Details</li>
                <li>FINISH</li>

              </ul>
              <!-- fieldsets -->
              <fieldset>
                <h1 class="fs-title">Create your account<h1>
                <h6 id="invalid-email-alert" style="color:red; display:none;">Invalid fields, Please fill all the required fields!</h6>
                <input required type="text" name="username" placeholder="Username" />                
                <input required type="email" name="email" placeholder="Email" />
                <input required id="userPass" type="password" name="password" placeholder="Password" minlength="6" maxlength="12">
                <input required id="confirm_pass" type="password" name="cpass" placeholder="Confirm Password" minlength="6" maxlength="12">
                <h6 id="pw-msg" style="display:none">password must be 6-12 numbers and characters</h6>
                <input type="button" name="next" class="next action-button" value="Next" />
              </fieldset>

              <fieldset>
                <h2 class="fs-title">Personal Details:</h2>
                <input required type="text" name="fname" placeholder="First Name" />
                <input required type="text" name="lname" placeholder="Last Name" />
                <div id="gender">
					<h3>Gender:</h3>
						<label>
							<img src="http://cdn.onlinewebfonts.com/svg/img_264370.png">
							<input checked type="radio" name='gender' value='male'> Male 
						</label>
						<label>
							<img src="https://cdn.onlinewebfonts.com/svg/img_361220.png">
							<input type="radio" name='gender' value='female'>Female 
						</label>
                </div>
                <div id="category">
	                <h3>Category:</h3>
	                <label>
	                  <img src="img/parent.png" alt="">
	                  <input type="radio" name="permission" value="1">Parent
	                </label>
	                <label>
	                  <img src="img/children.png" alt="">
	                  <input type="radio" name="permission" value="0">Child
	                </label>
                </div>
               <h4>Date of Birth</h4>
<select name="DOBDay">
  <option> - Day - </option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>

<select name="DOBMonth">
  <option> - Month - </option>
  <option value="01">January</option>
  <option value="02">Febuary</option>
  <option value="03">March</option>
  <option value="04">April</option>
  <option value="05">May</option>
  <option value="06">June</option>
  <option value="07">July</option>
  <option value="08">August</option>
  <option value="09">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
</select>
               
      <select name="birth-year">
        <option> - Year - </option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
  </select>
                <input style="display:block;margin:auto" type="button" name="previous" class="previous action-button" value="Previous" />
                <input type="submit" style="background-color:#27ae60" name="submit"  value="Submit" />


              </fieldset>
            </form>
      </div>


<script>
$(document).ready(function(){
	$("#pay_bills tr input").css("width","100%");
});
</script>
<br><br><br><br><br>
   </main>
   <footer>
     <center>
        Homies 2018©<br>
      Ilay Elazar | Noy Tsarfaty | Nadia Medavdovski
     </center>
   </footer>
</body>
</html>