<?php
    require('config.php');

    if($connect->connect_errno)
    {
        echo '<div class="alert alert-danger  col-lg-6" role="alert">Database connection error.</div>';
    } else 
    {
        if(isset($_POST['formSubmitted']))
        {           
            $file = addslashes(file_get_contents($_FILES['FormControlFile']['tmp_name']));

            $user_name = test_input($_POST['name']);
            $user_email = test_input($_POST['email']);
            $user_title = test_input($_POST['title']);
            $title_description = test_input($_POST['description']);

            $query = "INSERT INTO image(image,name,email,title,description) VALUES ('$file','$user_name','$user_email','$user_title','$title_description')";
            $result = $connect->query($query,MYSQLI_STORE_RESULT);
            mysqli_close($connect);
        
            header('location:react_index.php');
            exit;
            
        }    

}
    
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
            
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="main.css" rel="stylesheet">
    <title>React - Template</title>
    
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/react/16.7.0-alpha.2/umd/react.development.js"
      crossorigin
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/16.7.0-alpha.2/umd/react-dom.production.min.js"
      crossorigin
    ></script>
    <script crossorigin src="browser.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>


<div class="grid-container">
  <div  id="root"></div>
  <div  id="output"></div>
</div>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</body>
</html>

<script type="text/babel">

class GetUserInfo extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            userInfo:[]
        }

        this.getInfo = this.getInfo.bind(this);
    }

    getInfo(e){
        e.preventDefault();
        let request = new XMLHttpRequest();
        request.open('POST','get_user_info.php',true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onload = ()=>{
            const results = request.response;
            
            this.setState({
                userInfo:results
            });
            
            const show = this.state.userInfo; 
            document.getElementById('output').innerHTML = show;   
        }
        request.send();
    }

    render(){
        
        return  <form method="POST" action="get_user_info.php">
                    <input type="submit" id="displayBtn" onClick={this.getInfo} className="btn btn-success" value="Display"/>
                </form>
                
    }
}
ReactDOM.render(<GetUserInfo/>,document.getElementById('output'));


class FormInput extends React.Component{

    render(){
        
        return (
            <div>
                <form method="POST" enctype="multipart/form-data">
                    <div className="form-group">
                        <input type="file" class="form-control-file" name="FormControlFile" id="FormControlFile" required/>
                    </div>

                    <div className="form-group">
                        <label for="InputName">Name</label>
                        <input type="text" class="form-control" id="InputName" aria-describedby="name" name="name" placeholder="Enter name" required/>  
                    </div>

                    <div class="form-group">
                        <label for="InputEmail">Email address</label>
                        <input type="email" class="form-control"  id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter email" required/>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div className="form-group">
                        <label for="InputJobTitle">Job Title</label>
                        <input type="text" class="form-control" id="InputJobTitle" name="title" aria-describedby="jobTitle" placeholder="Enter Job title" required/>  
                    </div>

                    <div class="form-group">
                        <label for="FormControlTextarea">Brief description</label>
                        <textarea class="form-control" id="FormControlTextarea" name="description" rows="3"  wrap="hard"  required></textarea>
                    </div>
                    <button type="submit" name="formSubmitted" class="btn btn-primary">Submit</button>
                </form>
            </div>
        )
    }
}
ReactDOM.render(<FormInput/>,document.getElementById('root'));
