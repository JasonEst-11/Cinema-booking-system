<html>
    <head>
        <title>register</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body > 
        <div class="container d-flex justify-content-center bg-primary"> 
            <div class="card align-middle bg-warning" style='width: 400px;height: 500px;'>    
            <h1>Registration form</h1>           
                <form method="POST" action="../includes/functions.inc.php" target="_self">
                    <div class="mb-3">
                        <label for="Formcontrolemail">Email address</label>
                        <input type="email" class="form-control" id="Formcontrolemail" name="email"/>
                    </div>              

                    <div class="mb-3">
                        <label for="Formcontrolpassword">Password</label>
                        <input type="password" class="form-control" id="Formcontrolpassword" name="pass"/>
                    </div>

                    <div class="mb-3">
                        <label for="Formcontrolpassword">Full name</label>
                        <input type="text" class="form-control" id="Formcontrolpassword" name="fname"/>
                    </div>

                    <div class="mb-3">
                        <label for="Formcontrolphone">Phone</label>
                        <input type="tel" class="form-control" id="Formcontrolphone" name="phone"/>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn-primary" name="register">Submit</button>
                    </div>
                </form>
                <a href="index.php"><-Back</a> 
            </div>
        </div>
    </body>
</html>