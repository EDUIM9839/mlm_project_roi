
    <!--start page wrapper -->
    <style>
        body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f3f3;
    font-family: 'Arial', sans-serif;
}

.container {
    text-align: center;
}

h2 {
    font-size: 2rem;
    margin: 0;
    color: #333;
}

p {
    font-size: 1.5rem;
    color: #666;
}

.home-button {
    display: inline-block;
    margin-top: 0px;
    padding: 10px 20px;
    font-size: 1rem;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.home-button:hover {
    background-color: #0056b3;
}
.gif {
    margin: 0px 0;
    max-width: 55%;
    height: auto;
}

    </style>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suspend</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="page-content">
              <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
               
                <div class="ps-3">
                   
                </div>
                
            </div>
    <div class="container">
        <img src="{{ Storage::url('app/gif/suspendss.gif')}}" alt="Not Found" class="gif">
        <h2>Hey!! {{$username}}</h2>
        <h2 style="color:red;">Your Id has been Suspended!!</h2>
        <p>Sorry, You can not login your account, Please contact to <b><i>Binary Circle </i></b>Support Team.</p>
        <a href="/" class="home-button">Go to Homepage</a>
    </div>
    </div>
    </div>
</body>
</html>

